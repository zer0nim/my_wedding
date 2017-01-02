<?php

require_once '../model/budget.class.php';
require_once '../model/depense.class.php';
require_once '../model/contacts.class.php';
require_once '../model/tables.class.php';
require_once '../model/evenement.class.php';
require_once '../model/photo.class.php';
require_once '../model/note.class.php';
require_once '../model/lien.class.php';
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
      $req = $this->db->prepare('SELECT * FROM ListeSouhaits WHERE ListSouh_idM = :idM ORDER BY ListSouh_preference');
      $req->execute(array(':idM' => $idM,));
      while ($donnee = $req->fetch()) {
        $data[] = array('nom' => $donnee['ListSouh_nom'],
                        'preference' => $donnee['ListSouh_preference'],);
      }
      return $data;
    }

    // supprime les souhait d'un mariage
    function delListeSouhait($idM, $nom) {
      $req = $this->db->prepare('DELETE FROM ListeSouhaits WHERE ListSouh_idM = :idM AND ListSouh_nom = :ListSouh_nom');
      $req->execute(array(':idM' => $idM,
                          ':ListSouh_nom' => $nom,));
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
        var_dump($liste);
        $req = $this->db->prepare('INSERT INTO ListeSouhaits VALUES(:idM, :nom, :preference)');
        $req->execute(array(':idM' => $idM,
                            ':nom' => $value,
                            ':preference' => $preference,));
        $preference++;
      }
    }

    // écris un élément dans la liste de souhait d'un mariage
    function addListeSouhait($idM, $elem) {
      $req = $this->db->prepare('SELECT max(ListSouh_preference) AS ListSouh_preference FROM ListeSouhaits WHERE ListSouh_idM = :idM');
      $req->execute(array(':idM' => $idM, ));
      $donnee = $req->fetch();

      $preference = $donnee['ListSouh_preference'] + 1;

      $req = $this->db->prepare('INSERT INTO ListeSouhaits VALUES(:idM, :nom, :preference)');
      $req->execute(array(':idM' => $idM,
                          ':nom' => $elem,
                          ':preference' => $preference,));
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

    function getMaries($idM,$nomF,$prenomF,$nomH,$prenomH) {
      $req = $this->db->prepare('SELECT * FROM Contact WHERE cont_idM = :idM and cont_nom=:nomF or cont_nom=:nomH and cont_prenom=:prenomF or cont_prenom=:prenomH');
      $req->execute(array(':idM' => $idM,
                          ':nomF' => $nomF,
                          ':prenomF' => $prenomF,
                          ':nomH' => $nomH,
                          ':prenomH' => $prenomH));
      $donnee = $req->fetchAll(PDO::FETCH_CLASS, "contacts");
      return $donnee;
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
        $req = $this->db->prepare('SELECT cont_id, cont_nom, cont_prenom FROM Contact WHERE cont_idM = :cont_idM AND cont_nom = :cont_nom AND cont_prenom = :cont_prenom AND cont_mail = :cont_mail');
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

    //attribué une table à un contact
    function setTableToContact($table, $contact) {
      try {
        $req = $this->db->prepare('UPDATE Contact SET cont_idT = :idTable WHERE cont_idM = :cont_idM AND cont_id = :idContact');
        $req->execute(array(':cont_idM' => $contact->getCont_idM(),
                           ':idTable' => $table->getListTab_id(),
                           ':idContact' => $contact->getCont_id()));
      }
      catch (PDOException $e) {
        exit("Erreur d'attribution d'une table à un contact: ".$e->getMessage());
      }
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

      try {
        $nbPlace = $this->db->prepare('Select numplace From V_NbPlaceParMariage Where idM = :idMariage');
        $nbPlace->execute(array(':idMariage' => $idMariage));
        $nbPlace = $nbPlace->fetch();
        $nbPlace = $nbPlace[0];
        //$nbPlace contient le nombre de place disponible pour ce mariage
      }
      catch (PDOException $e) {
        exit("Erreur de req sql placement -> nbPlace : ".$e->getMessage());
      }

      try {
        $req = $this->db->prepare('
        Select listTab_id, listTab_nbPlaces - (Select count(*)
                                   From Contact
                                   Where cont_idT = L.listTab_id) as nbPlaceRestante
        From ListeTables L
        Where listTab_idM = :idMariage');

        $req->execute(array(':idMariage' => $idMariage));
        $donnees = $req->fetchAll();
        foreach ($donnees as $donnee) {
          $nbPlaceRestante[$donnee[0]] = $donnee[1];
        }
        //$nbPlaceRestante contient le nombre de place restante par table
      }
      catch (PDOException $e) {
        exit("Erreur de req sql placement -> nbPlaceRestante : ".$e->getMessage());
      }

      $contacts = $this->getContactsIndiceParId($idMariage);
      //$contacts contient la liste des invités du mariage
      $tables = $this->getTablesIndiceParId($idMariage);
      //$tables contient la liste des tables du mariage

      if ($nbPlace < count($contacts)) {
        echo "Pas assez de place disponible...<BR>";
        echo "Il manque ".(count($contacts)-$nbPlace)." places.<BR>";
        echo "Pensez à rajouter des tables !<BR>";
      }
      else {

        //$this->setTableToContact($table, $contact);
        foreach ($tables as $table) {
          echo $table->getListTab_id()." ".$table->getListTab_nom()."<BR>";
          $suiv = current($tables);
          if ($suiv !== false) {
            echo "Prochaine table : ".$suiv->getListTab_id()."<BR>";
            $suiv = next($tables);
          }
          else {
            echo "Dernière table !<BR>";
          }
        }
        foreach ($tabPasEnsemble as $pasEnsemble) {
          echo $contacts[$pasEnsemble[0]]->getCont_nom()." ".$contacts[$pasEnsemble[0]]->getCont_prenom()." et ".$contacts[$pasEnsemble[1]]->getCont_nom()." ".$contacts[$pasEnsemble[1]]->getCont_prenom()." ne s'aiment pas !<BR>";
        }
        echo "<BR>";
        foreach ($tabEnsemble as $ensemble) {
          echo $contacts[$ensemble[0]]->getCont_nom()." ".$contacts[$ensemble[0]]->getCont_prenom()." et ".$contacts[$ensemble[1]]->getCont_nom()." ".$contacts[$ensemble[1]]->getCont_prenom()." s'aiment !<BR>";
        }
      }
    }


    //----------------------------------------------------------------------------------------
    // fonction pour la fonctionnalité inspiration
    //----------------------------------------------------------------------------------------

// Photo -> pict_id, pict_idM, pict_date, pict_title, pict_adress, pict_descr
/*
AND link_isInsprtn = :link_isInsprtn
':link_isInsprtn' => $isInsp,
*/
    function getPhotos($idM, $isInsp) {
      try {
        $req = $this->db->prepare('SELECT * FROM Photo WHERE pict_idM = :idM AND pict_isInsprtn = :pict_isInsprtn');
        $req->execute(array(':idM' => $idM,
                            ':pict_isInsprtn' => $isInsp,));
        $donnee = $req->fetchAll(PDO::FETCH_CLASS, "photo");
      }
      catch (PDOException $e) {
        exit("Erreur recupération des photos: ".$e->getMessage());
      }
      return $donnee;
    }

    function getPhoto($idM, $pict_id, $isInsp) {
      try {
        $req = $this->db->prepare('SELECT * FROM Photo WHERE pict_idM = :idM and pict_id = :pict_id');
        $req->execute(array(':idM' => $idM,
                            ':pict_id' => $pict_id,));
        $donnee = $req->fetchAll(PDO::FETCH_CLASS, "photo");
      }
      catch (PDOException $e) {
        exit("Erreur recupération de la photo: ".$e->getMessage());
      }
      return $donnee[0];
    }

    function delPhoto($idM, $pict_id) {
      try {
        $req = $this->db->prepare('DELETE FROM Photo WHERE pict_idM = :idM and pict_id = :pict_id');
        $req->execute(array(':idM' => $idM,
                            ':pict_id' => $pict_id,));
      }
      catch (PDOException $e) {
        exit("Erreur suppression de photo: ".$e->getMessage());
      }
    }

    function setPhoto($photo, $isInsp) {
      try {
        $req = $this->db->prepare('INSERT INTO Photo VALUES(:pict_id, :pict_idM,  NOW(), :pict_title, :pict_format, :pict_descr, :pict_isInsprtn)');
        $req->execute(array(':pict_id' => $photo->getPict_id(),
                            ':pict_idM' => $photo->getPict_idM(),
                            ':pict_title' => $photo->getPict_title(),
                            ':pict_format' => $photo->getPict_format(),
                            ':pict_descr' => $photo->getPict_descr(),
                            ':pict_isInsprtn' => $isInsp,));
                            $date = new DateTime();
                            $date->setTimezone(new DateTimeZone('Europe/Berlin'));
                            $idDate['id'] = $this->db->lastInsertId(); //récupére l'identifiant de l'élément ajouté
                            $idDate['date'] = $date->format('Y-m-d H:i:s');
                            return($idDate);
                          }
      catch (PDOException $e) {
        exit("Erreur création nouvelle photo: ".$e->getMessage());
      }
    }

    function modifyPhoto($photo) {
      try {
        $req = $this->db->prepare('UPDATE Photo SET pict_title = :pict_title, pict_descr = :pict_descr, pict_format = :pict_format WHERE pict_idM = :pict_idM AND pict_id = :pict_id');
        $req->execute(array(':pict_id' => $photo->getPict_id(),
                            ':pict_idM' => $photo->getPict_idM(),
                            ':pict_title' => $photo->getPict_title(),
                            ':pict_format' => $photo->getPict_format(),
                            ':pict_descr' => $photo->getPict_descr()));
                          }
      catch (PDOException $e) {
        exit("Erreur création nouvelle photo: ".$e->getMessage());
      }
    }

    // Note ->  note_id, note_idM, note_date, note_title, note_text

        function getNotes($idM, $isInsp) {
          try {
            $req = $this->db->prepare('SELECT * FROM Note WHERE note_idM = :idM AND note_isInsprtn = :note_isInsprtn');
            $req->execute(array(':idM' => $idM,
                                ':note_isInsprtn' => $isInsp,));
            $donnee = $req->fetchAll(PDO::FETCH_CLASS, "note");
          }
          catch (PDOException $e) {
            exit("Erreur recupération des notes: ".$e->getMessage());
          }
          return $donnee;
        }

        function getNote($idM, $note_id) {
          try {
            $req = $this->db->prepare('SELECT * FROM Note WHERE note_idM = :idM and note_id = :note_id');
            $req->execute(array(':idM' => $idM,
                                ':note_id' => $note_id,));
            $donnee = $req->fetchAll(PDO::FETCH_CLASS, "note");
          }
          catch (PDOException $e) {
            exit("Erreur recupération de la note: ".$e->getMessage());
          }
          return $donnee[0];
        }

        function delNote($idM, $note_id) {
          try {
            $req = $this->db->prepare('DELETE FROM Note WHERE note_idM = :idM and note_id = :note_id');
            $req->execute(array(':idM' => $idM,
                                ':note_id' => $note_id,));
          }
          catch (PDOException $e) {
            exit("Erreur suppression de note: ".$e->getMessage());
          }
        }

        function setNote($note, $isInsp) {
          try {
            $req = $this->db->prepare('INSERT INTO Note VALUES(:note_id, :note_idM,  NOW(), :note_title, :note_text, :note_isInsprtn)');
            $req->execute(array(':note_id' => $note->getNote_id(),
                                ':note_idM' => $note->getNote_idM(),
                                ':note_title' => $note->getNote_title(),
                                ':note_text' => $note->getNote_text(),
                                ':note_isInsprtn' => $isInsp,));
                                $date = new DateTime();
                                $date->setTimezone(new DateTimeZone('Europe/Berlin'));
                                $idDate['id'] = $this->db->lastInsertId(); //récupére l'identifiant de l'élément ajouté
                                $idDate['date'] = $date->format('Y-m-d H:i:s');
                                return($idDate);
                              }
          catch (PDOException $e) {
            exit("Erreur création nouvelle photo: ".$e->getMessage());
          }
        }

        function modifyNote($note) {
          try {
            $req = $this->db->prepare('UPDATE Note SET note_title = :note_title, note_text = :note_text WHERE note_idM = :note_idM AND note_id = :note_id');
            $req->execute(array(':note_id' => $note->getNote_id(),
                                ':note_idM' => $note->getNote_idM(),
                                ':note_title' => $note->getNote_title(),
                                ':note_text' => $note->getNote_text()));
                              }
          catch (PDOException $e) {
            exit("Erreur création nouvelle photo: ".$e->getMessage());
          }
        }

    // Lien ->  link_id, link_idM, link_date, link_adress, link_descr

    function getLiens($idM, $isInsp) {
      try {
        $req = $this->db->prepare('SELECT * FROM Lien WHERE link_idM = :idM AND link_isInsprtn = :link_isInsprtn');
        $req->execute(array(':idM' => $idM,
                            ':link_isInsprtn' => $isInsp,));
        $donnee = $req->fetchAll(PDO::FETCH_CLASS, "lien");
      }
      catch (PDOException $e) {
        exit("Erreur recupération des liens: ".$e->getMessage());
      }
      return $donnee;
    }

    function getLien($idM, $link_id) {
      try {
        $req = $this->db->prepare('SELECT * FROM Lien WHERE link_idM = :idM and link_id = :link_id');
        $req->execute(array(':idM' => $idM,
                            ':link_id' => $link_id,));
        $donnee = $req->fetchAll(PDO::FETCH_CLASS, "lien");
      }
      catch (PDOException $e) {
        exit("Erreur recupération du lien: ".$e->getMessage());
      }
      return $donnee[0];
    }

    function delLien($idM, $link_id) {
      try {
        $req = $this->db->prepare('DELETE FROM Lien WHERE link_idM = :idM and link_id = :link_id');
        $req->execute(array(':idM' => $idM,
                            ':link_id' => $link_id,));
      }
      catch (PDOException $e) {
        exit("Erreur suppression de lien: ".$e->getMessage());
      }
    }

    function setLien($lien, $isInsp) {
      try {
        $req = $this->db->prepare('INSERT INTO Lien VALUES(:link_id, :link_idM, NOW(), :link_adress, :link_descr, :link_isInsprtn)');
        $req->execute(array(':link_id' => $lien->getLink_id(),
                            ':link_idM' => $lien->getLink_idM(),
                            ':link_adress' => $lien->getLink_adress(),
                            ':link_descr' => $lien->getLink_descr(),
                            ':link_isInsprtn' => $isInsp,));
                            $date = new DateTime();
                            $date->setTimezone(new DateTimeZone('Europe/Berlin'));
                            $idDate['id'] = $this->db->lastInsertId(); //récupére l'identifiant de l'élément ajouté
                            $idDate['date'] = $date->format('Y-m-d H:i:s');
                            return($idDate);
                          }
      catch (PDOException $e) {
        exit("Erreur création nouveau lien: ".$e->getMessage());
      }
    }

    function modifyLien($lien) {
      try {
        $req = $this->db->prepare('UPDATE Lien SET link_adress = :link_adress, link_descr = :link_descr WHERE link_idM = :link_idM AND link_id = :link_id');
        $req->execute(array(':link_id' => $lien->getLink_id(),
                            ':link_idM' => $lien->getLink_idM(),
                            ':link_adress' => $lien->getLink_adress(),
                            ':link_descr' => $lien->getLink_descr()));
                          }
      catch (PDOException $e) {
        exit("Erreur modification du lien: ".$e->getMessage());
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

    function getTablesIndiceParId($idM) {
      $req = $this->db->prepare('SELECT * FROM ListeTables WHERE listTab_idM = :idM');
      $req->execute(array(':idM' => $idM,));
      $donnees = $req->fetchAll(PDO::FETCH_CLASS, "tables");
      foreach ($donnees as $donnee) {
        $listTables[$donnee->getListTab_id()] = $donnee;
      }
      return $listTables;
    }

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

    // modifie le nom d'une table d'un mariage
    function updateTableNom($table) {
      try {
        $req = $this->db->prepare('UPDATE ListeTables SET listTab_nom = :listTab_nom WHERE listTab_idM = :listTab_idM AND listTab_id = :listTab_id');
        $req->execute(array(':listTab_idM' => $table->getListTab_idM(),
                            ':listTab_id' => $table->getListTab_id(),
                            ':listTab_nom' => $table->getListTab_nom()));
                          }
      catch (PDOException $e) {
        exit("Erreur modification table: ".$e->getMessage());
      }
    }
    // modifie le nombre de place d'une table d'un mariage
    function updateTablePlaces($table) {
      try {
        $req = $this->db->prepare('UPDATE ListeTables SET listTab_nbPlaces = :listTab_nbPlaces WHERE listTab_idM = :listTab_idM AND listTab_id = :listTab_id');
        $req->execute(array(':listTab_idM' => $table->getListTab_idM(),
                            ':listTab_id' => $table->getListTab_id(),
                            ':listTab_nbPlaces' => $table->getListTab_nbPlaces()));
                          }
      catch (PDOException $e) {
        exit("Erreur modification table: ".$e->getMessage());
      }
    }

    // reinitialise la table attribué a un contact
    function updCntTable($cntIdM, $cntId, $numT) {
        $req = $this->db->prepare('UPDATE Contact SET cont_idT=:cont_idT WHERE cont_idM=:cont_idM AND cont_id=:cont_id');
        $req->execute(array(':cont_id' => $cntId,
                            ':cont_idM' => $cntIdM,
                            ':cont_idT' => $numT,));
    }

    //----------------------------------------------------------------------------------------
    // fonction pour la fonctionnalité planning
    //----------------------------------------------------------------------------------------

    // fonction qui retourne l'id du dernier événement du mariage
    function getLastIdEvenement($idM){
		try {
			$req = $this->db->prepare('SELECT max(plan_id) FROM Planning WHERE plan_idM = :idM');
			$req->execute(array(':idM' => $idM));
		}catch (PDOException $e) {
			exit("Erreur geLastId : ".$e->getMessage());
		}

		$resultat = $req->fetch()[0];
		if ($resultat != null){
			return $resultat;
		}else{
			return 0;
		}

    }

    // fonction qui retourne les événements d'un mariage
    function getEvenements($idM){
		try {
			$req = $this->db->prepare('SELECT * FROM Planning WHERE plan_idM = :idM');
			$req->execute(array(':idM' => $idM));
		}catch (PDOException $e) {
			exit("Erreur geEvenements : ".$e->getMessage());
		}

		$resultat = $req->fetchAll(PDO::FETCH_ASSOC);
		$tabEvenements = null;

		if ($resultat != null){
			foreach ($resultat as $evenement) {
				$tabEvenements[] = new evenement($evenement['plan_id'], $evenement['plan_description'], $evenement['plan_start'], $evenement['plan_end']);
			}
		}

		return $tabEvenements;

    }

    // fonction pour ajouter un évenement
    function addEvenement($evenement, $idM){
		try {
			$req = $this->db->prepare('insert INTO Planning values(:id, :idM, :description, :start, :end)');
			$req->execute(array(':idM' => $idM, ':id' => $evenement->getId(), ':description' => $evenement->getDescription(), ':start' => $evenement->getStart()->format('Y-m-d H:i:s'), ':end' => $evenement->getEnd()->format('Y-m-d H:i:s')));
		}catch (PDOException $e) {
			exit("Erreur addEvenements : ".$e->getMessage());
		}
    }

    // fonction pour supprimer un évenement
    function delEvenement($idevenement, $idM){
		try {
			$req = $this->db->prepare('delete FROM Planning WHERE plan_idM = :idM and plan_id = :id');
			$req->execute(array(':idM' => $idM, ':id' => $idevenement));
		}catch (PDOException $e) {
			exit("Erreur delEvenements : ".$e->getMessage());
		}
    }

    // fonction pour mettre à jour un évenement
    function updateEvenement($evenement, $idM){
		try {
			$req = $this->db->prepare('update Planning set plan_description = :description, plan_start = :start, plan_end = :end WHERE plan_idM = :idM and plan_id = :id');
			$req->execute(array(':idM' => $idM, ':id' => $evenement->getId(), ':description' => $evenement->getDescription(), ':start' => $evenement->getStart()->format('Y-m-d H:i:s'), ':end' => $evenement->getEnd()->format('Y-m-d H:i:s')));
		}catch (PDOException $e) {
			exit("Erreur updateEvenements : ".$e->getMessage());
		}
    }


    //----------------------------------------------------------------------------------------
    // fonction pour la fonctionnalité Mon compte
    //----------------------------------------------------------------------------------------
    //GETTERS POUR LE COMPTE
    function getMdpAccount($idA){
      try {
        $req = $this->db->prepare('SELECT acc_mdp FROM Account WHERE acc_id = :idA');
        $req->execute(array(':idA' => $idA));
        $req=$req->fetch();
        $req=$req[0];
        return $req;
      }catch (PDOException $e) {
        exit("Erreur getter du mdp du compte: ".$e->getMessage());
      }
    }

    function getMailAccount($idA){
      try {
        $req = $this->db->prepare('SELECT acc_mail FROM Account WHERE acc_id = :idA');
        $req->execute(array(':idA' => $idA));
        $req=$req->fetch();
        $req=$req[0];
        return $req;
      }catch (PDOException $e) {
        exit("Erreur getter du mail du compte: ".$e->getMessage());
      }
    }
    //fonction pour modifier le mot de passe
    function updateMdpAccount($idA, $newMdp){
      try {
        $req = $this->db->prepare('UPDATE Account SET acc_mdp = :mdp WHERE acc_id = :idA');
        $req->execute(array(':mdp' => $newMdp,
                            ':idA' => $idA));
      }catch (PDOException $e) {
        exit("Erreur modification du mdp du compte: ".$e->getMessage());
      }
    }

    //fonction pour modifier le mail
    function updateMailAccount($idA, $newMail){
      try {
        $req = $this->db->prepare('UPDATE Account SET acc_mail = :mail WHERE acc_id = :idA');
        $req->execute(array(':mail' => $newMail,
                            ':idA' => $idA));
      }catch (PDOException $e) {
        exit("Erreur modification du mail du compte: ".$e->getMessage());
      }
    }

    //----------------------------------------------------------------------------------------
    // fonction pour la fonctionnalité inscription et connexion
    //----------------------------------------------------------------------------------------
    function connexion($email,$mdp){
      try{
        $req = $this->db->prepare('SELECT acc_id FROM Account a WHERE acc_mail = :mail and acc_mdp= :mdp');
        $req->execute(array(':mail' => $email,
                              ':mdp'=> $mdp));
        $req=$req->fetch();
        //var_dump($req);
        $reponse[0]=$req[0];

        $req = $this->db->prepare('SELECT maria_id FROM Account a,Mariage m WHERE acc_mail = :mail and acc_mdp= :mdp and a.acc_id=m.maria_idAcc');
        $req->execute(array(':mail' => $email,
                              ':mdp'=> $mdp));
        $req=$req->fetch();
        //var_dump($req);
        $reponse[1]=$req[0];
        //var_dump($reponse);
        return $reponse;
      }catch(PDOException $e){
        exit("Erreur dans la fonction connexion: ".$e->getMessage());
      }
    }

    function inscription($email,$mdp){
      try{
        $req = $this->db->prepare('SELECT acc_mail FROM Account WHERE acc_mail = :mail');
        $req->execute(array(':mail' => $email));
        $req=$req->fetch();
        if($req[0] != NULL && $req[0]==$email){
          return 66;
        }else{
          $req = $this->db->prepare('INSERT INTO Account values(NULL, :mail, :mdp)');
          $req->execute(array(':mail' => $email,
                              ':mdp'=> $mdp));
        }
      }catch(PDOException $e){
        exit("Erreur dans la fonction inscription: ".$e->getMessage());
      }
    }

    //----------------------------------------------------------------------------------------
    // fonction pour la fonctionnalité de creation de mariage
    //----------------------------------------------------------------------------------------
    function getIdMariage($idaccount){
      try{
        $req = $this->db->prepare('SELECT maria_id FROM Mariage WHERE maria_idAcc = :acc');
        $req->execute(array(':acc' => $idaccount));
        $req=$req->fetch()[0];
        return $req;
      }catch(PDOException $e){
        exit("Erreur dans la fonction getIdMariage: ".$e->getMessage());
      }
    }

    function getMariage($idaccount){
      try{
        $req = $this->db->prepare('SELECT maria_date, maria_lieu, maria_nomF, maria_prenomF, maria_nomH, maria_prenomH FROM Mariage WHERE maria_idAcc = :acc');
        $req->execute(array(':acc' => $idaccount));
        $req=$req->fetch();
        if ($req != NULL) {
          $req['maria_date']=explode(' ',$req['maria_date'])[0];
          $req['maria_date']=explode('-',$req['maria_date']);
          $req['maria_date']=$req['maria_date'][2].'/'.$req['maria_date'][1].'/'.$req['maria_date'][0];
        }

        return $req;
      }catch(PDOException $e){
        exit("Erreur dans la fonction getMariage: ".$e->getMessage());
      }
    }

    function modifMariage($idacc,$nom1,$prenom1,$nom2,$prenom2,$date,$adresse){
      try {
        $req = $this->db->prepare('UPDATE Mariage SET maria_date=:dat, maria_lieu=:lieu, maria_nomF=:nom1, maria_prenomF=:prenom1, maria_nomH=:nom2, maria_prenomH=:prenom2 WHERE maria_idAcc = :acc');
        $req=$req->execute(array(':dat' => $date,
                            ':lieu' => $adresse,
                            ':nom1' => $nom1,
                            ':prenom1' => $prenom1,
                            ':nom2' => $nom2,
                            ':prenom2' => $prenom2,
                            ':acc' => $idacc));
        return $req;
      }catch (PDOException $e) {
        exit("Erreur modification dans la fonction modifMariage: ".$e->getMessage());
      }
    }

    function createMariage($idaccount,$nom1,$prenom1,$nom2,$prenom2,$date,$adresse){
      try{
        $req = $this->db->prepare('INSERT INTO Mariage values(NULL, :acc, :dat, :lieu, :nom1, :prenom1, :nom2, :prenom2,:description)');
        $req=$req->execute(array(
                            ':acc' => $idaccount,
                            ':dat' => $date,
                            ':lieu' => $adresse,
                            ':nom1' => $nom1,
                            ':prenom1' => $prenom1,
                            ':nom2' => $nom2,
                            ':prenom2' => $prenom2,
                            ':description' => ""));
        return $req;
      }catch(PDOException $e){
        exit("Erreur dans la fonction createMariage: ".$e->getMessage());
      }
    }

    //----------------------------------------------------------------------------------------
    // fonction pour la fonctionnalité de question de mariage
    //----------------------------------------------------------------------------------------

    function envoiquestion($idm,$nom,$question,$date){
      try{
        $req = $this->db->prepare('INSERT INTO Questions values(NULL, :idm, :nom, :question, :dat)');
        $req=$req->execute(array(
                            ':idm' => $idm,
                            ':nom' => $nom,
                            ':question' => $question,
                            ':dat' => $date));
        return $req;
      }catch(PDOException $e){
        exit("Erreur dans la fonction envoiquestion: ".$e->getMessage());
      }
    }

    function getquestions($idm){
      try{
        $req = $this->db->prepare('SELECT quest_nom, quest_question, quest_date FROM Questions WHERE quest_idm = :idm');
        $req->execute(array(':idm' => $idm));
        $req=$req->fetchAll();
        if ($req != NULL) {
          $nb=count($req);
          for ($i=0; $i < $nb; $i++) {
            $req[$i]['quest_date']=explode(' ',$req[$i]['quest_date']);
            $date=$req[$i]['quest_date'][0];
            $heure=$req[$i]['quest_date'][1];
            $date=explode('-',$date);
            $date=$date[2].'-'.$date[1].'-'.$date[0];
            $req[$i]['quest_date']=$date.' '.$heure;
          }
        }
        return $req;
      }catch(PDOException $e){
        exit("Erreur dans la fonction getquestions: ".$e->getMessage());
      }
    }

    //----------------------------------------------------------------------------------------
    // fonction pour recuperer l'id du mariage à partir du hash
    //----------------------------------------------------------------------------------------
    function getIdMariage_hash($hash){
      try{
        $req = $this->db->prepare('SELECT hashid_idM FROM Hashid WHERE hashid_hash=:hash');
        $req->execute(array(':hash' => $hash));
        $req=$req->fetch()[0];
        return $req;
      }catch(PDOException $e){
        exit("Erreur dans la fonction getIdMariage_hash: ".$e->getMessage());
      }
    }

    function insertHash($idM){
      try{
        $req = $this->db->prepare('INSERT INTO Hashid values(:idm, :hash)');
        $req=$req->execute(array(':idm' => $idM,
                                 ':hash' => sha1($idM)));
        return $req;
      }catch(PDOException $e){
        exit("Erreur dans la fonction insertHash: ".$e->getMessage());
      }
    }
  }

?>
