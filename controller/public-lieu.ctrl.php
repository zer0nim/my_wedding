<?php
  include_once('../model/DAO.class.php');
  session_start();
  if (isset($_GET['id'])) {
    $idM=$dao->getIdMariage_hash($_GET['id']);
    $info=$dao->getMariageidm($idM);
    $lieu=$info['maria_lieu'];
    include_once('../view/public-lieu.view.php');
  }else {
    echo "Page inaccessible";
  }
?>
