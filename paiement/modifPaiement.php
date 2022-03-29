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
		$ob = new Paiement($_POST['idpaiement']);
		$ob->GetByID($conn);
		$action = 'modifier';
			echo "<p class='size-18 text-center'><b>Modifier la catégorie ",$ob->Getlibpaiement(), "</p><br>";
	}
	else
	{
		$ob = new Paiement();
		$action = 'ajouter';
			echo "<p class='size-18 text-center'><b> Ajouter une nouvelle Catégorie </b></p><br>";
	}
?>
<div class="container">
<form method='POST' action='traitementpaiement.php'>
  <div class="row">
	<input name='idpaiement' type='hidden' value="<?php echo $ob->Getidpaiement(); ?>"/>
		<div class="col-5">Lib paiement:
			<input name='libpaiement' type='text' value="<?php echo $ob->Getlibpaiement(); ?>"/>
		</div>
  </div>
	<input name='action' type='hidden' value="<?php echo $action; ?>"/>
	<a class='button bg_dark-radius_5' href="paiement.vue.php">Retour</a>
	<button type='submit' class='button bg_green-radius_5'>Sauvegarder</button>
</form>
</div>
</body>
</html>