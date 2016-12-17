<?php
  include_once('session_gestion.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  if( isset($_POST['idtable']) && isset($_POST['idCnt'])) {
    $tb = new tables();
    $tb->faux_construct($_POST['idtable'], $idM, 'noName', 1);

    $cnt = new contacts();
    $cnt->faux_construct($_POST['idCnt'], $idM, NULL, NULL, NULL, NULL, NULL, NULL);

    echo $dao->setTableToContact($tb, $cnt);
  }
  else {
    echo "Failed";
  }
?>
