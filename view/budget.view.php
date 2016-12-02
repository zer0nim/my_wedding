<?php include('../view/header.php') ?>
<?php require_once '../view/baseMenuFnct.php'; ?>

<link rel="stylesheet" href="../view/css/budget.css" type="text/css" />

<div class="text-center">
    
    <div id="divboutonajouter" class="row border col-sm-4 col-sm-offset-4">
	<div class="row budgetglobal">
	    <p class="row no-margin">Budget global : <b id="budgetglobale"><?= $budgetglobale ?></b> €</p>
	    <p class="row no-margin">Budget global dépensé : <b id="budgetglobaledepense"><?= $budgetglobaledepense ?></b> €</p>
	    <p class="row no-margin">Budget global restant : <b id="budgetglobalerestant"><?= $budgetglobalerestant ?></b> €</p>
	</div>
        <button class="btn btn-primary" onClick="ajouter('<?= $idmariage ?>')">Ajouter un budget</button>
    </div>
    
    <?php
    if ($tabbudget != null){
        foreach ($tabbudget as $idbudget => $budget) {
            ?>
            <div id="<?= $idbudget ?>" class="row-margin div-budget border col-sm-5">
                <div class="row">
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
                <div class="row table-margin">
                    <p class="row no-margin">Total dépensé : <b id="totaldepense<?= $idbudget ?>" class="text-right"><?= $budget->getTotalDepense() ?> €</b></p>
                    <p class="row no-margin">Budget restant : <b class="text-right"><?= $budget->getTotalRest() ?> €</b></p>
                </div>
                <div class="row">
                    <button class="btn-d col-sm-5 col-sm-offset-1 btn btn-primary" onClick="supprimer('<?= $idbudget ?>', '<?= $budget->getIdMariage() ?>')">Supprimer</button>
                    <button class="btn-d col-sm-5 btn btn-primary" onclick="modifier('<?= $idbudget ?>', '<?= $budget->getIdMariage() ?>')">Modifier</button>
                </div>
            </div>
            <?php
        }
    }
    ?>

</div>


<?php include('../view/scripts.php') ?>
<script src="../view/js/budget.js"></script>

<?php include('../view/footer.php') ?>
