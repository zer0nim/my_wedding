<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  $allConts = $dao->getContacts(1);
  $toAppend = '';

  foreach ($allConts as $key => $value) {
    if ($value->getCont_idT() == NULL) {
      $toAppend = $toAppend . "<option value=\"" . $value->getCont_id() . "\">" . $value->getCont_nom() . " " . $value->getCont_prenom() . "</option>";
    }
  }

  $tb = new tables();
  $tb->faux_construct(NULL, $idM, "SansNom", 1);


  echo json_encode(array("idT" => $dao->setTable($tb),
                          "toAppend" => $toAppend));
?>
