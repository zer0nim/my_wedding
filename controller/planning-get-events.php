<?php

    require_once ('../model/evenement.class.php');
    require_once ('../model/DAO.class.php');
    
    session_start();
    
    $idM = $_SESSION['idM'];
    $evenements = $dao->getEvenements($idM);
    
    foreach ($evenements as $evenement) {
	echo $evenement->toStringArray()+'|'; // séparateur '|' entre les évenements
    }
    
?>