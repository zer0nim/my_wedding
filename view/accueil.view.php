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
			<a class="navbar-brand" href="accueil.ctrl.php">My Wedding</a>
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
			<ul class="nav navbar-nav">
				<li class="active"><a href="#">Accueil</a></li>
				<li><a href="creation.ctrl.php">Paramètres mariage</a></li>
				<li><a href="#">Page Publique</a></li>
				<li><a href="mon_compte.ctrl.php">Mon compte</a></li>
			</ul>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="session_delete.ctrl.php"><span class="glyphicon glyphicon-user"></span> Sign out</a></li>
			</ul>
			</div>
		</div>
		</nav>
	</header>

	<ul id="wedding">
		<li><span class="days">00</span><p class="days_text">Jours</p></li>
		<li class="seperator"> - </li>
		<li><span class="hours">00</span><p class="hours_text">Heures</p></li>
		<li class="seperator"> - </li>
		<li><span class="minutes">00</span><p class="minutes_text">Minutes</p></li>
		<li class="seperator"> - </li>
		<li><span class="seconds">00</span><p class="seconds_text">Secondes</p></li>
	</ul>

	<nav class="text-center">
		<div class="modifpadding col-btn col-xs-12 col-sm-6 col-lg-3">
		<a href="planning.ctrl.php" class="btn btn-block btn-lg btn-primary"><i class="fa fa-calendar fa-2x" aria-hidden="true"></i><br>Planning</a>
		</div>
		<div class="modifpadding col-btn col-xs-12 col-sm-6 col-lg-3">
		<a href="contacts.ctrl.php" class="btn btn-block btn-lg btn-primary"><i class="fa fa-address-book fa-2x" aria-hidden="true"></i><br>Contacts</a>
		</div>
		<div class="modifpadding col-btn col-xs-12 col-sm-6 col-lg-3">
		<a href="invitations.ctrl.php" class="btn btn-block btn-lg btn-primary"><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i><br>Invitations</a>
		</div>
		<div class="modifpadding col-btn col-xs-12 col-sm-6 col-lg-3">
		<a href="plandetable.ctrl.php" class="btn btn-block btn-lg btn-primary"><i class="fa fa-th fa-2x" aria-hidden="true"></i><br>Plan de table</a>
		</div>
		<div class="modifpadding col-btn col-xs-12 col-sm-6 col-lg-3">
		<a href="fournisseurs.ctrl.php" class="btn btn-block btn-lg btn-primary"><i class="fa fa-truck fa-2x" aria-hidden="true"></i><br>Fournisseurs</a>
		</div>
		<div class="modifpadding col-btn col-xs-12 col-sm-6 col-lg-3">
		<a href="inspiration.ctrl.php" class="btn btn-block btn-lg btn-primary"><i class="fa fa-paint-brush fa-2x" aria-hidden="true"></i><br>Inspiration</a>
		</div>
		<div class="modifpadding col-btn col-xs-12 col-sm-6 col-lg-3">
		<a href="liste.ctrl.php" class="btn btn-block btn-lg btn-primary"><i class="fa fa-gift fa-2x" aria-hidden="true"></i><br>Liste</a>
		</div>
		<div class="modifpadding col-btn col-xs-12 col-sm-6 col-lg-3">
		<a href="budget.ctrl.php" class="btn btn-block btn-lg btn-primary"><i class="fa fa-eur fa-2x" aria-hidden="true"></i><br>Budget</a>
		</div>
	</nav>

	<footer>

	</footer>

<?php include('../view/scripts.php') ?>
<script src="../view/js/accueil.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<?php include('../view/footer.php') ?>
