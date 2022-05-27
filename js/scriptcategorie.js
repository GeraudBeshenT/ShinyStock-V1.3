// autocompletion communes
function autocompletCategorie() {
    var min_length = 1; // nombre de caractère avant lancement recherch 
    var keyword = $('#nom_idcategorie').val(); // nom_id fait référence au champ de recherche puis lancement de la recherche grace ajax_refresh
    if (keyword.length >= min_length) {
        $.ajax({
            url: '../ajaxrefresh/ajax_refreshCategorie.php',
            type: 'POST',
            data: { keyword: keyword },
            success: function(data) {
                $('#nom_list_idcategorie').show();
                $('#nom_list_idcategorie').html(data);
            }
        });
    } else {
        $('#nom_list_idcategorie').hide();
    }
}
// Lors du choix dans la liste
function set_itemcategorie(item, item2) {
    // change input value
    $('#nom_idcategorie').val(item);
    $('#nom2_idcategorie').val(item2);
    // hide proposition list
    $('#nom_list_idcategorie').hide();
}


