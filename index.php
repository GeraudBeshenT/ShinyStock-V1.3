<!DOCTYPE html>
<html lang="fr">
<head>
  <title>ShinyStock</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="./css/GSS/css/styler1-form.css">
  <link rel="stylesheet" type="text/css" href="./css/GSS/css/styler1-grid.css">
  <link rel="stylesheet" type="text/css" href="./css/GSS/css/styler1-text.css">
  <link rel="stylesheet" href="./css/Bootstrap/css/bootstrap.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.2/datatables.min.css"/>
   <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.2/datatables.min.js"></script>
</head>
<body>
  
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../index.php">&nbsp &nbsp UV-Light</a>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Déconnexion</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column"><br>
              <li class="nav-item">
                <a class="nav-link active" href="./client/client.vue.php">
                  <i class='fa fa-user-o'></i> &nbsp <span data-feather="home"></span>
                  Clients <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./fournisseur/fournisseur.vue.php">
                  <i class='fa fa-vcard-o'></i>&nbsp<span data-feather="file"></span>
                  Fournisseurs
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./article/article.vue.php">
                  <i class='fa fa-shopping-basket'></i>&nbsp<span data-feather="shopping-cart"></span>
                  Articles
                </a>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Tables de références</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="./commune/commune.vue.php">
                  <span data-feather="file-text"></span>
                  Communes
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./etat/etat.vue.php">
                  <span data-feather="file-text"></span>
                  Etats
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./paiement/paiement.vue.php">
                  <span data-feather="file-text"></span>
                  Paiement
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./Tarif/tarif.vue.php">
                  <span data-feather="file-text"></span>
                  Tarifs
                </a>
              </li>
			  <li class="nav-item">
                <a class="nav-link" href="./categorie/categorie.vue.php">
                  <span data-feather="file-text"></span>
                  Catégories
                </a>
              </li>
			  <li class="nav-item">
                <a class="nav-link" href="./societe/societe.vue.php">
                  <span data-feather="file-text"></span>
                  Sociétés
                </a>
              </li>
			  <li class="nav-item">
                <a class="nav-link" href="./casier/casier.vue.php">
                  <span data-feather="file-text"></span>
                  Casiers
                </a>
              </li>
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Tables de commandes</span>
              <a class="d-flex align-items-center text-muted" href="#">
                <span data-feather="plus-circle"></span>
              </a>
            </h6>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="./documentfournisseur/documentfournisseur.vue.php">
                  <span data-feather="file-text"></span>
                    Bons de commande fournisseurs
                </a>
              </li>
            <ul class="nav flex-column mb-2">
              <li class="nav-item">
                <a class="nav-link" href="./documentclient/documentclient.vue.php">
                  <span data-feather="file-text"></span>
                    Bons de commande clients
                </a>
              </li>
            </ul>
            </ul>
          </div>
        </nav>
<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
          </div><br><br>
			<h1 class="heading-1 text-center">Bienvenue sur l'application ShinyStock !</h1><br><br>
        </main>
      </div>
    </div>
    </div>
    <div class="mb-5"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
		
	</body>
    <?php
        include 'footer.inc.php';
    ?>
</html>
