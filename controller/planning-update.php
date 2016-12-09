<?php

    require_once ('../model/evenement.class.php');
    require_once ('../model/DAO.class.php');
    
    session_start();
	if (false /* !isset($_SESSION['idmariage']) */){
		// si l'utilisateur n'est pas connecté, on ne met pas à jour
	}else{
    
		$idM = $_SESSION['idM'];

	}
	
?>