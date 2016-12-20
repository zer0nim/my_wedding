<?php include('../view/header.php') ?>
<link rel="stylesheet" href="../view/css/inspiration.css" type="text/css"/>
<?php require_once '../view/baseMenuFnct.php'; ?>

<div class="timeLine col-xs-12">

<div class="tlpoint col-xs-1">
</div>
<div class="tlbox panel panel-default col-xs-11">
  <div class="panel-heading">
    <span class="input-group-addon">Nouveau post</span>
      <select class="form-control">
        <option value="NULL" selected="selected">Type</option>
        <option value="note">Note</option>
        <option value="link">Lien</option>
        <option value="pict">Photo</option>
      </select>
  </div>
    <span class="input-group-addon">Veuillez selectioner le type ci-dessus.</span>
    <input type="button" class="btn btn-primary btn-block" value="Ajouter" disabled="true">
</div>

<div class="tlpoint col-xs-1">
  <p>2016<br>20/12<br>18h53</p>
</div>
  <div class="tlbox panel panel-default col-xs-11">
    <div class="panel-heading">
      <div class="input-group">
        <span class="input-group-addon">Lien</span>
        <input type="text"name="titre" class="form-control" aria-describedby="basic-addon1">
      </div>
    </div>
      <span class="input-group-addon">Description</span>
      <textarea class="form-control" name="description" id="" name=""></textarea>
  </div>

  <div class="tlpoint col-xs-1">
    <p>2016<br>19/12<br>14h28</p>
  </div>
  <div class="tlbox panel panel-default col-xs-11">
      <span class="input-group-addon">Note</span>
      <textarea class="form-control" name="description" id="" name=""></textarea>
  </div>

    <div class="tlpoint col-xs-1">
      <p>2016<br>17/12<br>20h50</p>
    </div>
    <div class="tlbox panel panel-default col-xs-11">
        <span class="input-group-addon">Photo</span>
        <img src="../img/3.jpg" width="100%" height="100%">
    </div>

</div>

<?php include('../view/scripts.php') ?>
<?php include('../view/footer.php') ?>
