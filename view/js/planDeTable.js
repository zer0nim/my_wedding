$(document).ready(function(){

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
				var newRow = "<tr id=\"link" + data + "\"><td><input type=\"text\" class=\"form-control\" placeholder=\"nom\" aria-describedby=\"basic-addon1\" value=\"SansNom\"><br><a class=\"btn btn-danger\" role=\"button\" onclick=\"return supprT(" + data + ");\">Supprimer</a></td><td><select class=\"form-control\"><option value=\"NULL\">-</option>" + optionNb + "</select></td><td><table class=\"table table-bordered table-striped table-hover table-responsive\"><tbody><tr><td><p><div class=\"input-group\"><select class=\"form-control\"><option>-</option></select><span class=\"input-group-btn\"><button class=\"btn btn-default\" type=\"button\">Ajouter</button></span></div></p></td></tr></tbody></table></td></tr>";
				console.log(optionNb);
				//Affichage de la nouvelle Table dans le tableau
				$("#tablesLink").append(newRow);
			},

			'text' // Format des données reçues.
	);
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
						$("#link"+ref).remove();
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