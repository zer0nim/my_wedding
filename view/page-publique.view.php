<?php include('../view/header.php') ?>
<link rel="stylesheet" type="text/css" href="../view/css/default.css" />
<link rel="stylesheet" type="text/css" href="../view/css/component.css" />

<link rel="stylesheet" href="../view/css/page-publique.css" type="text/css" />

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
					<a class="navbar-brand" href="accueil.ctrl.php">MyWedding</a>
				</div>

				<div class="collapse navbar-collapse" id="myNavbar">
					<ul class="nav navbar-nav">
						<li><a href="accueil.ctrl.php">Accueil</a></li>
						<li><a href="creation.ctrl.php">Paramètres mariage</a></li>
						<li class="active"><a href="">Page Publique</a></li>
						<li><a href="mon_compte.ctrl.php">Mon compte</a></li>
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li><a href="session_delete.ctrl.php"><span class="glyphicon glyphicon-user"></span> Sign out</a></li>
					</ul>
				</div>
			</div>
		</nav>
	</header>

	<nav class="nopadding col-xs-12">
		<div class="nopadding col-xs-12 col-lg-4">
			<a href="page-publique-public.ctrl.php?id=<?=sha1($idM)?>" class="btn btn-default btn-block">Aperçu visiteur</a>
		</div>
		<div class="nopadding col-xs-12 col-lg-4">
			<input type="submit" id="posts" class="btn btn-default btn-block" value="Posts" active>
		</div>
		<div class="nopadding col-xs-12 col-lg-4">
			<input type="submit" id="quests" class="btn btn-default btn-block" value="Questions">
		</div>
	</nav>

	<div class="infDescr">
		<span class="input-group-addon">Description</span>
		<textarea class="form-control" name="description" id="descrLink" name=""><?= $descr ?></textarea>
		<input type="submit" class="btn btn-default btn-block" id="modifDescrLink" value="Modifier">
	</div>

	<div class="col-lg-offset-2 col-lg-8">
		<div class="questions col-xs-12">
			<legend>Questions pour les organisateurs du mariage</legend>
			<div id="scrollable" class="col-xs-12">
				<?php
				if ($questions==0) {
					echo "<p>Pas de questions pour l'instant</p>\n";
				}else{
					$nb=count($questions);
					for ($i=0; $i < $nb; $i++) {
						if ($questions[$i]['quest_nom']=='Organisateur') {
							echo "<strong class=\"admin\">{$questions[$i]['quest_nom']}: </strong><p>{$questions[$i]['quest_question']}</p> <p class='date'>{$questions[$i]['quest_date']}</p>\n";
						}else {
							echo "<strong>{$questions[$i]['quest_nom']}: </strong><p>{$questions[$i]['quest_question']}</p> <p class='date'>{$questions[$i]['quest_date']}</p>\n";
						}
						if($i<$nb-1){
							echo "<hr>\n";
						}
					}
				}
				?>
				<script>
					element = document.getElementById('scrollable');
					element.scrollTop = element.scrollHeight;
				</script>
			</div>

			<form class="form-horizontal" action="page-publique.ctrl.php" method="post">
				<div class="form-group">
					<label for="nom" class="control-label col-xs-12">Nom/Prenom :<p id="orga">Organisateur<p></label>
				</div>

				<div class="form-group">
					<label for="question" class="control-label col-xs-12">Reponse :</label>
					<div class="col-xs-12">
						<input id="question" type="text" name="question" class="form-control" required>
					</div>
				</div>

				<div class="form-group">
					<div class="col-xs-12">
						<button class="btn btn-secondary" name="envoiQuestion">Envoyer</button>
					</div>
				</div>

			</form>
		</div>
	</div>

	<div class="main">
	  <ul class="cbp_tmtimeline">
	    <li id="newPost">
	      <div class="panel panel-default cbp_tmlabel">
	        <h2>Nouveau post</h2>
	        <div class="panel-heading">
	          <select id="postSlctLink" class="form-control">
	            <option value="none" selected="selected">Type</option>
	            <option value="note">Note</option>
	            <option value="link">Lien</option>
	            <option value="pict">Photo</option>
	          </select>
	        </div>
	        <div id="newpost" class="panel-body">

	          <form id="link" method="post" >
	            <label class="input-group-addon" for="textinput">Adresse</label>
	            <input type="text" name="adresse" class="form-control" aria-describedby="basic-addon1" required>
	            <span class="input-group-addon">Description</span>
	            <textarea class="form-control" name="description" id="" name=""></textarea>
	            <input type="submit" class="btn btn-default btn-block" value="Ajouter">
	          </form>

	          <form id="note" method="post" >
	            <label class="input-group-addon" for="textinput">Titre</label>
	            <input type="text" name="titre" class="form-control" aria-describedby="basic-addon1" required>
	            <span class="input-group-addon">Note</span>
	            <textarea class="form-control" name="description" id="" name="" required></textarea>
	            <input type="submit" class="btn btn-default btn-block" value="Ajouter">
	          </form>

	          <form id="pict" method="post" enctype="multipart/form-data">
	            <label class="input-group-addon" for="textinput" required>Titre</label>
	            <input type="text" name="titre" class="form-control" aria-describedby="basic-addon1" required>
	            <span class="input-group-addon">Description</span>
	            <textarea class="form-control" name="description" id="" name=""></textarea>
	            <input type="file" name="image" accept="image/*" required>
	            <div id="image_preview" class="col-lg-10 col-lg-offset-2">
	              <div class="thumbnail hidden">
	                  <img src="http://placehold.it/5" alt="">
	                  <div class="caption">
	                      <h4></h4>
	                      <p></p>
	                      <p><button type="button" class="btn btn-default btn-danger">Annuler</button></p>
	                  </div>
	              </div>
	            </div>
	            <input type="submit" class="btn btn-default btn-block" value="Ajouter">
	          </form>

	          <div id="none">
	            <p>Veuillez selectioner le type ci-dessus.</p>
	          </div>
	        </div>
	      </div>
	    </li>
			<?php if (isset($insp)) { printAllInsp($insp); } ?>
	  </ul>
	</div>

<?php include('../view/scripts.php'); ?>
 <script src="../view/js/page-publique.js"></script>
<?php include('../view/footer.php'); ?>
