<?php
  include('../view/header.php');
?>
<link rel="stylesheet" href="../view/css/mon_compte.css" type="text/css" />
</head>
<body class="container-fluid">

	<header>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="accueil.ctrl.php">My Wedding</a>
				</div>

				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li><a href="accueil.ctrl.php">Accueil</a></li>
						<li><a href="creation.ctrl.php">Paramètres mariage</a></li>
						<li><a href="">Page Publique</a></li>
						<li class="active"><a href="">Mon compte</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li><a href="session_delete.ctrl.php"><span class="glyphicon glyphicon-user"></span> Sign out</a></li>
					</ul>
				</div>
			</div>
		</nav>

	</header>
<?php
  if (isset($_POST['changeMdp']) || isset($_POST['changeMail'])) {
    if (isset($errmodif)) {?>
        <div class="alert alert-danger">
          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
          <strong>Changement non effectué :</strong><?=$messErr?>
        </div>
<?php
    }else {?>
        <div class="alert alert-success">
    			<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
    			<strong>Changement effectué !</strong>
    		</div>
<?php
    }
  }
 ?>

 <form class="col-sm-12 col-md-5 col-sm-offset-3 col-md-offset-2" action="mon_compte.ctrl.php" method="post">

   <div class="form-horizontal">
     <h4><strong>Changer son mot de passe :</strong></h4>
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

 <form class="col-sm-12 col-md-5 col-sm-offset-3 col-md-offset-0" action="mon_compte.ctrl.php" method="post">

   <div class="form-horizontal">
     <h4><strong>Changer son email :</strong></h4>
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
