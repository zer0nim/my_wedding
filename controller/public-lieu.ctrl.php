<?php
  include_once('../model/DAO.class.php');
  session_start();
  if (isset($_GET['idm'])) {
    $idM=$_GET['idm'];

    include_once('../view/public-lieu.view.php');
  }else {
    echo "Page inaccessible";
  }
?>
