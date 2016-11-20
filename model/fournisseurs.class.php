<?php
class fournisseurs {
  private $four_id;
  private $four_idM;
  private $four_titre;
  private $four_adresse;
  private $four_tel;
  private $four_mail;
  private $four_site;
  private $four_description;


function afficherFournisseur() {
  echo '<div class="box col-sm-6 col-md-4"><div class="thumbnail"><div class="caption"><address><strong>' . $this->four_titre . '</strong>';
  if (isset($this->four_adresse)) {
    echo '<br>' . $this->four_adresse;
  }
  if (isset($this->four_tel)) {
    echo '<br>' . $this->four_tel;
  }
  if (isset($this->four_mail)) {
    echo '<br>' . $this->four_mail;
  }
  if (isset($this->four_site)) {
    echo '<br>' . $this->four_site;
  }
  echo '</address><blockquote><p>' . $this->four_description . '</p></blockquote>';
  echo '<p><a href="fournisseurs.ctrl.php?idS=' . $this->four_id . '&idM=' . $this->four_idM . '" class="btn btn-danger" role="button">Supprimer</a></p></div></div></div>';
}
}
?>
