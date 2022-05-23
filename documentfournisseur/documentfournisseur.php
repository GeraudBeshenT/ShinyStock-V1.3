<!DOCTYPE html>
<html>
        <title>ShinyStock - fournisseur</title>
    <body>

		<?php
			include 'header.inc.php';
			include '../bdd/bdd.class.inc.php';
            include '../class/all.class.inc.php';
            $ob = new Documentfournisseur();
		?>

         <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
		<?php
				if ($_GET['action'] == 'voir')
				{
					$ob = new Documentfournisseur($_GET['id']);
					$ob->GetByID($conn);
					$action = 'voir';
						echo "<p class='size-18 text-center'><b>Consulter les données de ",$ob->GetID(), "</b></p><br>";
					echo "<div class='btn-toolbar mb-2 mb-md-0'></div>";
					echo "</div>";
					}
				
					echo "<p><b>- Date document</b> : ", $ob->GetDate_Document(),"</p>";
					echo "<p><b>- Satut</b> : ", $ob->GetStatut();
					echo "<p><b>- Commentaire</b> : ", $ob->GetCommentaire(),"</p>";
					echo "<p><b>- Etat</b> : ", $ob->GetEtat(),"</p>";
					echo "<p><b>- Tiers</b> : ", $ob->GetTiers(),"</p>";
		?>
		
		
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
    <!-- <button type="button" class="btn btn-primary btn-large" data-toggle="modal" data-target="#Veto">Afficher</button> -->

    
    <?php
        include 'footer.inc.php';
    ?>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>