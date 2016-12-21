
$(document).ready(function(){
	$('#note').hide();
	$('#link').hide();
	$('#pict').hide();
	$('#none').show();

	$('#postSlctLink').bind("input", function modifCreaPost() {
		console.log("Selected: " + $('#postSlctLink').val());

		if ($('#postSlctLink').val() == 'note') {
			$('#note').show();
			$('#link').hide();
			$('#pict').hide();
			$('#none').hide();
		}
		else if ($('#postSlctLink').val() == 'link') {
			$('#note').hide();
			$('#link').show();
			$('#pict').hide();
			$('#none').hide();
		}
		else if ($('#postSlctLink').val() == 'pict') {
			$('#note').hide();
			$('#link').hide();
			$('#pict').show();
			$('#none').hide();
		}
		else if ($('#postSlctLink').val() == 'none') {
			$('#note').hide();
			$('#link').hide();
			$('#pict').hide();
			$('#none').show();
		}
	});
});
