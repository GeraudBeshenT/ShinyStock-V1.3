// autocompletion societe
function autocompletS() {
    var min_length = 1; // nombre de caractère avant lancement recherch 
    var keywordsociete = $('#nom_idsociete').val(); // nom_id fait référence au champ de recherche puis lancement de la recherche grace ajax_refresh
    if (keywordsociete.length >= min_length) {
        $.ajax({
            url: '../ajaxrefresh/ajax_refreshSociete.php',
            type: 'POST',
            data: { keywordsociete: keywordsociete },
            success: function(data) {
                $('#nom_list_idsociete').show();
                $('#nom_list_idsociete').html(data);
            }
        });
    } else {
        $('#nom_list_idsociete').hide();
    }
}
// Lors du choix dans la liste
function set_itemsociete(item3, item4) {
    // change input value
    $('#nom_idsociete').val(item3);
    $('#nom2_idsociete').val(item4);
    // hide proposition list
    $('#nom_list_idsociete').hide();
}