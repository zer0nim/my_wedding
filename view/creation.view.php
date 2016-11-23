<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>My Wedding</title>
	<meta name="description" content="Le site de planification de mariage">

	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://use.fontawesome.com/f332948f4d.js"></script>

	<!--	jQuery -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>

	<!-- Bootstrap Date-Picker Plugin -->
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/locales/bootstrap-datepicker.fr.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

	<!-- For GOOGLE autocomplete -->
	<script src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;key=AIzaSyAIGMBk_u4Odlmc-UhPHgQ3RsZzq6J0Ak0" type="text/javascript"></script>
	<link rel="stylesheet" href="../view/css/creation.css" type="text/css" />

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
						<li class="active"><a href="#">Paramètres mariage</a></li>
						<li><a href="#">Mon compte</a></li>
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
	<script>
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
	</script>
<!-- -^- Date input -^- -->

<!-- -v- Adress input -v- -->
		<div class="form-group col-xs-12">
			Adresse: <input id="user_input_autocomplete_address" placeholder="Votre adresse..." class="form-control">
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
