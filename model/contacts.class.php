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

  function faux_construct($cont_id, $cont_idM, $cont_nom, $cont_prenom, $cont_adresse, $cont_mail, $cont_age, $cont_tel) {
    if (isset($cont_id)) {
    $this->setCont_id($cont_id);}
    if (isset($cont_idM)) {
    $this->setCont_idM($cont_idM);}
    if (isset($cont_nom)) {
    $this->setCont_nom($cont_nom);}
    if (isset($cont_prenom)) {
    $this->setCont_prenom($cont_prenom);}
    if (isset($cont_adresse)) {
    $this->setCont_adresse($cont_adresse);}
    if (isset($cont_mail)) {
    $this->setCont_mail($cont_mail);}
    if (isset($cont_age)) {
    $this->setCont_age($cont_age);}
    if (isset($cont_tel)) {
    $this->setCont_tel($cont_tel);}
  }

  function setCont_id($cont_id) {
      $this->cont_id = $cont_id;
  }
  function setCont_idM($cont_idM) {
      $this->cont_idM = $cont_idM;
  }
  function setCont_nom($cont_nom) {
      $this->cont_nom = $cont_nom;
  }
  function setCont_prenom($cont_prenom) {
      $this->cont_prenom = $cont_prenom;
  }
  function setCont_adresse($cont_adresse) {
      $this->cont_adresse = $cont_adresse;
  }
  function setCont_mail($cont_mail) {
      $this->cont_mail = $cont_mail;
  }
  function setCont_age($cont_age) {
      $this->cont_age = $cont_age;
  }
  function setCont_tel($cont_tel) {
      $this->cont_tel = $cont_tel;
  }

  function getCont_id() {
      return $this->cont_id;
  }
  function getCont_idM() {
      return $this->cont_idM;
  }
  function getCont_nom() {
      return $this->cont_nom;
  }
  function getCont_prenom() {
      return $this->cont_prenom;
  }
  function getCont_adresse() {
      return $this->cont_adresse;
  }
  function getCont_mail() {
      return $this->cont_mail;
  }
  function getCont_age() {
      return $this->cont_age;
  }
  function getCont_tel() {
      return $this->cont_tel;
  }
}
?>
