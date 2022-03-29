<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-form.css">
	<link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-grid.css">
	<link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-text.css">
	<link rel="stylesheet" href="../css/Bootstrap/css/bootstrap.css">
	<title> Shinystock - Produit </title>
</head>
<body>
<br><div class="container bg-light">
<?php
	include '../all.class.inc.php';
	if ($_POST['action'] == 'modifier')
	{
		$ob = new Produit($_POST['id']);
		$ob->GetProduitByID($conn);
		$action = 'modifier';
		echo "<p class='size-18 text-center'><b>Modifier le produit ",$ob->Getnomarticle(), "</p><br>";
	}
	else
	{
		$ob = new Produit();
		$action = 'ajouter';
		echo "<p class='size-18 text-center'><b> Ajouter un nouveau Produit </b></p><br>";
	}
?>
<form method='POST' action='traitementProduit.php'>
	<input name='ID' type='hidden' value="<?php echo $ob->GetID(); ?>"/>
		<div class="row">
           	<div class="col">Nom: 
           		<input name='nom_article' type='text' value="<?php echo $ob->Getnomarticle(); ?>"/><br>
			</div>
           	<div class="col">Sous Fam: 
           		<input name='sous_fam' type='text' value="<?php echo $ob->Getqtearticle(); ?>"/><br>
           	</div>
        </div>
	<!-- Bouton de validation reprennant l'action ajouter ou modifier ! -->
	<input name='action' type='hidden' value="<?php echo $action; ?>"/>
	<a class='button bg_dark-radius_5' href="produit.vue.php">Retour</a>
	<button type='submit' class='button bg_green-radius_5'>Sauvegarder</button>
</form>
</body>
</html>