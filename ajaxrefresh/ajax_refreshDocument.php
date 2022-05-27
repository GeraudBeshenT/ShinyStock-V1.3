<?php
include '../bdd.class.inc.php';

$keyworddocument = '%'.$_POST['keyworddocument'].'%';  

$sqldocument = "SELECT * FROM documentfournisseur WHERE datedocfournisseur LIKE (:var) LIMIT 10";  
$reqdocument = $conn->prepare($sqldocument);
$reqdocument->bindParam(':var', $keyworddocument, PDO::PARAM_STR);
$reqdocument->execute();
$listdocument = $reqdocument->fetchAll();
foreach ($listdocument as $res)
{
    //  affichage
    $nom_list_iddocument = str_replace($_POST['keyworddocument'], '<b>'.$_POST['keyworddocument'].'</b>', $res['datedocfournisseur']);
    // sélection 
    echo '<li onclick="set_itemdocument(\''.str_replace("'", "\'", $res['datedocfournisseur']).'\','. '\''.str_replace("'", "\'", $res['iddocumentfournisseur']).'\')">'.$nom_list_iddocument.'</li>';
}
