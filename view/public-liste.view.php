<?php include('../view/header.php') ?>
<link rel="stylesheet" href="../view/css/public-liste.css" type="text/css" />
<link href='http://fonts.googleapis.com/css?family=Gabriela' rel='stylesheet' type='text/css'><!-- Pour polices-->

</head>
<body class="container-fluid">

	<header>
		<h1>Mariage de <?= $InfoM['maria_prenomH']?> et <?= $InfoM['maria_prenomF']?></h1>
		<div class="infDate"><?= $InfoM['maria_date']?></div>
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
						<li class="active"><a href="public-liste.ctrl.php?id=<?=sha1($idM)?>">liste de mariage</a></li>
						<li><a href="public-lieu.ctrl.php?id=<?=sha1($idM)?>">Lieu</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<div class="beautiful_Li col-sm-offset-1 col-sm-10 col-md-offset-2 col-md-8 col-lg-offset-3 col-lg-6">
		<h2>Notre Liste de Mariage</h2>
		<?php printList($listSouh); ?>
	</div>

	<?php include('../view/scripts.php'); ?>
	<?php include('../view/footer.php'); ?>
