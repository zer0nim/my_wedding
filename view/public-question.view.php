<?php include('../view/header.php') ?>
<link rel="stylesheet" href="../view/css/public-question.css" type="text/css" />
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
						<li><a href="page-publique-public.ctrl.php?idm=<?=$idM?>">Accueil</a></li>
						<li class="active"><a href="">Questions</a></li>
						<li><a href="public-lieu.ctrl.php?idm=<?=$idM?>">Lieu</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<div class="col-xs-12">
		<legend>Questions pour les organisateurs du mariage</legend>
		<div id="scrollable" class="col-xs-12">
			<?php
			if ($questions==0) {
				echo "<p>Pas de questions pour l'instant</p>\n";
			}else{
				$nb=count($questions);
				for ($i=0; $i < $nb; $i++) {
					if ($i<$nb-1) {
						echo "<strong>{$questions[$i]['quest_nom']}: </strong><p>{$questions[$i]['quest_question']}</p> <p class='date'>{$questions[$i]['quest_date']}</p><hr>\n";
					}else {
						echo "<strong>{$questions[$i]['quest_nom']}: </strong><p>{$questions[$i]['quest_question']}</p> <p class='date'>{$questions[$i]['quest_date']}</p>\n";
					}
				}
			}
			?>
			<script>
				element = document.getElementById('scrollable');
				element.scrollTop = element.scrollHeight;
			</script>
		</div>

		<form class="form-horizontal" action="public-question.ctrl.php?idm=<?=$idM?>" method="post">
			<div class="form-group">
				<label for="nom" class="control-label col-sm-2 col-lg-1">Nom/Prenom :</label>
				<div class="col-sm-10 col-lg-11">
					<input id="nom" type="text" name="nom" class="form-control" required>
				</div>
			</div>

			<div class="form-group">
				<label for="question" class="control-label col-sm-1">Question :</label>
				<div class="col-sm-11">
					<input id="question" type="text" name="question" class="form-control" required>
				</div>
			</div>

			<div class="form-group">
				<div class="col-xs-12">
					<button class="btn btn-secondary" name="envoiQuestion">Envoyer</button>
				</div>
			</div>

		</form>
	</div>

<?php
 include('../view/scripts.php');
 include('../view/footer.php');
?>
