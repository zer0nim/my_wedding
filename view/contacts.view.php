<?php include('../view/header.php') ?>
<link rel="stylesheet" href="../view/css/contacts.css" type="text/css" />
<?php require_once '../view/baseMenuFnct.php';?>

	<div class="row">
		<div class="edit-cnt panel panel-default">
		<div class="panel-body">
			<div class="col-xs-12 col-sm-5 col-lg-3">
			<input id="PreviousValue" type="text" name="" value="" style="display:none">
			<!-- -v- Liste contacts -v- -->
			<select multiple id="select-cnt" class="form-control">
				<?php printAllContacts($allContacts); ?>
			</select>
			<!-- -^- Liste contacts-^- -->
			<div class="nopadding form-group col-xs-12">
				<input type="button" class="btn btn-default btn-block" value="Créer nouveau" onClick="nouveauContact()">
				<input type="button" class="btn btn-danger btn-block" value="Supprimer" onClick="confirmation()">
			</div>
		</div>

<form id="contInfoform">
	<div id="info" class="col-xs-12 col-sm-7 col-lg-9 row">
		<div class="nopadding form-group col-xs-12">
			<div class="margin-b-form col-xs-12 col-sm-6">
				<div class="input-group">
					<span class="input-group-addon">Nom</span>
					<input id="NomLink" name="prependedtext" class="form-control" placeholder="" required="" type="text" tabindex="1">
				</div>
			</div>
			<div class="col-xs-12 col-sm-6">
				<div class="input-group">
					<span class="input-group-addon">Prenom</span>
					<input id="PrenomLink" name="prependedtext" class="form-control" placeholder="" required="" type="text" tabindex="2">
				</div>
			</div>
		</div>
		<div class="nopadding form-group col-xs-12">
			<div class="margin-b-form col-xs-12 col-lg-6">
				<div class="input-group">
					<span class="input-group-addon">Mail</span>
					<input id="MailLink" name="prependedtext" class="form-control" placeholder="" required="" type="email" tabindex="3">
				</div>
			</div>
			<div class="col-xs-12 col-lg-6">
				<div class="input-group">
					<span class="input-group-addon">Télephone</span>
					<input id="TelLink" name="prependedtext" class="form-control" placeholder="" type="text" tabindex="4">
				</div>
			</div>
		</div>
		<div class="nopadding form-group col-xs-12">
			<!-- -v- Adress input -v- -->
			<div class="margin-b-form col-xs-12 col-sm-9">
				<div class="input-group">
					<span class="input-group-addon">Adresse</span>
					<input id="user_input_autocomplete_address" class="form-control" tabindex="5">
				</div>
			</div>
			<!-- -^- Adress input -^- -->

			<div class="col-xs-12 col-sm-3">
				<select id="AgeLink" class="form-control" tabindex="6">
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
		<div class="form-group col-xs-12 col-lg-offset-3 col-lg-6">

				<div class="no-marg-bot panel panel-default">
					<div class="panel-heading">
						<h3 class="panel-title">Mésentente</h3>
					</div>


					<div class="input-group">
						<select id="listCntTMesentente" class="form-control">
						</select>
						<span class="input-group-btn">
							<button id="MesententeLink" class="addCntLink btn btn-default" type="button">Ajouter</button>
						</span>
					</div>
					<table class="table table-bordered table-striped table-hover table-responsive">
						<tbody id="cntTable">
						</tbody>
					</table>


				</div>
		</div>
		<!-- -^- Liste affinités-^- -->

		<div class="form-group	col-xs-12">
			<input id="SaveContactInfoLink" type="submit" class="btn btn-default" value="Enregistrer">
		</div>
	</div>
</div>
</div>
</div>
</form>


<?php include('../view/scripts.php') ?>
<script src="../view/js/contacts.js"></script>
<?php include('../view/footer.php') ?>
