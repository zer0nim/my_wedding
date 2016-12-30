<?php include('../view/header.php') ?>
<link rel="stylesheet" href="../view/css/page-publique-public.css" type="text/css" />
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
						<li class="active"><a href="">Accueil</a></li>
						<li><a href="public-question.ctrl.php?idm=<?=$idM?>">Questions</a></li>
						<li><a href="public-lieu.ctrl.php?idm=<?=$idM?>">Lieu</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>



<?php
 include('../view/scripts.php');
 include('../view/footer.php');
?>
