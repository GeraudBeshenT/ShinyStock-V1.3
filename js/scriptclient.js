// autocompletion 
function autocompletClient() {
    var min_length = 1; // nombre de caractère avant lancement recherch 
    var keyword = $('#nom_idclient').val(); // nom_id fait référence au champ de recherche puis lancement de la recherche grace ajax_refresh
    if (keyword.length >= min_length) {
        $.ajax({
            url: '../ajaxrefresh/ajax_refreshClient.php',
            type: 'POST',
            data: { keyword: keyword },
            success: function(data) {
                $('#nom_list_idclient').show();
                $('#nom_list_idclient').html(data);
            }
        });
    } else {
        $('#nom_list_id').hide();
    }
}
// Lors du choix dans la liste
function set_item(item, item2) {
    // change input value
    $('#nom_idclient').val(item);
    $('#nom2_idclient').val(item2);
    // hide proposition list
    $('#nom_list_idclient').hide();
}