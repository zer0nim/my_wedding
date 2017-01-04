<?php include('../view/header.php') ?>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" href="../view/css/liste.css" type="text/css" />
<?php require_once '../view/baseMenuFnct.php'; ?>

	<div class="box col-sm-6 col-md-4 col-sm-offset-3 col-md-offset-4">
		<div class="panel panel-default">
			<div class="panel-heading">Le plus important</div>
  		<div class="panel-body">
				<div class="liste">
					<ul id="sortable">
						<?php print_list($list); ?>
					</ul>
				</div>
  		</div>
  		<div class="panel-footer">Le moins important</div>
		</div>
		<span class="input-group-addon">Nouveau souhait</span>
		<input id="inputSouhait" name="souhait" type="text" class="form-control">
		<input id="addSouhait" type="submit" class="form-control btn btn-primary">
	</div>
<?php include('../view/scripts.php') ?>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- script pour récupérer l'ordre de la liste à chaque changement -->
<script src="../view/js/liste.js"></script>

<?php include('../view/footer.php') ?>
