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

$(document).ready(function(){
	var date_input=$('input[name="date"]');
	var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
	var options={
		language: "fr-FR",
		startDate: '+1d',
		format: 'dd/mm/yyyy',
		container: container,
		todayHighlight: true,
		autoclose: true,
	};
	date_input.datepicker(options);
})
