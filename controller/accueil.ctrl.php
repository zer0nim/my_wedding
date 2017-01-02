<?php
  include_once('session_create.ctrl.php');
  //var_dump($_SESSION['account'],$_SESSION['idM'],$_SESSION['date']);
  //Recup id du mariage
  $idM = $_SESSION['idM'];
  include_once('../view/accueil.view.php');
?>
