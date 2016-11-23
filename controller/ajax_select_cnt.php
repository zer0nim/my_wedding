<?php
  require_once '../model/DAO.class.php';
  $allContacts = $dao->getContacts(1);

  if( isset($_POST['idcont'])){

    echo json_encode(array("cont_nom" => $allContacts[$_POST['idcont'][0]]->getCont_nom(),
                            "cont_prenom" => $allContacts[$_POST['idcont'][0]]->getCont_prenom(),
                            "cont_adresse" => $allContacts[$_POST['idcont'][0]]->getCont_adresse(),
                            "cont_mail" => $allContacts[$_POST['idcont'][0]]->getCont_mail(),
                            "cont_age" => $allContacts[$_POST['idcont'][0]]->getCont_age(),
                            "cont_tel" => $allContacts[$_POST['idcont'][0]]->getCont_tel()));
  }
  else {
    echo "Failed";
  }
?>
