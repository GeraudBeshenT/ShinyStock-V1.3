<?php

	include '../bdd.class.inc.php';
	include '../all.class.inc.php';

	if (!(isset($_POST['action'])))
	{
		header("Location: document.vue.php");
	}

	switch ($_POST['action']) 
	{
		case 'ajouter':
			$ob = new Document($_POST['iddocumentclient'],$_POST['datedocclient'],$_POST['commentaireclient'],$_POST['statutclient'],$_POST['idetat'],$_POST['idfournisseur']);
			$ob->AddBDD($conn);
			header("Location: document.vue.php");
			break;

		case 'supprimer':
			$ob = new Document($_POST['iddocumentclient']);
			$ob->DelBDD($conn);
			header("Location: document.vue.php");
			break;

		case 'modifier':
			$ob = new Document($_POST['iddocumentclient'],$_POST['datedocclient'],$_POST['commentaireclient'],$_POST['statutclient'],$_POST['idetat'],$_POST['idfournisseur']);
			$ob->SaveBDD($conn);
			header("Location: document.vue.php");
			break;

		default:
			header("Location: document.vue.php");
			break;
	}
?>