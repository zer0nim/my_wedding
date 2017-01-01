<?php
  include_once('../model/DAO.class.php');
  session_start();
  if (isset($_GET['id'])) {
    $idM=$dao->getIdMariage_hash($_GET['id']);

    include_once('../view/public-lieu.view.php');
  }else {
    echo "Page inaccessible";
  }
?>
