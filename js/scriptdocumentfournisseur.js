// autocompletion documentfournisseur
function autocompletDocumentfournisseur() {
    var min_length = 1; // nombre de caractère avant lancement recherch 
    var keyworddocumentfournisseur = $('#nom_iddocumentfournisseur').val(); // nom_id fait référence au champ de recherche puis lancement de la recherche grace ajax_refresh
    if (keyworddocumentfournisseur.length >= min_length) {
        $.ajax({
            url: '../ajaxrefresh/ajax_refreshDocumentfournisseur.php',
            type: 'POST',
            data: { keyworddocumentfournisseur: keyworddocumentfournisseur },
            success: function(data) {
                $('#nom_list_iddocumentfournisseur').show();
                $('#nom_list_iddocumentfournisseur').html(data);
            }
        });
    } else {
        $('#nom_list_iddocumentfournisseur').hide();
    }
}
// Lors du choix dans la liste
function set_itemdocumentfournisseur(item3, item4) {
    // change input value
    $('#nom_iddocumentfournisseur').val(item3);
    $('#nom2_iddocumentfournisseur').val(item4);
    // hide proposition list
    $('#nom_list_iddocumentfournisseur').hide();
}