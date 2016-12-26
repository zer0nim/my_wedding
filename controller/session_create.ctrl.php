<?php
  session_start();
  require_once('../model/DAO.class.php');
  $_SESSION['idM'] = 1;
  $_SESSION['account'] = 1;
  $req = $dao->getMariage($_SESSION['idM']);
  $_SESSION['date'] = $req[0];
  require_once('session_gestion.ctrl.php');
?>
