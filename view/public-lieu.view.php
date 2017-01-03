<?php include('../view/header.php') ?>
<link rel="stylesheet" href="../view/css/public-lieu.css" type="text/css" />

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

	<div class="col-lg-offset-3 col-lg-6">
		<span id="text_latlng"></span>
		<div id="map-canvas" style="width: 500px;height: 500px;"></div>
		<h2 id="text_adresse"></h2>
	</div>
	<?php include('../view/scripts.php'); ?>
	<script src="../view/js/public-lieu.js"></script>
	<?php include('../view/footer.php'); ?>
