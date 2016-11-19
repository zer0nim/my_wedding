<?php
class fournisseurs {
  private $id;
  private $idM;
  private $titre;
  private $adresse;
  private $tel;
  private $mail;
  private $site;
  private $description;
}

function afficherFournisseur() {
  echo '<div class="box col-sm-6 col-md-4"><div class="thumbnail"><div class="caption"><address><strong>' . $titre . '</strong>';
  if (isset($adresse)) {
    echo '<br>' . $adresse;
  }
  if (isset($tel)) {
    echo '<br>' . $tel;
  }
  if (isset($mail)) {
    echo '<br>' . $mail;
  }
  if (isset($site)) {
    echo '<br>' . $site;
  }
  echo '</address><blockquote><p>' . $description . '</p></blockquote>';
  echo '<p><a href="fournisseurs.ctrl.php?id=' . $id . '" class="btn btn-danger" role="button">Supprimer</a></p></div></div></div>';
}
?>
