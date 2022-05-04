<?php
include '../bdd.class.inc.php';

$keyword = '%'.$_POST['keyword'].'%';  

$sql = "SELECT * FROM client WHERE nomclient LIKE (:var) LIMIT 10";  
$req = $conn->prepare($sql);
$req->bindParam(':var', $keyword, PDO::PARAM_STR);
$req->execute();
$list = $req->fetchAll();
foreach ($list as $res)
{
    //  affichage
    $nom_list_idclient = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['nomclient']);
    // sélection 
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $res['nomclient']).'\','. '\''.str_replace("'", "\'", $res['idclient']).'\')">'.$nom_list_idclient.'</li>';
}