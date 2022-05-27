<?php
// Lien de connection à la base de donnée et les différentes classes créées.
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
// barre de recherche
$searchQuery = " ";
if ($searchValue != '') {
    $searchQuery = " AND (idfournisseur LIKE :idfournisseur) "
            . "OR (nomfournisseur LIKE :nomfournisseur)"
            . "OR (adressefournisseur LIKE :adressefournisseur)"
            . "OR (emailfournisseur LIKE :emailfournisseur)"
            . "OR (telephonefournisseur LIKE :telephonefournisseur)";
    $searchArray = array(
        'idfournisseur' => "%$searchValue%",
        'nomfournisseur' => "%$searchValue%",
        'adressefournisseur' => "%$searchValue%",
        'emailfournisseur' => "%$searchValue%",
        'telephonefournisseur' => "%$searchValue%"
    );
}
// D'après la classe societe, selection de toutes les données de la table état
$ob = new Fournisseur();

$totalRecords = $ob->CountBDD($conn);
$totalRecordwithFilter = $ob->CountParamBDD($conn,$searchQuery,$searchArray);

$stmt = $conn->prepare("SELECT * FROM fournisseur INNER JOIN commune ON commune.idcommune = fournisseur.idcommune INNER JOIN societe ON societe.idsociete = fournisseur.idsociete INNER JOIN paiement ON paiement.idpaiement = fournisseur.idpaiement WHERE supfournisseur = 0 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

foreach ($searchArray as $key => $search) {
    $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int) $row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int) $rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();
// Boucle modifier supprimé qui se répète sur toutes les lignes du tableau.
// Récupération de l'idfournisseur, formulaire de modification/suppression qui envoient les données dans les fichiers modifournisseur/tratiementfournisseur.
foreach ($empRecords as $row) {
    if ($row['supfournisseur'] == 0) {
        $data[] = array(
            "idfournisseur" => $row['idfournisseur'],
            "nomfournisseur" => $row['nomfournisseur'],
            "adressefournisseur" => $row['adressefournisseur'],
            "telephonefournisseur" => $row['telephonefournisseur'],
            "emailfournisseur" => $row['emailfournisseur'],
            "libcommune" => $row['libcommune'],
            "codefournisseur" => $row['codefournisseur'],
            "libpaiement" => $row['libpaiement'],
            "actions" => "<div class='btn-group'>"
            // bouton détail
            . "<form method='POST' action='fournisseur.php'>"
                . "<button type='submit' class='btn btn-success rounded-pill'><i class='fa fa-search'></i></button>"
                . "<input name='idfournisseur' type='hidden' value='" . $row['idfournisseur'] . "'/>"
                . "<input name='type' type='hidden' value='fournisseur'/>"
                . "<input name='action' type='hidden' value='voir'/>"
            . "</form> &nbsp"
            . "<form method='POST' action='modiffournisseur.php'>"
                . "<button type='submit' class='btn btn-primary rounded-pill'><i class='fa fa-edit'></i></button>"
                . "<input name='idfournisseur' type='hidden' value='" . $row['idfournisseur'] . "'/>"
                . "<input name='type' type='hidden' value='fournisseur'/>"
                . "<input name='action' type='hidden' value='modifier'/>"
            . "</form> &nbsp"
            ."<form method='POST' action='traitementfournisseur.php'>"
                . "<button type='submit' class='btn btn-danger rounded-pill'><i class='fa fa-trash'></i></button>"
                . "<input name='idfournisseur' type='hidden' value='" . $row['idfournisseur'] . "'/>"
                . "<input name='type' type='hidden' value='fournisseur'/>"
                . "<input name='action' type='hidden' value='supprimer'/>"
            . "</form></div>",
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