<?php
  session_start();
  require_once('../model/DAO.class.php');
  //remplire les valeur avec celle de la bdd
  $_SESSION['account'] = $info[0];
  $_SESSION['idM'] = $info[1];
  $req = $dao->getMariage($_SESSION['account']);
  $_SESSION['date'] = $req[0];
  //var_dump($info,$req,$_SESSION['date']);
?>
