<?php
class note {
  private $note_id;
  private $note_idM;
  private $note_date;
  private $note_title;
  private $note_text;

  function faux_construct($note_id, $note_idM, $note_date, $note_title, $note_text) {
    if (isset($note_id)) {
      $this->setNote_id($note_id);}
    if (isset($note_idM)) {
      $this->setNote_idM($note_idM);}
    if (isset($note_date)) {
      $this->setNote_date($note_date);}
    if (isset($note_title)) {
      $this->setNote_title($note_title);}
    if (isset($note_text)) {
      $this->setNote_text($note_text);}
  }

  function setNote_id($note_id) {
      $this->note_id = $note_id;
  }
  function setNote_idM($note_idM) {
      $this->note_idM = $note_idM;
  }
  function setNote_date($note_date) {
      $this->note_date = $note_date;
  }
  function setNote_title($note_title) {
      $this->note_title = $note_title;
  }
  function setNote_text($note_text) {
      $this->note_text = $note_text;
  }


  function getNote_id() {
      return $this->note_id;
  }
  function getNote_idM() {
      return $this->note_idM;
  }
  function getNote_date() {
      return $this->note_date;
  }
  function getNote_title() {
      return $this->note_title;
  }
  function getNote_text() {
      return $this->note_text;
  }
}
?>
