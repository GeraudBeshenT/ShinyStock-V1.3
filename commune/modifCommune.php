<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter - Modifier: Communes</title>
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
		$ob = new Commune($_POST['idcommune']);
		$ob->GetByID($conn);
		$action = 'modifier';
			echo "<p class='size-18 text-center'><b>Modifier la catégorie ",$ob->Getlibcommune(), "</p><br>";
	}
	else
	{
		$ob = new Commune();
		$action = 'ajouter';
			echo "<p class='size-18 text-center'><b> Ajouter une nouvelle Catégorie </b></p><br>";
	}
?>
<div class="container">
<form method='POST' action='traitementCommune.php'>
  <div class="row">
	<input name='idcommune' type='hidden' value="<?php echo $ob->Getidcommune(); ?>"/>
		<div class="col-6">Lib commune:
			<input name='libcommune' type='text' value="<?php echo $ob->Getlibcommune(); ?>"/>
		</div>
		<div class="col-6">Code postal:
			<input name='cpcommune' type='text' value="<?php echo $ob->Getcpcommune(); ?>"/>
		</div>
  </div>
	<input name='action' type='hidden' value="<?php echo $action; ?>"/>
	<a class='button bg_dark-radius_5' href="commune.vue.php">Retour</a>
	<button type='submit' class='button bg_green-radius_5'>Sauvegarder</button>
</form>
</div>
</body>
</html>