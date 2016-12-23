<?php
class lien {
  private $link_id;
  private $link_idM;
  private $link_date;
  private $link_adress;
  private $link_descr;

  function faux_construct($link_id, $link_idM, $link_date, $link_adress, $link_descr) {
    if (isset($link_id)) {
      $this->setLink_id($link_id);}

    if (isset($link_idM)) {
      $this->setLink_idM($link_idM);}

    if (isset($link_date)) {
      $this->setLink_date($link_date);}

    if (isset($link_adress)) {
      $this->setLink_adress($link_adress);}

    if (isset($link_descr)) {
      $this->setLink_descr($link_descr);}
  }

  function setLink_id($link_id) {
      $this->link_id = $link_id;
  }
  function setLink_idM($link_idM) {
      $this->link_idM = $link_idM;
  }
  function setLink_date($link_date) {
      $this->link_date = $link_date;
  }
  function setLink_adress($link_adress) {
      $this->link_adress = $link_adress;
  }
  function setLink_descr($link_descr) {
      $this->link_descr = $link_descr;
  }



  function getLink_id() {
      return $this->link_id;
  }
  function getLink_idM() {
      return $this->link_idM;
  }
  function getLink_date() {
      return $this->link_date;
  }
  function getLink_adress() {
      return $this->link_adress;
  }
  function getLink_descr() {
      return $this->link_descr;
  }
}
?>
