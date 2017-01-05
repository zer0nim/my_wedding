<?php

    include_once ('session_create.ctrl.php');
    require_once ('../model/evenement.class.php');
    require_once ('../model/DAO.class.php');

    $idM = $_SESSION['idM'];

    if (isset($_POST['action'])){
		$action = $_POST['action'];
		$id = $_POST['id'];

		if ($action == 'updateevenement' || $action == 'addevenement'){
			$description = $_POST['description'];
			$start = $_POST['start'];
			$end = $_POST['end'];
		}

		if ($action == 'updateevenement'){
			$evenement = new evenement($id, $description, $start, $end);
			$dao->updateEvenement($evenement, $idM);

		}else if ($action == 'addevenement'){
			$newId = $dao->getLastIdEvenement($idM)+1;
			$evenement = new evenement($newId, $description, $start, $end);
			$dao->addEvenement($evenement, $idM);
			echo $newId;

		}else if ($action == 'delevenement'){
			$dao->delEvenement($id, $idM);

		}
    }
?>
