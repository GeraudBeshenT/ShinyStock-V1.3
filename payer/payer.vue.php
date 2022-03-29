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
            <h1 class="h2">Commandes</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-toolbar mb-2 mb-md-0">
			  <form method='POST' action='../modif/modifPayer.php'>
                <input name='action' type='hidden' value='ajouter'/>
                <button type='submit' class='btn btn-secondary'>Ajouter</button>
			  </form> &nbsp
              <button class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            </div>
          </div>
		<script type="text/javascript">
            
			$(document).ready(function () {
                $('#Payer').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'serverMethod': 'post',
                    'ajax': {
                        'url': 'ajaxfilesPayer.php',
                    },
                    'columns': [
                    // Récuperation des valeurs pour compléter le tableau ... #datatable 
                        // {data: 'id_tarif'},
						{data: 'lib_tarif'},
                        {data: 'Nom_article'},
                        {data: 'montant'},
                        {data: 'actions'},
                    ],
                });
				var table = $('#example').DataTable();
			 
				$('#Payer tbody').on( 'click', 'tr', function () {
					if ( $(this).hasClass('selected') ) {
						$(this).removeClass('selected');
					}
				} );
			 
            });
			
			$('#myModal').on('shown.bs.modal', function () {
				$('#myInput').trigger('focus')
			})

		</script>
        <div class="container"><br>
        <!-- Bouton ajouter qui renvoie au formulaire de modification dont la valeur est AJOUTER. -->
            <table id = 'Payer' class = 'display dataTable text-center '>
                <thead>
                    <tr>
                        <!--<th>ID Payer</th>-->
						<th>Tarif</th>
                        <th>Nom Article</th>
                        <th>Montant</th>
                        <th>Actions</th>
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



