<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  $n = new note();
  $n->faux_construct(NULL, 1, NULL, $_POST['titre'], $_POST['note']);
  $dao->setNote($n);
  echo ('success');
?>
