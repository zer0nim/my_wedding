<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];


  if ($_POST['typeP'] == 'p') {
    $valid_ext = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
    foreach ($valid_ext as $key => $ext) {
      if (file_exists ('../uploads/' . $idM . '/' . $_POST['id'] . '.' . $ext)) {
        unlink('../uploads/' . $idM . '/' . $_POST['id'] . '.' . $ext);
      }
    }
    $dao->delPhoto($idM, $_POST['id']);
  }
  elseif ($_POST['typeP'] == 'l') {
    $dao->delLien($idM, $_POST['id']);
  }
  elseif ($_POST['typeP'] == 'n') {
    $dao->delNote($idM, $_POST['id']);
  }

  echo ('success');
?>
