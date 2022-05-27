<?php

	include '../bdd.class.inc.php';
	include '../all.class.inc.php';

	if (!(isset($_POST['action'])))
	{
		header("Location: detailfournisseur.vue.php");
	}

	switch ($_POST['action']) 
	{
		case 'ajouter':
			$ob = new Detailfournisseur(0,$_POST['iddocumentfournisseur'],$_POST['idarticle'],$_POST['qteachat']);
			$ob->AddBDD($conn);
			header("Location: detailfournisseur.vue.php");
			break;

		case 'supprimer':
			$ob = new Detailfournisseur($_POST['iddetailfournisseur']);
			$ob->DelBDD($conn);
			header("Location: detailfournisseur.vue.php");
			break;

		case 'modifier':
			$ob = new Detailfournisseur($_POST['iddetailfournisseur'],$_POST['iddocumentfournisseur'],$_POST['idarticle'],$_POST['qteachat']);
			$ob->SaveBDD($conn);
			header("Location: detailfournisseur.vue.php");
			break;

		default:
			header("Location: detailfournisseur.vue.php");
			break;
	}
?>