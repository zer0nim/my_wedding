<?php 

    require_once '../model/DAO.class.php';

    $budget = null; 
    if (isset($_GET['idbudget'])){
        
        if(isset($_GET['action']) && $_GET['action'] != "ajouter" && $_GET['action'] != "supprimer"){
            // initialisation de $budget avec la base de donnée
            
            $budget = $dao->getbudget($_GET['idbudget']);

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
        
        }
        
    }

    if (isset($_GET['action'])){
        
        // -----------------------------------------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------------------------------------
        if ($_GET['action'] == "supprimer"){
            // suppression dans la base de donnée de idbudget a faire
            $dao->suppbudget($_GET['idbudget']);
            
        // -----------------------------------------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------------------------------------
        // -----------------------------------------------------------------------------------------------------------------
        }else if ($_GET['action'] == "modifier" || $_GET['action'] == "ajouter"){
            // modification de l'affichage pour pouvoir modifier
            
            if ($_GET['action'] == "ajouter"){
                
                // creation d'un budget avec des valeurs par defaut
                $budget['idbudget'] = $_GET['idbudget'];
        
                $budget['description'] = "description";
                $budget['value'] = 0;
                $budget['totaldepense'] = 0;
                $budget['totalrest'] = 0;

                $depense['depdescription'] = "description";
                $depense['depvalue'] = 0;

                $budget['tabdepense'][$_GET['idbudget']] = $depense;
                
                ?> <div id="<?= $budget['idbudget'] ?>" class="row-margin budget col-sm-4 col-sm-offset-1 col-sm-push-1">
            <?php } ?>
            

            <!-- La vue pour modifier -->
            <form id="form<?= $budget['idbudget'] ?>" method="post" action="budget-modifie.php?idbudget=<?= $budget['idbudget'] ?>&action=valider">

                <div class="row col-sm-12">
                    <p><input name="description" type="text" value="<?= $budget['description'] ?>"> : <input name="value" type="number" min="0" value="<?= $budget['value'] ?>"> €</p>
                </div>

                <table class="row scroll form-control">
                    <tr class="row"><th class="col-sm-12"></th><th class="col-sm-12 text-center">Description</th><th class="col-sm-12 text-right">Prix</th></tr>
                    <?php foreach ($budget['tabdepense'] as $iddepense => $depense) { ?>
                    <tr id="<?= $iddepense ?>" class="row"><td><p class="btn btn-danger" onclick="supp('<?= $iddepense ?>')"> X </p></td><td><input name="<?= $iddepense ?>depdescription" type="text" value="<?= $depense['depdescription'] ?>"></td><td><input name="<?= $iddepense ?>depvalue" type="number" min="0" value="<?= $depense['depvalue'] ?>"></td></tr>
                    <?php } ?>
                    <tr id="idadd<?= $budget['idbudget'] ?>" class="row"></td><td><td><p class="col-sm-5 col-sm-offset-3 btn btn-success" onclick="add('<?= $budget['idbudget'] ?>')">new</p></td><td></td></tr>
                </table>
                
                <div class="row bouton-margin">
                    <p onclick="annuler('<?= $budget['idbudget'] ?>')" name="action" value="annuler" class="col-sm-4 col-sm-offset-1 btn btn-primary">Annuler</p>
                    <p onclick="valider('<?= $budget['idbudget'] ?>')" name="action" value="valider" class="col-sm-4 col-sm-offset-1 btn btn-primary">Valider</p>
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
                
                $budget['idbudget'] = $_GET['idbudget'];
        
                $budget['description'] = $_POST['description'];
                $budget['value'] = $_POST['value'];
                $budget['totaldepense'] = 0;
                $budget['totalrest'] = $budget['value'];

                foreach ($_POST as $name => $value) {
                    if (strripos($name, "depdescription") !== false){ // si c'est une description de dépense
                        $budget['tabdepense'][str_replace("depdescription", "", $name)]['depdescription'] = $value;
                    }else if (strripos($name, "depvalue") !== false){ // si c'est une valeur de depense
                        $budget['tabdepense'][str_replace("depvalue", "", $name)]['depvalue'] = $value;
                        
                        $budget['totalrest'] = $budget['totalrest'] - $value;
                        $budget['totaldepense'] = $budget['totaldepense'] + $value;
                    }
                }
                
                // mise à jour de la base de donnée
                $dao->updateBudget($budget);
                                
            }
            
            if ($budget != null){
            
?>
            
                <div class="row col-sm-12">
                    <p><?= $budget['description']?> : <?= $budget['value'] ?> €</p>
                </div>
                <table class="row scroll form-control">
                    <tr class="row"><th class="col-sm-12 text-center">Description</th><th class="col-sm-12">Prix</th></tr>
                    <?php
                        foreach ($budget['tabdepense'] as $id => $depense) {
                    ?>
                            <tr class="row"><td><?= $depense['depdescription'] ?></td><td class="text-right"><?= $depense['depvalue'] ?> €</td></tr>
                    <?php
                            }
                    ?>
                </table>
                <table class="row table-margin col-sm-10">
                    <tr class="row"><td class="text-center">Total dépensé</td><td class="text-right"><?= $budget['totaldepense'] ?> €</td></tr>
                    <tr class="row"><td class="text-center">Budget restant</td><td class="text-right"><?= $budget['totalrest'] ?> €</td></tr>
                </table>
                <div class="row">                    
                    <button class="col-sm-4 col-sm-offset-1 btn btn-primary" onClick="confirmation(<?= $budget['idbudget'] ?>)">Supprimer</button>
                    <button class="col-sm-4 col-sm-offset-1 btn btn-primary" onclick="afficheModif(<?= $budget['idbudget'] ?>)">Modifier</button>
                </div>
            
<?php

            } 
        }
    }
    
?> 