<!DOCTYPE html>
<html>
	<head>
		<title>ShinyStock - Produit</title>
		<meta charset="utf-8">
		<script type='text/javascript' src='js/jquery.min.js'></script>
		<script type='text/javascript' src='js/script.js'></script>
	</head>
    <body>
        <?php
            include '../header.inc.php';
            include '../bdd.class.inc.php';
        ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Produits</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-toolbar mb-2 mb-md-0">
			  <button type='button' class='btn btn-secondary' data-toggle='modal' data-target='#exampleModalCenter'>Ajouter</button> &nbsp
			  <form method='POST' action='modifProduit.php'>
                <input name='action' type='hidden' value="ajouter"/>
				<button type='button' class='btn btn-secondary' onclick="production(table)">Créer un produit</button>
			  </form> &nbsp
              <button class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            </div>
          </div>
		
		<script type="text/javascript">
            
			$(document).ready(function () {
				const queryString = window.location.search;
				const urlParams = new URLSearchParams(queryString);
				var id_article = urlParams.get('id_article');
                table = $('#Produit').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'serverMethod': 'post',
                    'ajax': {
                        'url': 'ajaxfilesProduit.php?id_article_produit='+ id_article,
                    },
                    'columns': [
						{data: 'id_article_article'},
						{data: 'nom_article'},
                        {data: 'qte_article'},
						{data: 'Qte_stock'},
                        {data: 'actions'},                   
                    ],
                });
            });
            
        </script>
		
		
		<script>
          function myFunction(a,b,c,d,e) 
          {
            document.getElementById("titre").textContent=a;
            document.getElementById("id_article").value=b;
            document.getElementById("nom_article").value=c;
            document.getElementById("nom_idProduit").value=d;
            document.getElementById("nom2_idProduit").value=e;
          }
        </script>
		
		
        <div class="container"><br>
				<!-- Modal -->
				<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<form method="POST" action="traitementProduit.php">
						<div class="modal-body">
							<div class="form-group">
								<label for="article">Sélectionnez les articles</label>
								<input type="number" name="article" class="form-control" onkeyup="autocompleteProduit()" placeholder="Tapez un article">
								<input type="hidden" name="produit" value="<?php echo $_GET['id_article']; ?>">
								<input type="hidden" name="action" value="compose">
								<ul id="nom_list_idProduit"></ul>
							</div>
							<label for="quantite">Indiquez la quantité</label>
							<input type="number" class="form-control" name="quantite" placeholder="Quantité">
						</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
						<button type="submit" class="btn btn-primary">Valider</button>
					</div>
					</form>
					<div class="modal-header">
						<h5 class="modal-title" id="exampleModalLongTitle">Ajouter des articles au produit</h5>
					</div>
				</div>
			</div>
		</div>
			
            <table id = 'Produit' class = 'display dataTable text-center '>
                <thead>
                    <tr>
						<th>ID Composant</th>
						<th>Composants</th>
                        <th>Quantité nécessaire</th>
						<th>Quantité en stock</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="mb-5"></div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </body>
        
    <script>
				function production(table) {
					const queryString = window.location.search;
					const urlParams = new URLSearchParams(queryString);
					var id_article = urlParams.get('id_article');
					if (table.rows().count() == 0) {
                            alert('cet article ne possède pas de composants');
                            return;
                        }
                        let quantite_production = prompt("Quel est la quantité de ce produit à produire ?");
                        if (!quantite_production) {
                            return;
                        }
                        if (quantite_production < 1) {
                            alert('veuillez choisir une quantité supérieure à 0');
                            return;
                        }
                        let id_comp = table.columns().data()[0];
                        let lib_comp = table.columns().data()[1];
                        let quantite_p = table.columns().data()[2];
                        let quantite_s = table.columns().data()[3];
                        let data = {};
                        for (let i = 0; i < id_comp.length; i++) {
                            data[i] = {
                                'id': id_comp[i],
                                'lib': lib_comp[i],
                                'qte_p': quantite_p[i],
                                'qte_s': quantite_s[i]
                            };
                            if (data[i]['qte_p'] * quantite_production > data[i]['qte_s']) {
                                alert('Pas assez de "' + data[i]['lib'] + '" pour la production!');
                                var block = true;
                            }
                        }
                        if (block) {
                            return;
                        } else {
							console.log(data);
                            $.ajax({
                                url: '../ajaxrefresh/production.php?id_article=' + id_article + '&quantite=' + quantite_production,
                                method: 'POST',
                                dataType: 'json',
                                data: { 'jsonData': data },
                                complete: function(result) {
                                    $('#Produit').DataTable().ajax.reload();
                                },
                            });
                        }
				}
	</script>
    
	<?php
        include '../footer.inc.php';
    ?>
</html>




