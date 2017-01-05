<?php include('../view/header.php') ?>
<link rel="stylesheet" href="../view/css/inspiration.css" type="text/css"/>

<link rel="stylesheet" type="text/css" href="../view/css/default.css" />
<link rel="stylesheet" type="text/css" href="../view/css/component.css" />

<?php require_once '../view/baseMenuFnct.php'; ?>

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
    <?php printAllInsp($insp); ?>
  </ul>
</div>

<?php include('../view/scripts.php') ?>
<script src="../view/js/inspiration.js"></script>
<?php include('../view/footer.php') ?>
