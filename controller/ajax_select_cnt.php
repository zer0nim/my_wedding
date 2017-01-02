<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  // recup id du mariage
  $idM = $_SESSION['idM'];

  if( isset($_POST['idcont'])){
    $Contact = $dao->getContact($idM, $_POST['idcont'][0]);
    $mesentente = $dao->getMesententeCnt($idM, $_POST['idcont'][0]);
    echo json_encode(array("cont_nom" => $Contact->getCont_nom(),
                            "cont_prenom" => $Contact->getCont_prenom(),
                            "cont_adresse" => $Contact->getCont_adresse(),
                            "cont_mail" => $Contact->getCont_mail(),
                            "cont_age" => $Contact->getCont_age(),
                            "cont_tel" => $Contact->getCont_tel(),
                            "mesentente" => $mesentente,));
  }
  else {
    echo "Failed";
  }
?>
