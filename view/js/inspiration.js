
$(document).ready(function(){
	$('.edit').hide();

	$('#note').hide();
	$('#link').hide();
	$('#pict').hide();
	$('#none').show();

	$('#postSlctLink').bind("input", modifCreaPost);

	$('#link').on('submit', function (e) {
		// On empêche le navigateur de soumettre le formulaire
		e.preventDefault();

		var form = $(this);

		$.post(
				'../controller/ajax_link_upload.php', // Le fichier cible côté serveur.
				{
						adr : form.children().next().val(),
						desc : form.children().next().next().next().val()
				},

				function(data){
					$('#postSlctLink').val('none').change();
					modifCreaPost();

					var postLink = "<li id=\'l" + data['id'] + "\'" + "<time class=\"cbp_tmtime\" datetime=\"" + data['date'] + "\"><span>" + data['date'].split(" ")[0] + "</span><span>" + data['date'].split(" ")[1] + "</span></time>" + "\n";
					postLink = postLink + "<div class=\"cbp_tmicon fa fa-paint-brush\"></div>" + "\n";
					postLink = postLink + "<div class=\"cbp_tmlabel\">" + "\n";

					postLink = postLink + "<h2 class=\"cnt_l" + data['id'] + "\"><i class=\"fa fa-link\" aria-hidden=\"true\"></i> <a href=\"" + data['adress'] + "\">" + data['adress'] + "</a></h2>" + "\n";
					postLink = postLink + "<p class=\"cnt_l" + data['id'] + "\">" + data['descr'] + "</p>" + "\n";
					postLink = postLink + "<a class=\"cnt_l" + data['id'] + " supprCntLink btn btn-danger btn-xs\" onclick=\"return supprInsp(" + data['id'] + ", " + "'l'" + ");\" role=\"button\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a>" + "\n";
					postLink = postLink + "<a class=\"cnt_l" + data['id'] + " btn btn-warning btn-xs\" onclick=\"return edit(" + data['id'] + ", " + "'l'" + ");\" role=\"button\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></a>" + "\n";

	        postLink = postLink +  "<form method=\"post\" class=\"edit link\" id=\"edit" +  data['id'] + "l\">" + "\n";
	        postLink = postLink +  "<label class=\"control-label\" for=\"textinput\">Adresse</label>" + "\n";
	        postLink = postLink +  "<input type=\"text\" name=\"adresse\" class=\"form-control\" aria-describedby=\"basic-addon1\" value=\"" + data['adress'] + "\"required>" + "\n";
	        postLink = postLink +  "<span class=\"input-group-addon\">Description</span>" + "\n";
	        postLink = postLink +  "<textarea class=\"form-control\" name=\"description\" id=\"\" name=\"\">" + data['descr'] + "</textarea>" + "\n";
	        postLink = postLink +  "<input type=\"submit\" class=\"btn btn-default btn-block\" value=\"Modifier\">" + "\n";
	        postLink = postLink +  "<input type=\"button\" class=\"btn btn-primary btn-block\" value=\"Annuler\" onclick=\"return cancelEdit(" + data['id'] + ", " + "'l'" + ");\">" + "\n";
	        postLink = postLink +  "</form>" + "\n";

	        postLink = postLink +  "</div></li>" + "\n";

					$('#newPost').after(postLink);

					$('.link').on('submit', modifLink);

					$('.edit').hide();
					//console.log(data);
				},

				'json' // Format des données reçues.
		);
	});

	$('.link').on('submit', modifLink);

	$('#note').on('submit', function (e) {
		// On empêche le navigateur de soumettre le formulaire
		e.preventDefault();

		var form = $(this);

		$.post(
				'../controller/ajax_note_upload.php', // Le fichier cible côté serveur.
				{
						titre : form.children().next().val(),
						note : form.children().next().next().next().val()
				},

				function(data){
					$('#postSlctLink').val('none').change();
					modifCreaPost();

					var postLink = "<li id=\'n" + data['id'] + "\'" + "<time class=\"cbp_tmtime\" datetime=\"" + data['date'] + "\"><span>" + data['date'].split(" ")[0] + "</span><span>" + data['date'].split(" ")[1] + "</span></time>" + "\n";
					postLink = postLink + "<div class=\"cbp_tmicon fa fa-paint-brush\"></div>" + "\n";
					postLink = postLink + "<div class=\"cbp_tmlabel\">" + "\n";

					postLink = postLink + "<h2 class=\"cnt_n" + data['id'] + "\">" + data["titre"] + "</h2>" + "\n";
					postLink = postLink + "<p class=\"cnt_n" + data['id'] + "\">" + data["text"] + "</p>" + "\n";
					postLink = postLink + "<a class=\"cnt_n" + data['id'] + " supprCntLink btn btn-danger btn-xs\" onclick=\"return supprInsp(" + data['id'] + ", " + "'n'" + ");\" role=\"button\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a>" + "\n";
					postLink = postLink + "<a class=\"cnt_n" + data['id'] + " btn btn-warning btn-xs\" onclick=\"return edit(" + data['id'] + ", " + "'n'" + ");\" role=\"button\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></a>" + "\n";

					postLink = postLink + "<form class=\"edit note\" id=\"edit" + data['id'] + "n\" method=\"post\" >" + "\n";
					postLink = postLink + "<label class=\"control-label\" for=\"textinput\">Titre</label>" + "\n";
					postLink = postLink + "<input type=\"text\" name=\"titre\" class=\"form-control\" aria-describedby=\"basic-addon1\" value=\"" + data["titre"] + "\" required>" + "\n";
					postLink = postLink + "<span class=\"input-group-addon\">Note</span>" + "\n";
					postLink = postLink + "<textarea class=\"form-control\" name=\"description\" id=\"\" name=\"\" required>" + data["text"] + "</textarea>" + "\n";
					postLink = postLink + "<input type=\"submit\" class=\"btn btn-default btn-block\" value=\"Modifier\">" + "\n";
					postLink = postLink + "<input type=\"button\" class=\"btn btn-primary btn-block\" value=\"Annuler\" onclick=\"return cancelEdit(" + data['id'] + ", " + "'n'" + ");\">" + "\n";
					postLink = postLink + "</form>" + "\n";

					postLink = postLink + "</div></li>" + "\n";


					$('#newPost').after(postLink);

					$('.note').on('submit', modifnote);

					$('.edit').hide();

					//console.log(data);
				},

				'json' // Format des données reçues.
		);
	});

	$('.note').on('submit', modifnote);

	$('#pict').on('submit', function (e) {
	  // On empêche le navigateur de soumettre le formulaire
	  e.preventDefault();

	  var $form = $(this);
	  var formdata = (window.FormData) ? new FormData($form[0]) : null;
	  var data = (formdata !== null) ? formdata : $form.serialize();
		var name = $form.find('input[name="image"]')[0].files[0]['name'];

		if ($form.find('input[name="image"]')[0].files[0]['size'] > 2000000) {
			sweetAlert("Oops...", "La taille de fichier maximal et de 2mo!", "error");
		}
		else if ($.inArray(name.substr((name.lastIndexOf('.') +1)), ["jpg", "jpeg", "gif", "png"]) == -1) {
			sweetAlert("Oops...", "Seuls les formats jpg, jpeg, gif et png sont acceptés!", "error");
		}
		else {
		  $.ajax({
		      url: '../controller/ajax_pict_upload.php',
		      type: $form.attr('method'),
		      contentType: false, // obligatoire pour de l'upload
		      processData: false, // obligatoire pour de l'upload
		      dataType: 'json', // selon le retour attendu
		      data: data,
		      success: function (data) {
						$('#postSlctLink').val('none').change();
						modifCreaPost();

						var postLink = "<li id=\'p" + data['id'] + "\'" + "<time class=\"cbp_tmtime\" datetime=\"" + data['date'] + "\"><span>" + data['date'].split(" ")[0] + "</span><span>" + data['date'].split(" ")[1] + "</span></time>" + "\n";
						postLink = postLink + "<div class=\"cbp_tmicon fa fa-paint-brush\"></div>" + "\n";
						postLink = postLink + "<div class=\"cbp_tmlabel\">" + "\n";

						postLink = postLink +  "<h2 class=\"cnt_p" + data['id'] + "\">" + data["titre"] + "</h2>" + "\n";
						postLink = postLink +  "<p class=\"cnt_p" + data['id'] + "\">" + data["descr"] + "</p>" + "\n";
						postLink = postLink +  "<img class=\"cnt_p" + data['id'] + "\" src=\"../uploads/" + data["idM"] + "/" + data["id"] + "." + data["format"] + "\" width=\"100%\" height=\"100%\">" + "\n";
						postLink = postLink + "<a class=\"cnt_p" + data['id'] + " supprCntLink btn btn-danger btn-xs\" onclick=\"return supprInsp(" + data['id'] + ", " + "'p'" + ");\" role=\"button\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a>" + "\n";
						postLink = postLink + "<a class=\"cnt_p" + data['id'] + " btn btn-warning btn-xs\" onclick=\"return edit(" + data['id'] + ", " + "'p'" + ");\" role=\"button\"><i class=\"fa fa-pencil-square-o\" aria-hidden=\"true\"></i></a>" + "\n";

		        postLink = postLink + "<form method=\"post\" enctype=\"multipart/form-data\" class=\"edit pict\" id=\"edit" + data["id"] + "p\">" + "\n";
		        postLink = postLink + "<label class=\"control-label\" for=\"textinput\" required>Titre</label>" + "\n";
		        postLink = postLink + "<input type=\"text\" name=\"titre\" class=\"form-control\" aria-describedby=\"basic-addon1\" value=\"" + data["titre"] + "\" required>" + "\n";
		        postLink = postLink + "<span class=\"input-group-addon\">Description</span>" + "\n";
		        postLink = postLink + "<textarea class=\"form-control\" name=\"description\" id=\"\" name=\"\">" + data["descr"] + "</textarea>" + "\n";
		        postLink = postLink + "<input type=\"file\" name=\"image\" accept=\"image/*\" required>" + "\n";
		        postLink = postLink + "<div class=\"image_preview col-lg-10 col-lg-offset-2\">" + "\n";
		        postLink = postLink + "<div class=\"thumbnail hidden\">" + "\n";
		        postLink = postLink + "<img src=\"http://placehold.it/5\" alt=\"\">" + "\n";
		        postLink = postLink + "<div class=\"caption\">" + "\n";
		        postLink = postLink + "<h4></h4>" + "\n";
		        postLink = postLink + "<p></p>" + "\n";
		        postLink = postLink + "<p><button type=\"button\" class=\"btn btn-default btn-danger\">Annuler</button></p>" + "\n";
		        postLink = postLink + "</div>" + "\n";
		        postLink = postLink + "</div>" + "\n";
		        postLink = postLink + "</div>" + "\n";
		        postLink = postLink + "<input type=\"submit\" class=\"btn btn-default btn-block\" value=\"Modifier\">" + "\n";
		        postLink = postLink + "<input type=\"button\" class=\"btn btn-primary btn-block\" value=\"Annuler\" onclick=\"return cancelEdit(" + data["id"] + ", " + "'p'" + ");\">" + "\n";
		        postLink = postLink + "</form>" + "\n";

		        postLink = postLink + "</div></li>" + "\n";

						$('#newPost').after(postLink);

						$('.pict').on('submit', modifpict);

						$('.edit').hide();

						// A change sélection de fichier
						$('.pict').find('input[name="image"]').on('change', function (e) {
							var files = $(this)[0].files;

							if (files.length > 0) {
									// On part du principe qu'il n'y qu'un seul fichier
									// étant donné que l'on a pas renseigné l'attribut "multiple"
									var file = files[0],
									$image_preview = $(this).next();
									// Ici on injecte les informations recoltées sur le fichier pour l'utilisateur
									$image_preview.find('.thumbnail').removeClass('hidden');
									$image_preview.find('img').attr('src', window.URL.createObjectURL(file));
									$image_preview.find('h4').html(file.name);
									$image_preview.find('.caption p:first').html(file.size +' bytes');
							}
						});

						// Bouton "Annuler"
						$('.image_preview').find('button[type="button"]').on('click', function (e) {
							e.preventDefault();

							$(this).parent().parent().parent().parent().prev().val('');
							$(this).parent().parent().parent().addClass('hidden');
						});

						//console.log(data);
		      }
		  });
		}
	});

	$('.pict').on('submit', modifpict);

	// A change sélection de fichier
	$('#pict').find('input[name="image"]').on('change', function (e) {
	  var files = $(this)[0].files;

	  if (files.length > 0) {
	      // On part du principe qu'il n'y qu'un seul fichier
	      // étant donné que l'on a pas renseigné l'attribut "multiple"
	      var file = files[0],
	          $image_preview = $('#image_preview');

	      // Ici on injecte les informations recoltées sur le fichier pour l'utilisateur
	      $image_preview.find('.thumbnail').removeClass('hidden');
	      $image_preview.find('img').attr('src', window.URL.createObjectURL(file));
	      $image_preview.find('h4').html(file.name);
	      $image_preview.find('.caption p:first').html(file.size +' bytes');
	  }
	});

	// Bouton "Annuler"
	$('#image_preview').find('button[type="button"]').on('click', function (e) {
	  e.preventDefault();

	  $('#pict').find('input[name="image"]').val('');
	  $('#image_preview').find('.thumbnail').addClass('hidden');
	});

	// A change sélection de fichier
	$('.pict').find('input[name="image"]').on('change', function (e) {
		var files = $(this)[0].files;

		if (files.length > 0) {
				// On part du principe qu'il n'y qu'un seul fichier
				// étant donné que l'on a pas renseigné l'attribut "multiple"
				var file = files[0],
				$image_preview = $(this).next();
				// Ici on injecte les informations recoltées sur le fichier pour l'utilisateur
				$image_preview.find('.thumbnail').removeClass('hidden');
				$image_preview.find('img').attr('src', window.URL.createObjectURL(file));
				$image_preview.find('h4').html(file.name);
				$image_preview.find('.caption p:first').html(file.size +' bytes');
		}
	});

	// Bouton "Annuler"
	$('.image_preview').find('button[type="button"]').on('click', function (e) {
		e.preventDefault();

		$(this).parent().parent().parent().parent().prev().val('');
		$(this).parent().parent().parent().addClass('hidden');
	});

});

