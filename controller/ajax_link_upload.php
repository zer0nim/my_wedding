<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  $ln = new lien();
  $ln->faux_construct(NULL, 1, NULL, $_POST['adr'], $_POST['desc']);
  $dao->setLien($ln);
  echo ('success');
?>
