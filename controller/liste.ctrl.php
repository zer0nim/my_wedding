<?php
  include_once('php_gestion.ctrl.php');
  require_once('../model/DAO.class.php');
  $idM = $_SESSION['idM'];

















  $data = $dao->getListeSouhait($idM);
  include_once('../view/liste.view.php');
?>
