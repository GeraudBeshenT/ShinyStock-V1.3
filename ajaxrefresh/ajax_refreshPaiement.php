<?php
include '../bdd.class.inc.php';

$keywordpaiement = '%'.$_POST['keywordpaiement'].'%';  

$sqlpaiement = "SELECT * FROM paiement WHERE libpaiement LIKE (:var) LIMIT 10";  
$reqpaiement = $conn->prepare($sqlpaiement);
$reqpaiement->bindParam(':var', $keywordpaiement, PDO::PARAM_STR);
$reqpaiement->execute();
$listpaiement = $reqpaiement->fetchAll();
foreach ($listpaiement as $res)
{
    //  affichage
    $nom_list_idpaiement = str_replace($_POST['keywordpaiement'], '<b>'.$_POST['keywordpaiement'].'</b>', $res['libpaiement']);
    // sélection 
    echo '<li onclick="set_itempaiement(\''.str_replace("'", "\'", $res['libpaiement']).'\','. '\''.str_replace("'", "\'", $res['idpaiement']).'\')">'.$nom_list_idpaiement.'</li>';
}
