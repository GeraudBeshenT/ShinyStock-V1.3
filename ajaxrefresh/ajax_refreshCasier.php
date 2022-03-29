<?php
include '../bdd.class.inc.php';

$keywordCasier = '%'.$_POST['keywordCasier'].'%';  
$keywordCasier = str_replace(' ','%%',$keywordCasier);

$sqlCasier = "SELECT * FROM article WHERE libarticle LIKE (:var) LIMIT 10";  
$reqCasier = $conn->prepare($sqlCasier);
$reqCasier->bindParam(':var', $keywordCasier, PDO::PARAM_STR);
$reqCasier->execute();
$listCasier = $reqCasier->fetchAll();
foreach ($listCasier as $res)
{
    //  affichage
    $nom_list_idCasier = str_replace($_POST['keywordCasier'], '<b>'.$_POST['keywordCasier'].'</b>', $res['libarticle']);
    // sélection 
     echo '<li class="list-group-item list-group-item-action py-2" onclick="set_itemCasier(\''.str_replace("'", "\'", $res['libarticle']).'\','. '\''.str_replace("'", "\'", $res['idarticle']).'\')">'.$nom_list_idCasier.'</li>';
}