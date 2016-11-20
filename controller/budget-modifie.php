<?php 

    require_once '../model/DAO.class.php';

    $budget = null; 
    if (isset($_GET['idbudget'])){
        
        if(isset($_GET['action']) && $_GET['action'] != "ajouter" && $_GET['action'] != "supprimer"){
            // initialisation de $budget avec la base de donnée
            
            $budget = $dao->getbudget($_GET['idbudget']);
            
            /*
            // pour un exemple car on a pas de bd pour le moment
            $budget['idbudget'] = $_GET['idbudget'];
            $budget['description'] = "une description";
            $budget['value'] = 1500;
            $budget['totaldepense'] = 1000;
            $budget['totalrest'] = 500;

            $depense['depdescription'] = "achat de chose";
            $depense['depvalue'] = 1000;

            $budget['tabdepense']['1100'] = $depense;
            // --------------------------------------
            */
            
        }
        
    }

    if (isset($_GET['action'])){
        
        // -----------------------------------------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------------------------------------
        if ($_GET['action'] == "supprimer"){
            // suppression dans la base de donnée de idbudget a faire
            $dao->supBudget($_GET['idbudget']);
            
        // -----------------------------------------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------------------------------------
        }else if ($_GET['action'] == "modifier" || $_GET['action'] == "ajouter"){
            // modification de l'affichage pour pouvoir modifier
            
            if ($_GET['action'] == "ajouter"){
                
                // creation d'un budget avec des valeurs par defaut
                $depenseobj = new depense($_GET['iddepense'], $_GET['idbudget'], "description", 0);
                $tabdepense[$_GET['iddepense']] = $depenseobj;
                $budget = new budget($_GET['idbudget'], $_GET['idmariage'], "description", 0, $tabdepense)
                
                ?> <div id="<?= $_GET['idbudget'] ?>" class="row-margin budget col-sm-4 col-sm-offset-1 col-sm-push-1">
            <?php } ?>
            

            <!-- La vue pour modifier -->
            <form id="form<?= $budget->getId() ?>" method="post" action="budget-modifie.php?idbudget=<?= $budget->getId() ?>&action=valider">

                <div class="row col-sm-12">
                    <p><input name="description" type="text" value="<?= $budget->getDescription() ?>"> : <input name="value" type="number" min="0" value="<?= $budget->getValue() ?>"> €</p>
                </div>

                <table class="row scroll form-control">
                    <tr class="row"><th class="col-sm-12"></th><th class="col-sm-12 text-center">Description</th><th class="col-sm-12 text-right">Prix</th></tr>
                    <?php 
                        $tabdepense = $budget->getTabdepense(); 
                        if ($tabdepense != null){
                            foreach ($tabdepense as $iddepense => $depense) { 
                    ?>
                    <tr id="<?= $iddepense ?>" class="row"><td><p class="btn btn-danger" onclick="supp('<?= $iddepense ?>')"> X </p></td><td><input name="<?= $iddepense ?>depdescription" type="text" value="<?= $depense->getDescription() ?>"></td><td><input name="<?= $iddepense ?>depvalue" type="number" min="0" value="<?= $depense->getValue() ?>"></td></tr>
                    <?php }} ?>
                    <tr id="idadd<?= $budget->getId() ?>" class="row"></td><td><td><p class="col-sm-5 col-sm-offset-3 btn btn-success" onclick="add('<?= $budget->getId() ?>')">new</p></td><td></td></tr>
                </table>
                
                <div class="row bouton-margin">
                    <p onclick="annuler('<?= $budget->getId() ?>', '<?= $budget->getIdMariage() ?>')" name="action" value="annuler" class="col-sm-4 col-sm-offset-1 btn btn-primary">Annuler</p>
                    <p onclick="valider('<?= $budget->getId() ?>', '<?= $budget->getIdMariage() ?>')" name="action" value="valider" class="col-sm-4 col-sm-offset-1 btn btn-primary">Valider</p>
                </div>
 
            </form>

<?php 
            if ($_GET['action'] == "ajouter"){
                ?> </div> <?php
            }
            
        // -----------------------------------------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------------------------------------
        }else if ($_GET['action'] == "annuler" || $_GET['action'] == "valider"){
            // modification de l'affichage pour empcher la modification
            
            if ($_GET['action'] == "valider"){
            // enregistrement dans la base de donnée des modifications
            // si idbudget n'existe pas dans la base, il faut creer un nouveau budget dans la base
                $tabdepense = null;
                foreach ($_POST as $name => $value) {
                    if (strripos($name, "depdescription") != false){ // si c'est une description de dépense
                        $tabdepense[str_replace("depdescription", "", $name)]['depdescription'] = $value;
                    }else if (strripos($name, "depvalue") != false){ // si c'est une valeur de depense
                        $tabdepense[str_replace("depvalue", "", $name)]['depvalue'] = $value;
                    }
                }
                
                // creation de objets depenses
                if ($tabdepense != null){
                    foreach ($tabdepense as $id => $depense) {
                        $tabdepense[$id] = new depense($id, $_GET['idbudget'], $depense['depdescription'], $depense['depvalue']);
                    }
                }
                
                $budget = new budget($_GET['idbudget'], $_GET['idmariage'], $_POST['description'], $_POST['value'], $tabdepense);
                
                // mise à jour de la base de donnée
                $dao->updateBudget($budget);
                
                // re récuparation de l'obget avec les vrais attributs id
                $budget = $dao->getLastBudget($_GET['idmariage']);
                ?> <?= $budget->getId() ?> <?php
            }
            
            if ($budget != null){
                
?>
            
                <div class="row col-sm-12">
                    <p><?= $budget->getDescription() ?> : <?= $budget->getValue() ?> €</p>
                </div>
                <table class="row scroll form-control">
                    <tr class="row"><th class="col-sm-12 text-center">Description</th><th class="col-sm-12">Prix</th></tr>
                    <?php
                        $tabdepense = $budget->getTabdepense();
                        if ($tabdepense != null){
                            foreach ($tabdepense as $id => $depense) {
                    ?>
                    <tr class="row"><td><?= $depense->getDescription() ?></td><td class="text-right"><?= $depense->getValue() ?> €</td></tr>
                    <?php
                        }}
                    ?>
                </table>
                <table class="row table-margin col-sm-10">
                    <tr class="row"><td class="text-center">Total dépensé</td><td class="text-right"><?= $budget->getTotalDepense() ?> €</td></tr>
                    <tr class="row"><td class="text-center">Budget restant</td><td class="text-right"><?= $budget->getTotalRest() ?> €</td></tr>
                </table>
                <div class="row">                    
                    <button class="col-sm-4 col-sm-offset-1 btn btn-primary" onClick="confirmation('<?= $budget->getId() ?>', '<?= $budget->getIdMariage() ?>')">Supprimer</button>
                    <button class="col-sm-4 col-sm-offset-1 btn btn-primary" onclick="afficheModif('<?= $budget->getId() ?>', '<?= $budget->getIdMariage() ?>')">Modifier</button>
                </div>
            
<?php

            } 
        }
    }
    
?> 