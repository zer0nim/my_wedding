<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Wedding Planner</title>
  <meta name="description" content="Le site de planification de mariage">

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://use.fontawesome.com/f332948f4d.js"></script>
  <link rel="stylesheet" href="index.css" type="text/css" />

  <link type="text/css" href="cntDown/jquery.countdown.css?v=1.0.0.0" rel="stylesheet">
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="cntDown/jquery.countdown.min.js?v=1.0.0.0"></script>

</head>
<body class="container-fluid">

  <header>
    <div class="navbar navbar-default">
      <div class="navbar-header">
        <a class="navbar-brand" href="#">My Wedding Planner</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Accueil</a></li>
        <li><a href="#">Paramètres de l'événement</a></li>
        <li><a href="#">Page Publique</a></li>
        <li><a href="#">Mon compte</a></li>
      </ul>
    </div>
  </header>

  	<ul id="wedding">
  	  <li><span class="days">00</span><p class="days_text">Jours</p></li>
  		<li class="seperator"> - </li>
  		<li><span class="hours">00</span><p class="hours_text">Heures</p></li>
  		<li class="seperator"> - </li>
  		<li><span class="minutes">00</span><p class="minutes_text">Minutes</p></li>
  		<li class="seperator"> - </li>
  		<li><span class="seconds">00</span><p class="seconds_text">Secondes</p></li>
  	</ul>
  	<script type="text/javascript">
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
  	</script>







  <nav class="text-center">
    <div class="col-btn col-xs-12 col-sm-6 col-lg-3">
      <a href="#" class="col-xs-12 btn btn-block btn-lg btn-primary"><i class="fa fa-tasks fa-2x" aria-hidden="true"></i><br>Liste de tâches</a>
    </div>
    <div class="col-btn col-xs-12 col-sm-6 col-lg-3">
      <a href="#" class="btn btn-block btn-lg btn-primary"><i class="fa fa-calendar fa-2x" aria-hidden="true"></i><br>Planning</a>
    </div>
    <div class="col-btn col-xs-12 col-sm-6 col-lg-3">
      <a href="#" class="btn btn-block btn-lg btn-primary"><i class="fa fa-address-book fa-2x" aria-hidden="true"></i><br>Invités</a>
    </div>
    <div class="col-btn col-xs-12 col-sm-6 col-lg-3">
      <a href="#" class="btn btn-block btn-lg btn-primary"><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i><br>Cartes d'invitation</a>
    </div>
    <div class="col-btn col-xs-12 col-sm-6 col-lg-3">
      <a href="#" class="btn btn-block btn-lg btn-primary"><i class="fa fa-th fa-2x" aria-hidden="true"></i><br>Plan de table</a>
    </div>
    <div class="col-btn col-xs-12 col-sm-6 col-lg-3">
      <a href="#" class="btn btn-block btn-lg btn-primary"><i class="fa fa-cutlery fa-2x" aria-hidden="true"></i><br>Repas</a>
    </div>
    <div class="col-btn col-xs-12 col-sm-6 col-lg-3">
      <a href="#" class="btn btn-block btn-lg btn-primary"><i class="fa fa-truck fa-2x" aria-hidden="true"></i><br>Fournisseurs</a>
    </div>
    <div class="col-btn col-xs-12 col-sm-6 col-lg-3">
      <a href="#" class="btn btn-block btn-lg btn-primary"><i class="fa fa-paint-brush fa-2x" aria-hidden="true"></i><br>Inspiration</a>
    </div>
  </nav>

  <footer>

  </footer>
</body>

</html>
