<?php
  include_once('session_gestion.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  if( isset($_POST['idtable'])){
    $dao->delTable($idM, $_POST['idtable']);
    echo "Success";
  }
  else {
    echo "Failed";
  }
?>
