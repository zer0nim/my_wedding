<?php
  include_once('session_create.ctrl.php');
  require_once('../model/DAO.class.php');
  $idM = $_SESSION['idM'];

  // Pour suppression d'un fournisseur
  if (isset($_GET['idS']) && (isset($_GET['idM']))) {
    $req = $dao->estCouplePresentFournisseur($_GET['idS'], $_GET['idM']);
    if ($req[0] == 1) {
      $dao->delFournisseur($_GET['idS'], $_GET['idM']);
    }
  }
  // Fin suppression d'un fournisseurs

  // Pour ajout d'un fournisseur
  $titre = isset($_POST['titre']) ? $_POST['titre'] : NULL;
  $description = isset($_POST['description']) ? $_POST['description'] : NULL;

  $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : NULL;
  $tel = isset($_POST['tel']) ? $_POST['tel'] : NULL;
  $mail = isset($_POST['mail']) ? $_POST['mail'] : NULL;
  $site = isset($_POST['site']) ? $_POST['site'] : NULL;

  $dao->addFournisseur($idM, $titre, $adresse, $tel, $mail, $site, $description);
  // Fin ajout d'un fournisseurs

  $fours = $dao->getFournisseurs($idM);

  //Envoie des données à la vue
  $data['fournisseurs'] = $fours;
  include_once('../view/fournisseurs.view.php');
?>
