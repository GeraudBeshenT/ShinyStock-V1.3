<?php
include '../bdd.class.inc.php';

$keywordarticle = '%'.$_POST['keywordarticle'].'%';  

$sqlarticle = "SELECT * FROM article WHERE libarticle LIKE (:var) LIMIT 10";  
$reqarticle = $conn->prepare($sqlarticle);
$reqarticle->bindParam(':var', $keywordarticle, PDO::PARAM_STR);
$reqarticle->execute();
$listarticle = $reqarticle->fetchAll();
foreach ($listarticle as $res)
{
    //  affichage
    $nom_list_idarticle = str_replace($_POST['keywordarticle'], '<b>'.$_POST['keywordarticle'].'</b>', $res['libarticle']);
    // sélection 
    echo '<li onclick="set_itemarticle(\''.str_replace("'", "\'", $res['libarticle']).'\','. '\''.str_replace("'", "\'", $res['idarticle']).'\')">'.$nom_list_idarticle.'</li>';
}
