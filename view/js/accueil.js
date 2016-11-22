$('#wedding').countdown({
	date: '02/27/2017 14:00:00',
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
