<!DOCTYPE html>
<html>
    <head>
        <title>ShinyStock - Articles</title>
        <meta charset="utf-8">
	</head>
    <body>
		<?php
			include '../header.inc.php';
			include '../bdd.class.inc.php';
		?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Articles</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-toolbar mb-2 mb-md-0">
			  <form method='POST' action='modifArticle.php'>
                <input name='action' type='hidden' value='ajouter'/>
                <button type='submit' class='btn btn-secondary'>Ajouter</button>
			  </form>
            </div>
            </div>
          </div>
		<script type="text/javascript">
            
			$(document).ready(function () {
                $('#Articles').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'serverMethod': 'post',
                    'ajax': {
                        'url': 'ajaxfilesArticle.php',
                    },
                    'columns': [
                    // Récuperation des valeurs pour compléter le tableau ... #datatable 
                        {data: 'libarticle'},
                        {data: 'qtestock'},
                        {data: 'qtecdefou'},
						// {data: 'description'},
                        {data: 'libcategorie'},
                        {data: 'produit'},
                        {data: 'actions'}
                    ],
                });
            });
			
		</script>
        <div class="container"><br>
        <!-- Bouton ajouter qui renvoie au formulaire de modification dont la valeur est AJOUTER. -->
            <table id = 'Articles' class = 'display dataTable text-center '>
                <thead>
                    <tr>
                        <th>libarticle</th>
                        <th>Quantité en stock</th>
                        <th>Quantité commandé au fournisseur</th>
                        <!-- <th>Commentaire</th> -->
						<th>Description</th>
                        <th>Création de produit</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="mb-5"></div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
		
	</body>
    <?php
        include '../footer.inc.php';
    ?>
</html>



