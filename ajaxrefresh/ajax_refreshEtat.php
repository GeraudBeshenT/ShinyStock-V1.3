<?php
include '../bdd.class.inc.php';

$keyword = '%'.$_POST['keyword'].'%';  

$sql = "SELECT * FROM etat WHERE libetat LIKE (:var) LIMIT 10";  
$req = $conn->prepare($sql);
$req->bindParam(':var', $keyword, PDO::PARAM_STR);
$req->execute();
$list = $req->fetchAll();
foreach ($list as $res)
{
    //  affichage
    $nom_list_idetat = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['libetat']);
    // sélection 
    echo '<li onclick="set_itemetat(\''.str_replace("'", "\'", $res['libetat']).'\','. '\''.str_replace("'", "\'", $res['idetat']).'\')">'.$nom_list_idetat.'</li>';
}