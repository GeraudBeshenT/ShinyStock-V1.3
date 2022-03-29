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
    $searchQuery = " AND (libcasier LIKE :libcasier "
            . "OR libarticle LIKE :libarticle)";
    $searchValue = str_replace(" ","%%",$searchValue);
    $searchArray = array(
        'libcasier' => "%$searchValue%",
        'libarticle' => "%$searchValue%"
    );
}

$ob = new Casier();

$totalRecords = $ob->CountBDD($conn);
$totalRecordwithFilter = $ob->CountParamBDD($conn,$searchQuery,$searchArray);

$stmt = $conn->prepare("SELECT *
                FROM casier
                INNER JOIN article ON casier.idarticle = article.idarticle
                WHERE supcasier = 0 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");
foreach ($searchArray as $key => $search) {
    $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int) $row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int) $rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();

foreach ($empRecords as $row) {
    if ($row['supcasier'] == 0) {
        $data[] = array(
            "idcasier" => $row['idcasier'],
            "libcasier" => $row['libcasier'],
            "idarticle" => $row['idarticle'],
            "libarticle" => $row['libarticle'],
            "actions" => "<div class='btn-group'>"
            // bouton modifier
            . "<form method='POST' action='modifCasier.php'>"
                . "<button type='submit' class='btn btn-primary rounded-pill'><i class='fa fa-edit'></i></button>"
                . "<input name='idcasier' type='hidden' value='" . $row['idcasier'] . "'/>"
                . "<input name='type' type='hidden' value='Casier'/>"
                . "<input name='action' type='hidden' value='modifier'/>"
                . "</form> &nbsp"
                // Bouton supprimer
            ."<form method='POST' action='traitementCasier.php'>"
                . "<button type='submit' class='btn btn-danger rounded-pill'><i class='fa fa-trash'></i></button>"
                . "<input name='idcasier' type='hidden' value='" . $row['idcasier'] . "'/>"
                . "<input name='type' type='hidden' value='Casier'/>"
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