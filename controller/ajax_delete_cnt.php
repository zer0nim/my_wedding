<?php
  require_once '../model/DAO.class.php';
  $allContacts = $dao->getContacts(1);

  if( isset($_POST['idcont'])){
    foreach ($_POST['idcont'] as $key => $value) {
      echo $allContacts[$value]->getCont_id();
      $dao->delContacts(1, $allContacts[$value]->getCont_id());
    }
    echo "Success";
  }
  else {
    echo "Failed";
  }
?>
