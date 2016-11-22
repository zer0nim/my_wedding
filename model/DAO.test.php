<?php
// Test de la classe DAO
require_once('DAO.class.php');

  $cnt = new contacts();
  $cnt->faux_construct(NULL, 1, "bobin", "bill", "rue beaubourg", "billbobin@hotmail.fr", 32, "0600110011");

//  $dao->setContact(1, $cnt->getCont()); //check ok :)
//  $dao->delContacts(1, 2);              //check ok :)

  $donnee = $dao->getContacts(1);         //check ok :)
  var_dump($donnee);
?>
