<?php

require_once '../model/budget.class.php';
require_once '../model/depense.class.php';
require_once '../model/contacts.class.php';
require_once '../model/tables.class.php';
require_once '../model/evenement.class.php';

require_once('fournisseurs.class.php');
$dao = new DAO();

class DAO {

  private $db; // L'objet de la base de donnée

  // Ouverture de la base de donnée
  function __construct() {
    try {
      $this->db = new PDO('mysql:host=137.74.148.71;dbname=base;', 'iut2info', 'projetweb');
    } catch (PDOException $e) {
      exit("Erreur ouverture BD : ".$e->getMessage());
    }
  }

    //----------------------------------------------------------------------------------------
    // fonction pour la fonctionnalité budget
    //----------------------------------------------------------------------------------------

    // fonction pour mettre à jour le budget global
    function updateBudgetGlobal($idmariage, $valeur){
        try{
            $req = $this->db->prepare('update Budget set bud_valeur=:valeur where bud_id = 0 and bud_idM = :idmariage');
            $req->execute(array(':valeur' => $valeur, ':idmariage' => $idmariage));
        }catch (PDOException $e){
            exit("Erreur de req sql updateBudgetGlobal : ".$e->getMessage());
        }
    }

    // fonction pour récuperer ou creer la valeur du budget global
    // l'id de ce budget à une valeur négative = -idmariage
    function getBudgetGlobal($idmariage){
        try{
            $req = $this->db->prepare('select bud_valeur from Budget where bud_id = 0 and bud_idM = :idmariage');
            $req->execute(array(':idmariage' => $idmariage));
        }catch (PDOException $e){
            exit("Erreur de req sql getBudgetGlobal : ".$e->getMessage());
        }
        $resultat = $req->fetch(PDO::FETCH_ASSOC);

        // si le budget existe
        if ($resultat){
            return $resultat['bud_valeur'];
        }else{
            try{
                $req = $this->db->prepare('insert into Budget values(0, :idmariage, "budget global", :valeur)');
                $req->execute(array(':idmariage' => $idmariage, ':valeur' => 0));
            }catch (PDOException $e){
                exit("Erreur de req sql insert BudgetGlobal : ".$e->getMessage());
            }
            return 0;
        }
    }

    // recupere l'id du dernier budget ajouté au mariage dans la bd
    function getLastId($idmariage){
        try{
            $req = $this->db->prepare('select max(bud_id) from Budget where bud_idM = :idmariage');
            $req->execute(array(':idmariage' => $idmariage));
        }catch (PDOException $e){
            exit("Erreur de req sql getlastid : ".$e->getMessage());
        }
        return $req->fetch()[0];
    }

	// recupere l'id de la derniere depense ajouté au budget du mariage dans la bd
    function getLastIdDep($idbudget, $idmariage){
        try{
            $req = $this->db->prepare('select max(dep_id) from Depense where dep_idbudget = :idbudget and dep_idM = :idmariage');
            $req->execute(array(':idbudget' => $idbudget, ':idmariage' => $idmariage));
        }catch (PDOException $e){
            exit("Erreur de req sql getlastiddep : ".$e->getMessage());
        }
        return $req->fetch()[0];
    }

    // recupere un budget et ces depenses en fonction de son id
    function getBudget($idbudget, $idmariage){

        // recuperation des données du budget
        try{
            $req = $this->db->prepare('select * from Budget where bud_id = :idbudget and bud_idM = :idmariage');
            $req->execute(array(':idbudget' => $idbudget, ':idmariage' => $idmariage));
        }catch (PDOException $e){
            exit("Erreur de req sql getBudget : ".$e->getMessage());
        }
        $budget = $req->fetchAll(PDO::FETCH_ASSOC);

        // si le budget exist on continue sinon on renvoie null
        if ($budget != null){

            $budget = $budget[0]; // à cause du fetchAll()

            // recuperation des depenses
            try{
                $req = $this->db->prepare('select * from Depense where dep_idbudget = :idbudget and dep_idM = :idmariage');
                $req->execute(array(':idbudget' => $idbudget, ':idmariage' => $idmariage));
            }catch (PDOException $e){
                exit("Erreur de req sql getDepenses : ".$e->getMessage());
            }

            $depenses = null;
            $depenses = $req->fetchAll(PDO::FETCH_ASSOC);

            // creation des objets depense
            $tabdepense = null;

            if ($depenses != null){
                foreach ($depenses as $depense) {
                    $obj = new depense($depense['dep_id'], $depense['dep_description'], $depense['dep_valeur']);
                    $tabdepense[$depense['dep_id']] = $obj;
                }
            }

            return new budget($idbudget, $budget['bud_description'], $budget['bud_valeur'], $tabdepense);

        }else{
            return null;
        }
    }

