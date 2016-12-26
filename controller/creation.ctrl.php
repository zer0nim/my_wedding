<?php
include_once('../model/DAO.class.php');
include_once('session_create.ctrl.php');
if (isset($_POST['creation'])) {
  $nom1=$_POST['nom1'];
  $prenom1=$_POST['prenom1'];
  $nom2=$_POST['nom2'];
  $prenom2=$_POST['prenom2'];

  $date=$_POST['date'];
  $today = date("d/m/Y");
  $adresse=$_POST['adresse'];

  if ($date > $today) {
    $tabdate = explode("/", $date);
    $date=$tabdate[2].'/'.$tabdate[1].'/'.$tabdate[0];
    $idacc=$_SESSION['account'];
    $retour=$dao->createMariage($idacc,$nom1,$prenom1,$nom2,$prenom2,$date,$adresse);
    if (!$retour) {
      $erreur='create';
    }
  }else {
    $erreur='date';
  }

}

include_once('../view/creation.view.php');
?>
