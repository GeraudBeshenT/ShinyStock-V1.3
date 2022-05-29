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
    $searchQuery = " AND (iddetailfournisseur LIKE :iddetailfournisseur)
                    OR (datedocfournisseur LIKE :datedocfournisseur)";
    $searchArray = array(
        'iddetailfournisseur' => "%$searchValue%",
        'datedocfournisseur' => "%$searchValue%"
    );
}

$ob = new Detailfournisseur();

$totalRecords = $ob->CountBDD($conn);
$totalRecordwithFilter = $ob->CountParamBDD($conn,$searchQuery,$searchArray);

$stmt = $conn->prepare("SELECT * FROM detailfournisseur INNER JOIN documentfournisseur ON documentfournisseur.iddocumentfournisseur = detailfournisseur.iddocumentfournisseur INNER JOIN article ON article.idarticle = detailfournisseur.idarticle WHERE supdetailfournisseur = 0 AND detailfournisseur.iddocumentfournisseur = " . $_GET['iddocumentfournisseur'] . " " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

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
    if ($row['supdetailfournisseur'] == 0) {
        $data[] = array(
            "iddetailfournisseur" => $row['iddetailfournisseur'],
            "iddocumentfournisseur" => $row['iddocumentfournisseur'],
            "datedocfournisseur" => $row['datedocfournisseur'],
            "idarticle" => $row['idarticle'],
            "libarticle" => $row['libarticle'],
            "qteachat" => $row['qteachat'],
            "actions" => "<div class='btn-group'>"
            . "<form method='POST' action='modifDetailfournisseur.php'>"
                . "<button type='submit' class='btn btn-primary rounded-pill'><i class='fa fa-edit'></i></button>"
                . "<input name='iddetailfournisseur' type='hidden' value='" . $row['iddetailfournisseur'] . "'/>"
                . "<input name='type' type='hidden' value='Detail'/>"
                . "<input name='action' type='hidden' value='modifier'/>"
            . "</form> &nbsp"
            ."<form method='POST' action='traitementDetailfournisseur.php'>"
                . "<button type='submit' class='btn btn-danger rounded-pill'><i class='fa fa-trash'></i></button>"
                . "<input name='iddetailfournisseur' type='hidden' value='" . $row['iddetailfournisseur'] . "'/>"
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