<?php

require_once '../model/budget.class.php';
require_once '../model/depense.class.php';
require_once '../model/contacts.class.php';

require_once('fournisseurs.class.php');
$dao = new DAO();

class DAO {

  private $db; // L'objet de la base de donnée

  // Ouverture de la base de donnée
  function __construct() {
    try {
      $this->db = new PDO('mysql:host=137.74.148.71 ;dbname=base;', 'iut2info', 'projetweb');
    } catch (PDOException $e) {
      exit("Erreur ouverture BD : ".$e->getMessage());
    }
  }

    //----------------------------------------------------------------------------------------
    // fonction pour la fonctionnalité budget
    //----------------------------------------------------------------------------------------

    // recupere le dernier id de budget ajouté à la bd
    function getLastId($idmariage){
        try{
            $req = $this->db->prepare('select max(bud_id) from Budget where bud_idM = :idmariage');
            $req->execute(array(':idmariage' => $idmariage));
        }catch (PDOException $e){
            exit("Erreur de req sql getBudget : ".$e->getMessage());
        }
        return $req->fetch()[0];
    }

    // recupere un budget et ces depenses en fonction de son id
    function getBudget($idbudget){

        // recuperation des données du budget
        try{
            $req = $this->db->prepare('select * from Budget where bud_id = :idbudget');
            $req->execute(array(':idbudget' => $idbudget));
        }catch (PDOException $e){
            exit("Erreur de req sql getBudget : ".$e->getMessage());
        }
        $budget = $req->fetchAll(PDO::FETCH_ASSOC);

        // si le budget exist on continue sinon on renvoie null
        if ($budget != null){

            $budget = $budget[0]; // à cause du fetchAll()

            // recuperation des depenses
            try{
                $req = $this->db->prepare('select * from Depense where dep_idbudget = :idbudget');
                $req->execute(array(':idbudget' => $idbudget));
            }catch (PDOException $e){
                exit("Erreur de req sql getDepenses : ".$e->getMessage());
            }

            $depenses = null;
            $depenses = $req->fetchAll(PDO::FETCH_ASSOC /*PDO::FETCH_CLASS, "depense"*/);

            // creation des objets depense (sans fetch_class car il fait ****)
            $tabdepense = null;

            if ($depenses != null){
                foreach ($depenses as $depense) {
                    $obj = new depense(); $obj->setAll($depense['dep_id'], $depense['dep_idbudget'], $depense['dep_description'], $depense['dep_valeur']);
                    $tabdepense[$depense['dep_id']] = $obj;
                }
            }

            return new budget($idbudget, $budget['bud_idMariage'], $budget['bud_description'], $budget['bud_valeur'], $tabdepense);

        }else{
            return null;
        }
    }

    // recupere tout les budgets et depense d'un mariage
    function getBudgets($idmariage){
        $tabbudget = null;

        // recuperation de tout les id
        try{
            $req = $this->db->prepare('select bud_id from Budget where bud_idM = :idmariage order by bud_id desc');
            $req->execute(array(':idmariage' => $idmariage));
        }catch (PDOException $e){
            exit("Erreur de req sql getBudgets : ".$e->getMessage());
        }
        $resultats = $req->fetchAll();

        // creation des obgets budget
        if ($resultats != null){
            foreach ($resultats as $idbudget) {
                $tabbudget[$idbudget[0]] = $this->getBudget($idbudget[0]);
            }

            return $tabbudget;
        }else{
            return null;
        }
    }

    // supprime une depense en fonction de son id
    function supDepense($iddepense){
        try{
            $req = $this->db->prepare('delete from Depense where dep_id = :iddepense');
            $req->execute(array(':iddepense' => $iddepense));
        }catch (PDOException $e){
            exit("Erreur de req sql supp depense : ".$e->getMessage());
        }
    }

    // supprime un budget et ces depenses en fonction de son id
    function supBudget($idbudget){

        // suppression des depenses
        try{
            $req = $this->db->prepare('delete from Depense where dep_idbudget = :idbudget');
            $req->execute(array(':idbudget' => $idbudget));
        }catch (PDOException $e){
            exit("Erreur de req sql supp depenses : ".$e->getMessage());
        }

        // suppression du budget
        try{
            $req = $this->db->prepare('delete from Budget where bud_id = :idbudget');
            $req->execute(array(':idbudget' => $idbudget));
        }catch (PDOException $e){
            exit("Erreur de req sql supp budget : ".$e->getMessage());
        }
    }

