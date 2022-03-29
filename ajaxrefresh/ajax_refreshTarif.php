
<?php
include '../bdd.class.inc.php';

$keywordtarif = '%'.$_POST['keywordtarif'].'%';  

$sqltarif = "SELECT * FROM tarif WHERE libtarif LIKE (:var) LIMIT 10";  
$reqtarif = $conn->prepare($sqltarif);
$reqtarif->bindParam(':var', $keywordtarif, PDO::PARAM_STR);
$reqtarif->execute();
$listtarif = $reqtarif->fetchAll();
foreach ($listtarif as $res)
{
    //  affichage
    $nom_list_idtarif = str_replace($_POST['keywordtarif'], '<b>'.$_POST['keywordtarif'].'</b>', $res['libtarif']);
    // sélection 
    echo '<li onclick="set_itemtarif(\''.str_replace("'", "\'", $res['libtarif']).'\','. '\''.str_replace("'", "\'", $res['idtarif']).'\')">'.$nom_list_idtarif.'</li>';
}
?>