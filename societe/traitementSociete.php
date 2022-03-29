<?php

	include '../bdd.class.inc.php';
	include '../all.class.inc.php';

	if (!(isset($_POST['action'])))
	{
		header("Location: societe.vue.php");
	}

	switch ($_POST['action']) 
	{
		case 'ajouter':
			$ob = new Societe($_POST['idsociete'],$_POST['libsociete']);
			$ob->AddBDD($conn);
			header("Location: societe.vue.php");
			break;

		case 'supprimer':
			$ob = new Societe($_POST['idsociete']);
			$ob->DelBDD($conn);
			header("Location: societe.vue.php");
			break;

		case 'modifier':
			$ob = new Societe($_POST['idsociete'],$_POST['libsociete']);
			$ob->SaveBDD($conn);
			header("Location: societe.vue.php");
			break;

		default:
			header("Location: societe.vue.php");
			break;
	}
?>