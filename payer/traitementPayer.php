<?php
	
	include '../bdd.class.inc.php';
	include '../all.class.inc.php';

	if (!(isset($_POST['action'])))
	{
		header("Location: payer.vue.php");
	}
	
	switch ($_POST['action']) 
	{
		case 'ajouter':
			$ob = new Payer($_POST['id_tarif'],	$_POST['id_article'], $_POST['montant']);
			$ob->AddPayerBDD($conn);
			header("Location: payer.vue.php");
			break;

		case 'supprimer':
			$ob = new Payer($_POST['id']);
			$ob->DelPayerBDD($conn);
			header("Location: payer.vue.php");
			break;

		case 'modifier':
			$ob = new Payer($_POST['id_tarif'], $_POST['id_article'], $_POST['montant']);
			$ob->SavePayerBDD($conn);
			header("Location: payer.vue.php");
			break;

		default:
			header("Location: payer.vue.php");
			break;
	}
?>