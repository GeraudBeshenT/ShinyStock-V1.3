<?php

	include '../bdd.class.inc.php';
	include '../all.class.inc.php';

	if (!(isset($_POST['action'])))
	{
		header("Location: paiement.vue.php");
	}

	switch ($_POST['action']) 
	{
		case 'ajouter':
			$ob = new Paiement($_POST['idpaiement'],$_POST['libpaiement']);
			$ob->AddBDD($conn);
			header("Location: paiement.vue.php");
			break;

		case 'supprimer':
			$ob = new Paiement($_POST['idpaiement']);
			$ob->DelBDD($conn);
			header("Location: paiement.vue.php");
			break;

		case 'modifier':
			$ob = new Paiement($_POST['idpaiement'],$_POST['libpaiement']);
			$ob->SaveBDD($conn);
			header("Location: paiement.vue.php");
			break;

		default:
			header("Location: paiement.vue.php");
			break;
	}
?>