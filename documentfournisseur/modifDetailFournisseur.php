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
		<script type="text/javascript" src="../js/scriptarticle.js"></script>
		<script type="text/javascript" src="../js/scriptdocumentfournisseur.js"></script>
</head>
<body>
<br><div class="container bg-light">	
<?php
	include '../all.class.inc.php';
	if ($_POST['action'] == 'modifier')
	{
		$ob = new Detailfournisseur($_POST['iddetailfournisseur']);
		$ob->GetByID($conn);
		$action = 'modifier';
			echo "<p class='size-18 text-center'><b>Modifier le bon de commande ",$ob->Getiddetailfournisseur(), "</p><br>";
	}
	else
	{
		$ob = new Detailfournisseur();
		$action = 'ajouter';
			echo "<p class='size-18 text-center'><b> Ajouter un bon de commande </b></p><br>";
	}
?>
<div class="container">
<form method='POST' action='traitementDetailfournisseur.php'>
  <div class="row">
	<input name='iddetailfournisseur' type='hidden' value="<?php echo $ob->Getiddetailfournisseur(); ?>"/>
    <div class="col-6">
	  Document concerné:
      <input type="text" id="nom_iddocumentfournisseur" onkeyup="autocompletDocumentfournisseur()" placeholder="article" value='<?php echo $ob->Getdatedocfournisseur(); ?>' required>
      <input type="hidden" id="nom2_iddocumentfournisseur" name="iddocumentfournisseur" value='<?php echo $ob->Getiddocumentfournisseur(); ?>'>
      <ul id="nom_list_iddocumentfournisseur"></ul>
    </div>
    <div class="col-6">
	  Article:
      <input type="text" id="nom_idarticle" onkeyup="autocompletArticle()" placeholder="article" value='<?php echo $ob->Getlibarticle(); ?>' required>
      <input type="hidden" id="nom2_idarticle" name="idarticle" value='<?php echo $ob->Getidarticle(); ?>'>
      <ul id="nom_list_idarticle"></ul>
    </div>
		<div class="col-6">Quantité d'article:
			<input name='qteachat' type='text' value="<?php echo $ob->Getqteachat(); ?>"/>
		</div>
  </div>
	<input name='action' type='hidden' value="<?php echo $action; ?>"/>
	<a class='button bg_dark-radius_6' href="documentfournisseur.vue.php">Retour</a>
	<button type='submit' class='button bg_green-radius_6'>Sauvegarder</button>
</form>
</div>
</body>
</html>