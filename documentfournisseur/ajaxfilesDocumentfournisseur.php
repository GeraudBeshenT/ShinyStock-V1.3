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
    $searchQuery = " AND (iddocumentfournisseur LIKE :iddocumentfournisseur "
            . "OR datedocfournisseur LIKE :datedocfournisseur "
            . "OR statutfournisseur LIKE :statutfournisseur "
            . "OR commentairefournisseur LIKE :commentairefournisseur ";
    $searchArray = array(
        'iddocumentfournisseur' => "%$searchValue%",
        'datedocfournisseur' => "%$searchValue%",
        'statutfournisseur' => "%$searchValue%",
        'commentairefournisseur' => "%$searchValue%"
    );
}

$ob = new Documentfournisseur();

$totalRecords = $ob->CountBDD($conn);
$totalRecordwithFilter = $ob->CountParamBDD($conn,$searchQuery,$searchArray);

$stmt = $conn->prepare("SELECT * FROM documentfournisseur INNER JOIN etat ON etat.idetat = documentfournisseur.idetat INNER JOIN fournisseur ON documentfournisseur.idfournisseur = fournisseur.idfournisseur WHERE supdocumentfournisseur = 0 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

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
    if ($row['supdocumentfournisseur'] == 0) {
        $data[] = array(
            "iddocumentfournisseur" => $row['iddocumentfournisseur'],
            "datedocfournisseur" => $row['datedocfournisseur'],
            "statutfournisseur" => $row['statutfournisseur'],
            "commentairefournisseur" => $row['commentairefournisseur'],
            "idetat" => $row['idetat'],
            "libetat" => $row['libetat'],
            "idfournisseur" => $row['idfournisseur'],
            "nomfournisseur" => $row['nomfournisseur'],
            "actions" => "<div class='btn-group'>"
            . "<form method='POST' action='modifDocumentfournisseur.php'>"
                . "<button type='submit' class='btn btn-primary rounded-pill'><i class='fa fa-edit'></i></button>"
                . "<input name='iddocumentfournisseur' type='hidden' value='" . $row['iddocumentfournisseur'] . "'/>"
                . "<input name='type' type='hidden' value='Document'/>"
                . "<input name='action' type='hidden' value='modifier'/>"
            . "</form> &nbsp"
            ."<form method='POST' action='traitementDocumentfournisseur.php'>"
                . "<button type='submit' class='btn btn-danger rounded-pill'><i class='fa fa-trash'></i></button>"
                . "<input name='iddocumentfournisseur' type='hidden' value='" . $row['iddocumentfournisseur'] . "'/>"
                . "<input name='type' type='hidden' value='Document'/>"
                . "<input name='action' type='hidden' value='supprimer'/>"
            . "</form>"
            . "</div>",
            "detail" => "<div class='btn-group'>"
            . "<form method='POST' action='detailfournisseur.vue.php?iddocumentfournisseur=".$row['iddocumentfournisseur']."'>"
                . "<button type='submit' class='btn btn-success rounded-pill'><i class='fa fa-eye'></i></button>"
                . "<input name='type' type='hidden' value='Document'/>"
                . "<input name='iddocumentfournisseur' type='hidden' value='" . $row['iddocumentfournisseur'] . "'/>"
                . "<input name='action' type='hidden' value='modifier'/>"
            . "</form>"
            . "</div>",
            "export" => "<div class='btn-group'>"
            . "<form method='POST' action='./FPDF/pdfarticles.php' target='_blank'>"
                . "<button type='submit' class='btn btn-warning rounded-pill'>PDF</button>"
                . "<input name='iddocumentfournisseur' type='hidden' value='" . $row['iddocumentfournisseur'] . "'/>"
                . "<input name='type' type='hidden' value='Document'/>"
                . "<input name='action' type='hidden' value='modifier'/>"
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