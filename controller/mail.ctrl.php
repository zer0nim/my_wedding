<?php
  require_once('../model/DAO.class.php');
  //////////VERSION SANS SESSION//////////
  $idM=1;
  $nom='un inconnu qui test';
  ////////////////////////////////////////
  if (isset($_POST['actSend'])) {
    $mail = $_POST['for']; // Déclaration de l'adresse de destination.
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mail)){ // On filtre les serveurs qui présentent des bogues.
    	$passage_ligne = "\r\n";
    }else{
    	$passage_ligne = "\n";
    }
    //=====Déclaration des messages au format HTML.
    $message_html = $_POST['message'];
    //==========

    //=====Création de la boundary.
    $boundary = "-----=".md5(rand());
    $boundary_alt = "-----=".md5(rand());
    //==========

    //=====Définition du sujet.
    $sujet = $_POST['obj'];
    //=========

    //=====Création du header de l'e-mail.
    $header = "From: \"$nom\"<$mail>".$passage_ligne;
    $header.= "Reply-to: \"$nom\" <$mail>".$passage_ligne;
    $header.= "MIME-Version: 1.0".$passage_ligne;
    $header.= "Content-Type: multipart/mixed;".$passage_ligne." boundary=\"$boundary\"".$passage_ligne;
    //==========

    //=====Création du message.
    $message = $passage_ligne."--".$boundary.$passage_ligne;
    $message.= "Content-Type: multipart/alternative;".$passage_ligne." boundary=\"$boundary_alt\"".$passage_ligne;
    $message.= $passage_ligne."--".$boundary_alt.$passage_ligne;

    //=====Ajout du message au format HTML.
    $message.= "Content-Type: text/html; charset=\"UTF-8\"".$passage_ligne;
    $message.= "Content-Transfer-Encoding: 8bit".$passage_ligne;
    $message.= $passage_ligne.$message_html.$passage_ligne;
    //==========

    //=====On ferme la boundary alternative.
    $message.= $passage_ligne."--".$boundary_alt."--".$passage_ligne;
    //==========

    //$message.= $passage_ligne."--".$boundary.$passage_ligne;
  //  var_dump($mail,$sujet,$message,$header);
    //=====Envoi de l'e-mail.
    mail($mail,$sujet,$message,$header);
    //==========
  }

  include("../view/mail.view.php");
 ?>
