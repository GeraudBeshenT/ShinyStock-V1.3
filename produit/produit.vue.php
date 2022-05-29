<!DOCTYPE html>
<html>
        <title>ShinyStock - Produit</title>
    <body>
        <?php
            include '../header.inc.php';
            include '../bdd.class.inc.php';
        ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Produit</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-toolbar mb-2 mb-md-0">
              <form method='POST' action='modifProduit.php'>
                <input name='action' type='hidden' value="ajouter"/>
                <button type='submit' class='btn btn-secondary'>Ajouter</button>
              </form>
            </div>
            </div>
          </div>
        
        <script type="text/javascript">
            
            $(document).ready(function () {
            const queryString = window.location.search;
            const urlParams = new URLSearchParams(queryString);
            var id = urlParams.get('id');
                $('#Produit').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'serverMethod': 'post',
                    'ajax': {
                        'url': 'ajaxfilesProduit.php?id='+id,
                    },
                    'columns': [
                        // {data: 'idproduit'},
                        {data: 'libarticle'},
                        {data: 'qtearticle'},
                        {data: 'actions'},
                    ],
                });
            });
            
        </script>
        <div class="container"><br>
            <table id = 'Produit' class = 'display dataTable text-center '>
                <thead>
                    <tr>
                        <!-- <th>id Produit</th> -->
                        <th>Article composant le produit</th>
                        <th>Quantité</th>
                        <th>Actions</th>
                    </tr>    
                </thead>        
            </table>    
        </div>    
        <div class="mb-5"></div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    </body>
    <?php
        include '../footer.inc.php';
    ?>
</html>












