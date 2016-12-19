<?php

	include_once ('session_create.ctrl.php');
	require_once ('../model/DAO.class.php');

	$idM = $_SESSION['idM'];
	$evenements = $dao->getEvenements($idM);

	include_once('../view/planning.view.php');

?>