function modifCreaPost() {
	if ($('#postSlctLink').val() == 'note') {
		$('#upload').prop("disabled", false);
		$('#note').show();
		$('#link').hide();
		$('#pict').hide();
		$('#none').hide();
	}
	else if ($('#postSlctLink').val() == 'link') {
		$('#upload').prop("disabled", false);
		$('#note').hide();
		$('#link').show();
		$('#pict').hide();
		$('#none').hide();
	}
	else if ($('#postSlctLink').val() == 'pict') {
		$('#upload').prop("disabled", false);
		$('#note').hide();
		$('#link').hide();
		$('#pict').show();
		$('#none').hide();
	}
	else if ($('#postSlctLink').val() == 'none') {
		$('#upload').prop("disabled", true);
		$('#note').hide();
		$('#link').hide();
		$('#pict').hide();
		$('#none').show();
	}
}

function supprInsp(idToDel, typePost) {
	swal({
	  title: "Êtes-vous sûr?",
	  text: "Vous ne pouvez pas revenir en arrière!",
	  type: "warning",
	  showCancelButton: true,
	  confirmButtonColor: "#DD6B55",
	  confirmButtonText: "Oui, supprimer!",
	  closeOnConfirm: false
	},
	function(){
		$.post(
				'../controller/ajax_post_del.php', // Le fichier cible côté serveur.
				{
						id : idToDel,
						typeP : typePost
				},

				function(data){
					$('#' + typePost + idToDel).remove();
					swal("Supprimé!", "La publication a bien été supprimée.", "success");
					//console.log(data);
				},

				'text' // Format des données reçues.
		);
	});
}

