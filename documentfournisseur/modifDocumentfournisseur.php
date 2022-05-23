<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Ajouter - Modifier: État</title>
  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-form.css">
  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-grid.css">
  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-text.css">
  <link rel="stylesheet" href="../css/Bootstrap/css/bootstrap.css">
		<script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/scriptetat.js"></script>
		<script type="text/javascript" src="../js/scriptfournisseur.js"></script>
</head>
<body>
<br><div class="container bg-light">	
<?php
	include '../all.class.inc.php';
	if ($_POST['action'] == 'modifier')
	{
		$ob = new Documentfournisseur($_POST['iddocumentfournisseur']);
		$ob->GetByID($conn);
		$action = 'modifier';
			echo "<p class='size-18 text-center'><b>Modifier le bon de commande ",$ob->Getiddocumentfournisseur(), "</p><br>";
	}
	else
	{
		$ob = new Documentfournisseur();
		$action = 'ajouter';
			echo "<p class='size-18 text-center'><b> Ajouter un bon de commande </b></p><br>";
	}
?>
<div class="container">
<form method='POST' action='traitementdocumentfournisseur.php'>
  <div class="row">
	<input name='iddocumentfournisseur' type='hidden' value="<?php echo $ob->Getiddocumentfournisseur(); ?>"/>
		<div class="col-6">Date:
			<input name='datedocfournisseur' type='text' value="<?php echo $ob->Getdatedocfournisseur(); ?>"/>
		</div>
		<div class="col-6">statut:
			<input name='statutfournisseur' type='text' value="<?php echo $ob->Getstatutfournisseur(); ?>"/>
		</div>
		<div class="col-6">commentaire:
			<input name='commentairefournisseur' type='text' value="<?php echo $ob->Getcommentairefournisseur(); ?>"/>
		</div>
	    <div class="col-6 text-bold">Etat:
				<input name="libetat" type="text" id="nom_idetat" onkeyup="autocompletEtat()" value='<?php echo $ob->Getlibetat(); ?>' placeholder="libetat" required>
				<input type="hidden" id="nom2_idetat" name="idetat" value='<?php echo $ob->Getidetat(); ?>'>
				<ul id="nom_list_idetat"></ul>
      </div>
		<div class="col-6 text-bold">fournisseur:
    	<input name="nomfournisseur" type="text" id="nom_idfournisseur" onkeyup="autocompletFournisseur()" value='<?php echo $ob->Getnomfournisseur(); ?>' placeholder="fournisseur" required/>
      <input type="hidden" id="nom2_idfournisseur" name="idfournisseur" value='<?php echo $ob->Getidfournisseur(); ?>'>
      <ul id="nom_list_idfournisseur"></ul>
    </div>
  </div>
	<input name='action' type='hidden' value="<?php echo $action; ?>"/>
	<a class='button bg_dark-radius_6' href="documentfournisseur.vue.php">Retour</a>
	<button type='submit' class='button bg_green-radius_6'>Sauvegarder</button>
</form>
</div>
</body>
</html>