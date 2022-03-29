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
    $searchQuery = " AND (reference LIKE :reference)"
			. "OR (libcategorie LIKE :libcategorie)"
			. "OR (description LIKE :description)"
			. "OR (codedouane LIKE :codedouane)";
    $searchArray = array(
		'reference' => "%$searchValue%",
        'libcategorie' => "%$searchValue%",
		'description' => "%$searchValue%",
		'codedouane' => "%$searchValue%",
    );
}

$ob = new Categorie();

$totalRecords = $ob->CountBDD($conn);
$totalRecordwithFilter = $ob->CountParamBDD($conn,$searchQuery,$searchArray);

$stmt = $conn->prepare("SELECT * FROM categorie WHERE supcategorie = 0 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");


foreach ($searchArray as $key => $search) {
    $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int) $row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int) $rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();

foreach ($empRecords as $row) {
    if ($row['supcategorie'] == 0) {
        $data[] = array(
			"idcategorie" => $row['idcategorie'],
            "reference" => $row['reference'],
            "libcategorie" => $row['libcategorie'],
            "description" => $row['description'],
			"codedouane" => $row['codedouane'],
             "actions" => "<div class='btn-group'>"
            ."<form method='POST' action='traitementCategorie.php'>"
                . "<button type='submit' class='btn btn-danger rounded-pill'><i class='fa fa-trash'></i></button>"
                . "<input name='idcategorie' type='hidden' value='" . $row['idcategorie'] . "'/>"
                . "<input name='type' type='hidden' value='Categorie'/>"
                . "<input name='action' type='hidden' value='supprimer'/>"
            . "</form> &nbsp"
            . "<form method='POST' action='modifCategorie.php'>"
                . "<button type='submit' class='btn btn-primary rounded-pill'><i class='fa fa-edit'></i></button>"
                . "<input name='idcategorie' type='hidden' value='" . $row['idcategorie'] . "'/>"
                . "<input name='type' type='hidden' value='Categorie'/>"
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















