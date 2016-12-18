<?php
  require_once('../model/DAO.class.php');
  //////////VERSION SANS SESSION//////////
  include_once('session_create.ctrl.php');
  $idM = $_SESSION['idM'];
  ////////////////////////////////////////
  if (isset($_POST['actSave'])) {
    $texte=$_POST['editor1'];         //Récupère le nouveau texte à ajouter
    $dao->delInvitation($idM);        //Supprime l'ancien texte de la bdd
    $dao->setInvitation($idM,$texte); //Ajoute le nouveau texte dans la bdd
  }elseif (isset($_POST['actMail'])) {
    header('Location: mail.ctrl.php');
  }
  include_once('../view/invitations.view.php');
?>
