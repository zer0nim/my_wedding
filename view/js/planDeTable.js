$(document).ready(function(){
//$("#myTable > tbody > tr").length

	$(".cntTable").each(function() {
		if (($(this).find('td').length >= $(this).parent().parent().prev().children().val())) {
			$("#cntTableAdding_" + $(this).parent().parent().parent().attr('id')).hide();
		}
	});

	$(".nameLink").bind("input", function allowModifNom() {
		//--v modif du bouton v--
		$(this).next().children().prop("disabled", false);
		$(this).next().children().removeClass('btn-success');
		$(this).next().children().addClass('btn-warning');
	});

	$(".nameModifLink").bind("click", function saveModifNom() {
		//--v modif du bouton v--
		$(this).prop("disabled", true);
		$(this).removeClass('btn-warning');
		$(this).addClass('btn-success');

		//--v enregistrement dans la base v--
		$.post(
				'../controller/ajax_update_nom_table.php', // Le fichier cible côté serveur.
				{
						idtable : $(this).parent().parent().parent().parent().attr('id'),
						nom : $(this).parent().prev().val()
				},

				function(data){
					//console.log(data);
				},

				'text' // Format des données reçues.
		);
	});

	$(".addCntLink").bind("click", function ModifCnt() {
		var slctdCont = $(this).parent().prev();
		//modification dans la base
		$.post(
				'../controller/ajax_modify_cnt_table.php', // Le fichier cible côté serveur.
				{
						idtable : slctdCont.parent().parent().parent().attr('id'),
						idCnt : slctdCont.val()
				},

				function(data){
					var newCntRow = "<tr id=\"contId" + slctdCont.val() + "\"><td>" + slctdCont.find(":selected").text() + "<a onclick=\"return supprCntTab(" + slctdCont.val() + ")\;\" class=\"supprCntLink btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a></td></tr>";
					$("#cntTable_" + slctdCont.parent().parent().parent().attr('id')).append(newCntRow);
					$('.listCntToAddlink option[value=' + slctdCont.val() + ']').remove();

					sortTable($("#cntTable_" + slctdCont.parent().parent().parent().attr('id')).parent(),'asc');

					if (slctdCont.parent().prev().find('tbody').find('td').length >= slctdCont.parent().parent().prev().children().val()) {
						$("#cntTableAdding_" + slctdCont.parent().parent().parent().attr('id')).hide();
					}
					//console.log(data);
				},

				'text' // Format des données reçues.
		);
	});

	$(".nbPlacesLink").bind("click", function savePrevNbPlaces() {
		$(this).data('previous', $(this).val());
	});

	$(".nbPlacesLink").bind("input", function saveModifNbPlaces() {
		var linkNb = $(this);
//		console.log(linkNb.parent().next().children().find('tbody').find('td').length + "/" + linkNb.val());

		if (linkNb.parent().next().children().find('tbody').find('td').length > linkNb.val()) {
//			console.log("need to cancel the modification, prev = " + linkNb.data('previous'));
			sweetAlert("Oops...", "Supprimez d'abord des contacts de la table!", "error");
			linkNb.val([]);
			linkNb.val(linkNb.data('previous')).change();
		}
		else {
			if (linkNb.parent().next().children().find('tbody').find('td').length < linkNb.val()) {
				$("#cntTableAdding_" + linkNb.parent().parent().attr('id')).show();
			}
			else {
				$("#cntTableAdding_" + linkNb.parent().parent().attr('id')).hide();
			}
			//modification dans la base
			$.post(
					'../controller/ajax_update_places_table.php', // Le fichier cible côté serveur.
					{
							idtable : $(this).parent().parent().attr('id'),
							nbPlaces : $(this).val()
					},

					function(data){
						//console.log(data);
					},

					'text' // Format des données reçues.
			);
		}
	});
});

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

$.fn.sortOptions = function(){
    $(this).each(function(){
        var op = $(this).children("option");
        op.sort(function(a, b) {
            return a.text > b.text ? 1 : -1;
        })
        return $(this).empty().append(op);
    });
}

