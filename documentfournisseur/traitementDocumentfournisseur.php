<?php

	include '../bdd.class.inc.php';
	include '../all.class.inc.php';

	if (!(isset($_POST['action'])))
	{
		header("Location: documentfournisseur.vue.php");
	}

	switch ($_POST['action']) 
	{
		case 'ajouter':
			$ob = new Documentfournisseur(0,$_POST['datedocfournisseur'],$_POST['commentairefournisseur'],$_POST['statutfournisseur'],$_POST['idetat'],$_POST['idfournisseur']);
			$ob->AddBDD($conn);
			header("Location: documentfournisseur.vue.php");
			break;

		case 'supprimer':
			$ob = new Documentfournisseur($_POST['iddocumentfournisseur']);
			$ob->DelBDD($conn);
			header("Location: documentfournisseur.vue.php");
			break;

		case 'modifier':
			$ob = new Documentfournisseur($_POST['iddocumentfournisseur'],$_POST['datedocfournisseur'],$_POST['commentairefournisseur'],$_POST['statutfournisseur'],$_POST['idetat'],$_POST['idfournisseur']);
			$ob->SaveBDD($conn);
			header("Location: documentfournisseur.vue.php");
			break;

		default:
			header("Location: documentfournisseur.vue.php");
			break;
	}
?>