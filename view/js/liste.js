$(document).ready(function(){ // quand la page a fini de se charger

   $("#sortable").sortable({ // initialisation de Sortable sur #list-photos
  	 placeholder: 'highlight', // classe à ajouter à l'élément fantome
  	 update: function() {	// callback quand l'ordre de la liste est changé
  			 var order = $('#sortable').sortable('serialize'); // récupération des données à envoyer
  			 $.post('liste-modifie.php',order);
  	 }
   });
   $("#sortable").disableSelection(); // on désactive la possibilité au navigateur de faire des sélections

//Todo verifier si non existant !
  $("#addSouhait").bind("click", function addSouhait() {
    var nomSouh = $(this).prev().val();

    var tab = new Array();
    $("#sortable").find('li').each(function(){
      tab.push($(this).attr('id').slice(5));
    });

    if ($.inArray(nomSouh, tab) != -1) {
      sweetAlert("Oops...", "Souhait: \"" + nomSouh + "\" déja présent!", "error");
    }
    else if (nomSouh == "") {
      sweetAlert("Oops...", "Veuillez d'abord entrer un nom de souhait!", "error");
    }
    else {
      $.post(
          '../controller/ajax_list_add.php', // Le fichier cible côté serveur.
          {
              nom : nomSouh
          },

          function(data){
            var newLi = '<li id="list_' + nomSouh + '" class="list-group-item ui-state-default">' + nomSouh + '	<a class="supr-souh btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></li>';
            $("#sortable").append(newLi);
            $("#inputSouhait").val("");
            $(".supr-souh").bind("click", supprSouhait);
            //console.log(data);
          },

          'text' // Format des données reçues.
      );
  }
  });

  $(".supr-souh").bind("click", supprSouhait);
});

function supprSouhait() {
  var nomSouh = $(this).parent().attr('id').slice(5);

  swal({
		title: "Êtes-vous sur de vouloir supprimer le souhait?",
		text: "Vous ne pourrez pas revenir en arrière!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: "#DD6B55",
		confirmButtonText: "Oui, supprimer!",
		cancelButtonText: "Non, annuler!",
		closeOnConfirm: false
	},
	function(isConfirm){
	  if (isConfirm) {
      $.post(
          '../controller/ajax_list_delete.php', // Le fichier cible côté serveur.
          {
              nom : nomSouh
          },

          function(data){
            $('#list_' + nomSouh).remove();
            //console.log(data);
          },

          'text' // Format des données reçues.
      );
			swal("Supprimé!", "", "success");
	  }
	});
}
