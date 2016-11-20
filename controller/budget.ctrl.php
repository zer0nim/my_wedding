<?php

    require_once '../model/DAO.class.php';

    // ! l'id doit etre un nombre qui ne commence pas par 0 !
    // recuperation des budgets
    
    $idmariage = 1; // modifier par l'id du mariage à afficher
    $tabbudget = $dao->getBudgets($idmariage);
    
    /*
    // pour un exemple
    $budget['description'] = "une description";
    $budget['value'] = 1500;
    $budget['totaldepense'] = 1000;
    $budget['totalrest'] = 500;
    
    $depense['depdescription'] = "achat de chose";
    $depense['depvalue'] = 1000;
    
    $budget['tabdepense']['110'] = $depense;
    $tabbudget['100'] = $budget;
    // ------------------------
    */
    
    include_once('../view/budget.view.php');
  
?>
