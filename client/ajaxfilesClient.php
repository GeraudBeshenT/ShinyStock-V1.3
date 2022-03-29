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
    $searchQuery = " AND (nom LIKE :nom "
            . "OR adresse LIKE :adresse)";
    $searchValue = str_replace(" ","%%",$searchValue);
    $searchArray = array(
        'nom' => "%$searchValue%",
        'adresse' => "%$searchValue%"
    );
}


$ob = new Clients();

$totalRecords = $ob->CountBDD($conn);
$totalRecordwithFilter = $ob->CountParamBDD($conn,$searchQuery,$searchArray);

$stmt = $conn->prepare("SELECT *
                FROM tiers
                INNER JOIN tarif ON tiers.idtarif = tarif.idtarif
                INNER JOIN commune ON tiers.idcommune = commune.idcommune
                INNER JOIN paiement ON tiers.idpaiement = paiement.idpaiement
                WHERE suptiers = 0 AND typetiers = 0 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");
foreach ($searchArray as $key => $search) {
    $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int) $row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int) $rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();

foreach ($empRecords as $row) {
    if ($row['suptiers'] == 0) {
        $data[] = array(
            "idtiers" => $row['idtiers'],
            "nom" => $row['nom'],
            "adresse" => $row['adresse'],
            "telephone" => $row['telephone'],
			"email" => $row['email'],
			"libcommune" => $row['libcommune'],
            "prefixe" => $row['prefixe'],
            "indicprospect" => $row['indicprospect'],
            "iban" => $row['iban'],
            "bic" => $row['bic'],
            "codebanque" => $row['codebanque'],
            "codeguichet" => $row['codeguichet'],
            "ncompte" => $row['ncompte'],
            "clerib" => $row['clerib'],
            "domiciliation" => $row['domiciliation'],
            "tel2" => $row['tel2'],
            "libtarif" => $row['libtarif'],
            "libpaiement" => $row['libpaiement'],
            "libtarif" => $row['libtarif'],
            "actions" => "<div class='btn-group'>"
            // bouton détail
            . "<form method='POST' action='client.php'>"
                . "<button type='submit' class='btn btn-success rounded-pill'><i class='fa fa-search'></i></button>"
                . "<input name='idtiers' type='hidden' value='" . $row['idtiers'] . "'/>"
                . "<input name='type' type='hidden' value='Client'/>"
                . "<input name='action' type='hidden' value='voir'/>"
            . "</form> &nbsp"
            // bouton modifier
            . "<form method='POST' action='modifClient.php'>"
                . "<button type='submit' class='btn btn-primary rounded-pill'><i class='fa fa-edit'></i></button>"
                . "<input name='idtiers' type='hidden' value='" . $row['idtiers'] . "'/>"
                . "<input name='type' type='hidden' value='Client'/>"
                . "<input name='action' type='hidden' value='modifier'/>"
                . "</form> &nbsp"
                // Bouton supprimer
            ."<form method='POST' action='traitementClient.php'>"
                . "<button type='submit' class='btn btn-danger rounded-pill'><i class='fa fa-trash'></i></button>"
                . "<input name='idtiers' type='hidden' value='" . $row['idtiers'] . "'/>"
                . "<input name='type' type='hidden' value='Client'/>"
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