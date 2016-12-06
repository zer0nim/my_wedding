<?php
  require_once '../model/DAO.class.php';

  $cnt = new contacts();
  $cnt->faux_construct($_POST['idcont'], 1, $_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['mail'], $_POST['age'], $_POST['tel']);
  $dao->updateContactInfo($cnt);
  echo "success";
?>
