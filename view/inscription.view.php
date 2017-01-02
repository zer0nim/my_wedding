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
						<h1>MyWedding:</h1>
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
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dignissim id ante luctus bibendum. Sed non arcu nec turpis molestie commodo et ut orci. Nam id lobortis erat. Maecenas ultricies nec nisl eget porttitor. In efficitur, turpis a vestibulum lobortis, orci tortor hendrerit risus, vel volutpat purus diam vitae sem. Aliquam dapibus risus id iaculis euismod. Nulla egestas porttitor ante, non luctus risus eleifend id. Morbi in libero elementum, pharetra leo eget, porta orci. Cras bibendum porta dolor sit amet vehicula. Integer nec quam purus. Integer aliquet posuere venenatis. Aliquam ante massa, tristique nec tempor a, placerat fermentum lacus.</p>
				</div>
				<div class="col-sm-4">
					<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" height="140" width="140">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dignissim id ante luctus bibendum. Sed non arcu nec turpis molestie commodo et ut orci. Nam id lobortis erat. Maecenas ultricies nec nisl eget porttitor. In efficitur, turpis a vestibulum lobortis, orci tortor hendrerit risus, vel volutpat purus diam vitae sem. Aliquam dapibus risus id iaculis euismod. Nulla egestas porttitor ante, non luctus risus eleifend id. Morbi in libero elementum, pharetra leo eget, porta orci. Cras bibendum porta dolor sit amet vehicula. Integer nec quam purus. Integer aliquet posuere venenatis. Aliquam ante massa, tristique nec tempor a, placerat fermentum lacus.</p>
				</div>
				<div class="col-sm-4">
					<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" height="140" width="140">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dignissim id ante luctus bibendum. Sed non arcu nec turpis molestie commodo et ut orci. Nam id lobortis erat. Maecenas ultricies nec nisl eget porttitor. In efficitur, turpis a vestibulum lobortis, orci tortor hendrerit risus, vel volutpat purus diam vitae sem. Aliquam dapibus risus id iaculis euismod. Nulla egestas porttitor ante, non luctus risus eleifend id. Morbi in libero elementum, pharetra leo eget, porta orci. Cras bibendum porta dolor sit amet vehicula. Integer nec quam purus. Integer aliquet posuere venenatis. Aliquam ante massa, tristique nec tempor a, placerat fermentum lacus.</p>
				</div>
				<div class="col-sm-4">
					<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" height="140" width="140">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dignissim id ante luctus bibendum. Sed non arcu nec turpis molestie commodo et ut orci. Nam id lobortis erat. Maecenas ultricies nec nisl eget porttitor. In efficitur, turpis a vestibulum lobortis, orci tortor hendrerit risus, vel volutpat purus diam vitae sem. Aliquam dapibus risus id iaculis euismod. Nulla egestas porttitor ante, non luctus risus eleifend id. Morbi in libero elementum, pharetra leo eget, porta orci. Cras bibendum porta dolor sit amet vehicula. Integer nec quam purus. Integer aliquet posuere venenatis. Aliquam ante massa, tristique nec tempor a, placerat fermentum lacus.</p>
				</div>
				<div class="col-sm-4">
					<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" height="140" width="140">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dignissim id ante luctus bibendum. Sed non arcu nec turpis molestie commodo et ut orci. Nam id lobortis erat. Maecenas ultricies nec nisl eget porttitor. In efficitur, turpis a vestibulum lobortis, orci tortor hendrerit risus, vel volutpat purus diam vitae sem. Aliquam dapibus risus id iaculis euismod. Nulla egestas porttitor ante, non luctus risus eleifend id. Morbi in libero elementum, pharetra leo eget, porta orci. Cras bibendum porta dolor sit amet vehicula. Integer nec quam purus. Integer aliquet posuere venenatis. Aliquam ante massa, tristique nec tempor a, placerat fermentum lacus.</p>
				</div>
				<div class="col-sm-4">
					<img class="img-circle" src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw==" alt="Generic placeholder image" height="140" width="140">
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse dignissim id ante luctus bibendum. Sed non arcu nec turpis molestie commodo et ut orci. Nam id lobortis erat. Maecenas ultricies nec nisl eget porttitor. In efficitur, turpis a vestibulum lobortis, orci tortor hendrerit risus, vel volutpat purus diam vitae sem. Aliquam dapibus risus id iaculis euismod. Nulla egestas porttitor ante, non luctus risus eleifend id. Morbi in libero elementum, pharetra leo eget, porta orci. Cras bibendum porta dolor sit amet vehicula. Integer nec quam purus. Integer aliquet posuere venenatis. Aliquam ante massa, tristique nec tempor a, placerat fermentum lacus.</p>
				</div>
			</div>


		<footer>
			<p class="col-sm-6">Addresse: qwfqwfqwf</p>
			<p class="col-sm-6">Mentions légales: qwfqwfqwfqwf</p>
		</footer>

		<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
		<script src="../../assets/js/ie10-viewport-bug-workaround.js"></script><!-- c'est quoi ce truc ? -->

<?php include('../view/scripts.php') ?>
<?php include('../view/footer.php') ?>
