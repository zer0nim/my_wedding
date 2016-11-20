<?php
  require_once('../model/DAO.class.php');
  $idM = 1;
  $fours = $dao->getFournisseurs($idM);





  //Envoie des données à la vue
  $data['fournisseurs'] = $fours;
  var_dump($data['fournisseurs'][1]);
  include_once('../view/fournisseurs.view.php');
?>
