<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  $n = new note();
  $n->faux_construct(NULL, 1, NULL, $_POST['titre'], $_POST['note']);

  $idDate = $dao->setNote($n);
  $n->setNote_id($idDate['id']);
  $n->setNote_date($idDate['date']);

  echo json_encode(array("date" => $n->getNote_date(),
                          "titre" => $n->getNote_title(),
                          "text" => $n->getNote_text(),
                          "id" => $n->getNote_id(),
                          "idM" => $n->getNote_idM()));
?>
