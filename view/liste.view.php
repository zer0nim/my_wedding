<?php
  require_once '../view/baseMenuFnct.php';
?>
<script type="text/javascript" src="jquery-3.1.1.min.js"></script>
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="../view/css/liste.css" type="text/css" />

  <div class="demo">

  <ul id="sortable">
      <li id="listItem_1" class="ui-state-default">Item 1</li>
      <li id="listItem_2" class="ui-state-default">Item 2</li>
      <li id="listItem_3" class="ui-state-default">Item 3</li>
      <li id="listItem_4" class="ui-state-default">Item 4</li>
      <li id="listItem_5" class="ui-state-default">Item 5</li>
      <li id="listItem_6" class="ui-state-default">Item 6</li>
      <li id="listItem_7" class="ui-state-default">Item 7</li>
  </ul>

  </div><!-- End demo -->

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
</html>
