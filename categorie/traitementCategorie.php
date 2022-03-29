<?php

	include '../bdd.class.inc.php';
	include '../all.class.inc.php';

	if (!(isset($_POST['action'])))
	{
		header("Location: categorie.vue.php");
	}

	switch ($_POST['action']) 
	{
		case 'ajouter':
			$ob = new Categorie(0, $_POST['reference'], $_POST['libcategorie'], $_POST['description'], $_POST['codedouane']);
			$ob->AddBDD($conn);
			header("Location: categorie.vue.php");
			break;

		case 'supprimer':
			$ob = new Categorie($_POST['idcategorie']);
			$ob->DelBDD($conn);
			header("Location: categorie.vue.php");
			break;

		case 'modifier':
			$ob = new Categorie($_POST['idcategorie'], $_POST['reference'], $_POST['libcategorie'], $_POST['description'], $_POST['codedouane']);
			$ob->SaveBDD($conn);
			header("Location: categorie.vue.php");
			break;

		default:
			header("Location: categorie.vue.php");
			break;
	}
?>