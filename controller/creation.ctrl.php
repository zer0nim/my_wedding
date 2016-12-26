<?php
include_once('../model/DAO.class.php');
include_once('session_create.ctrl.php');
  $idacc=$_SESSION['account'];
if (isset($_POST['creation'])) {
  $nom1=$_POST['nom1'];
  $prenom1=$_POST['prenom1'];
  $nom2=$_POST['nom2'];
  $prenom2=$_POST['prenom2'];

  $date=$_POST['date'];
  $adresse=$_POST['adresse'];


  $tabdate = explode("/", $date);
  $date=$tabdate[2].'/'.$tabdate[1].'/'.$tabdate[0];

  if ($dao->getMariage($idacc) != NULL) {
    $retour=$dao->modifMariage($idacc,$nom1,$prenom1,$nom2,$prenom2,$date,$adresse);
    $modif='Informations sur le mariage modifiées !';
  }else {
    $retour=$dao->createMariage($idacc,$nom1,$prenom1,$nom2,$prenom2,$date,$adresse);
    $modif='Mariage créé !';
  }

  if ($retour=NULL) {
    $erreur='La creation/modification a échoué';
  }

}

include_once('../view/creation.view.php');
?>
