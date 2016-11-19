<?php
  require_once('../model/DAO.class.php');

/* Fonction pour DAO.class.php
  function getFournisseurs($idM) {
    $req = $this->db->prepare('SELECT * FROM Fournisseurs WHERE four_idM = :id');
    $req->execute(array(':id' => $idM,));
    $donnee = $req->fetchAll(PDO::FETCH_CLASS, "fournisseurs");
    return $donnee;
  }
*/









  include_once('../view/fournisseurs.view.php');
?>
