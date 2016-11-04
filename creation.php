<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Wedding Planner</title>
  <meta name="description" content="Le site de planification de mariage">

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://use.fontawesome.com/f332948f4d.js"></script>

  <!--  jQuery -->
  <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
  
  <!-- Bootstrap Date-Picker Plugin -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/locales/bootstrap-datepicker.fr.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>

  <!-- For GOOGLE autocomplete -->
  <script src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;key=AIzaSyAIGMBk_u4Odlmc-UhPHgQ3RsZzq6J0Ak0" type="text/javascript"></script>
  <link rel="stylesheet" href="creation.css" type="text/css" />

</head>
<body class="container-fluid">

  <header>
    <div class="navbar navbar-default">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">My Wedding Planner</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Création de l'événement</a></li>
        <li><a href="#">Mon compte</a></li>
      </ul>
    </div>
  </header>



  <form class="col-lg-6">
    <legend>Création de l'événement</legend>

    <!-- -v- Name input -v- -->
    <div class="form-group">
      <label class="control-label">Mariage de</label><br>
    Nom : <input type="text" class="form-control">
    Prenom : <input type="text" class="form-control">
  </div>

  <div class="form-group">
    Nom : <input type="text" class="form-control">
    Prenom : <input type="text" class="form-control">
  </div>
  <!-- -^- Name input -^- -->

  <!-- -v- Description input -v- -->
  <div class="form-group">
    Description : <textarea id="textarea" class="form-control"></textarea>
  </div>
  <!-- -^- Description input -^- -->

<!-- -v- Date input -v- -->
  <div class="form-group">
      Date: <input class="form-control" id="date" name="date" placeholder="JJ/MM/AAAA" type="text"/>
  </div>
  <script>
      $(document).ready(function(){
        var date_input=$('input[name="date"]');
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        var options={
          language: "fr-FR",
          startDate: '+1d',
          format: 'dd/mm/yyyy',
          container: container,
          todayHighlight: true,
          autoclose: true,
        };
        date_input.datepicker(options);
      })
  </script>
<!-- -^- Date input -^- -->

<!-- -v- Adress input -v- -->
    <div class="form-group">
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

<!-- -v- Button -v- -->
    <div class="form-group">
        <button id="singlebutton" name="singlebutton" class="btn btn-primary">Créer l'événement</button>
    </div>
<!-- -^- Button -^- -->

  </form>


  <footer>
  </footer>
</body>
</html>
