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
      $pic->faux_construct(NULL, $idM, NULL, $_POST['titre'], (end((explode(".", $_FILES["image"]["name"])))), $_POST['description']);
      $idDate = $dao->setPhoto($pic, $_POST['isInsp']);
      $pic->setPict_id($idDate['id']);
      $pic->setPict_date($idDate['date']);

      if (!file_exists('../uploads/')) {
          mkdir('../uploads/');
      }
      if (!file_exists('../uploads/' . $idM)) {
        mkdir('../uploads/' . $idM);
      }
      move_uploaded_file($_FILES['image']['tmp_name'], '../uploads/' . $idM . '/' . $idDate['id'] . '.' . end((explode(".", $_FILES["image"]["name"]))));
      echo json_encode(array("date" => $pic->getPict_date(),
                              "titre" => $pic->getPict_title(),
                              "descr" => $pic->getPict_descr(),
                              "id" => $pic->getPict_id(),
                              "idM" => $pic->getPict_idM(),
                              "format" => $pic->getPict_format()));
    }
  }
?>
