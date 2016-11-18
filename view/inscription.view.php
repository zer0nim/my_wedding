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
			<h1>Bienvenue sur MyWedding</h1>
		</header>

		<main>
			<div id="container">
				<form class="form-signin" action="connecter.ctrl.php" method="get">
					<h2 class="form-signin-heading">Connectez-vous</h2>

					<label for="inputEmail" class="sr-only">Adresse mail</label>
					<input type="email" id="inputEmail" class="form-control" placeholder="Adresse mail" required autofocus>

					<label for="inputPassword" class="sr-only">Mot de passe</label>
					<input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>

					<div class="checkbox">
						<label>
							<input type="checkbox" value="remember-me"> Se souvenir de moi
						</label>
					</div>
					<button class="btn btn-lg btn-primary btn-block" type="submit">Connexion</button>
				</form>


				<form class="form-signin" action="inscrire.ctrl.php" method="get">
					<h2 class="form-signin-heading">Inscrivez-vous</h2>

					<label for="inputNom" class="sr-only">Nom</label>
					<input type="text" id="inputNom" class="form-control" placeholder="Nom" required autofocus>

					<label for="inputPrenom" class="sr-only">Prenom</label>
					<input type="text" id="inputPrenom" class="form-control" placeholder="Prenom" required>

					<label for="inputEmail" class="sr-only">Adresse mail</label>
					<input type="email" id="inputEmail" class="form-control" placeholder="Adresse mail" required>

					<label for="inputPassword" class="sr-only">Mot de passe</label>
					<input type="password" id="inputPassword" class="form-control" placeholder="Mot de passe" required>

					<button class="btn btn-lg btn-primary btn-block" type="submit">Inscription</button>
				</form>
			</div>
		</main>

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
	</body>
</html>
