<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  if( isset($_POST['idcont'])){
    foreach ($_POST['idcont'] as $key => $value) {
      $dao->delContacts($idM, $value);
    }
    echo "Success";
  }
  else {
    echo "Failed";
  }
?>
