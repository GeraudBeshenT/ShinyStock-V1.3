<!DOCTYPE html>
<html>
    <title>ShinyStock - Client</title>
    <body>
        <?php
            include '../header.inc.php';
            include '../bdd.class.inc.php';
            include '../all.class.inc.php';
            $ob = new Document();
        ?>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Document</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-toolbar mb-2 mb-md-0">
              <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#AjDocument">Ajouter</button>&nbsp
              <button class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            </div>
          </div>

        <div class="modal fade" id="AjDocument" tabindex="-1" role="dialog" aria-labelledby="purchaseLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="purchaseLabel">Ajouter un document</h4>
                    </div>
                    <div class="modal-body">
                        <form method='POST' action='traitementDocument.php'>
                            <div class='row'>
                                <input name='num_documents' type='hidden' value='<?php echo $ob->GetNum_documents(); ?>'/>
                                <div class='col-4'>Commentaire: 
                                    <input name='commentaire' type='text' value='<?php echo $ob->GetCommentaire(); ?>' /><br>
                                </div>
                                <div class='col-4'>Statut: 
                                    <input name='Statut' type='text' value='<?php echo $ob->GetStatut(); ?>'/><br>
                                </div>
                                <div class='col-4'>État: 
                                    <input name='id_etat' type='text' value='<?php echo $ob->GetLib_Etat()->GetID(); ?>' /><br>
                                </div>
                                <div class='col-4'>Tiers: 
                                    <input name='id_tiers' type='text' value='<?php echo $ob->GetLib_Tiers()->GetID();; ?>'/><br>
                                </div>
                                <input name='action' type='hidden' value='ajouter'/>
                            </div>
                            
                         
                    </div>
                    <div class="modal-footer">
                        <button type='submit' class='button bg_green-radius_5 rounded-pill'>Sauvegarder</button>
                        <button type="button" class="btn btn-danger rounded-pill" data-dismiss="modal">fermer</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            
            $(document).ready(function () {
                $('#Document').DataTable({
                    'processing': true,
                    'serverSide': true,
                    'serverMethod': 'post',
                    'ajax': {
                        'url': 'ajaxfilesDocument.php',
                    },
                    'columns': [
                        {data: 'date_documents'},
                        {data: 'commentaire'},
                        {data: 'statut'},
                        {data: 'id_etat'},
                        {data: 'id_tiers'},
                        {data: 'actions'}
                    ],
                });
            });
            
        </script>
        <div class="container"><br>
            <table id = 'Document' class = 'display dataTable text-center '>
                <thead>
                    <tr>
                        <th>date_documents</th>
                        <th>commentaire</th>
                        <th>statut</th>
                        <th>id état</th>
                        <th>id tiers</th>
                        <th>ACTIONS</th>
                    </tr>
                </thead>
            </table>
        </div>
        <div class="mb-5"></div>

        <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="purchaseLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="purchaseLabel"></h4>
                    </div>
                    <div class="modal-body">
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">fermer</button>
                    </div>
                </div>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    </body>
    <!-- <button type="button" class="btn btn-primary btn-large" data-toggle="modal" data-target="#Veto">Afficher</button> -->

    
    <?php
        include '../footer.inc.php';
    ?>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>