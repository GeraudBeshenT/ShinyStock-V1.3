<?php
	include '../bdd.class.inc.php';
	include 'fournisseur.class.inc.php';

	if (!(isset($_POST['action'])))
	{
		header("Location: fournisseur.vue.php");
	}
	switch ($_POST['action']) 
	{
		case 'ajouter':
			$ob = new Fournisseur(0, 1, $_POST['nom'], $_POST['adresse'], $_POST['telephone'], $_POST['email'], (int)$_POST['idcommune'], '', $_POST['prefixe'], $_POST['indicprospect'], $_POST['iban'], $_POST['bic'], $_POST['codebanque'], $_POST['codeguichet'], $_POST['ncompte'], $_POST['clerib'], $_POST['domiciliation'], $_POST['tel2'], (int)$_POST['idtarif'], '', (int)$_POST['idsociete'],'', (int)$_POST['idpaiement'], '', $_POST['codefournisseur'], $_POST['libfournisseur']);
			$ob->AddBDD($conn);
			header("Location: fournisseur.vue.php");
			break;

		case 'supprimer':
			$ob = new Fournisseur($_POST['idtiers']);
			$ob->DelBDD($conn);
			header("Location: fournisseur.vue.php");
			break;

		case 'modifier':
			$ob = new Fournisseur($_POST['idtiers'], 1, $_POST['nom'], $_POST['adresse'], $_POST['telephone'], $_POST['email'], $_POST['idcommune'], $_POST['prefixe'], $_POST['idtarif'], $_POST['idsociete'], $_POST['idpaiement'], $_POST['codefournisseur'], $_POST['libfournisseur']);
			$ob->SaveBDD($conn);
			header("Location: fournisseur.vue.php");
			break;

		default:
			header("Location: fournisseur.vue.php");
			break;
	}
?>