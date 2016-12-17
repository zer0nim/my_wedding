$(document).ready(function(){
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
					console.log(data);
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
					console.log(data);
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
					console.log(data);
				},

				'text' // Format des données reçues.
		);
	});
});

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
				var newRow = "<tr id=\"" + data + "\"><td><input type=\"text\" class=\"form-control\" placeholder=\"nom\" aria-describedby=\"basic-addon1\" value=\"SansNom\"><br><a class=\"btn btn-danger\" role=\"button\" onclick=\"return supprT(" + data + ");\">Supprimer</a></td><td><select class=\"form-control\">" + optionNb + "</select></td><td><table class=\"table table-bordered table-striped table-hover table-responsive\"><tbody><tr><td><p><div class=\"input-group\"><select class=\"form-control\"><option>-</option></select><span class=\"input-group-btn\"><button class=\"btn btn-default\" type=\"button\">Ajouter</button></span></div></p></td></tr></tbody></table></td></tr>";
				console.log(optionNb);
				//Affichage de la nouvelle Table dans le tableau
				$("#tablesLink").append(newRow);
			},

			'text' // Format des données reçues.
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
				$('.listCntToAddlink').append("<option value='" + $("#contId" + cntId).val() + "'>" + $("#contId" + cntId).text() + "</option>");
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
