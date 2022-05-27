<?php
	
	include '../bdd.class.inc.php';
	include '../all.class.inc.php';

	if (!(isset($_POST['action'])))
	{
		header("Location: article.vue.php");
	}

	switch ($_POST['action']) 
	{
		case 'ajouter':
			$ob = new Article($_POST['idarticle'], $_POST['libarticle'], $_POST['sousfam'], $_POST['reffour'], $_POST['genrod'], $_POST['frais'], $_POST['idtarif'], $_POST['qtecdefou'], $_POST['qtestock'], $_POST['cptac'], $_POST['cptvem'], $_POST['cptvec'], $_POST['cptveom'], $_POST['cptvee'], $_POST['cptvecee'], $_POST['commentaire'], $_POST['idcategorie']);
			$ob->AddBDD($conn);
			
			header("Location: article.vue.php");
			break;

		case 'supprimer':
			$ob = new Article($_POST['idarticle']);
			$ob->DelBDD($conn);
			header("Location: article.vue.php");
			break;

		case 'modifier':
			$ob = new Article($_POST['idarticle'], $_POST['libarticle'], $_POST['sousfam'], $_POST['reffour'], $_POST['genrod'], $_POST['frais'], $_POST['idtarif'], $_POST['qtecdefou'], $_POST['qtestock'], $_POST['cptac'], $_POST['cptvem'], $_POST['cptvec'], $_POST['cptveom'], $_POST['cptvee'], $_POST['cptvecee'], $_POST['commentaire'], $_POST['idcategorie']);
			$ob->SaveBDD($conn);
			header("Location: article.vue.php");
			break;

		default:
			header("Location: article.vue.php");
			break;
	}
?>