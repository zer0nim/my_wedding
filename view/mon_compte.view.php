<?php
  include('../view/header.php');
?>
<link rel="stylesheet" href="../view/css/mon_compte.css" type="text/css" />
<?php
  include_once('../view/baseMenuFnct.php');
 ?>

 <form class="col-lg-5 col-sm-12 col-md-6 col-lg-offset-1" action="mon_compte.ctrl.php" method="post">

   <div class="form-horizontal">
     <h2 class="">Changer son mot de passe :</h2>
     <div class="form-group">
       <label for="nmdp" class="col-sm-12">Nouveau mot de passe :</label>
       <div class="col-sm-6">
         <input type="text" name="newmdp" id="nmdp" class="form-control" required>
       </div>
     </div>

     <div class="form-group">
       <label for="cmdp" class="col-sm-12">Confirmer nouveau mot de passe :</label>
       <div class="col-sm-6">
         <input type="text" id="cmdp" name="confirmMdp" class="form-control" required>
       </div>
     </div>

     <div class="row">
       <button class="col-sm-6 btn btn-primary" name="changemdp">Confirmer</button>
     </div>
   </div>

 </form>

 <form class="col-lg-5 col-sm-12 col-md-6 col-lg-offset-1" action="mon_compte.ctrl.php" method="post">

   <div class="form-horizontal">
     <h2 class="">Changer son email :</h2>
     <div class="form-group">
       <label for="nmail" class="col-sm-12">Nouveau mail :</label>
       <div class="col-sm-6">
         <input type="text" name="newmail" id="nmail" class="form-control" required>
       </div>
     </div>

     <div class="form-group">
       <label for="cmail" class="col-sm-12">Confirmer son nouveau mail :</label>
       <div class="col-sm-6">
         <input type="text" id="cmail" name="confirmMail" class="form-control" required>
       </div>
     </div>

     <div class="row">
       <button class="col-sm-6 btn btn-primary" name="changemdp">Confirmer</button>
     </div>
   </div>

 </form>
 <?php include('../view/scripts.php');
       include('../view/footer.php'); ?>
