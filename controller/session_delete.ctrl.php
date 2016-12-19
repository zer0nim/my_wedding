<?php
  if(isset($_SESSION['account'])){
    session_destroy();
  }

  /*session_start();
  $_SESSION['account'] = NULL;*/
?>
