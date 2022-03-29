<!DOCTYPE html>
<html>
<head>
	<meta charset='utf-8'>
	<title>Ajouter - Modifier: Client</title>
  <link rel='stylesheet' type='text/css' href='../css/GSS/css/styler1-form.css'>
  <link rel='stylesheet' type='text/css' href='../css/GSS/css/styler1-grid.css'>
  <link rel='stylesheet' type='text/css' href='../css/GSS/css/styler1-text.css'>
  <link rel='stylesheet' href='../css/Bootstrap/css/bootstrap.css'>
</head>
<body>
<!-- Choix du formulaire 'Ajouter un nouvel article' ou 'Modifier un article préétablie' -->
<div class='container'>
<?php
	include '../all.class.inc.php';
	if ($_POST['action'] == 'modifier')
	{
		$ob = new Payer($_POST['id']);
		$ob->GetPayerByID($conn);
		$action = 'modifier';
		echo 'Modifier la commande ',$ob->Getidtarif();
	}
	else
	{
		$ob = new Payer();
		$action = 'ajouter';
		echo 'Ajouter une nouvelle commande';
	}
?>
	<form method='POST' action='traitementPayer.php'>
        <div class='row'>
			<input name='id_tarif' type='hidden' value='<?php echo $ob->Getidtarif(); ?>'/>
			<div class='col-4'>Nom article : 
	       		<input name='id_article' type='text' value='<?php echo $ob->Getidarticle(); ?>'/><br>
			</div>
	       	<div class='col-4'>Montant : 
	       		<input name='montant' type='text' value='<?php echo $ob->Getmontant(); ?>' required/><br>
			</div>
			<input name='action' type='hidden' value='<?php echo $action; ?>'/>
		</div>
		<a href='payer.vue.php' class='button bg_dark-radius_5'>Retour</a>
		<button type='submit' class='button bg_green-radius_5'>Sauvegarder</button>
	</form>
	</div>
</body>
</html>