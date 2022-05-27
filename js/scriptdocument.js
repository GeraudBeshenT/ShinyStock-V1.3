// autocompletion document
function autocompletDocument() {
    var min_length = 1; // nombre de caractère avant lancement recherch 
    var keyworddocument = $('#nom_iddocument').val(); // nom_id fait référence au champ de recherche puis lancement de la recherche grace ajax_refresh
    if (keyworddocument.length >= min_length) {
        $.ajax({
            url: '../ajaxrefresh/ajax_refreshDocument.php',
            type: 'POST',
            data: { keyworddocument: keyworddocument },
            success: function(data) {
                $('#nom_list_iddocument').show();
                $('#nom_list_iddocument').html(data);
            }
        });
    } else {
        $('#nom_list_iddocument').hide();
    }
}
// Lors du choix dans la liste
function set_itemdocument(item3, item4) {
    // change input value
    $('#nom_iddocument').val(item3);
    $('#nom2_iddocument').val(item4);
    // hide proposition list
    $('#nom_list_iddocument').hide();
}