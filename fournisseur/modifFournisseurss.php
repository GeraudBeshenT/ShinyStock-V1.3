<!DOCTYPE html>
<html>
<head>
	<title>Ajouter - Modifier:  - Fournisseur </title>
	<meta charset="utf-8">
	  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-form.css">
	  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-grid.css">
	  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-text.css">
	  <link rel="stylesheet" href="../css/Bootstrap/css/bootstrap.css">
		<script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/scriptcommune.js"></script>
		<script type="text/javascript" src="../js/scripttarif.js"></script>
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
		echo "<p class='size-18 text-center'><b>Modifier le Fournisseur ",$ob->Getnom(), "</p><br>";
	}
	else
	{
		$ob = new Fournisseur();
		$action = 'ajouter';
		echo "<p class='size-18 text-center'><b> Ajouter un nouveau Fournisseur </b></p><br>";
	}
?>
	<form method='POST' action='traitementFournisseur.php'>
           	<div class="row">
				<input name='idfournisseur' type='hidden' value='<?php echo $ob->Getidfournisseur(); ?>'/>
	           	<div class="col-6 text-bold">
	           		Nom: 
	           		<input name='nomfournisseur' type='text' placeholder="Nom de la société" value='<?php echo $ob->Getnomfournisseur(); ?>' required /><br>
				</div>
	           	<div class="col-6 text-bold">
	           		Adresse: 
	           		<input name='adressefournisseur' type='text' placeholder="Adresse du Siège social" value='<?php echo $ob->Getadressefournisseur(); ?>' required /><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		Commune:
                    <input type="text" id="nom_id" onkeyup="autocompletC()" value='<?php echo $ob->Getlibcommune(); ?>' placeholder="" required>
                    <input type="hidden" id="nom2_id" name="idcommune" value='<?php echo $ob->Getidcommune(); ?>'>
                    <ul id="nom_list_id"></ul>
                </div>
	           	<div class="col-6 text-bold">
	           		Numéro de téléphone:
	           		<input name='telephonefournisseur' type='text' placeholder="Numéro de téléphone à 10 chiffres" value='<?php echo $ob->Gettelephonefournisseur(); ?>' required /><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		Email:
	           		<input name='emailfournisseur' type='text' placeholder="exemple@gmail.com" value='<?php echo $ob->Getemailfournisseur(); ?>' required/><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		Préfixe:
	           		<input name='prefixefournisseur' type='text' placeholder="Format alphabétique" value='<?php echo $ob->Getprefixefournisseur(); ?>' required/><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		Tarif:
                    <input type="text" id="nom_idtarif" onkeyup="autocompletT()" placeholder="Format numérique" value='<?php echo $ob->Getlibtarif(); ?>' required/>
                    <input type="hidden" id="nomtarif_idtarif" name="idtarif" value='<?php echo $ob->Getidtarif(); ?>'>
                    <ul id="nom_list_idtarif"></ul>
                </div>
	           	<div class="col-6 text-bold">
	           		Type de société:
                    <input type="text" id="nom_idsociete" onkeyup="autocompletS()" placeholder="Société ..." value='<?php echo $ob->Getlibsociete(); ?>' required>
                    <input type="hidden" id="nom2_idsociete" name="idsociete" value='<?php echo $ob->Getidsociete(); ?>'>
                    <ul id="nom_list_idsociete"></ul>
                </div>
	           	<div class="col-6 text-bold">
	           		Type de paiement:
                    <input type="text" id="nom_idpaiement" onkeyup="autocompletP()" placeholder="paiement" value='<?php echo $ob->GetlibPaiement(); ?>' required>
                    <input type="hidden" id="nom2_idpaiement" name="idpaiement" value='<?php echo $ob->GetidPaiement(); ?>'>
                    <ul id="nom_list_idpaiement"></ul>
                </div>
	           	<div class="col-6 text-bold">
	           		Code Fournisseurs:
	           		<input name='codefournisseur' type='text' pattern='[0-9]{1,4}' placeholder="Format numérique" value='<?php echo $ob->Getcodefournisseur(); ?>' required/><br>
	           	</div>
				<input name='action' type='hidden' value="<?php echo $action; ?>"/>
			</div>
			<br>
			<div class="col-6">
				<a class='button bg_dark-radius_5' href="fournisseur.vue.php">Retour</a>
				<button type='submit' class='button bg_green-radius_5'>Sauvegarder</button>
			</div>
		</form>
	</div>
</body>
</html>