// autocompletion paiement
function autocompletP() {
    var min_length = 1; // nombre de caractère avant lancement recherch 
    var keywordpaiement = $('#nom_idpaiement').val(); // nom_id fait référence au champ de recherche puis lancement de la recherche grace ajax_refresh
    if (keywordpaiement.length >= min_length) {
        $.ajax({
            url: '../ajaxrefresh/ajax_refreshpaiement.php',
            type: 'POST',
            data: { keywordpaiement: keywordpaiement },
            success: function(data) {
                $('#nom_list_idpaiement').show();
                $('#nom_list_idpaiement').html(data);
            }
        });
    } else {
        $('#nom_list_idpaiement').hide();
    }
}
// Lors du choix dans la liste
function set_itempaiement(item3, item4) {
    // change input value
    $('#nom_idpaiement').val(item3);
    $('#nom2_idpaiement').val(item4);
    // hide proposition list
    $('#nom_list_idpaiement').hide();
}