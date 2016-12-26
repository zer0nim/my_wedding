<?php include('../view/header.php') ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
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
					<a class="navbar-brand" href="accueil.ctrl.php">My Wedding</a>
				</div>

				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li><a href="accueil.ctrl.php">Accueil</a></li>
						<li class="active"><a href="">Paramètres mariage</a></li>
						<li><a href="">Page Publique</a></li>
						<li><a href="mon_compte.ctrl.php">Mon compte</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li><a href="inscription.ctrl.php"><span class="glyphicon glyphicon-user"></span> Sign out</a></li>
					</ul>
				</div>
			</div>
		</nav>

	</header>

	<form class="col-xs-12" method="post">
		<legend>Création et modification de l'événement</legend>
		<!--Première personne-->
		<div class="form-group col-xs-12	col-sm-6">
			<label class="control-label">Mariage de</label><br>
			Nom : <input name="nom1" type="text" class="form-control" required>
			Prenom : <input name="prenom1" type="text" class="form-control" required>
		</div>

		<!--Deuxième personne-->
		<div class="form-group col-xs-12	col-sm-6">
			<label class="control-label">et</label><br>
			Nom : <input name="nom2" type="text" class="form-control" required>
			Prenom : <input name="prenom2" type="text" class="form-control" required>
		</div>

		<!--Date du mariage-->
		<div class="form-group col-xs-12">
			Date: <input class="form-control" id="date" name="date" placeholder="JJ/MM/AAAA" type="text" required/>
		</div>

		<!--Adresse du lieu de mariage-->
		<div class="form-group col-xs-12">
			Adresse: <input id="user_input_autocomplete_address" name="adresse" class="form-control" required>
		</div>

		<!--Bouton d'envoi-->
		<div class="form-group	col-xs-12">
			<button id="singlebutton" name="creation" class="btn btn-primary">Créer l'événement</button>
		</div>
	</form>

<?php include('../view/scripts.php') ?>
<script src="../view/js/creation.js"></script>
<?php include('../view/footer.php') ?>
