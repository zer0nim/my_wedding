<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  //Recup id du mariage
  $idM = $_SESSION['idM'];

  $valid_ext = array( 'jpg' , 'jpeg' , 'gif' , 'png' );
  //vérification extention valide
  if (in_array(end((explode(".", $_FILES["image"]["name"]))),$valid_ext)) {
    //vérification taille < 500ko
    if ($_FILES['image']['size'] < 2000000) {

      $pic = new photo();
      $pic->faux_construct($_POST['idPict'], $idM, NULL, $_POST['titre'], (end((explode(".", $_FILES["image"]["name"])))), $_POST['description']);
      $dao->modifyPhoto($pic);

      if (!file_exists('../uploads/')) {
          mkdir('../uploads/');
      }
      if (!file_exists('../uploads/' . $idM)) {
        mkdir('../uploads/' . $idM);
      }

      foreach ($valid_ext as $key => $ext) {
        if (file_exists ('../uploads/' . $idM . '/' . $_POST['idPict'] . '.' . $ext)) {
          unlink('../uploads/' . $idM . '/' . $_POST['idPict'] . '.' . $ext);
        }
      }
      move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $idM . '/' . $_POST['idPict'] . '.' . end((explode(".", $_FILES["image"]["name"]))));
      echo json_encode('../uploads/' . $idM . '/' . $_POST['idPict'] . '.' . end((explode(".", $_FILES["image"]["name"]))));
    }
  }
?>
