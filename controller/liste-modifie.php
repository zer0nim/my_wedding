<?php
  include_once('session_create.ctrl.php');
  require_once('../model/DAO.class.php');
  $idM = $_SESSION[idM];
  $liste = $_POST['list'];
  var_dump($_POST['list']);
  echo $_POST['list'][0]['nom'];
  //var_dump($liste);
  $dao->delListeSouhaitMariage($idM);
  $dao->setListeSouhait($idM, $_POST['list']);
?>
