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

	<?php if (isset($erreur)) {?>
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Erreur : </strong><?=$erreur?>
			</div>
	<?php }elseif (isset($modif)) { ?>
		<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong><?=$modif?></strong>
		</div>
	<?php }
	if ($dao->getMariage($idacc) == NULL) { ?>
	<legend class="col-xs-12">Création de l'événement</legend>
	<form class="col-xs-12" method="post">
		<!--Première personne-->
		<div class="form-group col-xs-12	col-sm-6">
			<legend class="col-xs-12">Mariage de</legend>
			<label class="col-xs-12">Nom :</label>
			<div class="col-xs-12">
				<input name="nom1" type="text" class="form-control" required>
			</div>

			<label class="col-xs-12">Prenom :</label>
			<div class="col-xs-12">
				<input name="prenom1" type="text" class="form-control" required>
			</div>

		</div>

		<!--Deuxième personne-->
		<div class="form-group col-xs-12	col-sm-6">
			<legend class="col-xs-12">et</legend>
			<label class="col-xs-12">Nom :</label>
			<div class="col-xs-12">
				<input name="nom2" type="text" class="form-control" required>
			</div>

			<label class="col-xs-12">Prenom :</label>
			<div class="col-xs-12">
				<input name="prenom2" type="text" class="form-control" required>
			</div>
		</div>

		<legend >Informations supplémentaires</legend>
		<div class="form-group col-xs-12	col-sm-3">
			<!--Date du mariage-->
			<label class="col-xs-12">Date:</label>
			<div class="form-group col-xs-12">
				<input class="form-control" id="date" name="date" placeholder="JJ/MM/AAAA" type="text" required/>
			</div>
		</div>
		<!--Adresse du lieu de mariage-->
		<div class="form-group col-xs-12 col-sm-9">
			<label class="col-xs-12">Adresse :</label>
			<div class="form-group col-xs-12">
				<input id="user_input_autocomplete_address" name="adresse" class="form-control" required>
			</div>
		</div>

		<!--Bouton d'envoi-->
		<div class="form-group	col-xs-12">
			<button id="singlebutton" name="creation" class="btn btn-primary">Créer l'événement</button>
		</div>
	</form>

<?php }else { $data=$dao->getMariage($idacc); // formulaire avec les données deja existantes?>
	<legend class="col-xs-12">Modification de l'événement</legend>
	<form class="col-xs-12" method="post">
		<!--Première personne-->
		<div class="form-group col-xs-12	col-sm-6">
			<legend class="col-xs-12">Mariage de</legend>
			<label class="col-xs-12">Nom :</label>
			<div class="col-xs-12">
				<input name="nom1" type="text" class="form-control" value=<?=$data['maria_nomF']?> required>
			</div>

			<label class="col-xs-12">Prenom :</label>
			<div class="col-xs-12">
				<input name="prenom1" type="text" class="form-control" value=<?=$data['maria_prenomF']?> required>
			</div>

		</div>

		<!--Deuxième personne-->
		<div class="form-group col-xs-12	col-sm-6">
			<legend class="col-xs-12">et</legend>
			<label class="col-xs-12">Nom :</label>
			<div class="col-xs-12">
				<input name="nom2" type="text" class="form-control" value=<?=$data['maria_nomH']?> required>
			</div>

			<label class="col-xs-12">Prenom :</label>
			<div class="col-xs-12">
				<input name="prenom2" type="text" class="form-control" value=<?=$data['maria_prenomH']?> required>
			</div>
		</div>

		<legend >Informations supplémentaires</legend>
		<div class="form-group col-xs-12	col-sm-3">
			<!--Date du mariage-->
			<label class="col-xs-12">Date:</label>
			<div class="form-group col-xs-12">
				<input class="form-control" id="date" name="date" placeholder="JJ/MM/AAAA" type="text" value=<?=$data['maria_date']?> required/>
			</div>
		</div>
		<!--Adresse du lieu de mariage-->
		<div class="form-group col-xs-12 col-sm-9">
			<label class="col-xs-12">Adresse :</label>
			<div class="form-group col-xs-12">
				<input id="user_input_autocomplete_address" name="adresse" class="form-control" value="<?=$data['maria_lieu']?>" required>
			</div>
		</div>

		<!--Bouton d'envoi-->
		<div class="form-group col-xs-12">
			<button id="singlebutton" name="creation" class="btn btn-primary">Modifier l'événement</button>
		</div>


	</form>
<?php } ?>
<?php include('../view/scripts.php') ?>
<script src="../view/js/creation.js"></script>
<?php include('../view/footer.php') ?>
