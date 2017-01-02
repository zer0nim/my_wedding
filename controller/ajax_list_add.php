<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];
  $dao->addListeSouhait($idM, $_POST['nom']);
  echo "success";
?>
