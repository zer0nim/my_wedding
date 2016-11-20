<?php
  require_once('../model/DAO.class.php');
  $idM = 1;

  // Pour suppression d'un fournisseur
  if (isset($_GET['idS']) && (isset($_GET['idM']))) {
    $req = $dao->estCouplePresentFournisseur($_GET['idS'], $_GET['idM']);
    if ($req[0] == 1) {
      $dao->delFournisseur($_GET['idS'], $_GET['idM']);
    }
  }
  // Fin suppression d'un fournisseurs

  // Pour ajout d'un fournisseur
  if (isset($_GET['add'])) {
    if ($_GET['add'] == 1) {
      $titre = $_POST['titre'];
      $description = $_POST['description'];

      if (isset($_POST['adresse'])) {$adresse = $_POST['adresse'];} else {$adresse = NULL;}

      if (isset($_POST['tel'])) {$tel = $_POST['tel'];} else {$tel = NULL;}

      if (isset($_POST['mail'])) {$titre = $_POST['mail'];} else {$titre = NULL;}

      if (isset($_POST['site'])) {$titre = $_POST['site'];} else {$titre = NULL;}
    }
  }
  $dao->addFournisseur($idM, $titre, $adresse, $tel, $mail, $site, $description);
  // Fin ajout d'un fournisseurs

  $fours = $dao->getFournisseurs($idM);

  //Envoie des données à la vue
  $data['fournisseurs'] = $fours;
  include_once('../view/fournisseurs.view.php');
?>
