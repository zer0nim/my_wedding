<?php
  require_once('../model/DAO.class.php');
  $idM = 1;

















  $data = $dao->getListeSouhait($idM);
  include_once('../view/liste.view.php');
?>
