<?php
  include_once ('session_create.ctrl.php');
  require_once('../model/DAO.class.php');
  $idM = $_SESSION['idM'];

















  $data = $dao->getListeSouhait($idM);
  include_once('../view/liste.view.php');
?>
