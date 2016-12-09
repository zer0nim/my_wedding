<?php 
	include('../view/header.php');
	require_once '../view/baseMenuFnct.php'; 
?>

<link rel="stylesheet" href="../view/css/planning.css" type="text/css" />
<link href='../fullcalendar/fullcalendar.css' rel='stylesheet' />

<div id='calendar'></div>

<?php include('../view/scripts.php') ?>

<script src='../fullcalendar/lib/moment.min.js'></script>
<script src='../fullcalendar/lib/jquery.min.js'></script>
<script src='../fullcalendar/fullcalendar.min.js'></script>

<!-- C'est le script qui gère de mettre la view -->
<script>	
	$(document).ready(function() {
		var date = new Date();
		
		$('#calendar').fullCalendar({

			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,listWeek,listDay'
			},

			views: {
				listDay: { buttonText: 'list day' },
				listWeek: { buttonText: 'list week' }
			},
						
			defaultView: 'month',
			navLinks: true, // can click day/week names to navigate views
			editable: true,
			eventLimit: true, // allow "more" link when too many events

			events: [
				<?php
					/* format
						id: nombre,
						title: '',
						start: '2016-12-09',
						end: '2016-12-09', facultatif
						url: 'http://google.com/' facultatif
					*/

					if (isset($evenements)){
						foreach ($evenements as $evenement) {
				?>
							{
							id: <?= $evenement->getId() ?>,
							title: '<?= $evenement->getTitle() ?>',
							start: '<?= $evenement->getStart()->format('Y-m-d') ?>',
							end: '<?= $evenement->getEnd()->format('Y-m-d') ?>',
							url: '<?= $evenement->getUrl() ?>'
							},
				<?php
						}
					}
				?>
				
			]
		});
	});
</script>

<?php include('../view/footer.php') ?>