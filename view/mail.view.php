<?php include('../view/header.php') ?>
<link rel="stylesheet" href="../view/css/mail.css" type="text/css" />

<?php
	require_once '../view/baseMenuFnct.php';
	$texte=$dao->getInvitation($idM);
	if (isset($_POST['actSend'])) {
		if ($accepte) {
?>
		<div class="alert alert-success">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
			<strong>Mail envoyé !</strong>
		</div>
<?php }else{
?>
		<div class="alert alert-danger">
			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		  <strong>Erreur:</strong> Mail non envoyé
		</div>
<?php }
?>

  <form class="" action="mail.ctrl.php" method="post">

    <div class="form-horizontal col-sm-offset-3">
      <div class="form-group">
        <label for="from" class="col-sm-1">From : </label>
        <div class="col-sm-6">
          <input type="email" name="from" id="from" class="form-control" placeholder="example@mail.com" required autofocus>
        </div>
      </div>

      <div class="form-group">
        <label for="for" class="col-sm-1">For : </label>
        <div class="col-sm-6">
          <input type="email" id="for" name="for" class="form-control" placeholder="example@mail.com" required>
        </div>
      </div>

			<div class="form-group">
        <label for="obj" class="col-sm-1">Object : </label>
        <div class="col-sm-6">
          <input type="text" id="obj" name="obj" class="form-control" value="sans objet" required>
        </div>
      </div>

      <div class="form-group">
        <label for="message" class="col-sm-12">Message (with HTML beacon) : </label>
        <div class="col-sm-7">
          <textarea name="message" id="message" class="form-control" rows="15" cols="200"><?=$texte?></textarea>
        </div>
      </div>

      <div class="row">
        <button class="col-sm-7 btn btn-primary" name="actSend">Envoyer</button>
      </div>
    </div>

  </form>
</div>
<?php include('../view/scripts.php') ?>
<?php include('../view/footer.php') ?>
