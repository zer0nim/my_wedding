<?php
  include_once ('session_create.ctrl.php');
  require_once('../model/DAO.class.php');
  $idM = $_SESSION['idM'];

  $list = $dao->getListeSouhait($idM);
  include_once('../view/liste.view.php');

  function print_list($list) {
    if (isset($list)) {
      if (count($list) == 0) {
        echo "Vous n'avez pas encore fait de voeux";
      } else {
        foreach ($list as $key => $value) {
          echo '<li id="list_' . $value['nom'] . '" class="list-group-item ui-state-default">' . $value['nom'] . '	<a class="supr-souh btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></li>';
        }
      }
    } else {
      echo "Vous n'avez pas encore fait de voeux";
    }
  }
?>
