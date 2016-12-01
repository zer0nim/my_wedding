<?php 

    require_once '../model/DAO.class.php';
        
    if(isset($_POST['action'])){
                
        $idbudget = $_POST['idbudget'];
        $idmariage = $_POST['idmariage'];
        $action = $_POST['action'];

        if ($action == "supprimer"){
            // suppression dans la base de donnée de idbudget
            $dao->supBudget($idbudget);
            
        }else if ($action == "annuler" || $action == "valider"){
            
            if ($action == "valider"){
            // enregistrement dans la base de donnée des modifications
            // si idbudget n'existe pas dans la base, il faut creer un nouveau budget dans la base
                $tabdepense = null;
                
                // recuperation des données du formulaire
                foreach ($_POST as $name => $value) {
                    if (strripos($name, "depdescription") != false){ // si c'est une description de dépense
                        $tabdepense[str_replace("depdescription", "", $name)]['depdescription'] = $value;
                    }else if (strripos($name, "depvalue") != false){ // si c'est une valeur de depense
                        if ($value == null){
                            $tabdepense[str_replace("depvalue", "", $name)]['depvalue'] = 0;
                        }else{
                            $tabdepense[str_replace("depvalue", "", $name)]['depvalue'] = $value;
                        }
                    }
                }
                
                // creation de objets depenses
                if ($tabdepense != null){
                    foreach ($tabdepense as $id => $depense) {
                        $depenseobj = new depense($id, $depense['depdescription'], $depense['depvalue']);
                        $tabdepense[$id] = $depenseobj;
                    }
                }
                
                $budget = new budget($idbudget, $idmariage, $_POST['description'], $_POST['value'], $tabdepense);
                
                // mise à jour de la base de donnée
                // et de l'objet avec le nouvelle id
                $idbudget = $dao->updateBudget($budget);
                $budget->setId($idbudget);
                
                // affichage du nouvelle id car il faut le communiquer
                // a la page web client en cas de création d'un nouveau budget.
                // il est récupéré par javascript
                ?> <?= $budget->getId() ?> <?php
                
            }else{
                $budget = $dao->getbudget($idbudget);
            }
            
            if ($budget != null){
                
?>
            
                <div class="row col-sm-12">
                    <p><b id="description<?= $idbudget ?>"><?= $budget->getDescription() ?></b> : <b id="value<?= $idbudget ?>"><?= $budget->getValue() ?></b> €</p>
                </div>
                <table id="tab<?= $idbudget ?>" class="row scroll form-control">
                    <tr class="row"><th class="champ-description-depense col-sm-12 text-center">Description</th><th class="col-sm-12">Prix</th></tr>
                    <?php
                    $tabdepense = $budget->getTabdepense();
                    if ($tabdepense != null){
                        foreach ($tabdepense as $depense) {
                            ?>
                            <tr id="dep<?= $depense->getId() ?>" class="depense<?= $idbudget ?> row"><td><?= $depense->getDescription() ?></td><td class="text-right"><?= $depense->getValue() ?> €</td></tr>
                            <?php
                        }
                    }
                    ?>
                </table>
                <table class="row table-margin col-sm-10">
                    <tr class="row"><td class="text-center">Total dépensé : </td><td id="totaldepense<?= $idbudget ?>" class="text-right"><?= $budget->getTotalDepense() ?> €</td><td></td></tr>
                    <tr class="row"><td class="text-center">Budget restant : </td><td class="text-right"><?= $budget->getTotalRest() ?> €</td><td></td></tr>
                </table>
                <div class="row">
                    <button class="btn-d col-sm-5 col-sm-offset-1 btn btn-primary" onClick="supprimer('<?= $idbudget ?>', '<?= $budget->getIdMariage() ?>')">Supprimer</button>
                    <button class="btn-d col-sm-5 btn btn-primary" onclick="modifier('<?= $idbudget ?>', '<?= $budget->getIdMariage() ?>')">Modifier</button>
                </div>
            
<?php

            } 
        }
    }
    
?> 