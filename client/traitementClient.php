<?php
	include '../bdd.class.inc.php';
	include 'client.class.inc.php';

	if (!(isset($_POST['action'])))
	{
		header("Location: client.vue.php");
	}
	switch ($_POST['action']) 
	{
		case 'ajouter':
			$ob = new Client(0, $_POST['nomclient'], $_POST['adresseclient'], $_POST['telephoneclient'], $_POST['emailclient'], $_POST['idcommune'], $_POST['prefixeclient'], $_POST['indicprospect'], $_POST['iban'], $_POST['bic'], $_POST['codebanque'], $_POST['codeguichet'], $_POST['ncompte'], $_POST['clerib'], $_POST['domiciliation'], $_POST['tel2'], $_POST['idtarif'], $_POST['idpaiement']);
			$ob->AddBDD($conn);

			header("Location: client.vue.php");
			break;

		case 'supprimer':
			$ob = new Client($_POST['idclient']);
			$ob->DelBDD($conn);
			header("Location: client.vue.php");
			break;

		case 'modifier':
			$ob = new Client($_POST['idclient'],$_POST['nomclient'],$_POST['adresseclient'],$_POST['telephoneclient'],$_POST['emailclient'],$_POST['idcommune'],$_POST['prefixeclient'],$_POST['indicprospect'],$_POST['iban'],$_POST['bic'],$_POST['codebanque'],$_POST['codeguichet'],$_POST['ncompte'],$_POST['clerib'],$_POST['domiciliation'],$_POST['tel2'],$_POST['idtarif'],$_POST['idpaiement']);
			$ob->SaveBDD($conn);
			header("Location: client.vue.php");
			break;

		default:
			header("Location: client.vue.php");
			break;
	}
?>