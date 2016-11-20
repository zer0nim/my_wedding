<?php
  require_once '../view/baseMenuFnct.php';
?>
<link rel="stylesheet" href="../view/css/fournisseurs.css" type="text/css" />
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;key=AIzaSyAIGMBk_u4Odlmc-UhPHgQ3RsZzq6J0Ak0" type="text/javascript"></script>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery.matchHeight/0.7.0/jquery.matchHeight-min.js"></script>


<div class="row">

  <!--<div class="box col-sm-6 col-md-4">
    <div class="thumbnail">
      <div class="caption">
        <address>
          <strong>Sono et Eclairage</strong><br>
          Notre Dame, Paris, France<br>
          Téléphone : 0653783195<br>
          Adresse Mail : contact@sono3000.net<br>
          Site Internet : www.sono3000.net
        </address>
        <blockquote>
          <p>Livraison et installation de la sono et des éclairages mercredi 10 heure</p>
        </blockquote>
        <p><a href="#" class="btn btn-danger" role="button">Supprimer</a></p>
      </div>
    </div>
  </div>

  <div class="box col-sm-6 col-md-4">
    <div class="thumbnail">
      <div class="caption">
        <address>
          <strong>Clé de la salle</strong><br>
          Avenue du Stade de France, Saint-Denis, France<br>
          Téléphone : 0934163575<br>
          Adresse Mail : reservation@salledespectacles.com<br>
          Site Internet : www.salledespectacles.com
        </address>
        <blockquote>
          <p>Aller chercher les clés de la salle lundi dans la matinée </p>
        </blockquote>
        <p><a href="#" class="btn btn-danger" role="button">Supprimer</a></p>
      </div>
    </div>
  </div>

  <div class="box col-sm-6 col-md-4">
    <div class="thumbnail">
      <div class="caption">
        <address>
          <strong>Traiteur</strong><br>
          Paris Gare de Lyon, Place Louis Armand, Paris, France<br>
          Téléphone : 0657563135<br>
          Adresse Mail : contact@traiteur2000.fr<br>
          Site Internet : www.traiteur2000.fr
        </address>
        <blockquote>
          <p>Arrivée traiteur jeudi vers 20 heure 30</p>
        </blockquote>
        <p><a href="#" class="btn btn-danger" role="button">Supprimer</a></p>
      </div>
    </div>
  </div>-->
  <?php
    foreach ($data['fournisseurs'] as $key => $value) {
      $value->afficherFournisseur();
    }
  ?>


  <!-- Tableau d'ajout de fournisseur -->
  <div class="box col-sm-6 col-md-4">
    <div class="thumbnail">
      <div class="caption">
        <p><a href="#" class="btn btn-primary" role="button">Ajouter</a></p>
      </div>
      <div class="no-marg-bot panel panel-default">

        <form action="fournisseurs.ctrl.php" method="post">
          <div class="panel-heading">
            <input type="text" class="form-control" placeholder="Titre" aria-describedby="basic-addon1">
            <input type="text" class="form-control" id="user_input_autocomplete_address" placeholder="Adresse" aria-describedby="basic-addon1">
            <input type="text" class="form-control" placeholder="Téléphone" aria-describedby="basic-addon1">
            <input type="text" class="form-control" placeholder="Adresse mail" aria-describedby="basic-addon1">
            <input type="text" class="form-control" placeholder="Site Internet" aria-describedby="basic-addon1">

          </div>
          <textarea class="form-control" id="" placeholder="Description" name=""></textarea>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Script pour géré les différente hauteur des éléments dans la grille-->
<script>
  $(function() {
      $('.box').matchHeight();
  });
</script>

<script type="text/javascript">
  // Lie le champs adresse en champs autocomplete afin que l'API puisse afficher les propositions d'adresses
  function initializeAutocomplete(id) {
    var element = document.getElementById(id);
    if (element) {
      var autocomplete = new google.maps.places.Autocomplete(element, { types: ['geocode'] });
      google.maps.event.addListener(autocomplete, 'place_changed', onPlaceChanged);
    }
  }
  // Initialisation du champs autocomplete
  google.maps.event.addDomListener(window, 'load', function() {
    initializeAutocomplete('user_input_autocomplete_address');
  });
</script>
</body>
</html>
