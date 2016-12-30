<?php
  include_once('../model/DAO.class.php');
  include_once('session_create.ctrl.php');

  $idM=$_SESSION['idM'];


  if (isset($_POST['envoiQuestion'])) {
    $nom='Organisateur';
    $question=$_POST['question'];
    $date = date("Y-m-d H:i:s");
    $dao->envoiquestion($idM,$nom,$question,$date);
  }
  $questions=$dao->getquestions($idM);
  if ($questions==NULL) {
    $questions=0;
  }
  include_once('../view/page-publique.view.php');
?>
