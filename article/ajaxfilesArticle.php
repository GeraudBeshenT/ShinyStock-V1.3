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
    $searchQuery = " AND libarticle LIKE :libarticle "
			. "OR qtecdefou = :qtecdefou "
			. "OR qtestock = :qtestock "
			. "OR libcategorie LIKE :libcategorie ";
    $searchArray = array(
        'libarticle' => "%$searchValue%",
		'qtecdefou' => "%$searchValue%",
		'qtestock' => "%$searchValue%",
		'libcategorie' => "%$searchValue%"
    );
}


/* Création de l'objet Article */

$ob = new Article();

$totalRecords = $ob->CountBDD($conn);
$totalRecordwithFilter = $ob->CountParamBDD($conn,$searchQuery,$searchArray);


/* Déclaration de la requête de sélection pour l'affichage de la table Article */

$stmt = $conn->prepare("SELECT * FROM article INNER JOIN categorie ON article.idcategorie = categorie.idcategorie WHERE suparticle = 0 " . $searchQuery . " ORDER BY " . $columnName . " " . $columnSortOrder . " LIMIT :limit,:offset");
foreach ($searchArray as $key => $search) {
    $stmt->bindValue(':' . $key, $search, PDO::PARAM_STR);
}

var_dump($stmt);
die();

$stmt->bindValue(':limit', (int) $row, PDO::PARAM_INT);
$stmt->bindValue(':offset', (int) $rowperpage, PDO::PARAM_INT);
$stmt->execute();
$empRecords = $stmt->fetchAll();

$data = array();
foreach ($empRecords as $row) {
    if ($row['suparticle'] == 0) {
        $data[] = array(
            "idarticle" => $row['idarticle'],
            "libarticle" => $row['libarticle'],
            "qtecdefou" => $row['qtecdefou'],
            "qtestock" => $row['qtestock'],	
			"libcategorie" => $row['libcategorie'],
            "actions" => "<div class='btn-group'>"
            // bouton détail
            . "<form method='POST' action='Article.php'>"
                . "<button type='submit' class='btn btn-success rounded-pill'><i class='fa fa-search'></i></button>"
                . "<input name='idarticle' type='hidden' value='" . $row['idarticle'] . "'/>"
                . "<input name='type' type='hidden' value='Article'/>"
                . "<input name='action' type='hidden' value='voir'/>"
            . "</form> &nbsp"
            // bouton modifier
            . "<form method='POST' action='modifArticle.php'>"
                . "<button type='submit' class='btn btn-primary rounded-pill'><i class='fa fa-edit'></i></button>"
                . "<input name='idarticle' type='hidden' value='" . $row['idarticle'] . "'/>"
                . "<input name='type' type='hidden' value='Article'/>"
                . "<input name='action' type='hidden' value='modifier'/>"
                . "</form> &nbsp"
                // Bouton supprimer
            ."<form method='POST' action='traitementArticle.php'>"
                . "<button type='submit' class='btn btn-danger rounded-pill'><i class='fa fa-trash'></i></button>"
                . "<input name='idarticle' type='hidden' value='" . $row['idarticle'] . "'/>"
                . "<input name='type' type='hidden' value='Article'/>"
                . "<input name='action' type='hidden' value='supprimer'/>"
            . "</form></div>",
            "produit" => "<div class='btn-group'>"
            . "<form method='POST' action='../produit/produit.vue.php?id=".$row['idarticle']."'>"
                . "<button type='submit' class='btn btn-success rounded-pill'><i class='fa fa-eye'></i></button>"
                . "<input name='type' type='hidden' value='Article'/>"
                . "<input name='id' type='hidden' value='" . $row['idarticle'] . "'/>"
                . "<input name='action' type='hidden' value='modifier'/>"
            . "</form>"
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