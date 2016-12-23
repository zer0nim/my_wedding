<?php
class photo {
  private $pict_id;
  private $pict_idM;
  private $pict_date;
  private $pict_title;
  private $pict_format;
  private $pict_descr;

  function faux_construct($pict_id, $pict_idM, $pict_date, $pict_title, $pict_format, $pict_descr) {
    if (isset($pict_id)) {
      $this->setPict_id($pict_id);}
    if (isset($pict_idM)) {
      $this->setPict_idM($pict_idM);}
    if (isset($pict_date)) {
      $this->setPict_date($pict_date);}
    if (isset($pict_title)) {
      $this->setPict_title($pict_title);}
    if (isset($pict_format)) {
      $this->setPict_format($pict_format);}
    if (isset($pict_descr)) {
      $this->setPict_descr($pict_descr);}
  }

  function setPict_id($pict_id) {
      $this->pict_id = $pict_id;
  }
  function setPict_idM($pict_idM) {
      $this->pict_idM = $pict_idM;
  }
  function setPict_date($pict_date) {
      $this->pict_date = $pict_date;
  }
  function setPict_title($pict_title) {
      $this->pict_title = $pict_title;
  }
  function setPict_format($pict_format) {
      $this->pict_format = $pict_format;
  }
  function setPict_descr($pict_descr) {
      $this->pict_descr = $pict_descr;
  }



  function getPict_id() {
      return $this->pict_id;
  }
  function getPict_idM() {
      return $this->pict_idM;
  }
  function getPict_date() {
      return $this->pict_date;
  }
  function getPict_title() {
      return $this->pict_title;
  }
  function getPict_format() {
      return $this->pict_format;
  }
  function getPict_descr() {
      return $this->pict_descr;
  }
}
?>
