<?php include('../view/header.php') ?>
<link rel="stylesheet" href="../view/css/contacts.css" type="text/css" />
<?php require_once '../view/baseMenuFnct.php';?>

<form>
	<div class="row">
		<div class="edit-cnt panel panel-default">
		<div class="panel-body">
			<div class="col-xs-12 col-sm-5 col-lg-3">
			<!-- -v- Liste contacts -v- -->
			<select multiple id="select-cnt" class="form-control">
				<?php printAllContacts($allContacts); ?>
			</select>
			<!-- -^- Liste contacts-^- -->
			<div class="nopadding form-group col-xs-12">
				<button id="singlebutton" name="singlebutton" class="btn btn-default btn-block">Créer nouveau</button>
			</div>
			<div class="nopadding form-group col-xs-12">
				<button id="singlebutton" name="singlebutton" class="btn btn-danger btn-block" onClick="confirmation()">Supprimer</button>
			</div>
		</div>

	<div id="info" class="col-xs-12 col-sm-7 col-lg-9 row">
		<div class="nopadding form-group col-xs-12">
			<div class="margin-b-form col-xs-12 col-sm-6">
				<div class="input-group">
					<span class="input-group-addon">Nom</span>
					<input id="NomLink" name="prependedtext" class="form-control" placeholder="" required="" type="text">
				</div>
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="input-group">
					<span class="input-group-addon">Prenom</span>
					<input id="PrenomLink" name="prependedtext" class="form-control" placeholder="" required="" type="text">
				</div>
			</div>
		</div>
		<div class="nopadding form-group col-xs-12">
			<div class="margin-b-form col-xs-12 col-lg-6">
				<div class="input-group">
					<span class="input-group-addon">Mail</span>
					<input id="MailLink" name="prependedtext" class="form-control" placeholder="" required="" type="text">
				</div>
			</div>
			<div class="col-xs-12 col-lg-6">
				<div class="input-group">
					<span class="input-group-addon">Télephone</span>
					<input id="TelLink" name="prependedtext" class="form-control" placeholder="" type="text">
				</div>
			</div>
		</div>
		<div class="nopadding form-group col-xs-12">
			<!-- -v- Adress input -v- -->
			<div class="margin-b-form col-xs-12 col-sm-9">
				<div class="input-group">
					<span class="input-group-addon">Adresse</span>
					<input id="user_input_autocomplete_address" class="form-control">
				</div>
			</div>
			<!-- -^- Adress input -^- -->

			<div class="col-xs-12 col-sm-3">
				<select id="AgeLink" class="form-control">
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
			<div class="nopadding col-sm-4">

				<div class="no-marg-bot panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Entente</h3>
					</div>
						<select multiple id="afinite" class="form-control">
						</select>
				</div>

			</div>
			<div class="nopadding col-sm-4">

				<div class="no-marg-bot panel panel-default">
					<div class="control-btn panel-heading">
						<div class="btn-group btn-group-justified" role="group" aria-label="...">
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i></button>
							</div>
							<div class="btn-group" role="group">
								<button type="button" class="btn btn-default btn-xs"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i></button>
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
			<div class="nopadding col-sm-4">

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
</div>
</div>
</form>


<?php include('../view/scripts.php') ?>

<!-- For GOOGLE autocomplete -->
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;key=AIzaSyAIGMBk_u4Odlmc-UhPHgQ3RsZzq6J0Ak0" type="text/javascript"></script>

<script src="../view/js/contacts.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<?php include('../view/footer.php') ?>