function edit(idToEdit, typePost) {
	$('#edit' + idToEdit + typePost).show();
	$('.cnt_' + typePost + idToEdit).hide();

	//cnt_l6
}

function cancelEdit(idToEdit, typePost) {
	$('#edit' + idToEdit + typePost).hide();
	$('.cnt_' + typePost + idToEdit).show();
}

function modifLink(e) {
	// On empêche le navigateur de soumettre le formulaire
	e.preventDefault();

	var form = $(this);

	form.parent().children()[0].innerHTML = form.children().next().val();
	form.parent().children()[1].innerHTML = form.children().next().next().next().val();
	$.post(
			'../controller/ajax_link_modify.php', // Le fichier cible côté serveur.
			{
					adr : form.children().next().val(),
					desc : form.children().next().next().next().val(),
					idln : form.attr('id').slice(4, -1)
			},

			function(data){
				cancelEdit(form.attr('id').slice(4, -1), 'l')
				//console.log(data);
			},

			'json' // Format des données reçues.
	);
}

function modifnote(e) {
	// On empêche le navigateur de soumettre le formulaire
	e.preventDefault();

	var form = $(this);

	form.parent().children()[0].innerHTML = form.children().next().val();
	form.parent().children()[1].innerHTML = form.children().next().next().next().val();

	$.post(
			'../controller/ajax_note_modify.php', // Le fichier cible côté serveur.
			{
					titre : form.children().next().val(),
					note : form.children().next().next().next().val(),
					idln : form.attr('id').slice(4, -1)
			},

			function(data){
				cancelEdit(form.attr('id').slice(4, -1), 'n')
				//console.log(data);
			},

			'json' // Format des données reçues.
	);
}

