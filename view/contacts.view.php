<?php
require_once '../view/baseMenuFnct.php';
?>
<link rel="stylesheet" href="../view/css/contacts.css" type="text/css" />

<form>
	<div class="row">
		<div class="col-xs-12 col-sm-5 col-lg-3">
			<!-- -v- Button -v- -->
			<div class="nopadding form-group col-xs-12">
				<button id="singlebutton" name="singlebutton" class="btn btn-default btn-block">Créer nouveau</button>
			</div>
			<!-- -^- Button -^- -->
			<!-- -v- Button -v- -->
			<div class="nopadding form-group col-xs-12">
				<button id="singlebutton" name="singlebutton" class="btn btn-danger btn-block">Supprimer</button>
			</div>
			<!-- -^- Button -^- -->

			<!-- -v- Liste contacts -v- -->
			<select multiple id="select-cnt" class="form-control">
				<?php printAllContacts($allContacts); ?>
			</select>
			<!-- -^- Liste contacts-^- -->
			<script>
			$('#select-cnt').bind('input', function() {
					document.getElementById("NomLink").value = $(this).val(); // get the current value of the input field.
			});
			</script>

		</div>
		<!--
		ajouter Contact
		supprimer Contact
	-->

	<div class="col-xs-12 col-sm-7 col-lg-9 row">
		<div class="nopadding form-group col-xs-12">
			<div class="col-xs-12 col-sm-6">
				<div class="input-group">
					<span class="input-group-addon">Nom</span>
					<input id="NomLink" name="prependedtext" class="form-control" placeholder="" required="" type="text">
				</div>
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="input-group">
					<span class="input-group-addon">Prenom</span>
					<input id="prependedtext" name="prependedtext" class="form-control" placeholder="" required="" type="text">
				</div>
			</div>
		</div>
		<div class="nopadding form-group col-xs-12">
			<div class="margin-b-form col-xs-12 col-lg-6">
				<div class="input-group">
					<span class="input-group-addon">Mail</span>
					<input id="prependedtext" name="prependedtext" class="form-control" placeholder="" required="" type="text">
				</div>
			</div>
			<div class="col-xs-12 col-lg-6">
				<div class="input-group">
					<span class="input-group-addon">Télephone</span>
					<input id="prependedtext" name="prependedtext" class="form-control" placeholder="" type="text">
				</div>
			</div>
		</div>
		<div class="nopadding form-group col-xs-12">
			<!-- -v- Adress input -v- -->
			<div class="col-xs-12 col-sm-9">
				<div class="input-group">
					<span class="input-group-addon">Adresse</span>
					<input id="user_input_autocomplete_address" placeholder="Votre adresse..." class="form-control">
				</div>
			</div>
			<!-- -^- Adress input -^- -->

			<div class="col-xs-12 col-sm-3">
				<select class="form-control">
					<option value="NULL">Age</option>
					<?php
					for ($i=1; $i<=150; $i++)
					{
						?>
						<option value="<?=$i?>"><?=$i?></option>
						<?php
					}
					?>
				</select>
			</div>
		</div>

		<!-- -v- Liste affinités -v- -->
		<div class="form-group col-xs-12">
			<div class="nopadding col-xs-4">

				<div class="no-marg-bot panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Entente</h3>
					</div>
						<select multiple id="afinite" class="form-control">
						</select>
				</div>

			</div>
			<div class="nopadding col-xs-4">

				<div class="no-marg-bot panel panel-default">
					<div class="control-btn panel-heading">
						<div class="btn-group btn-group-justified" role="group" aria-label="...">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default btn-xs">&#60;</button>
							</div>
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default btn-xs">&#62;</button>
							</div>
						</div>
					</div>
						<select multiple id="afinite" class="form-control">
							<option>Bellefeuille Bertrand</option>
							<option>Bonnet Valentine</option>
							<option>Charette Christien</option>
							<option>Charette Didier</option>
							<option>Charette Oliver</option>
							<option>Delaunay Nicolas</option>
							<option>Des Meaux Baptiste</option>
							<option>Dodier Florence</option>
							<option>Frappier Christine</option>
							<option>Frappier Marguerite</option>
							<option>Garceau Camille</option>
							<option>Garceau Jeannine</option>
							<option>Garceau Thibault</option>
							<option>Georges Eugène</option>
							<option>Guilbon Sylvie</option>
							<option>Karel Vincent</option>
							<option>Lacroix Stéphane</option>
							<option>Lacroix Xavier</option>
							<option>Lazure Stéphanie</option>
							<option>Leblanc Claire</option>
							<option>Lemonnier Catherine</option>
							<option>Marchal Alfred</option>
							<option>Masson Aurélie</option>
							<option>Masson Chloe</option>
							<option>Masson Claudette</option>
							<option>Masson Jules</option>
							<option>Meunier Céline</option>
							<option>Meunier Eugène</option>
							<option>Perez Roger</option>
							<option>Petitjean lisa</option>
							<option>Petitjean Yves</option>
						</select>
				</div>
			</div>
			<div class="nopadding col-xs-4">

				<div class="no-marg-bot panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Mésentente</h3>
					</div>
						<select multiple id="afinite" class="form-control">
						</select>
				</div>

			</div>
		</div>
		<!-- -^- Liste affinités-^- -->

		<!-- -v- Button -v- -->
		<div class="form-group	col-xs-12">
			<button id="singlebutton" name="singlebutton" class="btn btn-primary">enregistrer</button>
		</div>
		<!-- -^- Button -^- -->
	</div>
</div>
</form>


<?php include('../view/scripts.php') ?>

<!-- For GOOGLE autocomplete -->
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;key=AIzaSyAIGMBk_u4Odlmc-UhPHgQ3RsZzq6J0Ak0" type="text/javascript"></script>

<script src="js/contacts.js"></script>

<?php include('../view/footer.php') ?>
