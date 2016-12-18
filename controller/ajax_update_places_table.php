<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  if( isset($_POST['idtable']) && isset($_POST['nbPlaces'])) {
    $tb = new tables();
    $tb->faux_construct($_POST['idtable'], $idM, "SansNom", $_POST['nbPlaces']);
    echo $dao->updateTablePlaces($tb);
  }
  else {
    echo "Failed";
  }
?>
