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
    $searchQuery = " AND (idcommune LIKE :idcommune) "
            . "OR (libcommune LIKE :libcommune)"
            . "OR (cpcommune LIKE :cpcommune)";
    $searchArray = array(
        'idcommune' => "%$searchValue%",
        'libcommune' => "%$searchValue%",
        'cpcommune' => "%$searchValue%"
    );
}
// D'après la classe commune, selection de toutes les données de la table état
$ob = new Commune();

$totalRecords = $ob->CountBDD($conn);
$totalRecordwithFilter = $ob->CountParamBDD($conn,$searchQuery,$searchArray);

$stmt = $conn->prepare("SELECT * FROM commune WHERE supcommune = 0 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");

foreach ($searchArray as $key => $search) {
    $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
}

$stmt->bindValue(':limit', (int) $row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int) $rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();
// Boucle modifier supprimé qui se répète sur toutes les lignes du tableau.
// Récupération de l'idcommune, formulaire de modification/suppression qui envoient les données dans les fichiers modicommune/tratiementcommune.
foreach ($empRecords as $row) {
    if ($row['supcommune'] == 0) {
        $data[] = array(
            "idcommune" => $row['idcommune'],
            "libcommune" => $row['libcommune'],
            "cpcommune" => $row['cpcommune'],
             "actions" => "<div class='btn-group'>"
            ."<form method='POST' action='traitementCommune.php'>"
                . "<button type='submit' class='btn btn-danger rounded-pill'><i class='fa fa-trash'></i></button>"
                . "<input name='idcommune' type='hidden' value='" . $row['idcommune'] . "'/>"
                . "<input name='type' type='hidden' value='commune'/>"
                . "<input name='action' type='hidden' value='supprimer'/>"
            . "</form> &nbsp"
            . "<form method='POST' action='modifCommune.php'>"
                . "<button type='submit' class='btn btn-primary rounded-pill'><i class='fa fa-edit'></i></button>"
                . "<input name='idcommune' type='hidden' value='" . $row['idcommune'] . "'/>"
                . "<input name='type' type='hidden' value='commune'/>"
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