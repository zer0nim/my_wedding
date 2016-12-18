<?php
  include_once('session_create.ctrl.php');
  require_once('../model/DAO.class.php');

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  $cnt = new contacts();

  $cnt->faux_construct(NULL, $idM, (($_POST['nom'] == "")? NULL : $_POST['nom']), (($_POST['prenom'] == "")? NULL : $_POST['prenom']), (($_POST['adresse'] == "")? NULL : $_POST['adresse']), (($_POST['mail'] == "")? NULL : $_POST['mail']), (($_POST['age'] == "")? NULL : $_POST['age']), (($_POST['tel'] == "")? NULL : $_POST['tel']));
  echo json_encode($dao->setContact($cnt));
?>
