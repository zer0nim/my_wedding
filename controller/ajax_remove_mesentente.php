<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  $dao->supprMesententeCnt($idM, $_POST['idCnt1'], $_POST['idCnt2']);
  echo "success";
?>
