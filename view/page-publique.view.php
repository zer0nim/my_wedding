<?php include('../view/header.php') ?>
<link rel="stylesheet" href="../view/css/page-publique.css" type="text/css" />
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
						<li><a href="creation.ctrl.php">Paramètres mariage</a></li>
						<li class="active"><a href="">Page Publique</a></li>
						<li><a href="mon_compte.ctrl.php">Mon compte</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li><a href="session_delete.ctrl.php"><span class="glyphicon glyphicon-user"></span> Sign out</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<nav class="nopadding col-xs-12">
		<div class="nopadding col-xs-12 col-lg-4">
			<a href="page-publique-public.ctrl.php?idm=<?=$idM?>" class="btn btn-default btn-block">Aperçu visiteur</a>
		</div>
		<div class="nopadding col-xs-12 col-lg-4">
			<input type="submit" class="btn btn-default btn-block" value="Posts">
		</div>
		<div class="nopadding col-xs-12 col-lg-4">
			<input type="submit" class="btn btn-default btn-block" value="Questions">
		</div>
	</nav>

	<div class="questions col-xs-12">
		<legend>Questions pour les organisateurs du mariage</legend>
		<div id="scrollable" class="col-xs-12">
			<?php
			if ($questions==0) {
				echo "<p>Pas de questions pour l'instant</p>\n";
			}else{
				$nb=count($questions);
				for ($i=0; $i < $nb; $i++) {
					if ($questions[$i]['quest_nom']=='Organisateur') {
						echo "<strong class=\"admin\">{$questions[$i]['quest_nom']}: </strong><p>{$questions[$i]['quest_question']}</p> <p class='date'>{$questions[$i]['quest_date']}</p>\n";
					}else {
						echo "<strong>{$questions[$i]['quest_nom']}: </strong><p>{$questions[$i]['quest_question']}</p> <p class='date'>{$questions[$i]['quest_date']}</p>\n";
					}
					if($i<$nb-1){
						echo "<hr>\n";
					}
				}
			}
			?>
			<script>
				element = document.getElementById('scrollable');
				element.scrollTop = element.scrollHeight;
			</script>
		</div>

		<form class="form-horizontal" action="page-publique.ctrl.php" method="post">
			<div class="form-group">
				<label for="nom" class="control-label col-sm-12">Nom/Prenom : Organisateur</label>
			</div>

			<div class="form-group">
				<label for="question" class="control-label col-sm-1">Reponse :</label>
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
