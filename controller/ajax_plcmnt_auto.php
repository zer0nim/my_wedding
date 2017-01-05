<?php
	include_once('session_create.ctrl.php');
	require_once '../model/DAO.class.php';

	//Recup id du mariage
	$idM = $_SESSION['idM'];

	exec('python3 ../pite/main.py ' . $idM, $output, $return);

	if ($return === 0) {
		echo('OK');
	} else {
		echo('ERROR ' . $return . ': ' . json_encode($output));
	}
?>
