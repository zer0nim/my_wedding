<?php
	require_once '../view/baseMenuFnct.php';
	///////////VERSION SANS SESSION////////////
	$idM=1;
	///////////////////////////////////////////
	$texte=$dao->getInvitation($idM);
	if(isset($_POST['actSave'])){
?>
		<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Enregistré !</strong>
		</div>
	<?php } ?>


<link rel="stylesheet" href="../view/css/invitations.css" type="text/css" />
<script src="../ckeditor/ckeditor.js"></script>

<div class="col-sm-12">
	<form class="" action="invitations-modifie.php" method="post">
		<!--<textarea name="texteInvit" wrap="soft" ></textarea>-->

		<textarea name="editor1" id="editor1" >
      <?=$texte?>
    </textarea>

		<div class="row">
				<button class="col-sm-2 col-sm-offset-2 btn btn-primary" name="actSave">Enregistrer</button>
				<button class="col-sm-2 col-sm-offset-1 btn btn-primary" name="actMail">Envoyer par mail</button>
				<button class="col-sm-2 col-sm-offset-1 btn btn-primary" name="actPrint">Imprimer</button>
		</div>
	</form>
</div>
<?php include('../view/scripts.php') ?>
<?php include('../view/footer.php') ?>
<script>
	CKEDITOR.replace( 'editor1' );
</script>
