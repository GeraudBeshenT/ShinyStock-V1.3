<?php

include '../../bdd.class.inc.php';
include '../../all.class.inc.php';

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
    $searchQuery = " AND (iddetailfournisseur LIKE :iddetailfournisseur ";
    $searchArray = array(
        'iddetailfournisseur' => "%$searchValue%"
    );
}

$ob = new Documentfournisseur();

$totalRecords = $ob->CountBDD($conn);
$totalRecordwithFilter = $ob->CountParamBDD($conn,$searchQuery,$searchArray);

$stmt = $conn->prepare("SELECT * FROM detailfournisseur INNER JOIN article ON article.idarticle = detailfournisseur.idarticle WHERE supdetailfournisseur = 0 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

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
            "idarticle" => $row['idarticle'],
            "iddocumentfournisseur" => $row['iddocumentfournisseur'],
            "qtearticle" => $row['qtearticle'],
            "actions" => "<div class='btn-group'>"
            . "<form method='POST' action='modifDocumentfournisseur.php'>"
                . "<button type='submit' class='btn btn-primary rounded-pill'><i class='fa fa-edit'></i></button>"
                . "<input name='iddetailfournisseur' type='hidden' value='" . $row['iddetailfournisseur'] . "'/>"
                . "<input name='type' type='hidden' value='Document'/>"
                . "<input name='action' type='hidden' value='modifier'/>"
            . "</form> &nbsp"
            ."<form method='POST' action='traitementDocumentfournisseur.php'>"
                . "<button type='submit' class='btn btn-danger rounded-pill'><i class='fa fa-trash'></i></button>"
                . "<input name='iddetailfournisseur' type='hidden' value='" . $row['iddetailfournisseur'] . "'/>"
                . "<input name='type' type='hidden' value='Document'/>"
                . "<input name='action' type='hidden' value='supprimer'/>"
            . "</form></div>",
            "plus" => "<div class='btn-group'>"
            // bouton détail
            . "<form method='POST' action='detail.vue.php'>"
                . "<button type='submit' class='btn btn-info rounded-pill'><i class='fa fa-plus'></i></button>"
                . "<input name='iddetailfournisseur' type='hidden' value='" . $row['iddetailfournisseur'] . "'/>"
                . "<input name='type' type='hidden' value='Document'/>"
                . "<input name='action' type='hidden' value='voir'/>"
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