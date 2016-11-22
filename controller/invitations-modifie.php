<?php
  if (isset($_POST['actSave'])) {
    echo "actSave<br>";
    $texte=$_POST['texteInvit'];
    include('../view/invitations.view.php');
  }elseif (isset($_POST['actMail'])) {
    echo "actMail<br>";
    include('../view/invitations.view.php');
  }elseif (isset($_POST['actPrint'])) {
    echo "actPrint<br>";
    include('../view/invitations.view.php');
  }else {
    echo "Cette page ne peut être chargé manuellement<br/>\n";
  }

 ?>
