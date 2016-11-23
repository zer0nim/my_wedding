<?php
	require_once '../view/baseMenuFnct.php';
?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="../view/css/liste.css" type="text/css" />

	<div class="box col-sm-6 col-md-4">
		<div class="demo">
			<ul id="sortable">
				<?php // Affichage de la liste
					foreach ($data as $key => $value) { echo '<li id="list_' . $value['nom'] . '" class="list-group-item ui-state-default" type="button">' . $value['nom'] . '</li>'
						;	}
				?>
			</ul>
		</div>
	<div class="box col-sm-6 col-md-4">

<?php include('../view/scripts.php') ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- script pour récupérer l'ordre de la liste à chaque changement -->
<script src="../view/js/liste.js"></script>
<?php include('../view/footer.php') ?>