    // met à jour ou cree un objet budget et ces depenses dans la bd
    // return l'id du budget crée
    function updateBudget($budget){

        // update budget ----------------------

        try{
            $req = $this->db->prepare('select bud_id from Budget where bud_id = :idbudget');
            $req->execute(array(':idbudget' => $budget->getId()));
        }catch (PDOException $e){
            exit("Erreur de req sql getidbudget : ".$e->getMessage());
        }

        // si le budget existe dans la bd on le modifie sinon on le cree
        if ($req->fetch() != null){
            // update du budget
            try{
                $req = $this->db->prepare('update Budget set bud_description=:description , bud_valeur=:valeur where bud_id = :idbudget');
                $req->execute(array(':description' => $budget->getDescription(), ':valeur' => $budget->getValue(), ':idbudget' => $budget->getId()));
            }catch (PDOException $e){
                exit("Erreur de req sql update budget : ".$e->getMessage());
            }

        }else{
            // insertion du budget
            try{
                $req = $this->db->prepare('insert into Budget values(NULL, :idmariage, :description, :valeur)');
                $req->execute(array(':idmariage' => $budget->getIdMariage(), ':description' => $budget->getDescription(), ':valeur' => $budget->getValue()));
            }catch (PDOException $e){
                exit("Erreur de req sql insert budget : ".$e->getMessage());
            }

            // modification de l'id du budget et des dépenses avec selui attribué pas la bd
            $newId = $this->getLastId($budget->getIdMariage());
            $budget->setId($newId);
        }

        // update depenses ---------------------------

        // récuperation des id des dépenses pour savoir les quelles ont été supprimés
        try{
            $req = $this->db->prepare('select dep_id from Depense where dep_idbudget = :idbudget');
            $req->execute(array(':idbudget' => $budget->getId()));
        }catch (PDOException $e){
            exit("Erreur de req sql getiddepense : ".$e->getMessage());
        }

        $tabdepense = $budget->getTabdepense(); // les dépenses du formulaires
        $tabdepenseinit = $req->fetchAll(PDO::FETCH_ASSOC); // les dépenses initial de la bd

        if ($tabdepense != null){

            // met à jour ou cree les depenses
            foreach ($tabdepense as $depense) {

                // si la depense existe dans la bd on la modifie sinon on la cree
                if (in_array($depense->getId(), $tabdepenseinit)){

                    //update depenses
                    try{
                        $req = $this->db->prepare('update Depense set dep_description=:description , dep_valeur=:valeur where dep_id = :idbdepense');
                        $req->execute(array(':description' => $depense->getDescription(), ':valeur' => $depense->getValue(), ':idbdepense' => $depense->getId()));
                    }catch (PDOException $e){
                        exit("Erreur de req sql update depense : ".$e->getMessage());
                    }

                }else{

                    //insert depenses
                    try{
                        $req = $this->db->prepare('insert into Depense values(NULL, :idbudget, :description, :valeur)'); // id à null car auto-incrementation
                        $req->execute(array(':idbudget' => $depense->getIdbudget(), ':description' => $depense->getDescription(), ':valeur' => $depense->getValue()));
                    }catch (PDOException $e){
                        exit("Erreur de req sql insert depense : ".$e->getMessage());
                    }
                }
            }
        }

        // supprime les depenses de la BD qui ont été supprimées par l'utilisateur
        if ($tabdepenseinit != null){
            if ($tabdepense != null){
                foreach ($tabdepenseinit as $id) {
                    if (!array_key_exists($id, $tabdepense)){
                        // si la dépense n'est plus dans la nouvelle table on la supprime
                        $this->supDepense($id);
                    }
                }
            }else{
                // si il n'y a aucune dépense dans la nouvelle table, on supprime toutes les dépenses
                try{
                    $req = $this->db->prepare('delete from Depense where dep_idbudget = :idbudget');
                    $req->execute(array(':idbudget' => $budget->getId()));
                }catch (PDOException $e){
                    exit("Erreur de req sql supp depenses : ".$e->getMessage());
                }
            }
        }

        return $budget->getId();

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
      $req = $this->db->prepare('SELECT * FROM ListeSouhaits WHERE ListSouh_idM = :id ORDER BY ListSouh_preference');
      $req->execute(array(':id' => $idM,));
      while ($donnee = $req->fetch()) {
        $data[] = array('nom' => $donnee['ListSouh_nom'], 'preference' => $donnee['ListSouh_preference'],);
      }
      return $data;
    }

    // supprime les souhait d'un mariage
    function delListeSouhaitMariage($idM) {
      $req = $this->db->prepare('DELETE FROM ListeSouhaits WHERE ListSouh_idM = :idM');
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
    // fonction pour la fonctionnalité invitation
    //----------------------------------------------------------------------------------------
    function setInvitation($idM,$texte){ //fonction pour enregistrer le texte dans la bd
      $req = $this->db->prepare('INSERT INTO Invitation VALUES(:idM, :texte)');
      $req->execute(array(':idM' => $idM,
                          ':texte' => $texte,));
    }

    function getInvitation($idM){//fonction pour recuperer le texte de la bd
      $req = $this->db->prepare('SELECT inv_invite FROM Invitation WHERE inv_idM=:idM');
      $req->execute(array(':idM' => $idM,));
      $data=$req->fetch();
      var_dump($data);
      $data=$data[0][0];
      return $data;
    }

    //----------------------------------------------------------------------------------------
    // fonction pour la fonctionnalité contacts
    //----------------------------------------------------------------------------------------
    /*
    private $cont_id;
    private $cont_nom;
    private $cont_prenom;
    private $cont_adresse;
    private $cont_mail;
    private $cont_age;
    private $cont_tel;
    */
    function getContacts($idM) {
      $req = $this->db->prepare('SELECT * FROM Contact WHERE cont_idM = :idM');
      $req->execute(array(':idM' => $idM,));
      $donnee = $req->fetchAll(PDO::FETCH_CLASS, "contacts");
      return $donnee;
    }

    // supprime un Contact d'un mariage
    function delContacts($idM, $idCont) {
      $req = $this->db->prepare('DELETE FROM Contact WHERE cont_idM = :idM');
      $req->execute(array(':idM' => $idM,));
    }

    // insert un Contact à un mariage
    function setContact($idM, $contacts) {
      foreach ($contacts as $key => $value) {
        $req = $this->db->prepare('INSERT INTO Contact VALUES(:idM, :cont_nom, :cont_prenom, :cont_adresse, :cont_mail, :cont_age, :cont_tel)');
        $req->execute(array(':idM' => $idM,
                              ':cont_nom' => $value['cont_nom'],
                              ':cont_prenom' => $value['cont_prenom'],
                              ':cont_adresse' => $value['cont_adresse'],
                              ':cont_mail' => $value['cont_mail'],
                              ':cont_age' => $value['cont_age'],
                              ':cont_tel' => $value['cont_tel']));
      }
    }
    //----------------------------------------------------------------------------------------
}

?>
