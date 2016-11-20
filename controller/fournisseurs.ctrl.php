<?php
  require_once('../model/DAO.class.php');
  $idM = 1;
  if (isset($_GET['idS']) && (isset($_GET['idM']))) {
    $req = $dao->estCouplePresentFournisseur($_GET['idS'], $_GET['idM']);
    if ($req[0] == 1) {
      $dao->delFournisseur($_GET['idS'], $_GET['idM']);
    }
  }
  $fours = $dao->getFournisseurs($idM);





  //Envoie des données à la vue
  $data['fournisseurs'] = $fours;
  include_once('../view/fournisseurs.view.php');
?>
