<?php

	include '../bdd.class.inc.php';
	include '../all.class.inc.php';

	if (!(isset($_POST['action'])))
	{
		header("Location: produit.vue.php");
	}

	switch ($_POST['action']) 
	{
		case 'ajouter':
			$ob = new Produit($_POST['idproduit'],$_POST['idarticleInitial'],$_POST['idarticleCompose'],$_POST['qtearticle']);
			$ob->AddBDD($conn);
			header("Location: produit.vue.php");
			break;

		case 'supprimer':
			$ob = new Produit($_POST['idproduit']);
			$ob->DelBDD($conn);
			header("Location: article.vue.php");
			break;

		case 'modifier':
			$ob = new Produit($_POST['idproduit'],$_POST['idarticleInitial'],$_POST['idarticleCompose'],$_POST['qtearticle']);
			$ob->SaveBDD($conn);
			header("Location: produit.vue.php");
			break;
			
		default:
			header("Location: produit.vue.php");
			break;
	}

?>