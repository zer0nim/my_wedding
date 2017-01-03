<?php include('../view/header.php') ?>
</head>
<body class="container-fluid">

	<header>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="page-publique.ctrl.php">My Wedding</a>
				</div>

				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li><a href="page-publique-public.ctrl.php?id=<?=sha1($idM)?>">Accueil</a></li>
						<li><a href="public-question.ctrl.php?id=<?=sha1($idM)?>">Questions</a></li>
						<li class="active"><a href="">Lieu</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<div>
		<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?sensor=false&language=fr"></script>
		<script type="text/javascript">
			var geocoder;
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
			}

			function TrouverAdresse() {
				// Récupération de l'adresse tapée dans le formulaire
				var adresse = document.getElementById('adresse').value;
				geocoder.geocode( { 'address': adresse}, function(results, status) {
					if (status == google.maps.GeocoderStatus.OK) {
						map.setCenter(results[0].geometry.location);
						// Récupération des coordonnées GPS du lieu tapé dans le formulaire
						var strposition = results[0].geometry.location+"";
						strposition=strposition.replace('(', '');
						strposition=strposition.replace(')', '');
						// Affichage des coordonnées dans le <span>
						document.getElementById('text_latlng').innerHTML='Coordonnées : '+strposition;
						// Création du marqueur du lieu (épingle)
						var marker = new google.maps.Marker({
							map: map,
							position: results[0].geometry.location
						});
					} else {
						alert('Adresse introuvable: ' + status);
					}
				});
			}
			// Lancement de la construction de la carte google map
			google.maps.event.addDomListener(window, 'load', initialiserCarte);
		</script>
	</div>
	<?php
	include('../view/scripts.php');
	include('../view/footer.php');
	?>
