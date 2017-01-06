<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  echo json_encode(array("nbCnts" => $dao->getNbContacts($idM),
                          "nbPlaces" => $dao->getNbPlacesTables($idM),));
?>
