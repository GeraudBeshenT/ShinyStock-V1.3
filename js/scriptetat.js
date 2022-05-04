// autocompletion 
function autocompletEtat() {
    var min_length = 1; // nombre de caractère avant lancement recherch 
    var keyword = $('#nom_idetat').val(); // nom_id fait référence au champ de recherche puis lancement de la recherche grace ajax_refresh
    if (keyword.length >= min_length) {
        $.ajax({
            url: '../ajaxrefresh/ajax_refreshEtat.php',
            type: 'POST',
            data: { keyword: keyword },
            success: function(data) {
                $('#nom_list_idetat').show();
                $('#nom_list_idetat').html(data);
            }
        });
    } else {
        $('#nom_list_idetat').hide();
    }
}
// Lors du choix dans la liste
function set_itemetat(item, item2) {
    // change input value
    $('#nom_idetat').val(item);
    $('#nom2_idetat').val(item2);
    // hide proposition list
    $('#nom_list_idetat').hide();
}