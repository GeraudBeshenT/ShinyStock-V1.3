<?php
/***********************************************

Fichier AjaxFiles pour l'affichage de la table Article

***********************************************/


/* Liaison des fichier de classe */

include '../bdd.class.inc.php';
include '../all.class.inc.php';

$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length'];
$columnIndex = $_POST['order'][0]['column'];
$columnName = $_POST['columns'][$columnIndex]['data'];
$columnSortOrder = $_POST['order'][0]['dir'];
$searchValue = $_POST['search']['value'];

$searchArray = array();

$searchQuery = " ";
if ($searchValue != '') {
    $searchQuery = " AND (id_tarif LIKE :id_tarif) "
			. "OR (lib_tarif LIKE :lib_tarif) "
			. "OR (Nom_article LIKE :Nom_article) "
			. "OR (montant LIKE :montant)";
    $searchArray = array(
        'id_tarif' => "%$searchValue%",
		'lib_tarif' => "%$searchValue%",
		'Nom_article' => "%$searchValue%",
		'montant' => "%$searchValue%"
    );
}


/* Création de l'objet Article */

$ob = new Payer();

$totalRecords = $ob->CountPayerBDD($conn);
$totalRecordwithFilter = $ob->CountParamPayerBDD($conn,$searchQuery,$searchArray);


/* Déclaration de la requête de sélection pour l'affichage de la table Article */

$stmt = $conn->prepare("SELECT * FROM `payer` INNER JOIN article ON payer.id_article = article.id_article INNER JOIN tarif ON payer.id_tarif=tarif.id_tarif WHERE b_suppayer = 0" . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

/*SELECT id_article, Nom_article, Sous_fam, ref_four, Genrod, Frais, qte_cde_fou, Qte_stock, cpt_ac, cpt_ve_M, cpt_ve_M, cpt_ve_C, cpt_ve_OM, cpt_ve_E, cpt_ve_CEE, commentaire, Reference, lib_categorie, description, nom_article AS Composition, b_suparticle FROM article INNER JOIN catégorie ON article.id_categorie = catégorie.id_categorie LEFT JOIN compose ON article.id_article = compose.id_article_produit WHERE b_suparticle = 0 -- AND b_supcompose = 0*/

foreach ($searchArray as $key => $search) {
    $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int) $row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int) $rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();
// Ligne action contentant les boutons modifier supprimer
// Boucle affichant toutes les lignes donc la valeur b_suparticle est affiché
// Bouton dont la valeur est = à l'idée de la ligne selectionné & la valeur est MODIFIER
// Bouton Supprimer qui renvoie au fichier de traitement grâce à l'id de la ligne selectionnée
foreach ($empRecords as $row) {
    if ($row['b_suppayer'] == 0) {
        $data[] = array(
			"id_tarif" => $row['id_tarif'],
            "lib_tarif" => $row['lib_tarif'],
			"Nom_article" => $row['Nom_article'],
            "montant" => $row['montant'],
            "actions" => "<div class='btn-group'>"
            ."<form method='POST' action='traitementPayer.php'>"
                . "<button type='submit' class='btn btn-danger rounded-pill'><i class='fa fa-trash'></i></button>"
                . "<input name='id' type='hidden' value='" . $row['id_tarif'] . "'/>"
                . "<input name='type' type='hidden' value='Payer'/>"
                . "<input name='action' type='hidden' value='supprimer'/>"
            . "</form> &nbsp"
            . "<form method='POST' action='modifPayer.php'>"
                . "<button type='submit' class='btn btn-primary rounded-pill'><i class='fa fa-edit'></i></button>"
                . "<input name='id' type='hidden' value='" . $row['id_tarif'] . "'/>"
                . "<input name='type' type='hidden' value='Payer'/>"
                . "<input name='action' type='hidden' value='modifier'/>"
            . "</form> &nbsp"
			. "</div>",
        );
    }
}

$response = array(
    "draw" => intval($draw),
    "iTotalRecords" => $totalRecords,
    "iTotalDisplayRecords" => $totalRecordwithFilter,
    "aaData" => $data
);

echo json_encode($response);
?>