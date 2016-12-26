<?php
  if ( !isset($_SESSION['account']) || $_SESSION['account'] == NULL) {
    header('location:inscription.ctrl.php');
  }
?>
