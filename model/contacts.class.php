<?php
class contacts {
  private $cont_id;
  private $cont_idM;
  private $cont_nom;
  private $cont_prenom;
  private $cont_adresse;
  private $cont_mail;
  private $cont_age;
  private $cont_tel;

  function setCont_id($cont_id) {
      $this->$cont_id = $cont_id;
  }
  function setCont_idM($cont_idM) {
      $this->$cont_idM = $cont_idM;
  }
  function setCont_nom($cont_nom) {
      $this->$cont_nom = $cont_nom;
  }
  function setCont_prenom($cont_prenom) {
      $this->$cont_prenom = $cont_prenom;
  }
  function setCont_adresse($cont_adresse) {
      $this->$cont_adresse = $cont_adresse;
  }
  function setCont_mail($cont_mail) {
      $this->$cont_mail = $cont_mail;
  }
  function setCont_age($cont_age) {
      $this->$cont_age = $cont_age;
  }
  function setCont_tel($cont_tel) {
      $this->$cont_tel = $cont_tel;
  }

  function getCont_id() {
      return $this->$cont_id;
  }
  function getCont_idM() {
      return $this->$cont_idM;
  }
  function getCont_nom() {
      return $this->$cont_nom;
  }
  function getCont_prenom() {
      return $this->$cont_prenom;
  }
  function getCont_adresse() {
      return $this->$cont_adresse;
  }
  function getCont_mail() {
      return $this->$cont_mail;
  }
  function getCont_age() {
      return $this->$cont_age;
  }
  function getCont_tel() {
      return $this->$cont_tel;
  }

  function getCont() {
    $value['cont_id'] = getCont_id();
    $value['cont_idM'] = getCont_idM();
    $value['cont_nom'] = getCont_nom();
    $value['cont_prenom'] = getCont_prenom();
    $value['cont_adresse'] = getCont_adresse();
    $value['cont_mail'] = getCont_mail();
    $value['cont_age'] = getCont_age();
    $value['cont_tel'] = getCont_tel();
    return $value;
  }
}
?>
