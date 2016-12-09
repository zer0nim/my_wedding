<?php
  include('../view/header.php');
?>
<link rel="stylesheet" href="../view/css/mon_compte.css" type="text/css" />
<?php
  include_once('../view/baseMenuFnct.php');
  if (isset($_POST['changeMdp']) || isset($_POST['changeMail'])) {
    if (isset($errmodif)) {
      if($errmodif=="MdpCourant"){?>
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Changement non effectué :</strong> Le nouveau mot de passe est le même que l'ancien
        </div>
<?php }elseif ($errmodif=="MdpConfirmation") {?>
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Changement non effectué :</strong> Nouveau mot de passe mal confirmé
        </div>
<?php }elseif ($errmodif=="MailCourant") {?>
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Changement non effectué :</strong> Le nouveau mail est le meme que l'ancien
        </div>
<?php }elseif ($errmodif=="MailConfirmation") {?>
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Changement non effectué :</strong> Nouveau mail mal confirmé
        </div>
<?php }
    }else {?>
      <div class="alert alert-success">
  			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  			<strong>Changement effectué !</strong>
  		</div>
<?php
    }
  }
 ?>

 <form class="col-sm-12 col-md-5 col-md-offset-2" action="mon_compte.ctrl.php" method="post">

   <div class="form-horizontal">
     <h2>Changer son mot de passe :</h2>
     <div class="form-group">
       <label for="nmdp" class="col-sm-12">Nouveau mot de passe :</label>
       <div class="col-sm-6">
         <input type="password" name="newmdp" id="nmdp" class="form-control" required>
       </div>
     </div>

     <div class="form-group">
       <label for="cmdp" class="col-sm-12">Confirmer nouveau mot de passe :</label>
       <div class="col-sm-6">
         <input type="password" name="confirmMdp" id="cmdp" class="form-control" required>
       </div>
     </div>

     <div class="row">
       <button class="col-xs-12 col-sm-6 btn btn-primary" name="changeMdp">Confirmer</button>
     </div>
   </div>

 </form>

 <form class="col-sm-12 col-md-5" action="mon_compte.ctrl.php" method="post">

   <div class="form-horizontal">
     <h2>Changer son email :</h2>
     <div class="form-group">
       <label for="nmail" class="col-sm-12">Nouveau mail :</label>
       <div class="col-sm-6">
         <input type="email" name="newmail" id="nmail" class="form-control" required>
       </div>
     </div>

     <div class="form-group">
       <label for="cmail" class="col-sm-12">Confirmer son nouveau mail :</label>
       <div class="col-sm-6">
         <input type="email" name="confirmMail" id="cmail" class="form-control" required>
       </div>
     </div>

     <div class="row">
       <button class="col-xs-12 col-sm-6 btn btn-primary" name="changeMail">Confirmer</button>
     </div>
   </div>

 </form>
 <?php include('../view/scripts.php');
       include('../view/footer.php'); ?>
