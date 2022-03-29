// autocompletion
function autocomplet() {
	var min_length = 2; // nombre de caractère avant lancement recherch 
	var keyword = $('#nom_id').val();  // nom_id fait référence au champ de recherche puis lancement de la recherche grace ajax_refresh
	if (keyword.length >= min_length) {
		$.ajax({
			url: 'ajax_refresh.php',
			type: 'POST',
			data: {keyword:keyword},
			success:function(data){
				$('#nom_list_id').show();
				$('#nom_list_id').html(data);
			}
		});
	} else {
		$('#nom_list_id').hide();
	}
}

// Lors du choix dans la liste
function set_item(item,item2) {
	// change input value
	$('#nom_id').val(item);
	$('#nom2_id').val(item2);
	$('#nom3_id').val(item3);
	$('#nom4_id').val(item4);
	$('#nom5_id').val(item5);
	$('#nom6_id').val(item6);
	// hide proposition list
	$('#nom_list_id').hide();
}