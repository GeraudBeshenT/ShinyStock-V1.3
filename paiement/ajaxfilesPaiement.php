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
    $searchQuery = " AND (idpaiement LIKE :idpaiement) "
            . "OR (libpaiement LIKE :libpaiement)";
    $searchArray = array(
        'idpaiement' => "%$searchValue%",
        'libpaiement' => "%$searchValue%"
    );
}
// D'après la classe societe, selection de toutes les données de la table état
$ob = new Paiement();

$totalRecords = $ob->CountBDD($conn);
$totalRecordwithFilter = $ob->CountParamBDD($conn,$searchQuery,$searchArray);

$stmt = $conn->prepare("SELECT * FROM paiement WHERE suppaiement = 0 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

foreach ($searchArray as $key => $search) {
    $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int) $row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int) $rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();
// Boucle modifier supprimé qui se répète sur toutes les lignes du tableau.
// Récupération de l'idpaiement, formulaire de modification/suppression qui envoient les données dans les fichiers modipaiement/tratiementpaiement.
foreach ($empRecords as $row) {
    if ($row['suppaiement'] == 0) {
        $data[] = array(
            "idpaiement" => $row['idpaiement'],
            "libpaiement" => $row['libpaiement'],
             "actions" => "<div class='btn-group'>"
            ."<form method='POST' action='traitementPaiement.php'>"
                . "<button type='submit' class='btn btn-danger rounded-pill'><i class='fa fa-trash'></i></button>"
                . "<input name='idpaiement' type='hidden' value='" . $row['idpaiement'] . "'/>"
                . "<input name='type' type='hidden' value='paiement'/>"
                . "<input name='action' type='hidden' value='supprimer'/>"
            . "</form> &nbsp"
            . "<form method='POST' action='modifPaiement.php'>"
                . "<button type='submit' class='btn btn-primary rounded-pill'><i class='fa fa-edit'></i></button>"
                . "<input name='idpaiement' type='hidden' value='" . $row['idpaiement'] . "'/>"
                . "<input name='type' type='hidden' value='paiement'/>"
                . "<input name='action' type='hidden' value='modifier'/>"
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