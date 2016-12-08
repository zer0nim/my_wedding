<?php
  require_once '../model/DAO.class.php';

  $tb = new tables();
  $tb->faux_construct(NULL, 1, "SansNom", 1);
  echo $dao->setTable($tb);
?>
