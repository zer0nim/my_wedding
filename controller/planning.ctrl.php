<?php

	include_once ('session_gestion.ctrl.php');
	require_once ('../model/DAO.class.php');
	
	$idM = $_SESSION['idM'];
	$evenements = $dao->getEvenements($idM);
	
	$evenements[] = new evenement(2, 'evenement test', '2016-12-10', '2016-12-14', null);

	include_once('../view/planning.view.php');
	
?>
