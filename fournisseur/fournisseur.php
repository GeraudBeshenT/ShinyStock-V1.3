<!DOCTYPE html>
<html>
        <title>ShinyStock - Données fournisseur</title>
    <body>

        <?php
            include '../header.inc.php';
            include '../bdd.class.inc.php';
            include '../all.class.inc.php';
            $ob = new Fournisseur();
        ?>

         <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <?php
                if ($_POST['action'] == 'voir')
                {
                    $ob = new Fournisseur($_POST['idfournisseur']);
                    $ob->GetByID($conn);
                    $action = 'voir';
                        echo "<p class='size-18 text-center'><b>Consulter les données de ",$ob->Getnomfournisseur(), "</b></p><br>";
                    echo "<div class='btn-toolbar mb-2 mb-md-0'></div>";
                    echo "</div>";
                    }
                
                    echo "<p><b>- Fournisseur</b> : ", $ob->Getlibsociete(),"&nbsp", $ob->Getnomfournisseur(),"</p>";
                    echo "<p><b>- Coordonnées</b> : ", $ob->Gettelephonefournisseur(), ",&nbsp", $ob->Getemailfournisseur(),"</p>";
                    echo "<p><b>- Adresse</b> : ", $ob->Getadressefournisseur(), ",&nbsp", $ob->Getlibcommune(),"</p>";
                    echo "<p><b>- Tarif indiqué</b> : ", $ob->Getlibtarif(),"</p>";
                    echo "<p><b>- Moyen de paiement</b> : ", $ob->Getlibpaiement(),"</p>";
                    echo "<p><b>- Infos légales</b> : ", $ob->Getcodefournisseur(),"</p>";
        ?>
        
        
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
    <!-- <button type="button" class="btn btn-primary btn-large" data-toggle="modal" data-target="#Veto">Afficher</button> -->

    
    <?php
        include '../footer.inc.php';
    ?>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>