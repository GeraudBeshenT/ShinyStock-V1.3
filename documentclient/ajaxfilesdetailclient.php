<?php

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
    $searchQuery = " AND (iddetailclient LIKE :iddetailclient)
                    OR (datedocclient LIKE :datedocclient)";
    $searchArray = array(
        'iddetailclient' => "%$searchValue%",
        'datedocclient' => "%$searchValue%"
    );
}

$ob = new Detailclient();

$totalRecords = $ob->CountBDD($conn);
$totalRecordwithFilter = $ob->CountParamBDD($conn,$searchQuery,$searchArray);

$stmt = $conn->prepare("SELECT * FROM detailclient INNER JOIN documentclient ON documentclient.iddocumentclient = detailclient.iddocumentclient INNER JOIN article ON article.idarticle = detailclient.idarticle WHERE supdetailclient = 0 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

foreach ($searchArray as $key => $search) {
    $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int) $row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int) $rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();
// Boucle modifier supprimé qui se répète sur toutes les lignes du tableau.
// Récupération de l'idclient, formulaire de modification/suppression qui envoient les données dans les fichiers modiclient/tratiementclient.
foreach ($empRecords as $row) {
    if ($row['supdetailclient'] == 0) {
        $data[] = array(
            "iddetailclient" => $row['iddetailclient'],
            "iddocumentclient" => $row['iddocumentclient'],
            "datedocclient" => $row['datedocclient'],
            "idarticle" => $row['idarticle'],
            "libarticle" => $row['libarticle'],
            "qteachat" => $row['qteachat'],
            "actions" => "<div class='btn-group'>"
            . "<form method='POST' action='modifDetailclient.php'>"
                . "<button type='submit' class='btn btn-primary rounded-pill'><i class='fa fa-edit'></i></button>"
                . "<input name='iddetailclient' type='hidden' value='" . $row['iddetailclient'] . "'/>"
                . "<input name='type' type='hidden' value='Detail'/>"
                . "<input name='action' type='hidden' value='modifier'/>"
            . "</form> &nbsp"
            ."<form method='POST' action='traitementDetailclient.php'>"
                . "<button type='submit' class='btn btn-danger rounded-pill'><i class='fa fa-trash'></i></button>"
                . "<input name='iddetailclient' type='hidden' value='" . $row['iddetailclient'] . "'/>"
                . "<input name='type' type='hidden' value='Detail'/>"
                . "<input name='action' type='hidden' value='supprimer'/>"
            . "</form>"
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