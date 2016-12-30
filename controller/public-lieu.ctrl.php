<?php
  include_once('../model/DAO.class.php');
  session_start();
  if (isset($_GET['idm'])) {
    $idM=$_GET['idm'];

    include_once('../view/page-publique-public.view.php');
  }else {
    echo "Page inaccessible";
  }
?>
