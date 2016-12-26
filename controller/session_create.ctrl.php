<?php
  session_start();
  if ( !isset($_SESSION['account']) || $_SESSION['account'] == NULL) {
    header('location:inscription.ctrl.php');
  }
  //require_once('session_gestion.ctrl.php');
?>
