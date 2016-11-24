$(document).ready(function(){
	$('#select-cnt').bind('input', function() {

		if ($(this).val().length == 1) {

			$.post(
					'../controller/ajax_select_cnt.php', // Le fichier cible côté serveur.
					{
							idcont : $(this).val()
					},

					function(data){
						document.getElementById("NomLink").value = data['cont_nom'];
						document.getElementById("PrenomLink").value = data['cont_prenom'];
						document.getElementById("user_input_autocomplete_address").value = data['cont_adresse'];
						document.getElementById("MailLink").value = data['cont_mail'];
						document.getElementById("TelLink").value = data['cont_tel'];
						document.getElementById("AgeLink").value = data['cont_age'];
					},

					'json' // Format des données reçues.
			);
		}
		else { //a faire: griser la partie droite de lecran
			document.getElementById("NomLink").value = "";
			document.getElementById("PrenomLink").value = "";
			document.getElementById("user_input_autocomplete_address").value = "";
			document.getElementById("MailLink").value = "";
			document.getElementById("TelLink").value = "";
			document.getElementById("AgeLink").value = "";
			document.getElementById("NomLink").value = "";
		}

	});
});

// Lie le champs adresse en champs autocomplete afin que l'API puisse afficher les propositions d'adresses
function initializeAutocomplete(id) {
	var element = document.getElementById(id);
	if (element) {
		var autocomplete = new google.maps.places.Autocomplete(element, { types: ['geocode'] });
		google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);
	}
}
// Initialisation du champs autocomplete
google.maps.event.addDomListener(window, 'load', function() {
	initializeAutocomplete('user_input_autocomplete_address');
});