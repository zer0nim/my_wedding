<?php
require('../fpdf181/fpdf.php');
require_once '../model/DAO.class.php';
include_once ('session_create.ctrl.php');
$idM = $_SESSION['idM'];
$allTables = $dao->getTables($idM);
$allContacts = $dao->getContacts($idM);

class PDF extends FPDF
{
  // En-tête
  function Header()
  {
      $this->SetFillColor(208,228,233);
      $this->SetFont('Arial','B',16);
      //         x y   210 x 297 mm, text, contour, retour a la ligne, Centré, remplissage
      $this->Cell(190,10,'Plan de Table',1,1,'C', true);
      $this->Ln(8);
  }

  // Pied de page
  function Footer()
  {
      // Positionnement à 1,5 cm du bas
      $this->SetY(-15);
      // Police Arial italique 8
      $this->SetFont('Arial','I',9);
      // Numéro de page
      $this->Cell(0,10,'Page '.$this->PageNo().' / {nb}',0,0,'C');
  }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();

foreach ($allTables as $key => $crntTb) {
  $pdf->SetFont('Times','',13);
  $pdf->SetFillColor(230,245,247);
  $pdf->Cell(130,10,utf8_decode($crntTb->getListTab_nom()),1,0,'', true);
  $pdf->SetFillColor(208,228,233);
  $pdf->Cell(20,10,utf8_decode($crntTb->getListTab_nbPlaces() . ' paces'),1,1,'C', true);
  foreach ($allContacts as $key => $crntCt) {
    if ($crntCt->getCont_idT() == $crntTb->getListTab_id()) {
      $pdf->Cell(25,10,'-', 0, 0, 'C');$pdf->Cell(165,10,utf8_decode($crntCt->getCont_nom() . ' ' . $crntCt->getCont_prenom()),0,1,'');
    }
  }
  $pdf->Ln(8);
}
$pdf->Output();


/*
foreach ($allTables as $key => $crntTb) {
  $pdf->SetFont('Times','',13);
  $pdf->SetFillColor(230,245,247);
  $pdf->Cell(130,10,utf8_decode($crntTb->getListTab_nom()),1,0,'', true);
  $pdf->SetFillColor(208,228,233);
  $pdf->Cell(20,10,utf8_decode($crntTb->getListTab_nbPlaces() . ' paces'),1,1,'C', true);
  foreach ($allContacts as $key => $crntCt) {
    if ($crntCt->getCont_idT() == $crntTb->getListTab_id()) {
      $pdf->Cell(25,10,'-', 0, 0, 'C');$pdf->Cell(165,10,utf8_decode($crntCt->getCont_nom() . ' ' . $crntCt->getCont_prenom()),0,1,'');
    }
  }
}
*/

/*
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();


$pdf->SetFont('Times','',13);
$pdf->SetFillColor(230,245,247);
$pdf->Cell(130,10,utf8_decode('Table Saint-Émilion'),1,0,'', true);
$pdf->SetFillColor(208,228,233);
$pdf->Cell(20,10,utf8_decode('3 paces'),1,1,'C', true);

$pdf->Cell(25,10,'-', 0, 0, 'C');$pdf->Cell(165,10,utf8_decode('Bellefeuille Bertrand'),0,1,'');

$pdf->Cell(25,10,'-', 0, 0, 'C');$pdf->Cell(165,10,utf8_decode('Charette Didier'),0,1,'');

$pdf->Cell(25,10,'-', 0, 0, 'C');$pdf->Cell(165,10,utf8_decode('Masson Claudette'),0,1,'');

$pdf->Ln(8);


$pdf->Output();
*/
?>
