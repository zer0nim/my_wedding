<?php
  require_once '../view/baseMenuFnct.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="../view/css/plandetable.css" type="text/css" />

<!--
Bouton Créer une table

"Tableau" remplissable:
  nomTable placesMin placesMax
Bouton enregistrer

Afficher "note":
  L'algo de plandetable utilise l'age ainsi que l'entente de chaque invité remplit dans la fonction contact

Bouton Générer

Affichage graphique modifiable des invités sur les tables

Bouton Impression du plan de table
-->
<button id="singlebutton" name="singlebutton" class="btn btn-default btn-block">Créer nouvelle</button>
<table class="table table-bordered table-striped table-hover table-condensed table-responsive">
	<thead>
		<tr>
			<th class="col-sm-3">Nom Table</th>
			<th class="col-sm-2">Places</th>
			<th  class="col-sm-7">Invités</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td>
        <input type="text" class="form-control" placeholder="nom" aria-describedby="basic-addon1" value="Table d'honneur">
        <br>
        <a href="#" class="btn btn-danger" role="button">Supprimer</a>
      </td>
			<td>
        <select class="form-control">
          <option value="NULL">-</option>
          <?php
          for ($i=1; $i<=500; $i++) {
            ?>
            <?php if ($i == 8){?>
              <option value="<?=$i?>" selected="selected"><?=$i?></option>
            <?php }else {?>
              <option value="<?=$i?>"><?=$i?></option>
            <?php }}
            ?>
        </select>
      </td>
			<td>
          <div class="thumbnail">
            <p>Leblanc Claire<a href="#" class="supr-inv btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></p>
            <p>Lemonnier Catherine<a href="#" class="supr-inv btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></p>
            <p>Marchal Alfred<a href="#" class="supr-inv btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></p>
            <p>Masson Aurélie<a href="#" class="supr-inv btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></p>
            <p>Masson Chloe<a href="#" class="supr-inv btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></p>
            <p>Masson Claudette<a href="#" class="supr-inv btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></p>
            <p><div class="input-group">
                <select class="form-control">
                  <option>-</option>
                  <option>Dodier Florence</option>
                  <option>Frappier Christine</option>
                  <option>Frappier Marguerite</option>
                  <option>Garceau Camille</option>
                  <option>Garceau Jeannine</option>
                  <option>Garceau Thibault</option>
                  <option>Georges Eugène</option>
                  <option>Guilbon Sylvie</option>
                  <option>Karel Vincent</option>
                  <option>Lacroix Stéphane</option>
                  <option>Lacroix Xavier</option>
                  <option>Lazure Stéphanie</option>
                  <option>Masson Jules</option>
                  <option>Meunier Céline</option>
                  <option>Meunier Eugène</option>
                  <option>Perez Roger</option>
                  <option>Petitjean lisa</option>
                  <option>Petitjean Yves</option>
                </select>
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button">Ajouter</button>
                </span>
              </div>
            </p>
          </div>
      </td>
		</tr>
    <tr>
			<td>
        <input type="text" class="form-control" placeholder="nom" aria-describedby="basic-addon1" value="Table tropicale">
        <br>
        <a href="#" class="btn btn-danger" role="button">Supprimer</a>
      </td>
			<td>
        <select class="form-control">
          <option value="NULL">-</option>
          <?php
          for ($i=1; $i<=500; $i++) {
            ?>
            <?php if ($i == 7){?>
              <option value="<?=$i?>" selected="selected"><?=$i?></option>
            <?php }else {?>
              <option value="<?=$i?>"><?=$i?></option>
            <?php }}
            ?>
        </select>

      </td>
			<td>
          <div class="thumbnail">
            <p>Bellefeuille Bertrand<a href="#" class="supr-inv btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></p>
            <p>Bonnet Valentine<a href="#" class="supr-inv btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></p>
            <p>Charette Christien<a href="#" class="supr-inv btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></p>
            <p>Charette Didier<a href="#" class="supr-inv btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></p>
            <p>Charette Oliver<a href="#" class="supr-inv btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></p>
            <p>Delaunay Nicolas<a href="#" class="supr-inv btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></p>
            <p>Des Meaux Baptiste<a href="#" class="supr-inv btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></p>
            <p><div class="input-group">
                <select class="form-control" disabled>
                  <option>-</option>
                  <option>Dodier Florence</option>
                  <option>Frappier Christine</option>
                  <option>Frappier Marguerite</option>
                  <option>Garceau Camille</option>
                  <option>Garceau Jeannine</option>
                  <option>Garceau Thibault</option>
                  <option>Georges Eugène</option>
                  <option>Guilbon Sylvie</option>
                  <option>Karel Vincent</option>
                  <option>Lacroix Stéphane</option>
                  <option>Lacroix Xavier</option>
                  <option>Lazure Stéphanie</option>
                  <option>Masson Jules</option>
                  <option>Meunier Céline</option>
                  <option>Meunier Eugène</option>
                  <option>Perez Roger</option>
                  <option>Petitjean lisa</option>
                  <option>Petitjean Yves</option>
                </select>
                <span class="input-group-btn">
                  <button class="btn btn-default" type="button">Ajouter</button>
                </span>
              </div>
            </p>
          </div>
      </td>
		</tr>
	</tbody>
</table>

<div class="alert alert-info alert-dismissable fade in">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>Info!</strong> La génération du plan de table utilise l'âge ainsi que l'entente de chaque invité modifiable dans la fonction contact.
</div>

<!-- -v- Button -v- -->
<div class="form-group  col-xs-12">
  <button id="singlebutton" name="singlebutton" class="btn btn-primary">enregistrer</button>
</div>
<!-- -^- Button -^- -->

<!-- -v- Button -v- -->
<div class="form-group  col-xs-12">
  <button id="singlebutton" name="singlebutton" class="btn btn-primary">Générer</button>
</div>
<!-- -^- Button -^- -->
</body>
</html>
