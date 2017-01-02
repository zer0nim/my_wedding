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

	<body>
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
				<div class="col-sm-4">
					<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" height="140" width="140">
					<h1>Le planning</h1>
					<BR>
					<p>Une aide à l'organisation temporelle de votre mariage.</p>
				</div>
				<div class="col-sm-4">
					<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" height="140" width="140">
					<h1>Les invités</h1>
					<BR>
					<p>Gérer simplement les invitations, la liste des invités et le plan de table.</p>
				</div>
				<div class="col-sm-4">
					<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" height="140" width="140">
					<h1>Les fournisseurs</h1>
					<BR>
					<p>Lister et contacter aisément vos fournisseurs.</p>
				</div>
				<div class="col-sm-4">
					<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" height="140" width="140">
					<h1>Inspiration</h1>
					<BR>
					<p>Une idée ? Notez la pour ne pas l'oublier.</p>
				</div>
				<div class="col-sm-4">
					<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" height="140" width="140">
					<h1>La liste de mariage</h1>
					<BR>
					<p>Vos invités n'auront plus de doutes sur vos souhaits !</p>
				</div>
				<div class="col-sm-4">
					<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" height="140" width="140">
					<h1>Le budget</h1>
					<BR>
					<p>La dépense de votre argent sera facilement visible.</p>
				</div>
			</div>


		<footer>
			<p class="col-sm-6">Adresse: qwfqwfqwf</p>
			<p class="col-sm-6">Mentions légales: bah yen a pas....</p>
		</footer>

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script><!-- c'est quoi ce truc ? -->

<?php include('../view/scripts.php') ?>
<?php include('../view/footer.php') ?>
