<!DOCTYPE html>
<html>
        <title>ShinyStock - Fournisseur</title>
    <body>
        <?php
            include '../header.inc.php';
            include '../bdd.class.inc.php';
        ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Types de Fournisseur</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-toolbar mb-2 mb-md-0">
              <form method='POST' action='modifFournisseur.php'>
                <input name='action' type='hidden' value="ajouter"/>
                <button type='submit' class='btn btn-secondary'>Ajouter</button>
              </form>  &nbsp
              <button class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            </div>
          </div>
        
        <script type="text/javascript">
            
            $(document).ready(function () {
                $('#Fournisseur').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'serverMethod': 'post',
                    'ajax': {
                        'url': 'ajaxfilesFournisseur.php',
                    },
                    'columns': [
                        // {data: 'idfournisseur'},
                        {data: 'nomfournisseur'},
                        {data: 'adressefournisseur'},
                        {data: 'emailfournisseur'},
                        {data: 'telephonefournisseur'},
                        {data: 'libcommune'},
                        {data: 'actions'},
                    ],
                });
            });
            
        </script>
        <div class="container"><br>
            <table id = 'Fournisseur' class = 'display dataTable text-center '>
                <thead>
                    <tr>
                        <!-- <th>id fournisseur</th> -->
                        <th>Fournisseur</th>
                        <th>Adresse postale</th>
                        <th>Adresse email</th>
                        <th>N° de téléphone</th>
                        <th>Ville</th>
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












