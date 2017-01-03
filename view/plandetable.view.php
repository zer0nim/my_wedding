<?php include('../view/header.php') ?>
<link rel="stylesheet" href="../view/css/plandetable.css" type="text/css" />
<?php require_once '../view/baseMenuFnct.php'; ?>

<div class="margin-bot col-lg-offset-2 col-lg-8 col-sm-12">
	<!-- -v- Génerer -v- -->
	<div class="nopadding">
		<div class="alert alert-info alert-dismissable fade in">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Info!</strong> La génération du plan de table utilise l'âge ainsi que l'entente de chaque invité modifiable dans la fonction contact.
		</div>
		<div class="nopadding form-group col-xs-12 col-lg-6">
			<button name="singlebutton" class="btn btn-primary btn-block">Placement automatique</button>
		</div>
		<a href="pdf_plandetable.ctrl.php" class="btn btn-primary btn-block">Telecharger</a>
	</div>
	<!-- -^- Génerer -^- -->

	<table class="table table-bordered table-striped table-hover table-condensed table-responsive">
		<thead>
			<tr>
				<th class="col-sm-3">Nom Table</th>
				<th class="col-sm-2">Places</th>
				<th	class="col-sm-7">Invités</th>
			</tr>
		</thead>
		<tbody id="tablesLink">
			<?php printAllTables($allTables, $allContacts); ?>
		</tbody>
		</table>


	<button name="singlebutton" class="btn btn-default btn-block" onClick="nouvelleTable()">Créer nouvelle</button>
</div>

<?php include('../view/scripts.php') ?>
<script src="../view/js/planDeTable.js"></script>
<?php include('../view/footer.php') ?>
