<!DOCTYPE html>
<html>
<head>
	<title>Ajouter - Modifier: Client</title>
	<meta charset='utf-8'>
	  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-form.css">
	  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-grid.css">
	  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-text.css">
	  <link rel="stylesheet" href="../css/Bootstrap/css/bootstrap.css">
		<script type="text/javascript" src="../js/jquery.min.js"></script>
		<script type="text/javascript" src="../js/scriptcommune.js"></script>
		<script type="text/javascript" src="../js/scripttarif.js"></script>
		<script type="text/javascript" src="../js/scriptpaiement.js"></script>
</head>
<body>
<div class='container bg-light'>
<?php
	include '../all.class.inc.php';
	if ($_POST['action'] == 'modifier')
	{
		$ob = new Clients($_POST['idtiers']);
		$ob->GetByID($conn);
		$action = 'modifier';
		echo "<p class='size-18 text-center'><b>Modifier le client ",$ob->Getnom(), "</p><br>";
	}
	else
	{
		$ob = new Clients();
		$action = 'ajouter';
		echo "<p class='size-18 text-center'><b> Ajouter un nouveau Fournisseur </b></p><br>";
	}
?>
	<form method='POST' action='traitementClient.php'>
        <div class='row'>
				<input name='idtiers' type='hidden' value='<?php echo $ob->Getidtiers(); ?>'/>
	           	<div class="col-6 text-bold">
	           		Nom: 
	           		<input name='nom' type='text' placeholder="Nom de la société" value='<?php echo $ob->Getnom(); ?>' required /><br>
				</div>
	           	<div class="col-6 text-bold">
	           		Adresse: 
	           		<input name='adresse' type='text' placeholder="Adresse du Siège social" value='<?php echo $ob->Getadresse(); ?>' required /><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		Numéro de téléphone:
	           		<input name='telephone' type='text' placeholder="Numéro de téléphone à 10 chiffres" value='<?php echo $ob->Gettelephone(); ?>' required /><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		Email:
	           		<input name='email' type='text' placeholder="exemple@gmail.com" value='<?php echo $ob->Getemail(); ?>' required/><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		Commune:
                    <input type="text" id="nom_id" onkeyup="autocompletC()" value='<?php echo $ob->Getlibcommune(); ?>' placeholder="Ville" required>
                    <input type="hidden" id="nom2_id" name="idcommune" value='<?php echo $ob->Getidcommune(); ?>'>
                    <ul id="nom_list_id"></ul>
                </div>
	           	<div class="col-6 text-bold">
	           		Préfixe:
	           		<input name='prefixe' type='text' placeholder="Format alphabétique" value='<?php echo $ob->Getprefixe(); ?>' required/><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		Indic Prospect:
	           		<input name='indicprospect' type='text' placeholder="Format alphabétique" value='<?php echo $ob->Getindicprospect(); ?>' required/><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		Iban:
	           		<input name='iban' type='text' placeholder="Format alphabétique" value='<?php echo $ob->Getiban(); ?>' required/><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		Bic:
	           		<input name='bic' type='text' placeholder="Format alphabétique" value='<?php echo $ob->Getbic(); ?>' required/><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		Banque:
	           		<input name='codebanque' type='text' placeholder="Format alphabétique" value='<?php echo $ob->Getcodebanque(); ?>' required/><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		Guichet:
	           		<input name='codeguichet' type='text' placeholder="Format alphabétique" value='<?php echo $ob->Getcodeguichet(); ?>' required/><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		Numéro de compte:
	           		<input name='ncompte' type='text' placeholder="Format alphabétique" value='<?php echo $ob->Getncompte(); ?>' required/><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		Clé RIB:
	           		<input name='clerib' type='text' placeholder="Format alphabétique" value='<?php echo $ob->Getclerib(); ?>' required/><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		Domiciliation:
	           		<input name='domiciliation' type='text' placeholder="Format alphabétique" value='<?php echo $ob->Getdomiciliation(); ?>' required/><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		Tel2:
	           		<input name='tel2' type='text' placeholder="Format alphabétique" value='<?php echo $ob->Gettel2(); ?>' required/><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		Tarif:
                    <input type="text" id="nom_idtarif" onkeyup="autocompletT()" placeholder="Format numérique" value='<?php echo $ob->Getlibtarif(); ?>' required/>
                    <input type="hidden" id="nomtarif_idtarif" name="idtarif" value='<?php echo $ob->Getidtarif(); ?>'>
                    <ul id="nom_list_idtarif"></ul>
                </div>
	           	<div class="col-6 text-bold">
	           		Type de paiement:
                    <input type="text" id="nom_idpaiement" onkeyup="autocompletP()" placeholder="paiement" value='<?php echo $ob->GetlibPaiement(); ?>' required>
                    <input type="hidden" id="nom2_idpaiement" name="idpaiement" value='<?php echo $ob->GetidPaiement(); ?>'>
                    <ul id="nom_list_idpaiement"></ul>
                </div>
			<input name='action' type='hidden' value='<?php echo $action; ?>'/>
		</div>
		<a class='button bg_dark-radius_5' href="client.vue.php">Retour</a>
		<button type='submit' class='button bg_green-radius_5'>Sauvegarder</button>
		</form>
	</div>
</body>
</html>