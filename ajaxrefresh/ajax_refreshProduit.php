<?php
include '../bdd/bdd.class.inc.php';

$keywordProduit = '%'.$_POST['keywordProduit'].'%';  

$sqlProduit = "SELECT * FROM article WHERE libarticle LIKE (:var) LIMIT 10";  
$reqProduit = $conn->prepare($sqlProduit);
$reqProduit->bindParam(':var', $keywordProduit, PDO::PARAM_STR);
$reqProduit->execute();
$listProduit = $reqProduit->fetchAll();
foreach ($listProduit as $res)
{
    //  affichage
    $nom_list_idProduit = str_replace($_POST['keywordProduit'], '<b>'.$_POST['keywordProduit'].'</b>', $res['libarticle']);
    // sélection 
    echo '<li onclick="set_itemProduit(\''.str_replace("'", "\'", $res['libarticle']).'\','. '\''.str_replace("'", "\'", $res['idarticle']).'\')">'.$nom_list_idProduit.'</li>';
}