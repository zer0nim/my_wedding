<?php
  require_once '../view/baseMenuFnct.php';
?>
<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
<!--<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="../view/css/liste.css" type="text/css" />

  <div class="demo">
    <ul id="sortable">
      <?php // Affichage de la liste
        foreach ($data as $key => $value) { echo '<li id="list_' . $value['nom'] . '" class="list-group-item ui-state-default" type="button">' . $value['nom'] . '</li>'
          ;  }
      ?>
    </ul>
  </div>

  <!-- script pour récupérer l'ordre de la liste à chaque changement -->
  <script>
  $(document).ready( function(){ // quand la page a fini de se charger
   $("#sortable").sortable({ // initialisation de Sortable sur #list-photos
     placeholder: 'highlight', // classe à ajouter à l'élément fantome
     update: function() {  // callback quand l'ordre de la liste est changé
         var order = $('#sortable').sortable('serialize'); // récupération des données à envoyer
         $.post('liste-modifie.php',order, function(reponse) {alert(reponse); });
     }
   });
   $("#sortable").disableSelection(); // on désactive la possibilité au navigateur de faire des sélections
  });
  </script>

</body>
</html><!--
$.post('liste-modifie.php',order, function(reponse) {alert(reponse); });-->
