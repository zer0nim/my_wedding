<?php

    require_once '../model/DAO.class.php';
	
	session_start();
	if (false /* !isset($_SESSION['idmariage']) */){
		// si l'utilisateur n'est pas connecté, redirection à l'accueil
		header('Location: ../index.php');
	}else{

		$idmariage = 1; // $_SESSION['idmariage'] modifier par l'id du mariage à afficher
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
	
	}

?>