    // recupere tout les budgets et depense d'un mariage
    // contient une partie du code de getBudget() mais necessaire pour limiter le nombre de requettes sql
    function getBudgets($idmariage){
        $tabbudget = null;

        // recuperation de tout les budget
        try{
            $req = $this->db->prepare('select * from Budget where bud_idM = :idmariage and bud_id > 0 order by bud_id desc');
            $req->execute(array(':idmariage' => $idmariage));
        }catch (PDOException $e){
            exit("Erreur de req sql getBudgets : ".$e->getMessage());
        }
        $budgets = $req->fetchAll(PDO::FETCH_ASSOC);

        if ($budgets != null){

            // recuperation de toutes les depenses de tout les budgets
            try{
                $req = $this->db->prepare('select * from Depense where dep_idM = :idmariage');
                $req->execute(array(':idmariage' => $idmariage));
            }catch (PDOException $e){
                exit("Erreur de req sql getDepenses : ".$e->getMessage());
            }
            $depenses = $req->fetchAll(PDO::FETCH_ASSOC);

            // modification du tableau pour l'indexer par idbudget et iddepense
			if ($depenses != null){
				$depenses2 = null;
				foreach ($depenses as $depense) {
					$depenses2[$depense['dep_idbudget']][$depense['dep_id']] = $depense;
				}
				$depenses = $depenses2;
			}

            // creation des objets budget et depense
            foreach ($budgets as $budget) {

                $tabdepense = null;

                if (isset($depenses[$budget['bud_id']])){
                    foreach ($depenses[$budget['bud_id']] as $depense) {
                        $tabdepense[$depense['dep_id']] = new depense($depense['dep_id'], $depense['dep_description'], $depense['dep_valeur']);
                    }
                }

                $tabbudget[$budget['bud_id']] = new budget($budget['bud_id'], $budget['bud_description'], $budget['bud_valeur'], $tabdepense);
            }

            return $tabbudget;
        }else{
            return null;
        }
    }

    // supprime une depense en fonction de son id
    function supDepense($iddepense, $idbudget, $idmariage){
        try{
            $req = $this->db->prepare('delete from Depense where dep_id = :iddepense and dep_idbudget = :idbudget and dep_idM = :idmariage');
            $req->execute(array(':iddepense' => $iddepense, ':idbudget' => $idbudget, ':idmariage' => $idmariage));
        }catch (PDOException $e){
            exit("Erreur de req sql supp depense : ".$e->getMessage());
        }
    }

    // supprime un budget et ces depenses en fonction de son id
    function supBudget($idbudget, $idmariage){

        // suppression des depenses
        try{
            $req = $this->db->prepare('delete from Depense where dep_idbudget = :idbudget and dep_idM = :idmariage');
            $req->execute(array(':idbudget' => $idbudget, ':idmariage' => $idmariage));
        }catch (PDOException $e){
            exit("Erreur de req sql supp depenses : ".$e->getMessage());
        }

        // suppression du budget
        try{
            $req = $this->db->prepare('delete from Budget where bud_id = :idbudget and bud_idM = :idmariage');
            $req->execute(array(':idbudget' => $idbudget, ':idmariage' => $idmariage));
        }catch (PDOException $e){
            exit("Erreur de req sql supp budget : ".$e->getMessage());
        }
    }