function modifpict(e) {
	// On empêche le navigateur de soumettre le formulaire
	e.preventDefault();

	var $form = $(this);
	var formdata = (window.FormData) ? new FormData($form[0]) : null;
	var data = (formdata !== null) ? formdata : $form.serialize();
	var name = $form.find('input[name="image"]')[0].files[0]['name'];

	data.append( 'idPict', $form.attr('id').slice(4, -1) );

	if ($form.find('input[name="image"]')[0].files[0]['size'] > 2000000) {
		sweetAlert("Oops...", "La taille de fichier maximal et de 2mo!", "error");
	}
	else if ($.inArray(name.substr((name.lastIndexOf('.') +1)), ["jpg", "jpeg", "gif", "png"]) == -1) {
		sweetAlert("Oops...", "Seuls les formats jpg, jpeg, gif et png sont acceptés!", "error");
	}
	else {
		$.ajax({
				url: '../controller/ajax_pict_modify.php',
				type: $form.attr('method'),
				contentType: false, // obligatoire pour de l'upload
				processData: false, // obligatoire pour de l'upload
				dataType: 'json', // selon le retour attendu
				data: data,
				success: function (data) {
					$form.parent().children()[0].innerHTML = $form.children().next().val();
					$form.parent().children()[1].innerHTML = $form.children().next().next().next().val();
					$($form.parent().children()[2]).attr('src',data + '?dt=' + (+new Date()) ); //'?dt=' + (+new Date()) pour que l'image se recharge meme avec le meme nom
					cancelEdit($form.attr('id').slice(4, -1), 'p')
					//console.log(data);
				}
		});
	}
}
