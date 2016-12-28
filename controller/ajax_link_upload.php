<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  $ln = new lien();
  $ln->faux_construct(NULL, $idM, NULL, $_POST['adr'], $_POST['desc']);

  $idDate = $dao->setLien($ln);
  $ln->setLink_id($idDate['id']);
  $ln->setLink_date($idDate['date']);

  echo json_encode(array("date" => $ln->getLink_date(),
                          "adress" => $ln->getLink_adress(),
                          "descr" => $ln->getLink_descr(),
                          "id" => $ln->getLink_id(),
                          "idM" => $ln->getLink_idM()));
?>
