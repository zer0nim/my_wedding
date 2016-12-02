<?php
  require_once('DAO.class.php');

  function placement($idMariage) {
    try {
      $tabPasEnsemble = $this->db->prepare('Select pref_idContact, pref_idContact2 From Preferences Where pref_idM = :idMariage and pref_aime = \'non\'');
      $tabPasEnsemble->execute(array(':idMariage' => $idMariage));
    }
    catch (PDOException $e) {
      exit("Erreur de req sql placement -> Pas ensemble : ".$e->getMessage());
    }

    try {
      $tabEnsemble = $this->db->prepare('Select pref_idContact, pref_idContact2 From Preferences Where pref_idM = :idMariage and pref_aime = \'oui\'');
      $tabEnsemble->execute(array(':idMariage' => $idMariage));
    }
    catch (PDOException $e) {
      exit("Erreur de req sql placement -> Ensemble : ".$e->getMessage());
    }

    $contacts = $this->db->getContacts($idMariage);
    foreach ($contacts as $contact) {
      echo "<p>".$contact."</p>";
      printf($contact);
    }
  }

  placement(1);
?>
