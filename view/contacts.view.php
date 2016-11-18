<!-- For GOOGLE autocomplete -->
<script src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;key=AIzaSyAIGMBk_u4Odlmc-UhPHgQ3RsZzq6J0Ak0" type="text/javascript"></script>
<?php
  require_once '../view/baseMenuFnct.php';
?>
<link rel="stylesheet" href="../view/css/contacts.css" type="text/css" />

<form>
  <div class="row">
    <div class="col-xs-12 col-sm-5 col-lg-3">
      <label>Liste des contacts:</label>
      <select multiple class="form-control">
        <option>Bellefeuille Bertrand</option>
        <option>Bonnet Valentine</option>
        <option>Charette Christien</option>
        <option>Charette Didier</option>
        <option>Charette Oliver</option>
        <option>Delaunay Nicolas</option>
        <option>Des Meaux Baptiste</option>
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
        <option>Leblanc Claire</option>
        <option>Lemonnier Catherine</option>
        <option>Marchal Alfred</option>
        <option>Masson Aurélie</option>
        <option>Masson Chloe</option>
        <option>Masson Claudette</option>
        <option>Masson Jules</option>
        <option>Meunier Céline</option>
        <option>Meunier Eugène</option>
        <option>Perez Roger</option>
        <option>Petitjean lisa</option>
        <option>Petitjean Yves</option>
      </select>
    </div>
    <!--
    ajouter Contact
    supprimer Contact
    -->

    <div class="col-xs-12 col-sm-7 col-lg-9 row">
      <div class="nopadding form-group col-xs-12">
        <div class="col-xs-12 col-sm-6">
          Nom : <input type="text" class="form-control">
        </div>
        <div class="col-xs-12 col-sm-6">
          Prenom : <input type="text" class="form-control">
        </div>
      </div>
      <div class="nopadding form-group col-xs-12">
        <div class="col-xs-12 col-sm-7">
          Mail : <input type="text" class="form-control">
        </div>
        <div class="col-xs-12 col-sm-5">
          Télephone : <input type="text" class="form-control">
        </div>
      </div>
      <div class="nopadding form-group col-xs-12">
        <!-- -v- Adress input -v- -->
        <div class="col-xs-12 col-sm-10">
          Adresse: <input id="user_input_autocomplete_address" placeholder="Votre adresse..." class="form-control">
        </div>
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
        <!-- -^- Adress input -^- -->

        <div class="col-xs-12 col-sm-2">
          Age :<br>
          <select class="form-control">
            <option value="NULL">-</option>
          <?php
              for ($i=1; $i<=150; $i++)
              {
          ?>
                <option value="<?=$i?>"><?=$i?></option>
          <?php
              }
          ?>
          </select>
        </div>
      </div>
<!--
			Bonne entante :
      Mauvaise entante :
-->
        <!-- -v- Button -v- -->
        <div class="form-group  col-xs-12">
            <button id="singlebutton" name="singlebutton" class="btn btn-primary">enregistrer</button>
        </div>
        <!-- -^- Button -^- -->
    </div>
  </div>
</form>

</body>
</html>
