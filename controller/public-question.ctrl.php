<?php
include_once('../model/DAO.class.php');
session_start();
if (isset($_GET['idm'])) {
  $idM=$_GET['idm'];
  if (isset($_POST['envoiQuestion'])) {
    $nom=$_POST['nom'];
    if (strtolower($nom)=='organisateur') {
      $erreur='Un invité ne peut pas s\'appeler Organisateur!';
    }
    $question=$_POST['question'];
    $date = date("Y-m-d H:i:s");
    if (!isset($erreur)) {
      $dao->envoiquestion($idM,$nom,$question,$date);
    }

  }
  $questions=$dao->getquestions($idM);
  if ($questions==NULL) {
    $questions=0;
  }
  include_once('../view/public-question.view.php');
}else {
  echo "Page inaccessible";
}
 ?>
