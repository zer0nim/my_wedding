<?php
  include_once('../model/DAO.class.php');
  session_start();
  if (isset($_GET['id'])) {
    $idM=$dao->getIdMariage_hash($_GET['id']);

    //Récupération nom, prenom des mariés et description de l'événement
    $InfoM = $dao->getMariageidm($idM);

    $listSouh = $dao->getListeSouhait($idM);

    include_once('../view/public-liste.view.php');
  }
  else {
    echo "Page inaccessible";
  }

  function printList($listSouh) {
    foreach ($listSouh as $key => $souh) {
      if ($key > 0) {
        echo "<div class=\"sep\"></div>";
      }
      echo "<ol><li class=\"souh\">" . $souh['nom'] . "</li></ol>";
    }
    echo "</ol>";
  }
?>
