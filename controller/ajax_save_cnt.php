<?php
  require_once '../model/DAO.class.php';

  $cnt = new contacts();

  $cnt->faux_construct(NULL, 1, (($_POST['nom'] == "")? NULL : $_POST['nom']), (($_POST['prenom'] == "")? NULL : $_POST['prenom']), (($_POST['adresse'] == "")? NULL : $_POST['adresse']), (($_POST['mail'] == "")? NULL : $_POST['mail']), (($_POST['age'] == "")? NULL : $_POST['age']), (($_POST['tel'] == "")? NULL : $_POST['tel']));
  echo json_encode($dao->setContact($cnt));
?>
