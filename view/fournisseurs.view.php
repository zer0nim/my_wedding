<?php
  require_once '../view/baseMenuFnct.php';
?>
<link rel="stylesheet" href="../view/css/fournisseurs.css" type="text/css" />
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;key=AIzaSyAIGMBk_u4Odlmc-UhPHgQ3RsZzq6J0Ak0" type="text/javascript"></script>


<div class="row">
  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <div class="caption">
        <h3>Sono</h3>
        <p>éclairage et sono lundi après-midi</p>
        <p><a href="#" class="btn btn-danger" role="button">Supprimer</a></p>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <div class="caption">
        <h3>Salle des fètes</h3>
        <p>Clé de la salle mardi matin</p>
        <p><a href="#" class="btn btn-danger" role="button">Supprimer</a></p>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <div class="caption">
        <h3>Nourriture</h3>
        <p>Livreur snack mercredi soir</p>
        <p><a href="#" class="btn btn-danger" role="button">Supprimer</a></p>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-4">
    <div class="thumbnail">
      <div class="caption">
        <h3>Traiteur</h3>
        <p>Traiteur jeudi 11 heure 30</p>
        <p><a href="#" class="btn btn-danger" role="button">Supprimer</a></p>
      </div>
    </div>
  </div>

  <div class="col-sm-6 col-md-4">

    <div class="thumbnail">
      <div class="caption">
        <p><a href="#" class="btn btn-primary" role="button">Ajouter</a></p>
      </div>
      <div class="no-marg-bot panel panel-default">
        <div class="panel-heading">
          <input type="text" class="form-control" placeholder="Titre" aria-describedby="basic-addon1">
          <input type="text" class="form-control" placeholder="Téléphone" aria-describedby="basic-addon1">
          <input type="text" class="form-control" placeholder="Adresse mail" aria-describedby="basic-addon1">
          <input type="text" class="form-control" id="user_input_autocomplete_address" placeholder="Adresse" aria-describedby="basic-addon1">
          <input type="text" class="form-control" placeholder="Site Internet" aria-describedby="basic-addon1">
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
        </div>
        <textarea class="form-control" id="" placeholder="Description" name=""></textarea>
      </div>
    </div>
  </div>


</div>
</body>
</html>
