<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>MyWedding</title>
		<meta name="description" content="Le site de planification de mariage">

		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="../view/css/inscription.css" type="text/css" />

	</head>

	<body class="container-fluid">
		<header>
				<div>
					<div class="col-sm-6">
						<h1>MyWedding</h1>
						<h2>Le meilleur moyen d'organiser votre mariage</h2>
					</div>
				</div>
		</header>

		<main>
			<?php if (isset($messErr)) {?>
					<div class="alert alert-danger">
						<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
						<strong>Erreur : </strong><?=$messErr?>
					</div>
			<?php } ?>
			<div id="sign">
				<form class="form-signin" action="inscription.ctrl.php" method="post">
					<h2 class="form-signin-heading">Connexion</h2>

					<label for="inputEmail" class="sr-only">Adresse mail</label>
					<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Adresse mail" required>

					<label for="inputPassword" class="sr-only">Mot de passe</label>
					<input type="password" name="motdepasse" id="inputPassword" class="form-control" placeholder="Mot de passe" required>

					<button class="btn btn-lg btn-primary btn-block" name="connexion" type="submit">Se connecter</button>
				</form>


				<form class="form-signin" action="inscription.ctrl.php" method="post">
					<h2 class="form-signin-heading">Inscription</h2>

					<label for="inputEmail" class="sr-only">Adresse mail</label>
					<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Adresse mail" required>

					<label for="inputPassword" class="sr-only">Mot de passe</label>
					<input type="password" name="motdepasse" id="inputPassword" class="form-control" placeholder="Mot de passe" required>

					<button class="btn btn-lg btn-primary btn-block" name="inscription" type="submit">S'inscrire</button>
				</form>
			</div>
		</main>

			<div id="features" class="container">
				<div class="fnctFrame col-sm-4">
					<span class="fa-stack fa-5x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-calendar fa-stack-1x fa-inverse"></i>
					</span>
					<h1>Le planning</h1>
					<BR>
					<p>Une aide à l'organisation temporelle de votre mariage.</p>
				</div>
				<div class="fnctFrame col-sm-4">
					<span class="fa-stack fa-5x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-envelope-o fa-stack-1x fa-inverse"></i>
					</span>
					<h1>Les invités</h1>
					<BR>
					<p>Gérez simplement les invitations, la liste des invités et le plan de table.</p>
				</div>
				<div class="fnctFrame col-sm-4">
					<span class="fa-stack fa-5x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-truck fa-stack-1x fa-inverse"></i>
					</span>
					<h1>Les fournisseurs</h1>
					<BR>
					<p>Listez et contactez aisément vos fournisseurs.</p>
				</div>
				<div class="fnctFrame col-sm-4">
					<span class="fa-stack fa-5x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-paint-brush fa-stack-1x fa-inverse"></i>
					</span>
					<h1>Les inspirations</h1>
					<BR>
					<p>Une idée ? Notez la pour ne pas l'oublier.</p>
				</div>
				<div class="fnctFrame col-sm-4">
					<span class="fa-stack fa-5x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-bullhorn fa-stack-1x fa-inverse"></i>
					</span>
					<h1>La page publique</h1>
					<BR>
					<p>Vos invités seront au courant de toutes les informations nécessaires !</p>
				</div>
				<div class="fnctFrame col-sm-4">
					<span class="fa-stack fa-5x">
					  <i class="fa fa-circle fa-stack-2x"></i>
					  <i class="fa fa-eur fa-stack-1x fa-inverse"></i>
					</span>
					<h1>Le budget</h1>
					<BR>
					<p>Vos dépenses seront facilement visible.</p>
				</div>
			</div>


		<footer>
			<p class="col-xs-12">Réalisation du site: IUT Grenoble Alpes - S3 groupe 11 - 2016/2017</p>
		</footer>

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script><!-- c'est quoi ce truc ? -->

<?php include('../view/scripts.php') ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>
<script src="../view/js/inscription.js"></script>
<?php include('../view/footer.php') ?>
