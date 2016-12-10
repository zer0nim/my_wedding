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



	<form class="col-xs-12">
		<legend>Création de l'événement</legend>

		<!-- -v- Name input -v- -->
		<div class="form-group col-xs-12	col-sm-6">
			<label class="control-label">Mariage de</label><br>
		Nom : <input type="text" class="form-control">
		Prenom : <input type="text" class="form-control">
	</div>

	<div class="form-group col-xs-12	col-sm-6">
		<label class="control-label">et</label><br>
		Nom : <input type="text" class="form-control">
		Prenom : <input type="text" class="form-control">
	</div>
	<!-- -^- Name input -^- -->

	<!-- -v- Description input -v- -->
	<div class="form-group col-xs-12">
		Description : <textarea id="textarea" class="form-control"></textarea>
	</div>
	<!-- -^- Description input -^- -->

<!-- -v- Date input -v- -->
	<div class="form-group col-xs-12">
			Date: <input class="form-control" id="date" name="date" placeholder="JJ/MM/AAAA" type="text"/>
	</div>
<!-- -^- Date input -^- -->

<!-- -v- Adress input -v- -->
		<div class="form-group col-xs-12">
			Adresse: <input id="user_input_autocomplete_address" class="form-control">
		</div>
<!-- -^- Adress input -^- -->

<!-- -v- Button -v- -->
		<div class="form-group	col-xs-12">
				<button id="singlebutton" name="singlebutton" class="btn btn-primary">Créer l'événement</button>
		</div>
<!-- -^- Button -^- -->

	</form>


	<footer>
	</footer>

<?php include('../view/scripts.php') ?>
<script src="../view/js/creation.js"></script>
<?php include('../view/footer.php') ?>
