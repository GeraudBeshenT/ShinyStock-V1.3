<?php
include '../bdd.class.inc.php';

$keyword = '%'.$_POST['keyword'].'%';  

$sql = "SELECT * FROM categorie WHERE libcategorie LIKE (:var) LIMIT 5";  
$req = $conn->prepare($sql);
$req->bindParam(':var', $keyword, PDO::PARAM_STR);
$req->execute();
$list = $req->fetchAll();
foreach ($list as $res)
{
    //  affichage
    $nom_list_id = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['libcategorie']);
    // sélection 
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $res['libcategorie']).'\','. '\''.str_replace("'", "\'", $res['idcategorie']).'\')">'.$nom_list_id.'</li>';
}
