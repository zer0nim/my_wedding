<?php
  include_once('../model/DAO.class.php');
  include_once('session_create.ctrl.php');
  $idA=$_SESSION['account'];
  if (isset($_POST['changeMdp'])) {
    $newmdp=$_POST['newmdp'];
    $confirmmdp=$_POST['confirmMdp'];
    $mdpcourant=$dao->getMdpAccount($idA);
    if ($newmdp == $confirmmdp){
      if ($newmdp!=$mdpcourant){
        $dao->updateMdpAccount($idA,$newmdp);
      }else {
        $errmodif="MdpCourant";
      }
    }else {
      $errmodif="MdpConfirmation";
    }
    if (isset($errmodif)) {
      if ($errmodif=="MdpCourant") {
        $messErr="Le nouveau mot de passe est le même que l'ancien";
      }elseif ($errmodif="MdpConfirmation") {
        $messErr="Nouveau mot de passe mal confirmé";
      }
    }
  }elseif (isset($_POST['changeMail'])) {
    $newmail=$_POST['newmail'];
    $confirmmail=$_POST['confirmMail'];
    $mailcourant=$dao->getMailAccount($idA);
    if($newmail == $confirmmail){
      if ($newmail!=$mailcourant) {
        $dao->updateMailAccount($idA,$newmail);
      }else {
        $errmodif="MailCourant";
      }
    }else {
      $errmodif="MailConfirmation";
    }
    if (isset($errmodif)) {
      if ($errmodif=="MailCourant") {
        $messErr="Le nouveau mail est le meme que l'ancien";
      }elseif ($errmodif="MailConfirmation") {
        $messErr="Nouveau mail mal confirmé";
      }
    }
  }
  include_once('../view/mon_compte.view.php');
 ?>
