<?php
  require_once('../model/DAO.class.php');
  $idM = 1;
  $liste = $_POST['list'];

  //var_dump($liste);
  $dao->delSouhaitMariage($idM);
  var_dump($dao->getListeSouhait($idM));
  $dao->setListeSouhait($idM, $liste);
?>
