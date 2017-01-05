$(document).ready(function(){
	var geocoder = new google.maps.Geocoder();
	var map;

	// initialisation de la carte Google Map de départ
	function initialiserCarte() {
		geocoder = new google.maps.Geocoder();
		// Ici j'ai mis la latitude et longitude du vieux Port de Marseille pour centrer la carte de départ
		var latlng = new google.maps.LatLng(43.295309,5.374457);
		var mapOptions = {
			zoom      : 14,
			center    : latlng,
			mapTypeId : google.maps.MapTypeId.ROADMAP
		}
		// map-canvas est le conteneur HTML de la carte Google Map
		map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);
		TrouverAdresse();
	}

	function TrouverAdresse() {
		// Récupération de l'adresse
		$.post(
				'../controller/ajax_recup_adress.php', // Le fichier cible côté serveur.
				{
				},

				function(data){
					//console.log(data);
					var adresse = data;
					geocoder.geocode( { 'address': adresse}, function(results, status) {
						if (status == google.maps.GeocoderStatus.OK) {
							map.setCenter(results[0].geometry.location);
							// Récupération des coordonnées GPS du lieu tapé dans le formulaire
							var strposition = results[0].geometry.location+"";
							strposition=strposition.replace('(', '');
							strposition=strposition.replace(')', '');
							// Affichage des coordonnées dans le <span>
							document.getElementById('text_latlng').innerHTML='Coordonnées : '+strposition;
							//
							// Création du marqueur du lieu (épingle)
							var marker = new google.maps.Marker({
								map: map,
								position: results[0].geometry.location
							});
						}
						else {
							alert('Adresse introuvable: ' + status);
						}
						$('#text_adresse').text(data);
					});
				},

				'json' // Format des données reçues.
		);
	}
	// Lancement de la construction de la carte google map
	google.maps.event.addDomListener(window, 'load', initialiserCarte);
});
