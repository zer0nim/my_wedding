
$(document).ready(function(){
	$('#note').hide();
	$('#link').hide();
	$('#pict').hide();
	$('#none').show();

	$('#postSlctLink').bind("input", function modifCreaPost() {
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
	});

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
					//console.log(data);
				},

				'text' // Format des données reçues.
		);
	});

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
					//console.log(data);
				},

				'text' // Format des données reçues.
		);
	});

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
		else if ($.inArray(name.substr((name.lastIndexOf('.') +1)), ["jpg", "jpeg", "gif", "png"]) != 0) {
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
						console.log("in function success");
						console.log(data);

						console.log(data['file']);
						console.log(data['text']);
		      }
		  });
		}
	});

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

});