    // met à jour ou cree un objet budget et ces depenses dans la bd
    function updateBudget(&$budget, $idmariage){

        // update budget ----------------------

        try{
            $req = $this->db->prepare('select bud_id from Budget where bud_id = :idbudget and bud_idM = :idmariage');
            $req->execute(array(':idbudget' => $budget->getId(), ':idmariage' => $idmariage));
        }catch (PDOException $e){
            exit("Erreur de req sql getidbudget : ".$e->getMessage());
        }

        // si le budget existe dans la bd on le modifie sinon on le cree
        if ($budget->getId() >= 0 && $req->fetch() != null){
            // update du budget
            try{
                $req = $this->db->prepare('update Budget set bud_description=:description , bud_valeur=:valeur where bud_id = :idbudget and bud_idM = :idmariage');
                $req->execute(array(':description' => $budget->getDescription(), ':valeur' => $budget->getValue(), ':idbudget' => $budget->getId(), ':idmariage' => $idmariage));
            }catch (PDOException $e){
                exit("Erreur de req sql update budget : ".$e->getMessage());
            }

        }else{
			// modification de l'id du budget avec l'id suivant dans la bd
            $newId = $this->getLastId($idmariage)+1;
            $budget->setId($newId);

            // insertion du budget
            try{
                $req = $this->db->prepare('insert into Budget values(:idbudget, :idmariage, :description, :valeur)');
                $req->execute(array(':idbudget' => $newId, ':idmariage' => $idmariage, ':description' => $budget->getDescription(), ':valeur' => $budget->getValue()));
            }catch (PDOException $e){
                exit("Erreur de req sql insert budget : ".$e->getMessage());
            }
        }

        // update depenses ---------------------------

        // récuperation des dépenses initial pour savoir les quelles ont été modifié ou supprimés
        try{
            $req = $this->db->prepare('select * from Depense where dep_idbudget = :idbudget and dep_idM = :idmariage');
            $req->execute(array(':idbudget' => $budget->getId(), ':idmariage' => $idmariage));
        }catch (PDOException $e){
            exit("Erreur de req sql getiddepense : ".$e->getMessage());
        }

        $resultat = $req->fetchAll(PDO::FETCH_ASSOC); // les dépenses initial de la bd
        $tabdepense = $budget->getTabdepense(); // les dépenses du formulaires

		// indexion des dépenses initiales par leurs id
		$tabdepenseinit = null;
		if ($resultat != null){
			foreach ($resultat as $depenseinit) {
				$tabdepenseinit[$depenseinit['dep_id']] = $depenseinit;
			}
		}

        if ($tabdepense != null){

			$newId = $this->getLastIdDep($budget->getId(), $idmariage);
			if ($newId == null){
				$newId = 0;
			}else{
				$newId++;
			}

            // met à jour ou cree les depenses
            foreach ($tabdepense as $depense) {

                // si la depense existe dans la bd on la modifie sinon on la cree
                if ($depense->getId() >= 0){//$tabdepenseinit != null && isset($tabdepenseinit[$depense->getId()])){

					// si la dépense à été modifé on la met à jour
					if ($depense->getValue() != $tabdepenseinit[$depense->getId()]['dep_valeur'] || $depense->getDescription() != $tabdepenseinit[$depense->getId()]['dep_description']){

						try{
							$req = $this->db->prepare('update Depense set dep_description=:description , dep_valeur=:valeur where dep_id = :idbdepense and dep_idbudget = :idbudget and dep_idM = :idmariage');
							$req->execute(array(':description' => $depense->getDescription(), ':valeur' => $depense->getValue(), ':idbdepense' => $depense->getId(), ':idbudget' => $budget->getId(), ':idmariage' => $idmariage));
						}catch (PDOException $e){
							exit("Erreur de req sql update depense : ".$e->getMessage());
						}
					}

                }else{

                    //insert depenses
                    try{
                        $req = $this->db->prepare('insert into Depense values(:id, :idbudget, :idmariage, :description, :valeur)'); // id à null car auto-incrementation
                        $req->execute(array(':id' => $newId, ':idbudget' => $budget->getId(), ':idmariage' => $idmariage, ':description' => $depense->getDescription(), ':valeur' => $depense->getValue()));
                    }catch (PDOException $e){
                        exit("Erreur de req sql insert depense : ".$e->getMessage());
                    }
					$depense->setId($newId);
					$newId++;
                }
            }
        }

        // supprime les depenses de la BD qui ont été supprimées par l'utilisateur
        if ($tabdepenseinit != null){
            if ($tabdepense != null){
                foreach ($tabdepenseinit as $id => $depenseinit) {
                    if (!isset($tabdepense[$id])){
                        // si la dépense n'est plus dans la nouvelle table on la supprime
                        $this->supDepense($id, $budget->getId(), $idmariage);
                    }
                }
            }else{
                // si il n'y a aucune dépense dans la nouvelle table, on supprime toutes les dépenses
                try{
                    $req = $this->db->prepare('delete from Depense where dep_idbudget = :idbudget and dep_idM = :idmariage');
                    $req->execute(array(':idbudget' => $budget->getId(), ':idmariage' => $idmariage));
                }catch (PDOException $e){
                    exit("Erreur de req sql supp depenses : ".$e->getMessage());
                }
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
      $data=$data['inv_invite'];
      return $data;
    }

    function delInvitation($idM) {
      $req = $this->db->prepare('DELETE FROM Invitation WHERE inv_idM = :idM');
      $req->execute(array(':idM' => $idM,));
    }

    //----------------------------------------------------------------------------------------
    // fonction pour la fonctionnalité contacts
    //----------------------------------------------------------------------------------------

    function getContacts($idM) {
      $req = $this->db->prepare('SELECT * FROM Contact WHERE cont_idM = :idM');
      $req->execute(array(':idM' => $idM,));
      $donnee = $req->fetchAll(PDO::FETCH_CLASS, "contacts");
      return $donnee;
    }

    function getContactsIndiceParId($idM) {
      $req = $this->db->prepare('SELECT * FROM Contact WHERE cont_idM = :idM');
      $req->execute(array(':idM' => $idM,));
      $donnees = $req->fetchAll(PDO::FETCH_CLASS, "contacts");
      foreach ($donnees as $donnee) {
        $listContact[$donnee->getCont_id()] = $donnee;
      }
      return $listContact;
    }

    function getContact($idM, $idCont) {
      $req = $this->db->prepare('SELECT * FROM Contact WHERE cont_idM = :idM and cont_id = :cont_id');
      $req->execute(array(':idM' => $idM,
                          ':cont_id' => $idCont,));
      $donnee = $req->fetchAll(PDO::FETCH_CLASS, "contacts");
      return $donnee[0];
    }

    // supprime un Contact d'un mariage
    function delContacts($idM, $idCont) {
      $req = $this->db->prepare('DELETE FROM Contact WHERE cont_idM = :idM and cont_id = :cont_id');
      $req->execute(array(':idM' => $idM,
                          ':cont_id' => $idCont,));
    }

    // modifie un Contact d'un mariage
    function updateContactInfo($contact) {
        $req = $this->db->prepare('UPDATE Contact SET cont_nom=:cont_nom, cont_prenom=:cont_prenom, cont_adresse=:cont_adresse, cont_mail=:cont_mail, cont_age=:cont_age, cont_tel=:cont_tel WHERE cont_idM=:cont_idM AND cont_id=:cont_id');
        $req->execute(array(':cont_id' => $contact->getCont_id(),
                            ':cont_idM' => $contact->getCont_idM(),
                            ':cont_nom' => $contact->getCont_nom(),
                            ':cont_prenom' => $contact->getCont_prenom(),
                            ':cont_adresse' => $contact->getCont_adresse(),
                            ':cont_mail' => $contact->getCont_mail(),
                            ':cont_age' => $contact->getCont_age(),
                            ':cont_tel' => $contact->getCont_tel()));
    }

    // insert un Contact à un mariage
    function setContact($contact) {
      try {
        $req = $this->db->prepare('INSERT INTO Contact VALUES(NULL, :cont_idM, :cont_nom, :cont_prenom, :cont_adresse, :cont_mail, :cont_age, :cont_tel, NULL)');
        $req->execute(array(':cont_idM' => $contact->getCont_idM(),
                            ':cont_nom' => $contact->getCont_nom(),
                            ':cont_prenom' => $contact->getCont_prenom(),
                            ':cont_adresse' => $contact->getCont_adresse(),
                            ':cont_mail' => $contact->getCont_mail(),
                            ':cont_age' => $contact->getCont_age(),
                            ':cont_tel' => $contact->getCont_tel()));
                          }
      catch (PDOException $e) {
        exit("Erreur création nouveau contact: ".$e->getMessage());
      }
      try {
        $req = $this->db->prepare('SELECT cont_id, cont_nom, cont_prenom FROM Contact WHERE cont_idM = :cont_idM and cont_nom = :cont_nom and cont_prenom = :cont_prenom and cont_mail = :cont_mail');
        $req->execute(array(':cont_idM' => $contact->getCont_idM(),
                            ':cont_nom' => $contact->getCont_nom(),
                            ':cont_prenom' => $contact->getCont_prenom(),
                            ':cont_mail' => $contact->getCont_mail()));
        $donnee = $req->fetch();
      }
      catch (PDOException $e) {
        exit("Erreur création nouveau contact: ".$e->getMessage());
      }
      return ($donnee);
    }
    //----------------------------------------------------------------------------------------

    function placement($idMariage) {
      try {
        $tabPasEnsemble = $this->db->prepare('Select pref_idContact, pref_idContact2 From Preferences Where pref_idM = :idMariage and pref_aime = \'non\'');
        $tabPasEnsemble->execute(array(':idMariage' => $idMariage));
        //$tabPasEnsemble[0] contient idContact et $tabPasEnsemble[1] contient idContact2
      }
      catch (PDOException $e) {
        exit("Erreur de req sql placement -> Pas ensemble : ".$e->getMessage());
      }

      try {
        $tabEnsemble = $this->db->prepare('Select pref_idContact, pref_idContact2 From Preferences Where pref_idM = :idMariage and pref_aime = \'oui\'');
        $tabEnsemble->execute(array(':idMariage' => $idMariage));
        //$tabEnsemble[0] contient idContact et $tabEnsemble[1] contient idContact2
      }
      catch (PDOException $e) {
        exit("Erreur de req sql placement -> Ensemble : ".$e->getMessage());
      }

      $contacts = $this->getContactsIndiceParId($idMariage);
      foreach ($tabPasEnsemble as $pasEnsemble) {
        echo $contacts[$pasEnsemble[0]]->getCont_nom()." ".$contacts[$pasEnsemble[0]]->getCont_prenom()." et ".$contacts[$pasEnsemble[1]]->getCont_nom()." ".$contacts[$pasEnsemble[1]]->getCont_prenom()." ne s'aiment pas !<BR>";
      }
      foreach ($tabEnsemble as $ensemble) {
        echo $contacts[$ensemble[0]]->getCont_nom()." ".$contacts[$ensemble[0]]->getCont_prenom()." et ".$contacts[$ensemble[1]]->getCont_nom()." ".$contacts[$ensemble[1]]->getCont_prenom()." s'aiment !<BR>";
      }
    }

    //----------------------------------------------------------------------------------------
    // fonction pour la fonctionnalité tables
    //----------------------------------------------------------------------------------------

/*
listTab_idM
listTab_id
listTab_nom
listTab_nbPlaces
*/

    function getTables($idM) {
      $req = $this->db->prepare('SELECT * FROM ListeTables WHERE listTab_idM = :idM');
      $req->execute(array(':idM' => $idM,));
      $donnee = $req->fetchAll(PDO::FETCH_CLASS, "tables");
      return $donnee;
    }

    function getTable($idM, $listTab_id) {
      $req = $this->db->prepare('SELECT * FROM ListeTables WHERE listTab_idM = :idM and listTab_id = :listTab_id');
      $req->execute(array(':idM' => $idM,
                          ':listTab_id' => $listTab_id,));
      $donnee = $req->fetchAll(PDO::FETCH_CLASS, "tables");
      return $donnee[0];
    }

    // supprime une table d'un mariage
    function delTable($idM, $listTab_id) {
      // On remplace par NULL les idTables des Contact associé a celle-ci
      try {
        $req = $this->db->prepare('UPDATE Contact SET cont_idT=NULL WHERE cont_idM=:cont_idM AND cont_idT=:cont_idT');
        $req->execute(array(':cont_idM' => $idM,
                            ':cont_idT' => $listTab_id));
      }
      catch (PDOException $e) {
        exit("Erreur suppression de table: ".$e->getMessage());
      }

      try {
        $req = $this->db->prepare('DELETE FROM ListeTables WHERE listTab_idM = :idM and listTab_id = :listTab_id');
        $req->execute(array(':idM' => $idM,
                            ':listTab_id' => $listTab_id,));
      }
      catch (PDOException $e) {
        exit("Erreur suppression de table: ".$e->getMessage());
      }
    }

    // insert une table à un mariage
    function setTable($table) {
      try {
        $req = $this->db->prepare('INSERT INTO ListeTables VALUES(:listTab_idM, :listTab_id, :listTab_nom, :listTab_nbPlaces)');
        $req->execute(array(':listTab_idM' => $table->getListTab_idM(),
                            ':listTab_id' => $table->getListTab_id(),
                            ':listTab_nom' => $table->getListTab_nom(),
                            ':listTab_nbPlaces' => $table->getListTab_nbPlaces()));
        return $this->db->lastInsertId(); //récupére l'identifiant de l'élément ajouté
                          }
      catch (PDOException $e) {
        exit("Erreur création nouvelle table: ".$e->getMessage());
      }
    }
    
    //----------------------------------------------------------------------------------------
    //----------------------------------------------------------------------------------------
    // fonction pour la fonctionnalité planning
    //----------------------------------------------------------------------------------------
    
    // fonction qui retourne les événements d'un mariage
    function getEvenements($idM){
	return null;
    }
}

?>
