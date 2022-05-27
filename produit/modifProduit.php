<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-form.css">
	<link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-grid.css">
	<link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-text.css">
	<link rel="stylesheet" href="../css/Bootstrap/css/bootstrap.css">
	<script type="text/javascript" src="../js/scriptarticle.js"></script>

	<title> Shinystock - Produit </title>
</head>
<body>
<br><div class="container bg-light">
<?php
	include '../all.class.inc.php';
	if ($_POST['action'] == 'modifier')
	{
		$ob = new Produit($_POST['idproduit']);
		$ob->GetByID($conn);
		$action = 'modifier';
		echo "<p class='size-18 text-center'><b>Modifier le produit ",$ob->Getlibproduit(), "</p><br>";
	}
	else
	{
		$ob = new Produit();
		$action = 'ajouter';
		echo "<p class='size-18 text-center'><b> Ajouter un nouveau Produit </b></p><br>";
	}
?>
<form method='POST' action='traitementProduit.php'>
	<input name='idproduit' type='hidden' value="<?php echo $ob->Getidproduit(); ?>"/>
		<div class="row">
	           	<div class="col-6 text-bold">
	           		Article:
                    <input type="text" id="nom_idarticle" onkeyup="autocompletArticle()" placeholder="article" value='<?php echo $ob->Getlibarticle(); ?>' required>
                    <input type="hidden" id="nom2_idarticle" name="idarticle" value='<?php echo $ob->Getidarticle(); ?>'>
                    <ul id="nom_list_idarticle"></ul>
                </div>
		<div class="col-6">Quantité Article:
			<input name='qtearticle' placeholder="adresse du fournisseur" type='text' value="<?php echo $ob->Getqtearticle(); ?>"/>
		</div>
        </div>
	<!-- Bouton de validation reprennant l'action ajouter ou modifier ! -->
	<input name='action' type='hidden' value="<?php echo $action; ?>"/>
	<a class='button bg_dark-radius_5' href="produit.vue.php">Retour</a>
	<button type='submit' class='button bg_green-radius_5'>Sauvegarder</button>
</form>
</body>
</html>