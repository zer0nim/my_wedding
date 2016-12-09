<?php
  include_once('session_gestion.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  $tb = new tables();
  $tb->faux_construct(NULL, $idM, "SansNom", 1);
  echo $dao->setTable($tb);
?>
