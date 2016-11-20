<?php
  require_once('../model/DAO.class.php');
  $idM = 1;

















  $data = $dao->getListeSouhait($idM);
  var_dump($data);
  include_once('../view/liste.view.php');
?>
