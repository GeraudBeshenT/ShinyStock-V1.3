<?php
include '../bdd.class.inc.php';

$keywordsociete = '%'.$_POST['keywordsociete'].'%';  

$sqlsociete = "SELECT * FROM societe WHERE libsociete LIKE (:var) LIMIT 10";  
$reqsociete = $conn->prepare($sqlsociete);
$reqsociete->bindParam(':var', $keywordsociete, PDO::PARAM_STR);
$reqsociete->execute();
$listsociete = $reqsociete->fetchAll();
foreach ($listsociete as $res)
{
    //  affichage
    $nom_list_idsociete = str_replace($_POST['keywordsociete'], '<b>'.$_POST['keywordsociete'].'</b>', $res['libsociete']);
    // sélection 
    echo '<li onclick="set_itemsociete(\''.str_replace("'", "\'", $res['libsociete']).'\','. '\''.str_replace("'", "\'", $res['idsociete']).'\')">'.$nom_list_idsociete.'</li>';
}
