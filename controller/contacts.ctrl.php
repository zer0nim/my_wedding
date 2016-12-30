<?php
  require_once('session_create.ctrl.php');
  function printAllContacts($allContacts) {
    foreach ($allContacts as $key => $contact) {
      echo '<option value="' . $contact->getCont_id() . '">' . $contact->getCont_nom() . " " . $contact->getCont_prenom() . "</option>" . "\n";
    }
  }

  $idM = $_SESSION['idM'];
  require_once '../model/DAO.class.php';
  $allContacts = $dao->getContacts($idM);
  include_once('../view/contacts.view.php');
?>
