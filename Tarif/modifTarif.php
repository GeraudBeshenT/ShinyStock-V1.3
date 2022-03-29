<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter - Modifier: État</title>
  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-form.css">
  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-grid.css">
  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-text.css">
  <link rel="stylesheet" href="../css/Bootstrap/css/bootstrap.css">
</head>
<body>
<!-- Choix du formulaire "Ajouter un nouvel article" ou "Modifier un article préétablie" -->
<br><div class="container bg-light">	
<?php
	include '../all.class.inc.php';
	if ($_POST['action'] == 'modifier')
	{
		$ob = new Tarif($_POST['idtarif']);
		$ob->GetByID($conn);
		$action = 'modifier';
			echo "<p class='size-18 text-center'><b>Modifier la catégorie ",$ob->Getlibtarif(), "</p><br>";
	}
	else
	{
		$ob = new Tarif();
		$action = 'ajouter';
			echo "<p class='size-18 text-center'><b> Ajouter une nouvelle Catégorie </b></p><br>";
	}
?>
<div class="container">
<form method='POST' action='traitementTarif.php'>
  <div class="row">
	<input name='idtarif' type='hidden' value="<?php echo $ob->Getidtarif(); ?>"/>
		<div class="col-5">Lib tarif:
			<input name='libtarif' type='text' value="<?php echo $ob->Getlibtarif(); ?>"/>
		</div>
  </div>
	<input name='action' type='hidden' value="<?php echo $action; ?>"/>
	<a class='button bg_dark-radius_5' href="tarif.vue.php">Retour</a>
	<button type='submit' class='button bg_green-radius_5'>Sauvegarder</button>
</form>
</div>
</body>
</html>