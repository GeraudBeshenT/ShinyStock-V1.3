<?php
include '../bdd.class.inc.php';

$keyworddocumentclient = '%'.$_POST['keyworddocumentclient'].'%';  

$sqldocumentclient = "SELECT * FROM documentclient WHERE datedocclient LIKE (:var) LIMIT 10";  
$reqdocumentclient = $conn->prepare($sqldocumentclient);
$reqdocumentclient->bindParam(':var', $keyworddocumentclient, PDO::PARAM_STR);
$reqdocumentclient->execute();
$listdocumentclient = $reqdocumentclient->fetchAll();
foreach ($listdocumentclient as $res)
{
    //  affichage
    $nom_list_iddocumentclient = str_replace($_POST['keyworddocumentclient'], '<b>'.$_POST['keyworddocumentclient'].'</b>', $res['datedocclient']);
    // sélection 
    echo '<li onclick="set_itemdocumentclient(\''.str_replace("'", "\'", $res['datedocclient']).'\','. '\''.str_replace("'", "\'", $res['iddocumentclient']).'\')">'.$nom_list_iddocumentclient.'</li>';
}
