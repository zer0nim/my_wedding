<?php
  require_once('../model/DAO.class.php');
  $idM=1;
  $texte=$dao->getInvitation($idM);
  include_once('../view/invitations.view.php');
?>
