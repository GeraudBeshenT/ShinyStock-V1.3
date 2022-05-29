<?php

	include '../bdd.class.inc.php';
	include '../all.class.inc.php';

	if (!(isset($_POST['action'])))
	{
		header("Location: detailclient.vue.php");
	}

	switch ($_POST['action']) 
	{
		case 'ajouter':
			$ob = new Detailclient(0,$_POST['iddocumentclient'],$_POST['idarticle'],$_POST['qteachat']);
			$ob->AddBDD($conn);
			header("Location: documentclient.vue.php");
			break;

		case 'supprimer':
			$ob = new Detailclient($_POST['iddetailclient']);
			$ob->DelBDD($conn);
			header("Location: documentclient.vue.php");
			break;

		case 'modifier':
			$ob = new Detailclient($_POST['iddetailclient'],$_POST['iddocumentclient'],$_POST['idarticle'],$_POST['qteachat']);
			$ob->SaveBDD($conn);
			header("Location: documentclient.vue.php");
			break;

		default:
			header("Location: documentclient.vue.php");
			break;
	}
?>