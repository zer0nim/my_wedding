<?php
class tables {
  private $listTab_idM;
  private $listTab_id;
  private $listTab_nom;
  private $listTab_nbPlaces;

  function faux_construct($listTab_id, $listTab_idM, $listTab_nom, $listTab_nbPlaces) {
    if (isset($listTab_id)) {
      $this->setListTab_id($listTab_id);}
    if (isset($listTab_idM)) {
      $this->setListTab_idM($listTab_idM);}
    if (isset($listTab_nom)) {
      $this->setListTab_nom($listTab_nom);}
    if (isset($listTab_nbPlaces)) {
      $this->setListTab_nbPlaces($listTab_nbPlaces);}
  }

  function setListTab_id($listTab_id) {
      $this->listTab_id = $listTab_id;
  }
  function setListTab_idM($listTab_idM) {
      $this->listTab_idM = $listTab_idM;
  }
  function setListTab_nbPlaces($listTab_nbPlaces) {
      $this->listTab_nbPlaces = $listTab_nbPlaces;
  }
  function setListTab_nom($listTab_nom) {
      $this->listTab_nom = $listTab_nom;
  }


  function getListTab_nom() {
      return $this->listTab_nom;
  }
  function getListTab_id() {
      return $this->listTab_id;
  }
  function getListTab_idM() {
      return $this->listTab_idM;
  }
  function getListTab_nbPlaces() {
      return $this->listTab_nbPlaces;
  }
}
?>
