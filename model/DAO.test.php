<?php
// Test de la classe DAO

require_once('DAO.class.php');

/*
$ln = new lien();

$ln->faux_construct(NULL, 1, '2017/01/13', 'http://google.fr', 'google');

var_dump($dao->getLiens(1));
$dao->setLien($ln);
$dao->delLien(1, 2);
var_dump($dao->getLiens(1));
var_dump($dao->getLien(1, 2));
*/

/*
$n = new note();
$n->faux_construct(NULL, 1, '2017/01/13', 'titreNote', 'heyheyhey');

var_dump($dao->getNotes(1));
$dao->setNote($n);
$dao->delNote(1, 2);
var_dump($dao->getNotes(1));
var_dump($dao->getNote(1, 2));
*/



/*
$pic = new photo();
$pic->faux_construct(NULL, 1, '2017/01/13', 'bestTitreEver', 'jpg', 'The best background-image !');

var_dump($dao->getPhotos(1));
echo $dao->setPhoto($pic);
var_dump($dao->getPhotos(1));
var_dump($dao->getPhoto(1, 2));
$dao->delPhoto(1, 2);
var_dump($dao->getPhotos(1));
*/



/*
$tb = new tables();
$tb->faux_construct(66, 1, "table ronde", 8);
$dao->updateTable($tb);
*/
//var_dump($dao->getTable(1, 0));

//var_dump($dao->getTables(1));

/*
$tb = new tables();
$tb->faux_construct(NULL, 1, "SansNom", 6);
$dao->setTable($tb);
*/

//$dao->delTable(1, 0);


/*
$cnt = new contacts();
$cnt->faux_construct(NULL, 1, "vdsdvv", "Bertrand", "rue des Belges", "Bertranddvd@gmail.fr", 32, "0600110011");
$dao->setContact($cnt);
$cnt->faux_construct(NULL, 1, "bbbb", "Bertrand", "rue des Belges", "Bertranddvd@gmail.fr", 32, "0600110011");
$dao->setContact($cnt);
$cnt->faux_construct(NULL, 1, "ngfg", "Bertrand", "rue des Belges", "Bertranddvd@gmail.fr", 32, "0600110011");
$dao->setContact($cnt);
$cnt->faux_construct(NULL, 1, "wee", "Bertrand", "rue des Belges", "Bertranddvd@gmail.fr", 32, "0600110011");
$dao->setContact($cnt);
$cnt->faux_construct(NULL, 1, "vcbgbgfbgf", "Bertrand", "rue des Belges", "Bertranddvd@gmail.fr", 32, "0600110011");
$dao->setContact($cnt);
$cnt->faux_construct(NULL, 1, "sds", "Bertrand", "rue des Belges", "Bertranddvd@gmail.fr", 32, "0600110011");
$dao->setContact($cnt);
*/

/* creation de contacts pour les tests
  $cnt = new contacts();
  $cnt->faux_construct(NULL, 1, "Bellefeuille", "Bertrand", "rue des Belges", "Bertranddvd@gmail.fr", 32, "0600110011");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Bonnet", "Valentine", "rue du Bélier", "Valentine@hotmail.fr", 28, "0600110211");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Charette", "Christian", "rue de Bélissen", "Christian@gmail.fr", 55, "0260110011");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Charette", "Didier", "Place Bellecour", "Didier@hotmail.fr", 45, "0600110361");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Charette", "Oliver", "Place Bellevue", "Oliver@gmail.fr", 35, "0600116011");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Delaunay", "Nicolas", "Place Benoît-Crépu", "Nicolas@hotmail.fr", 18, "0698610011");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Des Meaux", "Baptiste", "rue Berjon", "Baptiste@hotmail.fr", 12, "0600110016");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Dodier", "Florence", "square Marius-Berliet", "Florence@hotmail.fr", 13, "0600110098");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Frappier", "Christine", "rue Claude-Bernard", "Christine@hotmail.fr", 85, "0600115013");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Frappier", "Marguerite", "rue Paul-Bert", "Marguerite@hotmail.fr", 56, "0600910031");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Garceau", "Camille", "rue Berthelot", "Camille@gmail.com", 45, "0600119091");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Garceau", "Jeannine", "rue du Sergent Michel Berthet", "Jeannine@hotmail.fr", 48, "0620150011");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Garceau", "Thibault", "rue Bichat", "Thibault@gmail.fr", 49, "0600132051");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Georges", "Eugène", "square de Birmingham", "Eugène@gmail.fr", 23, "0680110017");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Guilbon", "Sylvie", "rue Thomas Blanchet", "Sylvie@hotmail.fr", 35, "0608916011");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Karel", "Vincent", "rue Marc-Bloch", "Vincent@orange.com", 36, "0600630013");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Lacroix", "Stéphane", "rue Bonafous", "Stéphane@hotmail.fr", 33, "0600116917");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Lacroix", "Xavier", "rue Bonaparte", "Xavier@hotmail.fr", 65, "0660190051");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Lazure", "Stéphanie", "rue de Bondy", "Stéphanie@hotmail.fr", 82, "0600110817");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Leblanc", "Claire", "rue Docteur-Bonhomme", "rgClaire@hotmail.fr", 74, "0600110517");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Lemonnier", "Catherine", "rue de Bonnel", "Catherine@hotmail.com", 35, "0600510087");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Marchal", "Alfred", "route du Bon-Pasteur", "Alfrgred@hotmail.fr", 36, "0620110031");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Masson", "Aurélie", "rue Bony", "Aurelie@hotmail.fr", 42, "0602310012");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Masson", "Chloe", "rue Bossuet", "Chloe@hotmail.fr", 48, "0606110911");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Masson", "Claudette", "rue de la Boucle", "Claud5ette@orange.fr", 65, "0607110321");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Masson", "Jules", "route des Bouquetiers", "Jules@gmail.fr", 65, "0602310078");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Meunier", "Céline", "rue Bourgelat", "Céline@orange.fr", 38, "0602110093");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Meunier", "Eugène", "rue de Bourgogne", "Eugè5ne@hotmail.fr", 34, "0633113011");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Perez", "Roger", "rue de la Bourse", "Roger@hotmail.fr", 32, "0600188061");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Petitjean", "lisa", "square Aimé-Boussange", "lisa@gmail.com", 33, "0689110214");
  $dao->setContact($cnt);
  $cnt->faux_construct(NULL, 1, "Petitjean", "Yves", "route de Brest", "Yves25@hotmail.fr", 31, "0600114441");
  $dao->setContact($cnt);
*/
//$dao->placement(1);

//Test des fonctions HASH
//$dao->insertHash(1);
//echo $dao->getIdMariage_hash('356a192b7913b04c54574d18c28d46e6395428ab');
?>
