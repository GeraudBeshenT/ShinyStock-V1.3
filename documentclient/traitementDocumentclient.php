<?php

	include '../bdd.class.inc.php';
	include '../all.class.inc.php';

	if (!(isset($_POST['action'])))
	{
		header("Location: documentclient.vue.php");
	}

	switch ($_POST['action']) 
	{
		case 'ajouter':
			$ob = new Documentclient($_POST['iddocumentclient'],$_POST['datedocclient'],$_POST['commentaireclient'],$_POST['statutclient'],$_POST['idetat'],$_POST['idclient']);
			$ob->AddBDD($conn);
			header("Location: documentclient.vue.php");
			break;

		case 'supprimer':
			$ob = new Documentclient($_POST['iddocumentclient']);
			$ob->DelBDD($conn);
			header("Location: documentclient.vue.php");
			break;

		case 'modifier':
			$ob = new Documentclient($_POST['iddocumentclient'],$_POST['datedocclient'],$_POST['commentaireclient'],$_POST['statutclient'],$_POST['idetat'],$_POST['idclient']);
			$ob->SaveBDD($conn);
			header("Location: documentclient.vue.php");
			break;

		default:
			header("Location: documentclient.vue.php");
			break;
	}
?>