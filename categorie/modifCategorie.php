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
		$ob = new Categorie($_POST['idcategorie']);
		$ob->GetByID($conn);
		$action = 'modifier';
			echo "<p class='size-18 text-center'><b>Modifier la catégorie ",$ob->Getlibcategorie(), "</p><br>";
	}
	else
	{
		$ob = new Categorie();
		$action = 'ajouter';
			echo "<p class='size-18 text-center'><b> Ajouter une nouvelle Catégorie </b></p><br>";
	}
?>
<div class="container">
<form method='POST' action='traitementCategorie.php'>
  <div class="row">
	<input name='idcategorie' type='hidden' value="<?php echo $ob->Getidcategorie(); ?>"/>
		<div class="col-5">Référence:
			<input name='reference' type='text' value="<?php echo $ob->Getreference(); ?>"/>
		</div>
		<div class="col-5">Libellé:
			<input name='libcategorie' type='text' value="<?php echo $ob->Getlibcategorie(); ?>"/>
		</div>
		<div class="col-5">Description:
			<input name='description' type='text' value="<?php echo $ob->Getdescription(); ?>"/>
		</div>
		<div class="col-5">Code:
			<input name='codedouane' type='text' value="<?php echo $ob->Getcodedouane(); ?>"/>
		</div>
				<input name='action' type='hidden' value="<?php echo $action; ?>"/>
			</div>
			<br>
			<div class="col-6">
				<a class='button bg_dark-radius_5' href="categorie.vue.php">Retour</a>
				<button type='submit' class='button bg_green-radius_5'>Sauvegarder</button>
			</div>
		</form>
</div>
</body>
</html>