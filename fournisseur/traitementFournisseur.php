<?php

	include '../bdd.class.inc.php';
	include '../all.class.inc.php';

	if (!(isset($_POST['action'])))
	{
		header("Location: fournisseur.vue.php");
	}

	switch ($_POST['action']) 
	{
		case 'ajouter':
			$ob = new Fournisseur($_POST['idfournisseur'],$_POST['nomfournisseur'],$_POST['adressefournisseur'],$_POST['telephonefournisseur'],$_POST['emailfournisseur'],$_POST['idcommune'],$_POST['prefixefournisseur'],$_POST['idsociete'],$_POST['idpaiement'],$_POST['codefournisseur']);
			$ob->AddBDD($conn);
			header("Location: fournisseur.vue.php");
			break;

		case 'supprimer':
			$ob = new Fournisseur($_POST['idfournisseur']);
			$ob->DelBDD($conn);
			header("Location: fournisseur.vue.php");
			break;

		case 'modifier':
			$ob = new Fournisseur($_POST['idfournisseur'],$_POST['nomfournisseur'],$_POST['adressefournisseur'],$_POST['telephonefournisseur'],$_POST['emailfournisseur'],$_POST['idcommune'],$_POST['prefixefournisseur'],$_POST['idsociete'],$_POST['idpaiement'],$_POST['codefournisseur']);
			$ob->SaveBDD($conn);
			header("Location: fournisseur.vue.php");
			break;

		default:
			header("Location: fournisseur.vue.php");
			break;
	}
?>