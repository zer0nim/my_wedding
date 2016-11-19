<?php
  require_once '../view/baseMenuFnct.php';
?>
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
			<th>Nom Table</th>
			<th>Places min</th>
			<th>Places max</th>
		</tr>
	</thead>
	<tbody>
		<tr>
			<td><input type="text" class="form-control" placeholder="nom" aria-describedby="basic-addon1"></td>
			<td><input type="number" class="form-control" placeholder="min" aria-describedby="basic-addon1"></td>
			<td><input type="number" class="form-control" placeholder="min" aria-describedby="basic-addon1"></td>
		</tr>
    <tr>
			<td><input type="text" class="form-control" placeholder="nom" aria-describedby="basic-addon1"></td>
			<td><input type="number" class="form-control" placeholder="min" aria-describedby="basic-addon1"></td>
			<td><input type="number" class="form-control" placeholder="min" aria-describedby="basic-addon1"></td>
		</tr>
	</tbody>
</table>
<!-- -v- Button -v- -->
<div class="form-group  col-xs-12">
  <button id="singlebutton" name="singlebutton" class="btn btn-primary">enregistrer</button>
</div>
<!-- -^- Button -^- -->
</body>
</html>
