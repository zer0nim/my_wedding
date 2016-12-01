<?php
  function printAllContacts($allContacts) {
    foreach ($allContacts as $key => $contact) {
      echo '<option value="' . $contact->getCont_id() . '">' . $contact->getCont_nom() . " " . $contact->getCont_prenom() . "</option>" . "\n";
    }
  }

  require_once '../model/DAO.class.php';
  $allContacts = $dao->getContacts(1);
  include_once('../view/contacts.view.php');
?>
