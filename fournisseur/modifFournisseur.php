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
		<script type="text/javascript" src="../js/scriptcommune.js"></script>
		<script type="text/javascript" src="../js/scriptpaiement.js"></script>
		<script type="text/javascript" src="../js/scriptsociete.js"></script>
</head>
<body>
<br><div class="container bg-light">	
<?php
	include '../all.class.inc.php';
	if ($_POST['action'] == 'modifier')
	{
		$ob = new Fournisseur($_POST['idfournisseur']);
		$ob->GetByID($conn);
		$action = 'modifier';
			echo "<p class='size-18 text-center'><b>Modifier le fournisseur ",$ob->Getnomfournisseur(), "</p><br>";
	}
	else
	{
		$ob = new Fournisseur();
		$action = 'ajouter';
			echo "<p class='size-18 text-center'><b> Ajouter un nouveau fournisseur </b></p><br>";
	}
?>
<div class="container">
<form method='POST' action='traitementfournisseur.php'>
  <div class="row">
	<input name='idfournisseur' type='hidden' value="<?php echo $ob->Getidfournisseur(); ?>"/>
		<div class="col-6">Nom fournisseur:
			<input name='nomfournisseur' placeholder="Nom du fournisseur" type='text' value="<?php echo $ob->Getnomfournisseur(); ?>"/>
		</div>
		<div class="col-6">Adresse postale:
			<input name='adressefournisseur' placeholder="adresse du fournisseur" type='text' value="<?php echo $ob->Getadressefournisseur(); ?>"/>
		</div>
		<div class="col-6">N° de téléphone:
			<input name='telephonefournisseur' placeholder="numéro de téléphone" type='text' value="<?php echo $ob->Gettelephonefournisseur(); ?>"/>
		</div>
		<div class="col-6">Adresse email:
			<input name='emailfournisseur' placeholder="adresse mail" type='text' value="<?php echo $ob->Getemailfournisseur(); ?>"/>
		</div>
	    <div class="col-6">Ville:
				<input name="libcommune" type="text" id="nom_id" onkeyup="autocompletC()" value='<?php echo $ob->Getlibcommune(); ?>' placeholder="commune" required>
				<input name="idcommune" type="hidden" id="nom2_id" name="idcommune" value='<?php echo $ob->Getidcommune(); ?>'>
				<ul id="nom_list_id"></ul>
      </div>
		<div class="col-6">Préfixe:
			<input name='prefixefournisseur' placeholder="préfixe" type='text' value="<?php echo $ob->Getprefixefournisseur(); ?>"/>
		</div>
		<div class="col-6">Société:
			<input type="text" id="nom_idsociete" onkeyup="autocompletS()" placeholder="type de société" value='<?php echo $ob->Getlibsociete(); ?>' required>
      <input type="hidden" id="nom2_idsociete" name="idsociete" value='<?php echo $ob->Getidsociete(); ?>'>
      <ul id="nom_list_idsociete"></ul>
    </div>
	  <div class="col-6">Type de paiement:
			<input type="text" id="nom_idpaiement" onkeyup="autocompletP()" placeholder="Type de paiement" value='<?php echo $ob->GetlibPaiement(); ?>' required>
      <input type="hidden" id="nom2_idpaiement" name="idpaiement" value='<?php echo $ob->GetidPaiement(); ?>'>
      <ul id="nom_list_idpaiement"></ul>
    </div>
		<div class="col-6">Code fournisseur:
			<input name='codefournisseur' placeholder="code (format numérique)" type='text' value="<?php echo $ob->Getcodefournisseur(); ?>"/>
		</div>
  </div>
	<input name='action' type='hidden' value="<?php echo $action; ?>"/>
	<a class='button bg_dark-radius_6' href="fournisseur.vue.php">Retour</a>
	<button type='submit' class='button bg_green-radius_6'>Sauvegarder</button>
</form>
</div>
</body>
</html>