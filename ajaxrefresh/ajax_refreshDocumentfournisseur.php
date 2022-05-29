<?php
include '../bdd.class.inc.php';

$keyworddocumentfournisseur = '%'.$_POST['keyworddocumentfournisseur'].'%';  

$sqldocumentfournisseur = "SELECT * FROM documentfournisseur WHERE datedocfournisseur LIKE (:var) LIMIT 10";  
$reqdocumentfournisseur = $conn->prepare($sqldocumentfournisseur);
$reqdocumentfournisseur->bindParam(':var', $keyworddocumentfournisseur, PDO::PARAM_STR);
$reqdocumentfournisseur->execute();
$listdocumentfournisseur = $reqdocumentfournisseur->fetchAll();
foreach ($listdocumentfournisseur as $res)
{
    //  affichage
    $nom_list_iddocumentfournisseur = str_replace($_POST['keyworddocumentfournisseur'], '<b>'.$_POST['keyworddocumentfournisseur'].'</b>', $res['datedocfournisseur']);
    // sélection 
    echo '<li onclick="set_itemdocumentfournisseur(\''.str_replace("'", "\'", $res['datedocfournisseur']).'\','. '\''.str_replace("'", "\'", $res['iddocumentfournisseur']).'\')">'.$nom_list_iddocumentfournisseur.'</li>';
}
