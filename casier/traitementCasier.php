<?php
	include '../bdd.class.inc.php';
	include 'casier.class.inc.php';

	if (!(isset($_POST['action'])))
	{
		header("Location: casier.vue.php");
	}
	switch ($_POST['action']) 
	{
		case 'ajouter':
			$ob = new Casier(0, $_POST['libcasier'], (int)$_POST['idarticle'], '');
			$ob->AddBDD($conn);

			header("Location: casier.vue.php");
			break;

		case 'supprimer':
			$ob = new Casier($_POST['idcasier']);
			$ob->DelBDD($conn);
			header("Location: casier.vue.php");
			break;

		case 'modifier':
			$ob = new Casier($_POST['idcasier'], $_POST['libcasier'], $_POST['idarticle']);
			$ob->SaveBDD($conn);
			header("Location: casier.vue.php");
			break;

		default:
			header("Location: casier.vue.php");
			break;
	}
?>