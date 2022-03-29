// autocompletion Tarif
function autocompletT() {
    var min_length = 1; // nombre de caractère avant lancement recherch 
    var keywordtarif = $('#nom_idtarif').val(); // nom_id fait référence au champ de recherche puis lancement de la recherche grace ajax_refresh
    if (keywordtarif.length >= min_length) {
        $.ajax({
            url: '../ajaxrefresh/ajax_refreshTarif.php',
            type: 'POST',
            data: { keywordtarif: keywordtarif },
            success: function(data) {
                $('#nom_list_idtarif').show();
                $('#nom_list_idtarif').html(data);
            }
        });
    } else {
        $('#nom_list_idtarif').hide();
    }
}
// Lors du choix dans la liste
function set_itemtarif(item3, item4) {
    // change input value
    $('#nom_idtarif').val(item3);
    $('#nomtarif_idtarif').val(item4);
    // hide proposition list
    $('#nom_list_idtarif').hide();
}