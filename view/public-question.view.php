<?php include('../view/header.php') ?>
<link rel="stylesheet" href="../view/css/public-question.css" type="text/css" />
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
						<li><a href="page-publique-public.ctrl.php?id=<?=sha1($idM)?>">Accueil</a></li>
						<li class="active"><a href="public-question.ctrl.php?id=<?=sha1($idM)?>">Questions</a></li>
						<li><a href="public-liste.ctrl.php?id=<?=sha1($idM)?>">liste de mariage</a></li>
						<li><a href="public-lieu.ctrl.php?id=<?=sha1($idM)?>">Lieu</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<?php if (isset($erreur)) {?>
			<div class="alert alert-danger">
				<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
				<strong>Message non envoyé : </strong><?=$erreur?>
			</div>
	<?php } ?>
	<div class="col-lg-offset-2 col-lg-8">
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

			<form class="form-horizontal" action="public-question.ctrl.php?id=<?=sha1($idM)?>" method="post">
				<div class="form-group">
					<label for="nom" class="control-label col-xs-12">Nom/Prenom :</label>
					<div class="col-xs-12">
						<input id="nom" type="text" name="nom" class="form-control" required>
					</div>
				</div>

				<div class="form-group">
					<label for="question" class="col-xs-12">Question :</label>
					<div class="col-xs-12">
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
	</div>

<?php
 include('../view/scripts.php');
 include('../view/footer.php');
?>
