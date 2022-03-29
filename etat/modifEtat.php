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
		// Si on clic sur le bouton modifier, celui ci renvoie vers ce fichier où la classe Etat est solicitée pour modifier ou ajouter.
		if ($_POST['action'] == 'modifier')
		{
			$ob = new Etat($_POST['idetat']);
			$ob->GetByID($conn);
			$action = 'modifier';
			echo "<p class='size-18 text-center'><b>Modifier l'état ",$ob->Getlibetat(), "</p><br>";
		}
		else
		{
			$ob = new Etat();
			$action = 'ajouter';
			echo "<p class='size-18 text-center'><b> Ajouter un nouvel Etat </b></p><br>";
		}
	?>
<!-- Formulaire de modification qui récupère les informations de la ligne selectionnée. -->
	<form method='POST' action='traitementEtat.php'>
		<div class="row">
			<input name='idetat' class="form-control" type='hidden' value="<?php echo $ob->Getidetat(); ?>"/>
			<div class="col-4">
				<input name='libetat' class="form-text text-muted" type='text' value="<?php echo $ob->Getlibetat(); ?>"/><br><br>
			</div>
			<input name='action' type='hidden' value="<?php echo $action; ?>"/>
		</div>
		<a class='button bg_dark-radius_5' href="etat.vue.php">Retour</a>
		<button type='submit' class='button bg_green-radius_5'>Sauvegarder</button>
	</form>
</div>

</body>
</html>