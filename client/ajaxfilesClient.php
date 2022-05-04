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
    $searchQuery = " AND (idclient LIKE :idclient) "
            . "OR (nomclient LIKE :nomclient)"
            . "OR (adresseclient LIKE :adresseclient)"
            . "OR (emailclient LIKE :emailclient)"
            . "OR (telephoneclient LIKE :telephoneclient)";
    $searchArray = array(
        'idclient' => "%$searchValue%",
        'nomclient' => "%$searchValue%",
        'adresseclient' => "%$searchValue%",
        'emailclient' => "%$searchValue%",
        'telephoneclient' => "%$searchValue%"
    );
}

$ob = new Client();

$totalRecords = $ob->CountBDD($conn);
$totalRecordwithFilter = $ob->CountParamBDD($conn,$searchQuery,$searchArray);

$stmt = $conn->prepare("SELECT * FROM client INNER JOIN commune ON commune.idcommune = client.idcommune INNER JOIN tarif ON tarif.idtarif = client.idtarif INNER JOIN paiement ON paiement.idpaiement = client.idpaiement WHERE supclient = 0 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

foreach ($searchArray as $key => $search) {
    $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int) $row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int) $rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();

foreach ($empRecords as $row) {
    if ($row['supclient'] == 0) {
        $data[] = array(
            "idclient" => $row['idclient'],
            "nomclient" => $row['nomclient'],
            "adresseclient" => $row['adresseclient'],
            "telephoneclient" => $row['telephoneclient'],
			"emailclient" => $row['emailclient'],
			"libcommune" => $row['libcommune'],
            // "prefixeclient" => $row['prefixeclient'],
            // "indicprospect" => $row['indicprospect'],
            // "iban" => $row['iban'],
            // "bic" => $row['bic'],
            // "codebanque" => $row['codebanque'],
            // "codeguichet" => $row['codeguichet'],
            // "ncompte" => $row['ncompte'],
            // "clerib" => $row['clerib'],
            // "domiciliation" => $row['domiciliation'],
            // "tel2" => $row['tel2'],
            // "libtarif" => $row['libtarif'],
            // "libpaiement" => $row['libpaiement'],
            // "libtarif" => $row['libtarif'],
            "actions" => "<div class='btn-group'>"
            // bouton détail
            . "<form method='POST' action='client.php'>"
                . "<button type='submit' class='btn btn-success rounded-pill'><i class='fa fa-search'></i></button>"
                . "<input name='idclient' type='hidden' value='" . $row['idclient'] . "'/>"
                . "<input name='type' type='hidden' value='Client'/>"
                . "<input name='action' type='hidden' value='voir'/>"
            . "</form> &nbsp"
            // bouton modifier
            . "<form method='POST' action='modifClient.php'>"
                . "<button type='submit' class='btn btn-primary rounded-pill'><i class='fa fa-edit'></i></button>"
                . "<input name='idclient' type='hidden' value='" . $row['idclient'] . "'/>"
                . "<input name='type' type='hidden' value='Client'/>"
                . "<input name='action' type='hidden' value='modifier'/>"
                . "</form> &nbsp"
                // Bouton supprimer
            ."<form method='POST' action='traitementClient.php'>"
                . "<button type='submit' class='btn btn-danger rounded-pill'><i class='fa fa-trash'></i></button>"
                . "<input name='idclient' type='hidden' value='" . $row['idclient'] . "'/>"
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