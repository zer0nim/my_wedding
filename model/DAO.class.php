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

    // retourne 1 si le couple idS et idM existe, sinon 0
    function estCouplePresentFournisseur($idS, $idM) {
      $req = $this->db->prepare('SELECT count(*) FROM Fournisseurs WHERE four_idM = :idM AND four_id = :idS');
      $req->execute(array(':idM' => $idM, ':idS' => $idS,));
      $donnee = $req->fetch();
      return $donnee;
    }

    // suprimme le fournisseur de id = $idS et de idM = $idM
    function delFournisseur($idS, $idM) {
      $req = $this->db->prepare('DELETE FROM Fournisseurs WHERE four_idM = :idM AND four_id = :idS');
      $req->execute(array(':idM' => $idM, ':idS' => $idS,));
    }

    // ajoute un fournisseur
    function addFournisseur($idM, $titre, $adresse, $tel, $mail, $site, $description) {
      $req = $this->db->prepare('INSERT INTO Fournisseurs(four_idM, four_titre, four_adresse, four_tel, four_mail, four_site, four_description) VALUES(:idM, :titre, :adresse, :tel, :mail, :site, :description) ');
      $req->execute(array(':idM' => $idM,
                          ':titre' => $titre,
                          ':adresse' => $adresse,
                          ':tel' => $tel,
                          ':mail' => $mail,
                          ':site' => $site,
                          ':description' => $description, ));
    }

    //----------------------------------------------------------------------------------------
    // fonction pour la fonctionnalité Liste de souhait
    //----------------------------------------------------------------------------------------

    // recupere tout la liste d'un mariage
    function getListeSouhait($idM) {
      $req = $this->db->prepare('SELECT * FROM ListeSouhaits WHERE ListSouh_idMariage = :id ORDER BY ListSouh_preference');
      $req->execute(array(':id' => $idM,));
      while ($donnee = $req->fetch()) {
        $data[] = array('nom' => $donnee['ListSouh_nom'], 'preference' => $donnee['ListSouh_preference'],);
      }
      return $data;
    }

    // supprime les souhait d'un mariage
    function delSouhaitMariage($idM) {
      $req = $this->db->prepare('DELETE FROM ListeSouhaits WHERE ListSouh_idMariage = :idM');
      $req->execute(array(':idM' => $idM,));
    }

    // écris la liste de souhait d'un mariage
    function setListeSouhait($idM, $liste) {
      $preference = 1;
      foreach ($liste as $key => $value) {
        echo "test";
        var_dump($liste);
        $req = $this->db->prepare('INSERT INTO ListeSouhaits VALUES(:idM, :nom, :preference)');
        $req->execute(array(':idM' => $idM,
                            ':nom' => $value,
                            ':preference' => $preference,));
        $preference++;
      }
    }

    //----------------------------------------------------------------------------------------
}

?>
