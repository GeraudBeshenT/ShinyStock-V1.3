<?php
/***********************************************

Partie Produit confiée à Géraud BESSON

***********************************************/
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
    $searchQuery = " AND (id_article_article LIKE :id_article_article) "
			. "OR (nom_article LIKE :nom_article)"
            . "OR (qte_article LIKE :qte_article)"
            . "OR (Qte_stock LIKE :Qte_stock)"
			. "OR (b_supcompose LIKE :b_supcompose)";
    $searchArray = array(
        'id_article_article' => "%$searchValue%",
		'nom_article' => "%$searchValue%",
        'qte_article' => "%$searchValue%",
        'Qte_stock' => "%$searchValue%",
		'b_supcompose' => "%$searchValue%"
    );
}

$ob = new Produit();

$totalRecords = $ob->CountProduitBDD($conn);
$totalRecordwithFilter = $ob->CountProduitParamBDD($conn,$searchQuery,$searchArray);

$stmt = $conn->prepare("SELECT id_article_article, nom_article, qte_article, Qte_stock, b_supcompose FROM `compose` INNER JOIN article ON compose.id_article_article = article.id_article WHERE b_supcompose = 0 AND id_article_produit = " . $_GET['id_article_produit'] . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

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
    if ($row['b_supcompose'] == 0) {
        $data[] = array(
            "id_article_article" => $row['id_article_article'],
			"nom_article" => $row['nom_article'],
            "qte_article" => $row['qte_article'],
            "Qte_stock" => $row['Qte_stock'],
            "actions" => "<div class='btn-group'>"
            ."<form method='POST' action='traitementProduit.php'>"
                . "<button type='submit' class='btn btn-danger rounded-pill'><i class='fa fa-trash'></i></button>"
                . "<input name='id' type='hidden' value='" . $row['id_article_article'] . "'/>"
                . "<input name='type' type='hidden' value='Article'/>"
                . "<input name='action' type='hidden' value='supprimer'/>"
            . "</form> &nbsp"
            . "<form method='POST' action='modifProduit.php'>"
                . "<button type='submit' class='btn btn-primary rounded-pill'><i class='fa fa-edit'></i></button>"
                . "<input name='id' type='hidden' value='" . $row['id_article_article'] . "'/>"
                . "<input name='type' type='hidden' value='Article'/>"
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