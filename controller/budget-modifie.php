<?php 

    require_once '../model/DAO.class.php';
    
    if(isset($_GET['action'])){

        $idbudget = $_GET['idbudget'];
        $idmariage = $_GET['idmariage'];
        $action = $_GET['action'];

        if($action == "annuler" || $action == "modifier"){
            // initialisation de $budget avec la base de donnée

            $budget = $dao->getbudget($idbudget);

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
                    
        // -----------------------------------------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------------------------------------
        if ($action == "supprimer"){
            // suppression dans la base de donnée de idbudget
            $dao->supBudget($idbudget);
            
        // -----------------------------------------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------------------------------------
        }else if ($action == "modifier" || $action == "ajouter"){
            // modification de l'affichage pour pouvoir modifier
            
            if ($action == "ajouter"){
                
                // creation d'un budget avec des valeurs par defaut
                $depenseobj = new depense();
                $depenseobj->setAll($_GET['iddepense'], $idbudget, "description", 0);
                $tabdepense[$_GET['iddepense']] = $depenseobj;
                $budget = new budget($idbudget, $idmariage, "description", 0, $tabdepense);
                
                ?> <div id="<?= $idbudget ?>" class="row-margin div-budget col-sm-5">
            <?php } ?>
            

            <!-- La vue pour modifier -->
            <form id="form<?= $budget->getId() ?>" method="post" action="budget-modifie.php?idbudget=<?= $idbudget ?>&action=valider">

                <div class="row col-sm-12">
                    <p><input class="champ-description" name="description" type="text" maxlength="35" value="<?= $budget->getDescription() ?>"> : <input class="champ-value" name="value" type="number" min="0" max="2000000000" value="<?= $budget->getValue() ?>"> €</p>
                </div>

                <table class="row scroll2 form-control">
                    <tr class="row"><th class=""></th><th class="champ-description-depense text-center">Description</th><th class="text-right">Prix</th></tr>
                    <?php 
                        $tabdepense = $budget->getTabdepense(); 
                        if ($tabdepense != null){
                            foreach ($tabdepense as $iddepense => $depense) { 
                    ?>
                    <tr id="<?= $iddepense ?>" class="row"><td><p class="btn btn-danger btn-sm" onclick="supp('<?= $iddepense ?>')"> X </p></td><td><input class="champ-description-depense" name="<?= $iddepense ?>depdescription" type="text" maxlength="50" value="<?= $depense->getDescription() ?>"></td><td><input class="champ-value" name="<?= $iddepense ?>depvalue" type="number" min="0" max="2000000000" value="<?= $depense->getValue() ?>"></td></tr>
                    <?php }} ?>
                    <tr id="idadd<?= $idbudget ?>" class="row"></td><td><td><p class="col-sm-5 col-sm-offset-3 btn btn-success" onclick="add('<?= $budget->getId() ?>')">new</p></td><td></td></tr>
                </table>
                
                <div class="row bouton-margin">
                    <p onclick="annuler('<?= $idbudget ?>', '<?= $idmariage ?>')" name="action" value="annuler" class="btn-d col-sm-5 col-sm-offset-1 btn btn-primary">Annuler</p>
                    <p onclick="valider('<?= $idbudget ?>', '<?= $idmariage ?>')" name="action" value="valider" class="btn-d col-sm-5 btn btn-primary">Valider</p>
                </div>
 
            </form>

<?php 
            if ($action == "ajouter"){
                ?> </div> <?php
            }
            
        // -----------------------------------------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------------------------------------
        }else if ($action == "annuler" || $action == "valider"){
            // modification de l'affichage pour empcher la modification
            
            if ($action == "valider"){
            // enregistrement dans la base de donnée des modifications
            // si idbudget n'existe pas dans la base, il faut creer un nouveau budget dans la base
                $tabdepense = null;
                
                // recuperation des données du formulaire
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
                        $depenseobj = new depense();
                        $depenseobj->setAll($id, $idbudget, $depense['depdescription'], $depense['depvalue']);
                        $tabdepense[$id] = $depenseobj;
                    }
                }
                
                $budget = new budget($idbudget, $idmariage, $_POST['description'], $_POST['value'], $tabdepense);
                
                // mise à jour de la base de donnée
                // et de l'objet avec le nouvelle id
                $budget->setId($dao->updateBudget($budget));
                
                // affichage du nouvelle id car il faut le communiquer
                // a la page web client en cas de création d'un nouveau budget.
                // il est récupéré par javascript
                ?> <?= $budget->getId() ?> <?php
            }
            
            if ($budget != null){
                
?>
            
                <div class="row col-sm-12">
                    <p><?= $budget->getDescription() ?> : <?= $budget->getValue() ?> €</p>
                </div>
                <table class="row scroll form-control">
                    <tr class="row"><th class="champ-description-depense col-sm-12 text-center">Description</th><th class="col-sm-12">Prix</th></tr>
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
                    <tr class="row"><td class="text-center">Total dépensé : </td><td class="text-right"><?= $budget->getTotalDepense() ?> €</td></tr>
                    <tr class="row"><td class="text-center">Budget restant : </td><td class="text-right"><?= $budget->getTotalRest() ?> €</td></tr>
                </table>
                <div class="row">                    
                    <button class="btn-d col-sm-5 col-sm-offset-1 btn btn-primary" onClick="confirmation('<?= $budget->getId() ?>', '<?= $budget->getIdMariage() ?>')">Supprimer</button>
                    <button class="btn-d col-sm-5 btn btn-primary" onclick="afficheModif('<?= $budget->getId() ?>', '<?= $budget->getIdMariage() ?>')">Modifier</button>
                </div>
            
<?php

            } 
        }
    }
    
?> 