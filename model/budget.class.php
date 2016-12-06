<?php
require_once '../model/depense.class.php';

class budget {
    private $id;
    private $description;
    private $value;
    private $tabdepense;

    function __construct($id, $description, $value, $tabdepense) {
        $this->id = $id;
        $this->description = $description;
        $this->value = $value;
        $this->tabdepense = $tabdepense;
    }

    function setId($id) {
        $this->id = $id;
    }
    
    function getId() {
        return $this->id;
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
