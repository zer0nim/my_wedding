<?php
require_once('fournisseurs.class.php');
$dao = new DAO();
class DAO {
  private $db; // L'objet de la base de donnée

  // Ouverture de la base de donnée
  function __construct() {
    try {
      $this->db = new PDO('mysql:host=164.132.34.157;dbname=base;', 'iut2info', 'projetweb');
    } catch (PDOException $e) {
      exit("Erreur ouverture BD : ".$e->getMessage());
    }
  }

    //----------------------------------------------------------------------------------------
    // fonction pour la fonctionnalité budget
    //----------------------------------------------------------------------------------------

    // recupere tout les budgets et depense d'un mariage
    function getBudgets($idmariage){

    }

    // recupere un budget et ces depenses en fonction de son id
    function getBudget($idbudget){

    }

    // supprime un budget et ces depenses en fonction de son id
    function supBudget($idbudget){

    }

    // met à jour ou cree un objet budget dans la bd
    // met à jour ou cree des objets depense dans la bd
    function updateBudget($budget){

    }

    //----------------------------------------------------------------------------------------
    // fonction pour la fonctionnalité fournisseurs
    //----------------------------------------------------------------------------------------

    // recupere tout les fournisseurs d'un mariage
    function getFournisseurs($idM) {
      $req = $this->db->prepare('SELECT * FROM Fournisseurs WHERE four_idM = :id');
      $req->execute(array(':id' => $idM,));
      $donnee = $req->fetchAll(PDO::FETCH_CLASS, "fournisseurs");
      return $donnee;
    }
}

?>
