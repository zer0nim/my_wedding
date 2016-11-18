<!DOCTYPE html>
<html>

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>My Wedding</title>
  <meta name="description" content="Le site de planification de mariage">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://use.fontawesome.com/f332948f4d.js"></script>

  <link type="text/css" href="../cntDown/jquery.countdown.css?v=1.0.0.0" rel="stylesheet">
  <script src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
  <script type="text/javascript" src="../cntDown/jquery.countdown.min.js?v=1.0.0.0"></script>

</head>
<body class="container-fluid">

<style>
.navbar-default .navbar-nav > .active > a {
  background-color: #dae8ef;
}
</style>

<header>
  <nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="accueil.ctrl.php">My wedding Planner</a>
      </div>
      <div class="collapse navbar-collapse" id="myNavbar">
        <ul class="nav navbar-nav">
          <li><a href="accueil.ctrl.php">Accueil</a></li>
          <li><a href="creation.ctrl.php">Paramètres de l'événement</a></li>
          <li><a href="#">Page Publique</a></li>
          <li><a href="#">Mon compte</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
          <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign out</a></li>
        </ul>
      </div>
    </div>
  </nav>
</header>

<nav class="test-center"><!-- @whitespace
--><a href="planning.ctrl.php" class="planning btn btn-link btn-sm"><i class="fa fa-calendar fa-2x" aria-hidden="true"></i></a><!-- @whitespace
--><a href="contacts.ctrl.php" class="contacts btn btn-link btn-sm"><i class="fa fa-address-book fa-2x" aria-hidden="true"></i></a><!-- @whitespace
--><a href="invitations.ctrl.php" class="invitations btn btn-link btn-sm"><i class="fa fa-envelope-o fa-2x" aria-hidden="true"></i></a><!-- @whitespace
--><a href="plandetable.ctrl.php" class="plandetable btn btn-link btn-sm"><i class="fa fa-th fa-2x" aria-hidden="true"></i></a><!-- @whitespace
--><a href="repas.ctrl.php" class="repas btn btn-link btn-sm"><i class="fa fa-cutlery fa-2x" aria-hidden="true"></i></a><!-- @whitespace
--><a href="fournisseurs.ctrl.php" class="fournisseurs btn btn-link btn-sm"><i class="fa fa-truck fa-2x" aria-hidden="true"></i></a><!-- @whitespace
--><a href="inspiration.ctrl.php" class="inspiration btn btn-link btn-sm"><i class="fa fa-paint-brush fa-2x" aria-hidden="true"></i></a><!-- @whitespace
--><a href="liste.ctrl.php" class="liste btn btn-link btn-sm"><i class="fa fa-gift fa-2x" aria-hidden="true"></i></a><!-- @whitespace
--><a href="budget.ctrl.php" class="budget btn btn-link btn-sm"><i class="fa fa-eur fa-2x" aria-hidden="true"></i></a>
</nav>
