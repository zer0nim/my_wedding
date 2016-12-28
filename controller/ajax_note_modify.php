<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  $n = new note();
  $n->faux_construct($_POST['idln'], $idM, NULL, $_POST['titre'], $_POST['note']);
  $dao->modifyNote($n);
  echo json_encode("success");
?>
