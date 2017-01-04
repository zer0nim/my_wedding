<?php
  include_once('../model/DAO.class.php');
  session_start();
  if (isset($_GET['id'])) {
    $idM=$dao->getIdMariage_hash($_GET['id']);
    $info=$dao->getMariageidm($idM);
    $lieu=$info['maria_lieu'];
    
    //Récupération nom, prenom des mariés et description de l'événement
    $InfoM = $dao->getMariageidm($idM);

    include_once('../view/public-lieu.view.php');
  }else {
    echo "Page inaccessible";
  }
?>
