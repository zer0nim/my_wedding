<?php
  session_start();
  //remplire les valeur avec celle de la bdd
  $_SESSION['account'] = $info[0];
  $_SESSION['idM'] = $info[1];
?>
