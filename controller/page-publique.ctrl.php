<?php
  include_once('../model/DAO.class.php');
  session_start();
  if (isset($_SESSION['idM'])) {
    $idM=$_SESSION['idM'];
  }elseif (isset($_GET['idm'])) {
    $idM=$_GET['idM'];
  }

  if (isset($_POST['envoiQuestion'])) {
    $nom=$_POST['nom'];
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
