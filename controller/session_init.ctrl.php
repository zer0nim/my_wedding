<?php
  session_start();
  require_once('../model/DAO.class.php');
  //remplire les valeur avec celle de la bdd
  $_SESSION['account'] = $info[0];
  $_SESSION['idM'] = $info[1];
  $req = $dao->getMariage($_SESSION['idM']);
  $_SESSION['date'] = $req[0];
  if ( !isset($_SESSION['account']) || $_SESSION['account'] == NULL) {
    header('location:inscription.ctrl.php');
  }
?>
