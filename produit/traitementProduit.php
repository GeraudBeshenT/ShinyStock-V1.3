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
			$ob = new Produit($_POST['id'],$_POST['lib']);
			$ob->AddProduitBDD($conn);
			header("Location: produit.vue.php");
			break;

		case 'supprimer':
			$ob = new Produit($_POST['id']);
			$ob->DelProduitBDD($conn);
			header("Location: article.vue.php");
			break;

		case 'modifier':
			$ob = new Produit($_POST['id_article_produit'],$_POST['id_article_article'],$_POST['qte_article']);
			$ob->SaveProduitBDD($conn);
			header("Location: produit.vue.php");
			break;
			
		case 'compose':
			$ob = new Produit($_POST['produit']);
			$ob->AddComposant($conn,$_POST['article'],$_POST['quantite']);
			header("Location: produit.vue.php?id_article=".$_POST['produit']);
			break;

		default:
			header("Location: produit.vue.php");
			break;
	}

?>