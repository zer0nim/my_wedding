<?php
  require_once('../model/DAO.class.php');
  require_once('session_delete.ctrl.php');
  if (isset($_POST['connexion'])) {
    $email=$_POST['email'];
    $mdp=$_POST['motdepasse'];
    $info=$dao->connexion($email,$mdp);
    if ($info != NULL) {
      include_once('session_init.ctrl.php');
      header('location:accueil.ctrl.php');
    }else {
      $erreur=0;
    }
  }elseif (isset($_POST['inscription'])) {
    $nom=$_POST['nom'];
    $prenom=$_POST['prenom'];
    $email=$_POST['email'];
    $mdp=$_POST['motdepasse'];
    include_once('session_create.ctrl.php');
  }

  if(isset($erreur)){
    switch ($erreur) {
      case 0:
        $messErr="Email ou mot de passe incorrect";
        break;

      default:
        $messErr="Erreur inconnue";
        break;
    }
  }
  include_once('../view/inscription.view.php');


?>
