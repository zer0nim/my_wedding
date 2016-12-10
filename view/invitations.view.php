<?php include('../view/header.php') ?>
<link rel="stylesheet" href="../view/css/invitations.css" type="text/css" />

<?php
	require_once '../view/baseMenuFnct.php';
	$texte=$dao->getInvitation($idM);
	if(isset($_POST['actSave'])){
?>
		<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Enregistré !</strong>
		</div>
<?php } ?>


	<form class="" action="invitations.ctrl.php" method="post">
		<div class="form-group col-lg-offset-2 col-lg-8 col-sm-12">
			<textarea name="editor1" id="editor1">
				<?=$texte?>
			</textarea>
		</div>
		<div class="row">
				<button class="col-sm-2 col-sm-offset-3 btn btn-primary" name="actSave">Enregistrer</button>
				<button class="col-sm-2 col-sm-offset-2 btn btn-primary" name="actMail">Envoyer par mail</button>
		</div>
	</form>
</div>
<?php include('../view/scripts.php') ?>
<script src="../ckeditor/ckeditor.js"></script>
<script src="../view/js/invitations.js"></script>
<?php include('../view/footer.php') ?>
