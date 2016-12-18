<?php

    include_once('session_create.ctrl.php');
    require_once '../model/DAO.class.php';

	$idmariage = $_SESSION['idM']; // id du mariage à afficher
	$tabbudget = $dao->getBudgets($idmariage);

	$budgetglobale = $dao->getBudgetGlobal($idmariage);
	$budgetglobaledepense = 0;

	if ($tabbudget != null){
		foreach ($tabbudget as $budget) {
			$budgetglobaledepense += $budget->getTotalDepense();
		}
	}
	$budgetglobalerestant = $budgetglobale - $budgetglobaledepense;

	include_once('../view/budget.view.php');

?>
