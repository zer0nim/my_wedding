<?php
  include_once('../model/DAO.class.php');
  //////////VERSION SANS SESSION//////////
  $idM=1;
  ////////////////////////////////////
  if (isset($_POST['actSave'])) {
    $texte=$_POST['texteInvit'];
    $dao->setInvitation($idM,$texte);
    include('../view/invitations.view.php');
  }elseif (isset($_POST['actMail'])) {
    include('../view/invitations.view.php');
  }elseif (isset($_POST['actPrint'])) {
    include('../view/invitations.view.php');
  }else {
    echo "Cette page ne peut être chargé manuellement<br/>\n";
  }

 ?>
