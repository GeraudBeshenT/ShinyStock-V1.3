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
		<script type="text/javascript" src="../js/scriptclient.js"></script>
</head>
<body>
<br><div class="container bg-light">	
<?php
	include '../all.class.inc.php';
	if ($_POST['action'] == 'modifier')
	{
		$ob = new Document($_POST['iddocumentclient']);
		$ob->GetByID($conn);
		$action = 'modifier';
			echo "<p class='size-18 text-center'><b>Modifier le bon de commande ",$ob->Getiddocumentclient(), "</p><br>";
	}
	else
	{
		$ob = new Document();
		$action = 'ajouter';
			echo "<p class='size-18 text-center'><b> Ajouter un bon de commande </b></p><br>";
	}
?>
<div class="container">
<form method='POST' action='traitementdocument.php'>
  <div class="row">
	<input name='iddocumentclient' type='hidden' value="<?php echo $ob->Getiddocumentclient(); ?>"/>
		<div class="col-6">Date:
			<input name='datedocclient' type='text' value="<?php echo $ob->Getdatedocclient(); ?>"/>
		</div>
		<div class="col-6">statut:
			<input name='statutclient' type='text' value="<?php echo $ob->Getstatutclient(); ?>"/>
		</div>
		<div class="col-6">commentaire:
			<input name='commentaireclient' type='text' value="<?php echo $ob->Getcommentaireclient(); ?>"/>
		</div>
	    <div class="col-6 text-bold">Etat:
				<input name="libetat" type="text" id="nom_idetat" onkeyup="autocompletEtat()" value='<?php echo $ob->Getlibetat(); ?>' placeholder="libetat" required>
				<input type="hidden" id="nom2_idetat" name="idetat" value='<?php echo $ob->Getidetat(); ?>'>
				<ul id="nom_list_idetat"></ul>
      </div>
		<div class="col-6 text-bold">client:
    	<input name="nomclient" type="text" id="nom_idclient" onkeyup="autocompletClient()" value='<?php echo $ob->Getnomclient(); ?>' placeholder="client" required/>
      <input type="hidden" id="nom2_idclient" name="idclient" value='<?php echo $ob->Getidclient(); ?>'>
      <ul id="nom_list_idclient"></ul>
    </div>
  </div>
	<input name='action' type='hidden' value="<?php echo $action; ?>"/>
	<a class='button bg_dark-radius_6' href="document.vue.php">Retour</a>
	<button type='submit' class='button bg_green-radius_6'>Sauvegarder</button>
</form>
</div>
</body>
</html>