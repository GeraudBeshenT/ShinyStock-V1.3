<?php
	include '../bdd.class.inc.php';
	include 'clients.class.inc.php';

	if (!(isset($_POST['action'])))
	{
		header("Location: client.vue.php");
	}
	switch ($_POST['action']) 
	{
		case 'ajouter':
			$ob = new Clients(0, 0, $_POST['nom'], $_POST['adresse'], $_POST['telephone'], $_POST['email'], (int)$_POST['idcommune'], '', $_POST['prefixe'], $_POST['indicprospect'], $_POST['iban'], $_POST['bic'], $_POST['codebanque'], $_POST['codeguichet'], $_POST['ncompte'], $_POST['clerib'], $_POST['domiciliation'], $_POST['tel2'], (int)$_POST['idtarif'], '', (int)$_POST['idpaiement'], '');
			$ob->AddBDD($conn);

			header("Location: client.vue.php");
			break;

		case 'supprimer':
			$ob = new Clients($_POST['idtiers']);
			$ob->DelBDD($conn);
			header("Location: client.vue.php");
			break;

		case 'modifier':
			$ob = new Clients($_POST['idtiers'], 0, $_POST['nom'], $_POST['adresse'], $_POST['telephone'], $_POST['email'], $_POST['idcommune'], $_POST['prefixe'], $_POST['indicprospect'], $_POST['iban'], $_POST['bic'], $_POST['codebanque'], $_POST['codeguichet'], $_POST['ncompte'], $_POST['clerib'], $_POST['domiciliation'], $_POST['tel2'], $_POST['idtarif'], $_POST['idpaiement']);
			$ob->SaveBDD($conn);
			header("Location: client.vue.php");
			break;

		default:
			header("Location: client.vue.php");
			break;
	}
?>