// autocompletion documentclient
function autocompletDocumentclient() {
    var min_length = 1; // nombre de caractère avant lancement recherch 
    var keyworddocumentclient = $('#nom_iddocumentclient').val(); // nom_id fait référence au champ de recherche puis lancement de la recherche grace ajax_refresh
    if (keyworddocumentclient.length >= min_length) {
        $.ajax({
            url: '../ajaxrefresh/ajax_refreshDocumentclient.php',
            type: 'POST',
            data: { keyworddocumentclient: keyworddocumentclient },
            success: function(data) {
                $('#nom_list_iddocumentclient').show();
                $('#nom_list_iddocumentclient').html(data);
            }
        });
    } else {
        $('#nom_list_iddocumentclient').hide();
    }
}
// Lors du choix dans la liste
function set_itemdocumentclient(item3, item4) {
    // change input value
    $('#nom_iddocumentclient').val(item3);
    $('#nom2_iddocumentclient').val(item4);
    // hide proposition list
    $('#nom_list_iddocumentclient').hide();
}