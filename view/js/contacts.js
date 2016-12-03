function actionSelect(anc_select_item) {
	//comparaison des valeurs dans la base
	if (anc_select_item == null) {
		asNoModif();
	}
	else {
		console.log('anc: ' + anc_select_item);
		$.post(
				'../controller/ajax_compare_cnt.php', // Le fichier cible côté serveur.
				{
						idcont : anc_select_item
				},
				function(data){
					if (
						(document.getElementById("NomLink").value == data['cont_nom']) &&
						(document.getElementById("PrenomLink").value == data['cont_prenom']) &&
						(document.getElementById("user_input_autocomplete_address").value == data['cont_adresse']) &&
						(document.getElementById("MailLink").value == data['cont_mail']) &&
						(document.getElementById("TelLink").value == data['cont_tel']) &&
						(document.getElementById("AgeLink").value == data['cont_age'])
					) {
						asNoModif();
					}
					else {
						$('#select-cnt').val([]);
						$('#select-cnt').val(anc_select_item).change();
						console
					/*	swal({
							title: "Are you sure?",
							text: "You will not be able to recover this imaginary file!",
							type: "warning",
							showCancelButton: true,
							confirmButtonColor: "#DD6B55",
							confirmButtonText: "Yes, delete it!",
							cancelButtonText: "No, cancel plx!",
							closeOnConfirm: false,
							closeOnCancel: false
						},
						function(isConfirm){
							if (isConfirm) {
								swal("Deleted!", "Your imaginary file has been deleted.", "success");
							} else {
									swal("Cancelled", "Your imaginary file is safe :)", "error");
							}
						});*/
					}
				},
				'json' // Format des données reçues.
		);
	}
}

function asNoModif() {
	if ($('#select-cnt').val().length == 1) {

		$.post(
				'../controller/ajax_select_cnt.php', // Le fichier cible côté serveur.
				{
						idcont : $('#select-cnt').val()
				},

				function(data){
					document.getElementById("NomLink").value = data['cont_nom'];
					document.getElementById("NomLink").disabled=false;
					document.getElementById("PrenomLink").value = data['cont_prenom'];
					document.getElementById("PrenomLink").disabled=false;
					document.getElementById("user_input_autocomplete_address").value = data['cont_adresse'];
					document.getElementById("user_input_autocomplete_address").disabled=false;
					document.getElementById("MailLink").value = data['cont_mail'];
					document.getElementById("MailLink").disabled=false;
					document.getElementById("TelLink").value = data['cont_tel'];
					document.getElementById("TelLink").disabled=false;
					document.getElementById("AgeLink").value = data['cont_age'];
					document.getElementById("AgeLink").disabled=false;

					document.getElementById("EntenteLink").disabled=false;
					document.getElementById("EntenteChoiceLink").disabled=false;
					document.getElementById("MesententeLink").disabled=false;
					document.getElementById("LikeLink").disabled=false;
					document.getElementById("dislikeLink").disabled=false;

					document.getElementById("SaveContactInfoLink").disabled=false;
					$('#info').removeClass('disabledInf');
				},

				'json' // Format des données reçues.
		);
	}
	else {
		$('#info').addClass('disabledInf');
		document.getElementById("NomLink").value = "";
		document.getElementById("NomLink").disabled=true;
		document.getElementById("PrenomLink").value = "";
		document.getElementById("PrenomLink").disabled=true;
		document.getElementById("user_input_autocomplete_address").value = "";
		document.getElementById("user_input_autocomplete_address").disabled=true;
		document.getElementById("MailLink").value = "";
		document.getElementById("MailLink").disabled=true;
		document.getElementById("TelLink").value = "";
		document.getElementById("TelLink").disabled=true;
		document.getElementById("AgeLink").value = "";
		document.getElementById("AgeLink").disabled=true;
		document.getElementById("NomLink").value = "";
		document.getElementById("NomLink").disabled=true;

		document.getElementById("EntenteLink").disabled=true;
		document.getElementById("EntenteChoiceLink").disabled=true;
		document.getElementById("MesententeLink").disabled=true;
		document.getElementById("LikeLink").disabled=true;
		document.getElementById("dislikeLink").disabled=true;

		document.getElementById("SaveContactInfoLink").disabled=true;
	}
}

// fonction pour confirmation de suppression d'un ou plusieurs contact (cree une popup)
function confirmation() {
	var msg = "Aucun contact n'est sélectionné !";
	var selected = $('#select-cnt').val();
	if (selected) {
		if (selected.length == 1) {
			msg = "e contact sélectionné";
		}
		else {
			msg = "es contacts sélectionnés";
		}

		swal({
		  title: "Êtes-vous sur de vouloir supprimer l" + msg + " ?",
		  text: "Vous ne pourrez pas revenir en arrière!",
		  type: "warning",
		  showCancelButton: true,
		  confirmButtonColor: "#DD6B55",
		  confirmButtonText: "Oui, supprimer!",
		  cancelButtonText: "Non, annuler!",
		  closeOnConfirm: false,
		  closeOnCancel: false
		},
		function(isConfirm){
		  if (isConfirm) {
		    swal("Supprimé!", "", "success");
				//suppression dans la base
				$.post(
						'../controller/ajax_delete_cnt.php', // Le fichier cible côté serveur.
						{
								idcont : selected
						},

						function(data){
							location.reload(true);
						},

						'text' // Format des données reçues.
				);
		  } else {
			    swal("Annnulé", "Votre fichier est en sécurité :)", "error");
		  }
		});
	}
	else {
		//message erreur
		swal("Oops...", msg, "error");
	}
}

// Lie le champs adresse en champs autocomplete afin que l'API puisse afficher les propositions d'adresses
function initializeAutocomplete(id) {
	var element = document.getElementById(id);
	if (element) {
		var autocomplete = new google.maps.places.Autocomplete(element, { types: ['geocode'] });
	}
}
// Initialisation du champs autocomplete
google.maps.event.addDomListener(window, 'load', function() {
	initializeAutocomplete('user_input_autocomplete_address');
});

$(document).ready(function(){
var anc_select_item;
	$('#info').addClass('disabledInf');
	document.getElementById("NomLink").value = "";
	document.getElementById("NomLink").disabled=true;
	document.getElementById("PrenomLink").value = "";
	document.getElementById("PrenomLink").disabled=true;
	document.getElementById("user_input_autocomplete_address").value = "";
	document.getElementById("user_input_autocomplete_address").disabled=true;
	document.getElementById("MailLink").value = "";
	document.getElementById("MailLink").disabled=true;
	document.getElementById("TelLink").value = "";
	document.getElementById("TelLink").disabled=true;
	document.getElementById("AgeLink").value = "";
	document.getElementById("AgeLink").disabled=true;
	document.getElementById("NomLink").value = "";
	document.getElementById("NomLink").disabled=true;

	document.getElementById("EntenteLink").disabled=true;
	document.getElementById("EntenteChoiceLink").disabled=true;
	document.getElementById("MesententeLink").disabled=true;
	document.getElementById("LikeLink").disabled=true;
	document.getElementById("dislikeLink").disabled=true;

	document.getElementById("SaveContactInfoLink").disabled=true;

	$( "#select-cnt" ).bind({
	  input: function() {
			actionSelect(anc_select_item);
	  },
	  mouseenter: function() {
			anc_select_item = $('#select-cnt').val();
	  }
	});
});
