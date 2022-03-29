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
		<script type="text/javascript" src="../js/scriptarticle.js"></script>
</head>
<body>
<div class='container bg-light'>
<?php
	include '../all.class.inc.php';
	if ($_POST['action'] == 'modifier')
	{
		$ob = new Casier($_POST['idcasier']);
		$ob->GetByID($conn);
		$action = 'modifier';
		echo "<p class='size-18 text-center'><b>Modifier le client ",$ob->Getlibcasier(), "</p><br>";
	}
	else
	{
		$ob = new Casier();
		$action = 'ajouter';
		echo "<p class='size-18 text-center'><b> Ajouter un nouveau Casier </b></p><br>";
	}
?>
	<form method='POST' action='traitementCasier.php'>
        <div class='row'>
				<input name='idcasier' type='hidden' value='<?php echo $ob->Getidcasier(); ?>'/>
	           	<div class="col-6 text-bold">
	           		libcasier: 
	           		<input name='libcasier' type='text' placeholder="libcasier de la société" value='<?php echo $ob->Getlibcasier(); ?>' required /><br>
				</div>
	           	<div class="col-6 text-bold">
	           		Article:
                    <input type="text" id="nom_idarticle" onkeyup="autocompletArticle()" placeholder="article" value='<?php echo $ob->Getlibarticle(); ?>' required>
                    <input type="hidden" id="nom2_idarticle" name="idarticle" value='<?php echo $ob->Getidarticle(); ?>'>
                    <ul id="nom_list_idarticle"></ul>
                </div>
			<input name='action' type='hidden' value='<?php echo $action; ?>'/>
		</div>
		<a class='button bg_dark-radius_5' href="casier.vue.php">Retour</a>
		<button type='submit' class='button bg_green-radius_5'>Sauvegarder</button>
		</form>
	</div>
</body>
</html>