function nouvelleTable() {

	$.post(
			'../controller/ajax_save_table.php', // Le fichier cible côté serveur.
			{
			},

			function(data){
				var optionNb = "";
				for (i=1; i<=500; i++) {
					if (i == 1) {
						optionNb = optionNb + "<option value=\"" + i + "\" selected=\"selected\">" + i + "</option>";
					}
					else {
						optionNb = optionNb + "<option value=\"" + i + "\">" + i + "</option>";
					}
				}

				var newRow = "<tr id=\"" + data['idT'] + "\"><td><div class=\"input-group\"><input type=\"text\" class=\"nameLink form-control\" placeholder=\"nom\" aria-describedby=\"basic-addon1\" value=\"SansNom\"><span class=\"input-group-btn\"><button class=\"nameModifLink btn btn-success\" type=\"button\" disabled=\"true\"><i class=\"fa fa-check\" aria-hidden=\"true\"></i></button></span></div><br><a class=\"btn btn-danger\" role=\"button\" onclick=\"return supprT(" + data['idT'] + ");\">Supprimer</a></td><td><select class=\"form-control nbPlacesLink\">" + optionNb + "</select></td><td><table class=\"table table-bordered table-striped table-hover table-responsive\"><tbody class=\"cntTable\" id=\"cntTable_" + data['idT']  + "\"></tbody></table><div class=\"input-group\" id=\"cntTableAdding_" + data['idT'] + "\"><select class=\"listCntToAddlink form-control\"></select><span class=\"input-group-btn\"><button class=\"addCntLink btn btn-default\" type=\"button\">Ajouter</button></span></div></td></tr>";
								//Affichage de la nouvelle Table dans le tableau
				$("#tablesLink").append(newRow);

//console.log(data['toAppend']);
$("#cntTableAdding_" + data['idT']).children().append(data['toAppend']);
		//		$("#cntTableAdding_" + data['idT']).append(data['toAppend']);

				// rappel des bind car non appliqué au dernier élément ajouté
				$(".nameLink").bind("input", function allowModifNom() {
					//--v modif du bouton v--
					$(this).next().children().prop("disabled", false);
					$(this).next().children().removeClass('btn-success');
					$(this).next().children().addClass('btn-warning');
				});

				$(".nameModifLink").bind("click", function saveModifNom() {
					//--v modif du bouton v--
					$(this).prop("disabled", true);
					$(this).removeClass('btn-warning');
					$(this).addClass('btn-success');

					//--v enregistrement dans la base v--
					$.post(
							'../controller/ajax_update_nom_table.php', // Le fichier cible côté serveur.
							{
									idtable : $(this).parent().parent().parent().parent().attr('id'),
									nom : $(this).parent().prev().val()
							},

							function(data){
								//console.log(data);
							},

							'text' // Format des données reçues.
					);
				});

				$(".addCntLink").bind("click", function ModifCnt() {
					var slctdCont = $(this).parent().prev();
					//modification dans la base
					$.post(
							'../controller/ajax_modify_cnt_table.php', // Le fichier cible côté serveur.
							{
									idtable : slctdCont.parent().parent().parent().attr('id'),
									idCnt : slctdCont.val()
							},

							function(data){
								var newCntRow = "<tr id=\"contId" + slctdCont.val() + "\"><td>" + slctdCont.find(":selected").text() + "<a onclick=\"return supprCntTab(" + slctdCont.val() + ")\;\" class=\"supprCntLink btn btn-danger btn-xs\" role=\"button\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a></td></tr>";
								$("#cntTable_" + slctdCont.parent().parent().parent().attr('id')).append(newCntRow);
								$('.listCntToAddlink option[value=' + slctdCont.val() + ']').remove();

								sortTable($("#cntTable_" + slctdCont.parent().parent().parent().attr('id')).parent(),'asc');

								if (slctdCont.parent().prev().find('tbody').find('td').length >= slctdCont.parent().parent().prev().children().val()) {
									$("#cntTableAdding_" + slctdCont.parent().parent().parent().attr('id')).hide();
								}
								//console.log(data);
							},

							'text' // Format des données reçues.
					);
				});

				$(".nbPlacesLink").bind("input", function saveModifNbPlaces() {
					//modification dans la base
					$.post(
							'../controller/ajax_update_places_table.php', // Le fichier cible côté serveur.
							{
									idtable : $(this).parent().parent().attr('id'),
									nbPlaces : $(this).val()
							},

							function(data){
								//console.log(data);
							},

							'text' // Format des données reçues.
					);
				});
			},

			'json' // Format des données reçues.
	);
}

supprCntTab = function(cntId) {
	//On met la TbleId du contact à NULL
	$.post(
			'../controller/ajax_delete_cnt_table.php', // Le fichier cible côté serveur.
			{
					idCnt : cntId
			},

			function(data){
				// --v ajoute le contact dans les posibilités d'ajout v--
				$('.listCntToAddlink').append("<option value='" + cntId + "'>" + $("#contId" + cntId).text() + "</option>");
				$('.listCntToAddlink').sortOptions();
				if (($("#contId" + cntId).parent().find('td').length - 1) < $("#contId" + cntId).parent().parent().parent().prev().children().val()) {
					$("#cntTableAdding_" + $("#contId" + cntId).parent().parent().parent().parent().attr('id')).show();
				}
				$("#contId" + cntId).remove();
			},

			'text' // Format des données reçues.
	);
	return false;
}

supprT = function(ref) {
	//fonction appelé lors du clic sur supprimer
//	console.log($('#supprLink').attr('href'));
	swal({
		title: "Êtes-vous sur de vouloir supprimer la table?",
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
			//suppression dans la base
			$.post(
					'../controller/ajax_delete_table.php', // Le fichier cible côté serveur.
					{
							idtable : ref
					},

					function(data){
						$("#"+ref).remove();
					},

					'text' // Format des données reçues.
			);
			swal("Supprimé!", "", "success");
	  }
	});
	return false;
}






/*
swal({
	title: "Êtes-vous sur de vouloir supprimer l" + msg + " ?",
	text: "Vous ne pourrez pas revenir en arrière!",
	type: "warning",
	showCancelButton: true,
	confirmButtonColor: "#DD6B55",
	confirmButtonText: "Oui, supprimer!",
	cancelButtonText: "Non, annuler!",
	closeOnConfirm: false
},
function(){
	swal("Supprimé!", "", "success");
});
*/
