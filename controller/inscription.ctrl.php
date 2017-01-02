<?php
  require_once('../model/DAO.class.php');
  //require_once('session_delete.ctrl.php');
  if (isset($_POST['connexion'])) {
    $email=$_POST['email'];
    $mdp=$_POST['motdepasse'];
    $info=$dao->connexion($email,$mdp);
    if ($info[0] != NULL) {
      include_once('session_init.ctrl.php');
      //var_dump($info);
      if ($info[1] == NULL) {
        header('location: creation.ctrl.php');
      }else{
        header('location:accueil.ctrl.php');
      }
    }else {
      $erreur=0;
    }

  }elseif (isset($_POST['inscription'])) {
    $email=$_POST['email'];
    $mdp=$_POST['motdepasse'];
    $coderetour=$dao->inscription($email,$mdp);
    if ($coderetour != NULL) {
      if($coderetour == 66){
        $erreur=1;
      }
    }else{
      $info=$dao->connexion($email,$mdp);
      include_once('session_init.ctrl.php');
      header('location: creation.ctrl.php');
    }
  }

  if(isset($erreur)){
    switch ($erreur) {
      case 0:
        $messErr='Email ou mot de passe incorrect lors de la connexion';
        break;

      case 1:
        $messErr='L\'email utilisé pour l\'inscription est déjà utilisé';
        break;

      case 2:
        $messErr='Erreur dans la procédure de connexion';
        break;
        
      default:
        $messErr="Erreur inconnue";
        break;
    }
  }
  include_once('../view/inscription.view.php');


?>
