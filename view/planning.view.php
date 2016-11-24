<?php include('../view/header.php') ?>
<link rel="stylesheet" href="../view/css/planning.css" type="text/css" />
<link href='../fullcalendar/fullcalendar.css' rel='stylesheet' />
<?php require_once '../view/baseMenuFnct.php'; ?>

<div id='calendar'></div>

<?php include('../view/scripts.php') ?>

<script src='../fullcalendar/lib/moment.min.js'></script>
<script src='../fullcalendar/lib/jquery.min.js'></script>
<script src='../fullcalendar/fullcalendar.min.js'></script>
<script>
	$(document).ready(function() {
		$('#calendar').fullCalendar({
		});
	});
</script>


<?php include('../view/footer.php') ?>
