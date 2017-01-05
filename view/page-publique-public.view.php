<?php include('../view/header.php') ?>
<link rel="stylesheet" type="text/css" href="../view/css/default.css" />
<link rel="stylesheet" type="text/css" href="../view/css/component.css" />

<link rel="stylesheet" href="../view/css/page-publique-public.css" type="text/css" />
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
					<a class="navbar-brand" href="page-publique.ctrl.php">MyWedding</a>
				</div>

				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li class="active"><a href="">Accueil</a></li>
						<li><a href="public-question.ctrl.php?id=<?=sha1($idM)?>">Questions</a></li>
						<li><a href="public-liste.ctrl.php?id=<?=sha1($idM)?>">liste de mariage</a></li>
						<li><a href="public-lieu.ctrl.php?id=<?=sha1($idM)?>">Lieu</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<?php
	if (isset($InfoM['maria_desc']) && $InfoM['maria_desc'] != "") {
			echo '<section><div class="infDescr"><p>' . $InfoM['maria_desc'] . '</p></div></section>';
		}
	?>

	<div class="main">
		<ul class="cbp_tmtimeline">
			<?php if (isset($insp)) { printAllInsp($insp); } ?>
		</ul>
	</div>

<?php
 include('../view/scripts.php');
 include('../view/footer.php');
?>
