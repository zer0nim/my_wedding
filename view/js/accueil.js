$(document).ready(function(){
	$.post(
			'../controller/ajax_get_wed_hour.php', // Le fichier cible côté serveur.
			{
					idcont : $('#select-cnt').val()
			},

			function(data){
				startCountdown(data);
			},

			'text' // Format des données reçues.
	);
});

function startCountdown(dateM) {
	$.getScript("../model/cntDown/jquery.countdown.min.js?v=1.0.0.0", function(){
		$('#wedding').countdown({
			date: dateM,
			offset: +2,
			day: 'Jour',
			days: 'Jours',
			hour: 'Heure',
			hours: 'Heures',
			minute: 'Minute',
			minutes: 'Minutes',
			second: 'Seconde',
			seconds: 'Secondes'
		}, function () {
			alert('Que la cérémonie commence !');
		});
	});
}
