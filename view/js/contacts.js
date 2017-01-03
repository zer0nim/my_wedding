$(document).ready(function(){
	disableCntInfo();
	$("#select-cnt" ).change(selectHandler);
	$("#select-cnt" ).unbind( "change", disselectHandler);

	$("#NomLink").bind("input", asDiffHandler);
	$("#PrenomLink").bind("input", asDiffHandler);
	$("#user_input_autocomplete_address").bind("input", asDiffHandler);
	$("#MailLink").bind("input", asDiffHandler);
	$("#TelLink").bind("input", asDiffHandler);
	$("#AgeLink").bind("input", asDiffHandler);

	$('#contInfoform').submit(function () {
		if ($('#select-cnt').val() == "newC") {
		//si Création nouveau contact non inscrit dans la bdd
			saveContact();
		}
		else {
		//si modification contact inscrit dans la bdd
			modifContact();
		}
		return false;
	});


	$('#MesententeLink').bind("click", function addMesentente() {
		var id1 = $("#select-cnt").val();
		var thisMes = $(this);
		var selected = $("option:selected", thisMes.parent().prev()).text();

		$.post(
				'../controller/ajax_modify_mesentente.php', // Le fichier cible côté serveur.
				{
						idCnt1 : id1,
						idCnt2 : thisMes.parent().prev().val()
				},

				function(data){
					//console.log(data);
					var newRow = "<tr id=\"messT_" + thisMes.parent().prev().val() + "\"><td><p>" + selected + "<a onclick=\"return supprMesentente(" + id1[0] + ", " + thisMes.parent().prev().val() + ");\" class=\"supprCntLink btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a></p></td></tr>";
					$("#cntTable").append(newRow);
					sortTable($("#cntTable"),'asc');
					$("option:selected", thisMes.parent().prev()).remove();
				},

				'text' // Format des données reçues.
		);
	});
});

function selectHandler() {
	actionSelect();
}
function disselectHandler() {
	preventChangeSlct();
}
function noDiffHandler() {
	$("#select-cnt" ).change(selectHandler);
	$("#select-cnt" ).unbind( "change", disselectHandler);
}
function asDiffHandler() {
	document.getElementById("SaveContactInfoLink").disabled=false;
	$("#select-cnt" ).change(disselectHandler);
	$("#select-cnt" ).unbind( "change", selectHandler );
}

function actionSelect() {
	$('#select-cnt').data('previous', $('#select-cnt').val());
	showCntInfo();
}

function preventChangeSlct() {
	swal({
		title: "Êtes-vous sur?",
	  text: "Les modifications effectuées sur le contact ne seront pas sauvegardées!",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
		confirmButtonText: "Ne pas sauvergarder",
	  cancelButtonText: "Annuler",
	  closeOnConfirm: true,
	  closeOnCancel: true
	},
	function(isConfirm){
	  if (isConfirm) {
			// Si le contact séléctionné est un "nouveauContact" on le supprime de la liste
			$('#select-cnt option[value=' + "newC" + ']').remove();
			noDiffHandler();
			showCntInfo();
	  }
		else {
			if ($("#select-cnt option[value='newC']").length > 0) {
			//en cas d'annulation de changement de nouveauContact
				$('#select-cnt').val([]);
				$('#select-cnt').val("newC").change();
			}
			else {
				$('#select-cnt').val([]);
				$('#select-cnt').val($('#select-cnt').data('previous')).change();
			}
		}
	});
}

function showCntInfo() {
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

					document.getElementById("MesententeLink").disabled=false;

					document.getElementById("SaveContactInfoLink").disabled=true;
					$('#info').removeClass('disabledInf');
					$("#listCntTMesentente").removeAttr('disabled');

					$("#cntTable").empty();
					$("#listCntTMesentente").empty();

						for (var key in data['mesentente']) {
							if (key == 'cntSelct') {
								$.each(data['mesentente'][key], function( index, value) {
									var newOpt = "<option value=\"" + value['id'] + "\">" + value['nomPrenom'] + "</option>";
									$("#listCntTMesentente").append(newOpt);
								});
								$("#listCntTMesentente").sortOptions();
							}
							else {
								var newRow = "<tr id=\"messT_" + data['mesentente'][key]['id'] + "\"><td><p>" + data['mesentente'][key]['cnt'] + "<a onclick=\"return supprMesentente(" + $('#select-cnt').val() + ", " + data['mesentente'][key]['id'] + ");\" class=\"supprCntLink btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a></p></td></tr>";
								$("#cntTable").append(newRow);
								sortTable($("#cntTable"),'asc');
							}
						}
				},

				'json' // Format des données reçues.
		);
	}
	else {
		disableCntInfo();
	}
}

function disableCntInfo() {
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

	document.getElementById("MesententeLink").disabled=true;

	document.getElementById("SaveContactInfoLink").disabled=true;

	$("#cntTable").empty();
	$("#listCntTMesentente").empty();
	$("#listCntTMesentente").attr('disabled', 'disabled');
}

