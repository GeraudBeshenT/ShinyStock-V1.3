<!DOCTYPE html>
<html>
<head>
	<title>Ajouter - Modifier:  - Article </title>
	<meta charset="utf-8">
	  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-form.css">
	  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-grid.css">
	  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-text.css">
	  <link rel="stylesheet" href="../css/Bootstrap/css/bootstrap.css">
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/scriptcategorie.js"></script>
</head>
<body>
<br><div class="container bg-light">
<?php
	include '../all.class.inc.php';
	if ($_POST['action'] == 'modifier')
	{
		$ob = new Article($_POST['idarticle']);
		$ob->GetByID($conn);
		$action = 'modifier';
		echo "<p class='size-18 text-center'><b>Modifier l'article : </b> ", $ob->Getlibarticle(), "</p><br>";
	}
	else
	{
		$ob = new Article();
		$action = 'ajouter';
		echo "<p class='size-18 text-center'><b> Ajouter un nouvel Article </b></p><br>";
	}
?>
	<form method='POST' action='traitementArticle.php'>
           	<div class="row">
				<input name='idtiers' type='hidden' value='<?php echo $ob->Getidarticle(); ?>'/>
	           	<div class="col-6 text-bold">
	           		Article: 
	           		<input name='libarticle' type='text' placeholder="Article" value='<?php echo $ob->Getlibarticle(); ?>' required /><br>
				</div>
	           	<div class="col-6 text-bold">
	           		Sousfam: 
	           		<input name='sousfam' type='text' pattern='[0-9]{1,11}' placeholder="Adresse du Siège social" value='<?php echo $ob->Getsousfam(); ?>' required /><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		reffour: 
	           		<input name='reffour' type='text' placeholder="reffour" value='<?php echo $ob->Getreffour(); ?>' required /><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		genrod: 
	           		<input name='genrod' type='text' pattern='[0-9]{1,11}' placeholder="chiffres" value='<?php echo $ob->Getgenrod(); ?>' required /><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		frais: 
	           		<input name='frais' type='text' pattern='[0-9]{1,11}' placeholder="chiffres" value='<?php echo $ob->Getfrais(); ?>' required /><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		qtecdefou: 
	           		<input name='qtecdefou' type='text' pattern='[0-9]{1,11}' placeholder="chiffres" value='<?php echo $ob->Getqtecdefou(); ?>' required /><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		qtestock: 
	           		<input name='qtestock' type='text' pattern='[0-9]{1,11}' placeholder="chiffres" value='<?php echo $ob->Getqtestock(); ?>' required /><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		cptac: 
	           		<input name='cptac' type='text' pattern='[0-9]{1,11}' placeholder="chiffres" value='<?php echo $ob->Getcptac(); ?>' required /><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		cptvem: 
	           		<input name='cptvem' type='text' pattern='[0-9]{1,11}' placeholder="chiffres" value='<?php echo $ob->Getcptvem(); ?>' required /><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		cptvec: 
	           		<input name='cptvec' type='text' pattern='[0-9]{1,11}' placeholder="chiffres" value='<?php echo $ob->Getcptvec(); ?>' required /><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		cptveom: 
	           		<input name='cptveom' type='text' pattern='[0-9]{1,11}' placeholder="chiffres" value='<?php echo $ob->Getcptveom(); ?>' required /><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		cptvee: 
	           		<input name='cptvee' type='text' pattern='[0-9]{1,11}' placeholder="chiffres" value='<?php echo $ob->Getcptvee(); ?>' required /><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		cptvecee: 
	           		<input name='cptvecee' type='text' pattern='[0-9]{1,11}' placeholder="chiffres" value='<?php echo $ob->Getcptvecee(); ?>' required /><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		commentaire: 
	           		<input name='commentaire' type='text' placeholder="Adresse du Siège social" value='<?php echo $ob->Getcommentaire(); ?>' required /><br>
	           	</div>
	           	<div class="col-6 text-bold">
	           		categorie:
                    <input type="text" id="nom_id" onkeyup="autocompletCategorie()" value='<?php echo $ob->Getlibcategorie(); ?>' placeholder="catégorie" required>
                    <input type="hidden" id="nom2_id" name="idcategorie" value='<?php echo $ob->Getidcategorie(); ?>'>
                    <ul id="nom_list_id"></ul>
                </div>
				<input name='action' type='hidden' value="<?php echo $action; ?>"/>
			</div>
			<br>
			<div class="col-6">
				<a class='button bg_dark-radius_5' href="article.vue.php">Retour</a>
				<button type='submit' class='button bg_green-radius_5'>Sauvegarder</button>
			</div>
		</form>
	</div>
</body>
</html>