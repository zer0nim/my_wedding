<?php
  require_once '../model/DAO.class.php';

  if( isset($_POST['idcont'])){
    foreach ($_POST['idcont'] as $key => $value) {
      $dao->delContacts(1, $value);
    }
    echo "Success";
  }
  else {
    echo "Failed";
  }
?>
