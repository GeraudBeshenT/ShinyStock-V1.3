<?php
include '../bdd.class.inc.php';

$keyword = '%'.$_POST['keyword'].'%';  

$sql = "SELECT * FROM commune WHERE libcommune LIKE (:var) LIMIT 10";  
$req = $conn->prepare($sql);
$req->bindParam(':var', $keyword, PDO::PARAM_STR);
$req->execute();
$list = $req->fetchAll();
foreach ($list as $res)
{
    //  affichage
    $nom_list_id = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['libcommune']);
    // sélection 
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $res['libcommune']).'\','. '\''.str_replace("'", "\'", $res['idcommune']).'\')">'.$nom_list_id.'</li>';
}