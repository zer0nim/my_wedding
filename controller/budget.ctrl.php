<?php

    require_once '../model/DAO.class.php';

    $idmariage = 1; // modifier par l'id du mariage à afficher
    $tabbudget = $dao->getBudgets($idmariage);

    $budgetglobale = $dao->getBudgetGlobal($idmariage);
    $budgetglobaledepense = 0;

    foreach ($tabbudget as $budget) {
        $budgetglobaledepense += $budget->getTotalDepense();
    }
    $budgetglobalerestant = $budgetglobale - $budgetglobaledepense;

    include_once('../view/budget.view.php');

?>