<?php
  include_once('../model/DAO.class.php');
  session_start();
  if (isset($_GET['idm'])) {
    $idM=$_GET['idm'];

    $liens = $dao->getLiens($idM, 0);
    $notes = $dao->getNotes($idM, 0);
    $photos = $dao->getPhotos($idM, 0);

    foreach ($liens as $key => $value) {
      $insp[$value->getLink_date()] = $value;
    }
    foreach ($notes as $key => $value) {
      $insp[$value->getNote_date()] = $value;
    }
    foreach ($photos as $key => $value) {
      $insp[$value->getPict_date()] = $value;
    }
    if (isset($insp)) {
      ksort($insp);
    }

    include_once('../view/page-publique-public.view.php');
  }else {
    echo "Page inaccessible";
  }


  function printAllInsp($insp) {
    if (isset($insp)) {
      foreach (array_reverse($insp) as $key => $value) {
        if (is_a($value, 'lien')) {
          $date = explode(" ", $value->getLink_date())[0];
          $dateFR = explode("-", $date)[2] . '-' . explode("-", $date)[1] . '-' . explode("-", $date)[0];

          echo '<li id=\'l' . $value->getLink_id() . '\'><time class="cbp_tmtime" datetime="' . $value->getLink_date() . '"><span>' . $dateFR . '</span><span>' . explode(" ", $value->getLink_date())[1] . '</span></time>' . "\n";
          echo '<div class="cbp_tmicon fa fa-paint-brush"></div>' . "\n";
          echo '<div class="cbp_tmlabel">' . "\n";
          echo '<h2 class="cnt_l' . $value->getLink_id() . '"><i class="fa fa-link" aria-hidden="true"></i> <a href="' . $value->getLink_adress() . '">' . $value->getLink_adress() . '</a></h2>' . "\n";
          echo '<p class="cnt_l' . $value->getLink_id() . '">' . $value->getLink_descr() . '</p>' . "\n";
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
          echo '</div></li>' . "\n";
        }
      }
    }
  }
?>
