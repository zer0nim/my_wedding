<?php

require_once '../model/budget.class.php';
require_once '../model/depense.class.php';

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

    // recupere la depenses
    function getDepense($iddepense){
        try{
            $req = $this->db->prepare('select * from Depense where dep_id = :iddepense');
            $req->execute(array(':iddepense' => $iddepense));
        }catch (PDOException $e){
            print("Erreur de req sql getDepense");
        }
        $depense = $req->fetchAll(PDO::FETCH_ASSOC)[0];
        
        if ($depense != null){
            return new depense($iddepense, $depense['dep_idbudget'], $depense['dep_description'], $depense['dep_valeur']);
            
        }else{
            return null;
        }
    }
    
    // recupere le dernier budget ajouté à la bd
    function getLastBudget($idmariage){
        try{
            $req = $this->db->prepare('select max(bud_id) from Budget where bud_idMariage = :idmariage');
            $req->execute(array(':idmariage' => $idmariage));
        }catch (PDOException $e){
            print("Erreur de req sql getBudget");
        }
        return $this->getBudget($req->fetch()[0]);
    }
  
    // recupere un budget et ces depenses en fonction de son id
    function getBudget($idbudget){
        try{
            $req = $this->db->prepare('select * from Budget where bud_id = :idbudget');
            $req->execute(array(':idbudget' => $idbudget));
        }catch (PDOException $e){
            print("Erreur de req sql getBudget");
        }
        $budget = $req->fetchAll(PDO::FETCH_ASSOC);
        
        if ($budget != null){
            // recuperation des depenses
            $budget = $budget[0];
            
            try{
                $req = $this->db->prepare('select dep_id from Depense where dep_idbudget = :idbudget');
                $req->execute(array(':idbudget' => $idbudget));
            }catch (PDOException $e){
                print("Erreur de req sql getBudget getdepense");
            }
            $iddepenses = $req->fetchAll();

            $tabdepense = null;
            if ($iddepenses != null){
                foreach ($iddepenses as $iddepense) {
                    $tabdepense[$iddepense[0]] = $this->getDepense($iddepense[0]);
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
        try{
            $req = $this->db->prepare('select bud_id from Budget where bud_idMariage = :idmariage order by bud_id desc');
            $req->execute(array(':idmariage' => $idmariage));
        }catch (PDOException $e){
            print("Erreur de req sql getBudgets");
        }
        $resultats = $req->fetchAll();
        
        // creation des obgets
        if ($resultats != null){
            foreach ($resultats as $idbudget) {
                $budgetobj = $this->getBudget($idbudget[0]);
                $tabbudget[$idbudget[0]] = $budgetobj;
            }
            return $tabbudget;
        }else{
            return null;
        }
    }
    
    // supprime une depense en fonction de son id
    function supDepense($iddepense){
                
        // suppression de la depenses
        try{
            $req = $this->db->prepare('delete from Depense where dep_id = :iddepense');
            $req->execute(array(':iddepense' => $iddepense));
        }catch (PDOException $e){
            print("Erreur de req sql supp depense");
        }
    }

    // supprime un budget et ces depenses en fonction de son id
    function supBudget($idbudget){
                
        // suppression des depenses
        try{
            $req = $this->db->prepare('delete from Depense where dep_idbudget = :idbudget');
            $req->execute(array(':idbudget' => $idbudget));
        }catch (PDOException $e){
            print("Erreur de req sql supp depenses");
        }
        
        // suppression du budget
        try{
            $req = $this->db->prepare('delete from Budget where bud_id = :idbudget');
            $req->execute(array(':idbudget' => $idbudget));
        }catch (PDOException $e){
            print("Erreur de req sql supp budget");
        }
    }
    
    // met à jour ou cree des objets depense dans la bd
    function updateDepense($depense){
        
        try{
            $req = $this->db->prepare('select dep_id from Depense where dep_id = :iddepense');
            $req->execute(array(':iddepense' => $depense->getId()));
        }catch (PDOException $e){
            print("Erreur de req sql getiddepense");
        }
        
        // si la depense existe on la modifie sinon on la cree
        if ($req->fetch() != null){
            //update depenses
            try{
                $req = $this->db->prepare('update Depense set dep_description=:description , dep_valeur=:valeur where dep_id = :idbdepense');
                $req->execute(array(':description' => $depense->getDescription(), ':valeur' => $depense->getValue(), ':idbdepense' => $depense->getId()));
            }catch (PDOException $e){
                print("Erreur de req sql update depense");
            }
                
        }else{
            //insert depenses
            try{
                $req = $this->db->prepare('insert into Depense values(NULL, :idbudget, :description, :valeur)');
                $req->execute(array(':idbudget' => $depense->getIdbudget(), ':description' => $depense->getDescription(), ':valeur' => $depense->getValue()));
            }catch (PDOException $e){
                print("Erreur de req sql insert depense");
            }
        }
        
    }

    // met à jour ou cree un objet budget et ces depenses dans la bd
    function updateBudget($budget){
        
        try{
            $req = $this->db->prepare('select bud_id from Budget where bud_id = :idbudget');
            $req->execute(array(':idbudget' => $budget->getId()));
        }catch (PDOException $e){
            print("Erreur de req sql getidbudget");
        }
        
        // si le budget existe dans la bd on le modifie sinon on le cree
        if ($req->fetch() != null){
            // update du budget
            try{
                $req = $this->db->prepare('update Budget set bud_description=:description , bud_valeur=:valeur where bud_id = :idbudget');
                $req->execute(array(':description' => $budget->getDescription(), ':valeur' => $budget->getValue(), ':idbudget' => $budget->getId()));
            }catch (PDOException $e){
                print("Erreur de req sql update budget");
            }
            
        }else{
            // insertion du budget
            try{
                $req = $this->db->prepare('insert into Budget values(NULL, :idmariage, :description, :valeur)');
                $req->execute(array(':idmariage' => $budget->getIdMariage(), ':description' => $budget->getDescription(), ':valeur' => $budget->getValue()));
            }catch (PDOException $e){
                print("Erreur de req sql insert budget");
            }
            
            // modification de l'id de l'objet avec selui attribué pas la bd
            $newId = $this->getLastBudget($budget->getIdMariage())->getId();
            $tab0 = $budget->getTabdepense();
            $tab = null;
            foreach ($tab0 as $depense) {
                $tab[$depense->getId()] = new depense($depense->getId(), $newId, $depense->getDescription(), $depense->getValue());
            } 
            $budget = new budget($newId, $budget->getIdMariage(), $budget->getDescription(), $budget->getValue(), $tab);
        }
        
        // update depenses
        
        $tabdepense = $budget->getTabdepense();
        
        $budgetinit = $this->getBudget($budget->getId());
        $tabdepenseinit = null;
        if ($budgetinit != null){
            $tabdepenseinit = $budgetinit->getTabdepense();
            
            // supprime les depenses qui ont été supprimées
            if ($tabdepenseinit != null){
                if ($tabdepense != null){
                    foreach ($tabdepenseinit as $depense) {
                        if (!array_key_exists($depense->getId(), $tabdepense)){
                            $this->supDepense($depense->getId());
                        }
                    }
                }else{
                    foreach ($tabdepenseinit as $depense) {
                        $this->supDepense($depense->getId());
                    }
                }
            }
        }
        
        // met à jour ou cree les depenses
        if ($tabdepense != null){
            foreach ($tabdepense as $depense) {
                $this->updateDepense($depense);
            }
        }

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
