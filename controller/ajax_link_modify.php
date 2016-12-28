<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  $ln = new lien();
  $ln->faux_construct($_POST['idln'], $idM, NULL, $_POST['adr'], $_POST['desc']);
  $dao->modifyLien($ln);
  echo json_encode("success");
?>
