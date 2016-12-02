<?php
  require_once('../model/DAO.class.php');
  //////////VERSION SANS SESSION//////////
  $idM=1;
  $email="emailfakelol@yopmail.com";
  $nom="fakeman";
  ////////////////////////////////////////
  if (isset($_POST['actSave'])) {
    $texte=$_POST['editor1'];         //Récupère le nouveau texte à ajouter
    $dao->delInvitation($idM);        //Supprime l'ancien texte de la bdd
    $dao->setInvitation($idM,$texte); //Ajoute le nouveau texte dans la bdd
  }elseif (isset($_POST['actMail'])) {
    if(!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)){
    	$passage_ligne = "\r\n";
    }else{
    	$passage_ligne = "\n";
    }

    $header = "From: \"$nom\"<$email>".$passage_ligne; //création du header du mail
    $header.= "Reply-to: \"$nom\" <$email>".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;

    $message = "...";
    $message .= "Content-Type: text/html; charset=\"ISO-8859-1\"".$passage_ligne;
    $message .= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message .= "...";

    $boundary = "-----=".md5(rand());
  }
  include_once('../view/invitations.view.php');
?>
