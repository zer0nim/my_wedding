<?php include('../view/header.php') ?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="../view/css/liste.css" type="text/css" />
<?php require_once '../view/baseMenuFnct.php'; ?>

	<div class="box col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
		<div class="liste">
			<ul id="sortable">
				<?php // Affichage de la liste
					foreach ($data as $key => $value) { echo '<li id="list_' . $value['nom'] . '" class="list-group-item ui-state-default" type="button">' . $value['nom'] . '</li>'
						;	}
				?>
			</ul>
			<input type="text" placeholder="nouveau souhait ?" class="form-control">
			<input type="submit" class="form-control btn btn-primary">
		</div>

<?php include('../view/scripts.php') ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- script pour récupérer l'ordre de la liste à chaque changement -->
<script src="../view/js/liste.js"></script>

<?php include('../view/footer.php') ?>
