<?php include('../view/header.php') ?>
<?php require_once '../view/baseMenuFnct.php'; ?>

<link rel="stylesheet" href="../view/css/budget.css" type="text/css" />

<div class="text-center">

    <div id="divboutonajouter" class="row border col-md-4 col-md-offset-4">
	<div class="row budgetglobal">
        <button id="boutonmodifierbudgetglobal" class="btn-xs btn-primary" onClick="modifierbudgetglobal()">Modifier</button>
	    <p class="row no-margin">Budget global : <b id="champbudgetglobale"><?= $budgetglobale ?></b> €</p>

	    <p class="row no-margin">Budget global dépensé : <b id="budgetglobaledepense"><?= $budgetglobaledepense ?></b> €</p>
	    <p class="row no-margin">Budget global restant : <b id="budgetglobalerestant"><?= $budgetglobalerestant ?></b> €</p>
	</div>
        <button class="btn btn-primary" onClick="ajouter()">Ajouter un budget</button>
    </div>

    <?php
    function cmp($a, $b) {
      if ($a->getValue() <= $b->getValue()) {
        return 1;
      }
      else {
        return -1;
      }
    }
    if ($tabbudget != null){
        foreach ($tabbudget as $idbudget => $budget) {
            ?>
            <div id="<?= $idbudget ?>" class="row-margin div-budget border col-md-5">
                <div class="row">
                    <p><b id="description<?= $idbudget ?>"><?= $budget->getDescription() ?></b> : <b id="value<?= $idbudget ?>"><?= $budget->getValue() ?></b> €</p>
                </div>
                <table id="tab<?= $idbudget ?>" class="row scroll form-control">
                    <tr class="row"><th class="champ-description-depense col-md-12 text-center">Description</th><th class="col-md-12 champ-description-depense">Prix</th></tr>
                    <?php
                    $tabdepense = $budget->getTabdepense();
                    usort($tabdepense, "cmp");
                    if ($tabdepense != null){
                        foreach ($tabdepense as $depense) {
                            ?>
                            <tr id="dep<?= $idbudget ?><?= $depense->getId() ?>" class="depense<?= $idbudget ?> row"><td class="border-depense"><?= $depense->getDescription() ?></td><td class="border-depense text-right"><?= $depense->getValue() ?> €</td></tr>
                            <?php
                        }
                    }
                    ?>
                </table>
                <div class="row table-margin form-group-lg">
                    <p class="row no-margin">Total dépensé : <b id="totaldepense<?= $idbudget ?>" class="text-right"><?= $budget->getTotalDepense() ?></b> €</p>
                    <p class="row no-margin">Budget restant : <b id="totalrestant<?= $idbudget ?>" class="totalrestant text-right"><?= $budget->getTotalRest() ?></b> €</p>
                </div>
                <div class="row">
                    <button class="btn-d col-xs-5 col-xs-offset-1 btn btn-primary" onClick="supprimer('<?= $idbudget ?>')">Supprimer</button>
                    <button class="btn-d col-xs-5 btn btn-primary" onclick="modifier('<?= $idbudget ?>')">Modifier</button>
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
