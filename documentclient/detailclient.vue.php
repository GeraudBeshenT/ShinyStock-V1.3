<!DOCTYPE html>
<html>
    <title>uv-light - Document</title>
    <body>
        <?php
            include '../header.inc.php';
            include '../bdd.class.inc.php';
        ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Bons de commande Clients</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-toolbar mb-2 mb-md-0">
              <form method='POST' action='modifDetailclient.php'>
                <input name='action' type='hidden' value="ajouter"/>
                <button type='submit' class='btn btn-secondary'>Ajouter</button>
              </form>  &nbsp
              <button class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            </div>
          </div>
        <script type="text/javascript">
            
            $(document).ready(function () {
                $('#detail').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'serverMethod': 'post',
                    'ajax': {
                        'url': 'ajaxfilesDetailclient.php',
                    },
                    'columns': [
                        {data: 'iddetailclient'},
                        {data: 'datedocclient'},
                        {data: 'libarticle'},
                        {data: 'qteachat'},
                        {data: 'actions'}
                    ],
                });
            });
            
        </script>
        <div class="container"><br>
            <table id = 'detail' class = 'display dataTable text-center '>
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>document</th>
                        <th>Article</th>
                        <th>Quantité acheté</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>    
        </div>    
        <div class="mb-5"></div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
    <!-- <button type="button" class="btn btn-primary btn-large" data-toggle="modal" data-target="#Veto">Afficher</button> -->

    
    <?php
        include '../footer.inc.php';
    ?>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>