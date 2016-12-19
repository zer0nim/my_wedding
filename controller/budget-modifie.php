<?php 

include_once('session_create.ctrl.php');
require_once '../model/DAO.class.php';

if (!isset($_SESSION['idM'])){
	// si l'utilisateur n'est pas connecté, on ne fait pas son action
}else{
        
    if(isset($_POST['action'])){
                
        $idmariage = $_SESSION['idM'];
        $action = $_POST['action'];

        if ($action == "supprimer"){
            // suppression dans la base de donnée de idbudget
			$idbudget = $_POST['idbudget'];
            $dao->supBudget($idbudget, $idmariage);
            
        }else if ($action == "updatebudgetglobal"){
            // mise à jour du budget global
            $dao->updateBudgetGlobal($idmariage, $_POST['value']);
            
        }else if ($action == "annuler" || $action == "valider"){
            
            $idbudget = $_POST['idbudget'];
            
            if ($action == "valider"){
            // enregistrement dans la base de donnée des modifications
            // si idbudget n'existe pas dans la base, il faut creer un nouveau budget dans la base
                $tabdepense = null;
                
                // recuperation des données du formulaire
                foreach ($_POST as $name => $value) {
                    if (strripos($name, "depdescription") == true){ // si c'est une description de dépense
						$tabdepense[substr_replace(str_replace("depdescription", "", $name), "", 0, strlen(strval($idbudget)))]['depdescription'] = $value;
                    }else if (strripos($name, "depvalue") == true){ // si c'est une valeur de depense
                        if ($value == null){
                            $tabdepense[substr_replace(str_replace("depvalue", "", $name), "", 0, strlen(strval($idbudget)))]['depvalue'] = 0;
                        }else{
							$id = substr_replace(str_replace("depvalue", "", $name), "", 0, strlen(strval($idbudget)));
							if ($value < 0){
								$tabdepense[$id]['depvalue'] = 0;
							}else if ($value > 2000000000){
								$tabdepense[$id]['depvalue'] = 2000000000;
							}else{
								$tabdepense[$id]['depvalue'] = $value;
							}
                        }
                    }
                }
                
                // creation de objets depenses
                if ($tabdepense != null){
                    foreach ($tabdepense as $id => $depense) {
                        $tabdepense[$id] = new depense($id, $depense['depdescription'], $depense['depvalue']);
                    }
                }
                
                $budget = new budget($idbudget, $_POST['description'], $_POST['value'], $tabdepense);
                
                // mise à jour de la base de donnée
                // et de l'objet avec le nouvelle id
                $dao->updateBudget($budget, $idmariage);
                $idbudget = $budget->getId();
				
                // affichage du nouvelle id car il faut le communiquer
                // a la page web client en cas de création d'un nouveau budget.
                // il est récupéré par javascript
                ?> <?= $budget->getId() ?> <?php
                
            }else{
                $budget = $dao->getbudget($idbudget, $idmariage);
            }
            
            if ($budget != null){
                
?>
            
                <div class="row">
                    <p><b id="description<?= $idbudget ?>"><?= $budget->getDescription() ?></b> : <b id="value<?= $idbudget ?>"><?= $budget->getValue() ?></b> €</p>
                </div>
                <table id="tab<?= $idbudget ?>" class="row scroll form-control">
                    <tr class="row"><th class="champ-description-depense col-md-12 text-center">Description</th><th class="col-md-12 champ-description-depense">Prix</th></tr>
                    <?php
                    $tabdepense = $budget->getTabdepense();
                    if ($tabdepense != null){
                        foreach ($tabdepense as $depense) {
                            ?>
                            <tr id="dep<?= $idbudget ?><?= $depense->getId() ?>" class="depense<?= $idbudget ?> row"><td class="border-depense"><?= $depense->getDescription() ?></td><td class="border-depense text-right"><?= $depense->getValue() ?> €</td></tr>
                            <?php
                        }
                    }
                    ?>
                </table>
                <div class="row table-margin">
                    <p class="row no-margin">Total dépensé : <b id="totaldepense<?= $idbudget ?>" class="text-right"><?= $budget->getTotalDepense() ?></b> €</p>
                    <p class="row no-margin">Budget restant : <b id="totalrestant<?= $idbudget ?>" class="totalrestant text-right"><?= $budget->getTotalRest() ?></b> €</p>
                </div>
                <div class="row">
                    <button class="btn-d col-xs-5 col-xs-offset-1 btn btn-primary" onClick="supprimer('<?= $idbudget ?>')">Supprimer</button>
                    <button class="btn-d col-xs-5 btn btn-primary" onclick="modifier('<?= $idbudget ?>')">Modifier</button>
                </div>
            
<?php

            } 
        }
    }
}
    
?> 