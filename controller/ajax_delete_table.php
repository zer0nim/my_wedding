<?php
  require_once '../model/DAO.class.php';

  if( isset($_POST['idtable'])){
    $dao->delTable(1, $_POST['idtable']);
    echo "Success";
  }
  else {
    echo "Failed";
  }
?>
