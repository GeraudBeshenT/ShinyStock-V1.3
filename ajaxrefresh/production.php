<?php
include('../all.class.inc.php');
if(isset($_POST['jsonData'])){
    $produit = new Produit($_GET['idarticle']);
    $test = $produit->produire($_GET['quantite'], $_POST['jsonData'], $conn);
}