// autocompletion article
function autocompletArticle() {
    var min_length = 1; // nombre de caractère avant lancement recherch 
    var keywordarticle = $('#nom_idarticle').val(); // nom_id fait référence au champ de recherche puis lancement de la recherche grace ajax_refresh
    if (keywordarticle.length >= min_length) {
        $.ajax({
            url: '../ajaxrefresh/ajax_refreshArticle.php',
            type: 'POST',
            data: { keywordarticle: keywordarticle },
            success: function(data) {
                $('#nom_list_idarticle').show();
                $('#nom_list_idarticle').html(data);
            }
        });
    } else {
        $('#nom_list_idarticle').hide();
    }
}
// Lors du choix dans la liste
function set_itemarticle(item3, item4) {
    // change input value
    $('#nom_idarticle').val(item3);
    $('#nom2_idarticle').val(item4);
    // hide proposition list
    $('#nom_list_idarticle').hide();
}