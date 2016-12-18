<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  if( isset($_POST['idtable']) && isset($_POST['nom'])) {
    $tb = new tables();
    $tb->faux_construct($_POST['idtable'], $idM, $_POST['nom'], 1);
    echo $dao->updateTableNom($tb);
  }
  else {
    echo "Failed";
  }
?>
