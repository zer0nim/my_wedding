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