function initCntInfo() {
	document.getElementById("NomLink").value = "";
	document.getElementById("NomLink").disabled=false;
	document.getElementById("PrenomLink").value = "";
	document.getElementById("PrenomLink").disabled=false;
	document.getElementById("user_input_autocomplete_address").value = "";
	document.getElementById("user_input_autocomplete_address").disabled=false;
	document.getElementById("MailLink").value = "";
	document.getElementById("MailLink").disabled=false;
	document.getElementById("TelLink").value = "";
	document.getElementById("TelLink").disabled=false;
	document.getElementById("AgeLink").value = "";
	document.getElementById("AgeLink").disabled=false;

	document.getElementById("MesententeLink").disabled=false;

	$("#cntTable").empty();
	$("#listCntTMesentente").empty();
	$("#listCntTMesentente").attr('disabled', 'disabled');

	asDiffHandler();
	$('#info').removeClass('disabledInf');
}

// fonction pour sauvergarder les infos d'un contact existant
function modifContact() {
var cnt = $('#select-cnt :selected');
var cntNomPrenom = $("#NomLink").val() + " " + $("#PrenomLink").val();

	//enregistrement dans la base
	$.post(
			'../controller/ajax_modify_cnt.php', // Le fichier cible côté serveur.
			{
					idcont : $('#select-cnt').val()[0],
					nom : $("#NomLink").val(),
					prenom : $("#PrenomLink").val(),
					adresse : $("#user_input_autocomplete_address").val(),
					mail : $("#MailLink").val(),
					tel : $("#TelLink").val(),
					age : $("#AgeLink").val()
			},

			function(data){
				console.log(data);
				swal("Contact enregistré!", "", "success");
				noDiffHandler();
				cnt.text(cntNomPrenom);
				document.getElementById("SaveContactInfoLink").disabled=true;
			},

			'json' // Format des données reçues.
	);
}

// fonction pour sauvergarder les infos d'un nouveau contact
function saveContact() {
	//enregistrement dans la base
	$.post(
			'../controller/ajax_save_cnt.php', // Le fichier cible côté serveur.
			{
					nom : $("#NomLink").val(),
					prenom : $("#PrenomLink").val(),
					adresse : $("#user_input_autocomplete_address").val(),
					mail : $("#MailLink").val(),
					tel : $("#TelLink").val(),
					age : $("#AgeLink").val()
			},

			function(data){
				$('#select-cnt option[value=' + "newC" + ']').text(data["cont_nom"] + " " + data["cont_prenom"]);
				$('#select-cnt option[value=' + "newC" + ']').val(data["cont_id"]);
				swal("Contact enregistré!", "", "success");
				noDiffHandler();
				document.getElementById("SaveContactInfoLink").disabled=true;
				//location.reload();
			},

			'json' // Format des données reçues.
	);
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
				if ($("#select-cnt option[value='newC']").length <= 0) {
					//suppression dans la base
					$.post(
							'../controller/ajax_delete_cnt.php', // Le fichier cible côté serveur.
							{
									idcont : selected
							},

							function(data){
								disableCntInfo();
								noDiffHandler();
								var i;
								for (i = 0; i < selected.length; ++i) {
	    						$('#select-cnt option[value=' + selected[i] + ']').remove();
								}
							},

							'text' // Format des données reçues.
					);
				}
				else {
					// Si le contact séléctionné est un "nouveauContact" on le supprime de la liste
					$('#select-cnt option[value=' + "newC" + ']').remove();
					disableCntInfo();
					noDiffHandler();
				}
		  }
			else {
			    swal("Annnulé", "Votre fichier est en sécurité :)", "error");
		  }
		});
	}
	else {
		//message erreur
		swal("Oops...", msg, "error");
	}
}

function	nouveauContact() {
	if ($("#SaveContactInfoLink").is(':disabled')) {
		$('#select-cnt').append(new Option("Nouveau contact","newC"));
		$('#select-cnt').val([]);
		$('#select-cnt').val("newC").change();
		initCntInfo();
	}
	else {
		if ($("#select-cnt option[value='newC']").length <= 0) {
			swal({
				title: "Êtes-vous sur?",
				text: "Des modifications en cours non pas été sauvegardées!",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: "#DD6B55",
				confirmButtonText: "Ne pas sauvergarder",
				cancelButtonText: "Annuler",
				closeOnConfirm: true,
				closeOnCancel: true
			},
			function(isConfirm){
				if (isConfirm) {
					$('#select-cnt option[value=' + "newC" + ']').remove();
					noDiffHandler();
					initCntInfo();
					$('#select-cnt').append(new Option("Nouveau contact","newC"));
					$('#select-cnt').val([]);
					$('#select-cnt').val("newC").change();
				}
				else {
					$('#select-cnt').val([]);
					$('#select-cnt').val($('#select-cnt').data('previous')).change();
				}
			});
		}
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

$.fn.sortOptions = function(){
    $(this).each(function(){
        var op = $(this).children("option");
        op.sort(function(a, b) {
            return a.text > b.text ? 1 : -1;
        })
        return $(this).empty().append(op);
    });
}

function sortTable(table, order) {
    var asc   = order === 'asc',
        tbody = table.find('tbody');

    tbody.find('tr').sort(function(a, b) {
        if (asc) {
            return $('td:first', a).text().localeCompare($('td:first', b).text());
        } else {
            return $('td:first', b).text().localeCompare($('td:first', a).text());
        }
    }).appendTo(tbody);
}

supprMesentente = function(cntId1, cntId2) {
	$.post(
			'../controller/ajax_remove_mesentente.php', // Le fichier cible côté serveur.
			{
					idCnt1 : cntId1,
					idCnt2 : cntId2
			},

			function(data){
				$("#messT_" + cntId2).remove();
			},

			'text' // Format des données reçues.
	);
	return false;
}
