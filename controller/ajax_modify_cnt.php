<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  $cnt = new contacts();
  $cnt->faux_construct($_POST['idcont'], $idM, $_POST['nom'], $_POST['prenom'], $_POST['adresse'], $_POST['mail'], $_POST['age'], $_POST['tel']);
  $dao->updateContactInfo($cnt);
  echo "success";
?>
