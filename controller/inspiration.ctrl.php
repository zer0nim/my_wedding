<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';
  $idM = $_SESSION['idM'];

  $liens = $dao->getLiens($idM);
  $notes = $dao->getNotes($idM);
  $photos = $dao->getPhotos($idM);

  foreach ($liens as $key => $value) {
    $insp[$value->getLink_date()] = $value;
  }
  foreach ($notes as $key => $value) {
    $insp[$value->getNote_date()] = $value;
  }
  foreach ($photos as $key => $value) {
    $insp[$value->getPict_date()] = $value;
  }
  ksort($insp);

  function printAllInsp($insp) {
    foreach (array_reverse($insp) as $key => $value) {
      if (is_a($value, 'lien')) {
        $date = explode(" ", $value->getLink_date())[0];
        $dateFR = explode("-", $date)[2] . '-' . explode("-", $date)[1] . '-' . explode("-", $date)[0];

        echo '<li id=\'l' . $value->getLink_id() . '\'><time class="cbp_tmtime" datetime="' . $value->getLink_date() . '"><span>' . $dateFR . '</span><span>' . explode(" ", $value->getLink_date())[1] . '</span></time>' . "\n";
        echo '<div class="cbp_tmicon fa fa-paint-brush"></div>' . "\n";
        echo '<div class="cbp_tmlabel">' . "\n";
        echo '<h2 class="cnt_l' . $value->getLink_id() . '"><i class="fa fa-link" aria-hidden="true"></i> <a href="' . $value->getLink_adress() . '">' . $value->getLink_adress() . '</a></h2>' . "\n";
        echo '<p class="cnt_l' . $value->getLink_id() . '">' . $value->getLink_descr() . '</p>' . "\n";
        echo '<a class="cnt_l' . $value->getLink_id() . ' supprCntLink btn btn-danger btn-xs" onclick="return supprInsp(' . $value->getLink_id() . ', ' . "'l'" . ');" role="button"><i class="fa fa-times" aria-hidden="true"></i></a>  ';
        echo '<a class="cnt_l' . $value->getLink_id() . ' btn btn-warning btn-xs" onclick="return edit(' . $value->getLink_id() . ', ' . "'l'" . ');" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

        echo '<form method="post" class="edit link" id="edit' . $value->getLink_id() . 'l">' . "\n";
        echo '<label class="control-label" for="textinput">Adresse</label>' . "\n";
        echo '<input type="text" name="adresse" class="form-control" aria-describedby="basic-addon1" value="' . $value->getLink_adress() . '"required>' . "\n";
        echo '<span class="input-group-addon">Description</span>' . "\n";
        echo '<textarea class="form-control" name="description" id="" name="">' . $value->getLink_descr() . '</textarea>' . "\n";
        echo '<input type="submit" class="btn btn-default btn-block" value="Modifier">' . "\n";
        echo '<input type="button" class="btn btn-primary btn-block" value="Annuler" onclick="return cancelEdit(' . $value->getLink_id() . ', ' . "'l'" . ');">' . "\n";
        echo '</form>' . "\n";

        echo '</div></li>' . "\n";

      }
      elseif (is_a($value, 'photo')) {
        $date = explode(" ", $value->getPict_date())[0];
        $dateFR = explode("-", $date)[2] . '-' . explode("-", $date)[1] . '-' . explode("-", $date)[0];

        echo '<li id=\'p' . $value->getPict_id() . '\'><time class="cbp_tmtime" datetime="' . $value->getPict_date() . '"><span>' . $dateFR . '</span><span>' . explode(" ", $value->getPict_date())[1] . '</span></time>' . "\n";
        echo '<div class="cbp_tmicon fa fa-paint-brush"></div>' . "\n";
        echo '<div class="cbp_tmlabel">' . "\n";
        echo '<h2 class="cnt_p' . $value->getPict_id() . '">' . $value->getPict_title() . '</h2>' . "\n";
        echo '<p class="cnt_p' . $value->getPict_id() . '">' . $value->getPict_descr() . '</p>' . "\n";
        echo '<img class="cnt_p' . $value->getPict_id() . '" src="../uploads/' . $value->getPict_idM() . '/' . $value->getPict_id() . '.' . $value->getPict_format() .'" width="100%" height="100%">' . "\n";
        echo '<a class="cnt_p' . $value->getPict_id() . ' supprCntLink btn btn-danger btn-xs" onclick="return supprInsp(' . $value->getPict_id() . ', ' . "'p'" . ');" role="button"><i class="fa fa-times" aria-hidden="true"></i></a>  ';
        echo '<a class="cnt_p' . $value->getPict_id() . ' supprCntLink btn btn-warning btn-xs" onclick="return edit(' . $value->getPict_id() . ', ' . "'p'" . ');" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

        echo '<form method="post" enctype="multipart/form-data" class="edit pict" id="edit' . $value->getPict_id() . 'p">' . "\n";
        echo '<label class="control-label" for="textinput" required>Titre</label>' . "\n";
        echo '<input type="text" name="titre" class="form-control" aria-describedby="basic-addon1" value="' . $value->getPict_title() . '" required>' . "\n";
        echo '<span class="input-group-addon">Description</span>' . "\n";
        echo '<textarea class="form-control" name="description" id="" name="">' . $value->getPict_descr() . '</textarea>' . "\n";
        echo '<input type="file" name="image" accept="image/*" required>' . "\n";
        echo '<div class="image_preview col-lg-10 col-lg-offset-2">' . "\n";
        echo '<div class="thumbnail hidden">' . "\n";
        echo '<img src="http://placehold.it/5" alt="">' . "\n";
        echo '<div class="caption">' . "\n";
        echo '<h4></h4>' . "\n";
        echo '<p></p>' . "\n";
        echo '<p><button type="button" class="btn btn-default btn-danger">Annuler</button></p>' . "\n";
        echo '</div>' . "\n";
        echo '</div>' . "\n";
        echo '</div>' . "\n";
        echo '<input type="submit" class="btn btn-default btn-block" value="Modifier">' . "\n";
        echo '<input type="button" class="btn btn-primary btn-block" value="Annuler" onclick="return cancelEdit(' . $value->getPict_id() . ', ' . "'p'" . ');">' . "\n";
        echo '</form>' . "\n";

        echo '</div></li>' . "\n";
      }
      elseif (is_a($value, 'note')) {
        $date = explode(" ", $value->getNote_date())[0];
        $dateFR = explode("-", $date)[2] . '-' . explode("-", $date)[1] . '-' . explode("-", $date)[0];

        echo '<li id=\'n' . $value->getNote_id() . '\'><time class="cbp_tmtime" datetime="' . $value->getNote_date() . '"><span>' . $dateFR . '</span><span>' . explode(" ", $value->getNote_date())[1] . '</span></time>' . "\n";
        echo '<div class="cbp_tmicon fa fa-paint-brush"></div>' . "\n";
        echo '<div class="cbp_tmlabel">' . "\n";
        echo '<h2 class="cnt_n' . $value->getNote_id() . '">'. $value->getNote_title() . '</h2>' . "\n";
        echo '<p class="cnt_n' . $value->getNote_id() . '">' . $value->getNote_text() . '</p>' . "\n";
        echo '<a class="cnt_n' . $value->getNote_id() . ' supprCntLink btn btn-danger btn-xs" onclick="return supprInsp(' . $value->getNote_id() . ', ' . "'n'" . ');" role="button"><i class="fa fa-times" aria-hidden="true"></i></a>  ';
        echo '<a class="cnt_n' . $value->getNote_id() . ' btn btn-warning btn-xs" onclick="return edit(' . $value->getNote_id() . ', ' . "'n'" . ');" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';

        echo '<form class="edit note" id="edit' . $value->getNote_id() . 'n" method="post" >' . "\n";
        echo '<label class="control-label" for="textinput">Titre</label>' . "\n";
        echo '<input type="text" name="titre" class="form-control" aria-describedby="basic-addon1" value="' . $value->getNote_title() . '" required>' . "\n";
        echo '<span class="input-group-addon">Note</span>' . "\n";
        echo '<textarea class="form-control" name="description" id="" name="" required>' . $value->getNote_text() . '</textarea>' . "\n";
        echo '<input type="submit" class="btn btn-default btn-block" value="Modifier">' . "\n";
        echo '<input type="button" class="btn btn-primary btn-block" value="Annuler" onclick="return cancelEdit(' . $value->getNote_id() . ', ' . "'n'" . ');">' . "\n";
        echo '</form>' . "\n";

        echo '</div></li>' . "\n";
      }
    }
  }

  include_once('../view/inspiration.view.php');
?>
