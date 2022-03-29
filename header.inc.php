<html lang="fr">
<head>
  <title>ShinyStock</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-form.css">
  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-grid.css">
  <link rel="stylesheet" type="text/css" href="../css/GSS/css/styler1-text.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="../css/Bootstrap/css/bootstrap.css">
   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
   <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.2/datatables.min.css"/>
   <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.2/datatables.min.js"></script>
   <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>

    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="../index.php">&nbsp &nbsp ShinyStock</a>
      <!--<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">-->
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
                <a class="nav-link active" href="../client/client.vue.php">
                  <i class='fa fa-user-o'></i> &nbsp <span data-feather="home"></span>
                  Clients <span class="sr-only">(current)</span>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../fournisseur/fournisseur.vue.php">
                  <i class='fa fa-vcard-o'></i>&nbsp<span data-feather="file"></span>
                  Fournisseurs
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../article/article.vue.php">
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
                <a class="nav-link" href="../commune/commune.vue.php">
                  <span data-feather="file-text"></span>
                  Communes
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../etat/etat.vue.php">
                  <span data-feather="file-text"></span>
                  Etats
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../paiement/paiement.vue.php">
                  <span data-feather="file-text"></span>
                  Paiement
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../tarif/tarif.vue.php">
                  <span data-feather="file-text"></span>
                  Tarifs
                </a>
              </li>
			  <li class="nav-item">
                <a class="nav-link" href="../categorie/categorie.vue.php">
                  <span data-feather="file-text"></span>
                  Catégories
                </a>
              </li>
			  <li class="nav-item">
                <a class="nav-link" href="../societe/societe.vue.php">
                  <span data-feather="file-text"></span>
                  Sociétés
                </a>
              </li>
			  <li class="nav-item">
                <a class="nav-link" href="../casier/casier.vue.php">
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
                <a class="nav-link" href="../document/document.vue.php">
                  <span data-feather="file-text"></span>
                    Commande
                </a>
                <!-- <a class="nav-link" href="../document.vue.php">
                  <span data-feather="file-text"></span>
                    Facturation
                </a> -->
              </li>
            </ul>
            </ul>
          </div>
        </nav>
  <!--<nav class="navbar navbar-expand-lg navbar-dark bg-none" style="background-color: #69C23C;">
    <div class="container-xl">
      <a href="../index.php"><img src="../img/shinystock.png" width="70" height="70" alt=""></a>&nbsp &nbsp
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07XL" aria-controls="navbarsExample07XL" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample07XL">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link" href="client.vue.php">Clients</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="fournisseur.vue.php">Fournisseurs</a>
          </li>
		  <li class="nav-item">
            <a class="nav-link" href="article.vue.php">Articles</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="dropdown07XL" data-bs-toggle="dropdown" aria-expanded="false">Divers</a>
            <ul class="dropdown-menu" aria-labelledby="dropdown07XL">
              <li><a class="dropdown-item" href="ville.vue.php">Communes</a></li>
              <li><a class="dropdown-item" href="etat.vue.php">Etats</a></li>
              <li><a class="dropdown-item" href="paiement.vue.php">Paiement</a></li>
			        <li><a class="dropdown-item" href="tarif.vue.php">Tarifs</a></li>
              <li><a class="dropdown-item" href="categorie.vue.php">Catégories</a></li>
              <li><a class="dropdown-item" href="societe.vue.php">Sociétés</a></li>
			        <li><a class="dropdown-item" href="casier.vue.php">Casiers</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </nav>-->
</body>
</html>