<?php
	
	// Ouverture du fichier CSV, création du fichier "content_annuaire.sql" et extraction des données.
	
	$fichier = fopen("article_contenu.sql", "w") or die ("Impossible d'écrire dans le fichier");
	$row = 1;
	if (($handle = fopen("articles_contenu.csv", "r")) !== FALSE) {
		while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
		$nom_article = $data[0];
		$sous_fam = $data[1];
		$ref_four = $data[2];
		$gencod = $data[3];
		$frais = $data[4];
		$qte_cde_fou = $data[5];
		$qte_stock = $data[6];
		$cpt_ac = $data[7];
		$cpt_ve_m = $data[8];
		$cpt_ve_c = $data[9];
		$cpt_ve_om = $data[10];
		$cpt_ve_e = $data[11];
		$cpt_ve_cee = $data[12];
		$commentaire = $data[13];
		$null = NULL;
		
		
	// Ecriture de la requête en reprenant les valeurs contenues dans les variables itérées et éventuellement modifiées au dessus (boucle if).
	 
		fwrite($fichier, "INSERT INTO article (id_article,nom_article,sous_fam,ref_four,genrod,frais,qte_cde_fou,qte_stock,cpt_ac,cpt_ve_m,cpt_ve_c,cpt_ve_om,cpt_ve_e,cpt_ve_cee,commentaire,id_categorie,b_suparticle) VALUES (" . "NULL" . ", '" . $nom_article . "', " . 4187364 . ", " . 19821 .", " . 187220 . ", " . 8827 . ", " . 1783 . ", " . 77329 . ", " . 738210 . ", " . 183920 . ", " . 782919 . ", " . 1981718 . ", " . 171019 . " , " . 10829 . ", '" . 'Super Outils' . "', " . 5 . ", " . 0 .");\n\n");
	}	
	
	// Fermeture des différents fichiers
	
		fclose($fichier);
		fclose($handle);
	}

?>