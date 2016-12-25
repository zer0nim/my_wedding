<?php
  include_once('session_create.ctrl.php');
  require_once '../model/DAO.class.php';

  $liens = $dao->getLiens(1);
  $notes = $dao->getNotes(1);
  $photos = $dao->getPhotos(1);

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
        echo '<li id=\'l' . $value->getLink_id() . '\'><time class="cbp_tmtime" datetime="' . $value->getLink_date() . '"><span>' . explode(" ", $value->getLink_date())[0] . '</span><span>' . explode(" ", $value->getLink_date())[1] . '</span></time>' . "\n";
        echo '<div class="cbp_tmicon fa fa-paint-brush"></div>' . "\n";
        echo '<div class="cbp_tmlabel">' . "\n";
        echo '<h2><i class="fa fa-link" aria-hidden="true"></i> <a href="' . $value->getLink_adress() . '">' . $value->getLink_adress() . '</a></h2>' . "\n";
        echo '<p>' . $value->getLink_descr() . '</p>' . "\n";
        echo '<a onclick="return supprInsp(' . $value->getLink_id() . ', ' . "'l'" . ');" class="supprCntLink btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></div></li>' . "\n";
      }
      elseif (is_a($value, 'photo')) {
        echo '<li id=\'p' . $value->getPict_id() . '\'><time class="cbp_tmtime" datetime="' . $value->getPict_date() . '"><span>' . explode(" ", $value->getPict_date())[0] . '</span><span>' . explode(" ", $value->getPict_date())[1] . '</span></time>' . "\n";
        echo '<div class="cbp_tmicon fa fa-paint-brush"></div>' . "\n";
        echo '<div class="cbp_tmlabel">' . "\n";
        echo '<h2>' . $value->getPict_title() . '</h2>' . "\n";
        echo '<p>' . $value->getPict_descr() . '</p>' . "\n";
        echo '<img src="../uploads/' . $value->getPict_idM() . '/' . $value->getPict_id() . '.' . $value->getPict_format() .'" width="100%" height="100%">' . "\n";
        echo '<a onclick="return supprInsp(' . $value->getPict_id() . ', ' . "'p'" . ');" class="supprCntLink btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></div></li>' . "\n";
      }
      elseif (is_a($value, 'note')) {
        echo '<li id=\'n' . $value->getNote_id() . '\'><time class="cbp_tmtime" datetime="' . $value->getNote_date() . '"><span>' . explode(" ", $value->getNote_date())[0] . '</span><span>' . explode(" ", $value->getNote_date())[1] . '</span></time>' . "\n";
        echo '<div class="cbp_tmicon fa fa-paint-brush"></div>' . "\n";
        echo '<div class="cbp_tmlabel">' . "\n";
        echo '<h2>'. $value->getNote_title() . '</h2>' . "\n";
        echo '<p>' . $value->getNote_text() . '</p>' . "\n";
        echo '<a onclick="return supprInsp(' . $value->getNote_id() . ', ' . "'n'" . ');" class="supprCntLink btn btn-danger btn-xs" role="button"><i class="fa fa-times" aria-hidden="true"></i></a></div></li>' . "\n";
      }
    }
  }

  include_once('../view/inspiration.view.php');
?>
