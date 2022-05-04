<?php
include '../bdd.class.inc.php';

$keyword = '%'.$_POST['keyword'].'%';  

$sql = "SELECT * FROM fournisseur WHERE nomfournisseur LIKE (:var) LIMIT 10";  
$req = $conn->prepare($sql);
$req->bindParam(':var', $keyword, PDO::PARAM_STR);
$req->execute();
$list = $req->fetchAll();
foreach ($list as $res)
{
    //  affichage
    $nom_list_idfournisseur = str_replace($_POST['keyword'], '<b>'.$_POST['keyword'].'</b>', $res['nomfournisseur']);
    // sélection 
    echo '<li onclick="set_item(\''.str_replace("'", "\'", $res['nomfournisseur']).'\','. '\''.str_replace("'", "\'", $res['idfournisseur']).'\')">'.$nom_list_idfournisseur.'</li>';
}