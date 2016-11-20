<?php
require_once '../model/depense.class.php';

class budget {
    private $id;
    private $idMariage;
    private $description;
    private $value;
    private $tabdepense;

    function __construct($id, $idmariage, $description, $value, $tabdepense) {
        $this->id = $id;
        $this->idMariage = $idmariage;
        $this->description = $description;
        $this->value = $value;
        $this->tabdepense = $tabdepense;
    }

    function getId() {
        return $this->id;
    }

    function getIdMariage() {
        return $this->idMariage;
    }

    function getDescription() {
        return $this->description;
    }

    function getValue() {
        return $this->value;
    }

    function getTabdepense() {
        return $this->tabdepense;
    }
    
    // la somme total depensé
    function getTotalDepense(){
        $val = 0;
        if ($this->tabdepense != null){
            foreach ($this->tabdepense as $depense){
                $val += $depense->getValue();
            }
        }
        return $val;
    }
    
    // la somme restante
    function getTotalRest(){
        return $this->value - $this->getTotalDepense();
    }
  
}

?>
