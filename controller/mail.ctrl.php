<?php
require_once('session_create.ctrl.php');
require_once('../model/DAO.class.php');

$idM = $_SESSION['idM'];
if (isset($_POST['actSend'])) {
  $nom=$_POST['from'];
  $mailfrom="www.mywedding.gdn";
  //$mailfor = $_POST['for']; // Déclaration de l'adresse de destination.
  $contacts=$dao->getContacts($idM);//récupère les contacts de la liste
  //var_dump($contacts);
  foreach ($contacts as $key => $cont) {
    $mailfor=$cont->getCont_mail(); //recupère le mail du contact
    //var_dump($mailfor);
    if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $mailfor)){ // On filtre les serveurs qui présentent des bogues.
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
    $header = "From: \"$nom\"<$mailfrom>".$passage_ligne;
    $header.= "To: <$mailfor>".$passage_ligne;
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
    //=====Envoi de l'e-mail.

    $valRetour[]=mail($mailfor,$sujet,$message,$header);
    var_dump($valRetour);
    $accepte=true;
    foreach ($valRetour as $value) {
      if ($value == false) {
        $accepte=$value;
      }
    }
  }
  //$accepte=mail($mailfor,$sujet,$message,$header);
  //==========
}

include_once("../view/mail.view.php");
?>
