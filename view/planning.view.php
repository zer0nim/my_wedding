<?php include('../view/header.php'); ?>

<link rel="stylesheet" href="../view/css/planning.css" type="text/css" />
<link href='../fullcalendar/fullcalendar.css' rel='stylesheet' />

<?php require_once '../view/baseMenuFnct.php'; ?>

<div class="div-principal">
	<div id='calendar'></div>
	<button id="boutonaddevenement" class="btn-md btn-primary" onClick="afficheModifieEvenement(null)">Ajouter un évènement</button>
</div>

<div id="fond-popup"></div>
<div id="popup"></div>

<?php include('../view/scripts.php') ?>

<script src='../fullcalendar/lib/moment.min.js'></script>
<script src='../fullcalendar/lib/jquery.min.js'></script>
<script src='../fullcalendar/fullcalendar.min.js'></script>
<script src='../fullcalendar/fullcalendar.js'></script>
<!-- <script src='../fullcalendar/locale-all.js'></script> -->
<script src='../fullcalendar/locale/fr.js'></script>

<script src='../view/js/planning.js'></script>

<!-- C'est le script qui gère de mettre la view -->
<script>	
	$(document).ready(function() {
				
		$('#calendar').fullCalendar({
		    				    
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,listWeek,listDay'
			},

			views: {
				listDay: { buttonText: 'jour' },
				listWeek: { buttonText: 'semaine' }
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
						start: ,
						end:
					*/

					if (isset($evenements)){
						foreach ($evenements as $evenement) {
				?>
							{
							id: <?= $evenement->getId() ?>,
							title: '<?= $evenement->getDescription() ?>',
							start: '<?= $evenement->getStart()->format('Y-m-d H:i:s') ?>',
							end: '<?= $evenement->getEnd()->format('Y-m-d H:i:s') ?>'
							},
				<?php
						}
					}
				?>
				
			],
			
			// fonction quand on click sur un évènement
			// utilisé pour quand l'utilisateur veut modifier un événement
			eventClick: function(event, element) {
				afficheModifieEvenement(event);
			},

			// fonction quand un évenemnt est changé de place
			eventDrop: function(event, delta, revertFunc) {
				modifEvenement(event, null);
			},
			
			// fonction quand un événement à sa durée qui est modifié
			eventResize: function(event, delta, revertFunc) {
				modifEvenement(event, null);
			}
		});
	});
</script>

<?php include('../view/footer.php') ?>