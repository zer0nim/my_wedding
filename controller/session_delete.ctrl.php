<?php
  if(isset($_SESSION['account'])){
    session_destroy();
  }
  include_once('session_gestion.ctrl.php');
?>
