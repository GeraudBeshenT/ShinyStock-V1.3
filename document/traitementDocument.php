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
			$ob = new Document($_POST['num_documents'],$_POST['date_documents'],$_POST['commentaire'],$_POST['staut'],$_POST['id_etat'],$_POST['id_tiers'],$_POST['num_documents_document_fini']);
			$ob->AddDocumentsBDD($conn);
			header("Location: document.vue.php");
			break;

		case 'supprimer':
			$ob = new Document($_POST['num_documents']);
			$ob->DelDocumentsBDD($conn);
			header("Location: document.vue.php");
			break;

		case 'modifier':
			$ob = new Document($_POST['num_documents'],$_POST['lib'],$_POST['commentaire'],$_POST['staut'],$_POST['id_etat'],$_POST['id_tiers'],$_POST['num_documents_document_fini']);
			$ob->SaveDocumentsBDD($conn);
			header("Location: document.vue.php");
			break;

		default:
			header("Location: document.vue.php");
			break;
	}
?>