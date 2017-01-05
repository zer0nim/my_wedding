<?php
require_once '../model/depense.class.php';

function cmp($a, $b) {
	if ($a->getValue() <= $b->getValue()) {
		return 1;
	}else {
		return -1;
	}
}

class budget {
    private $id;
    private $description;
    private $value;
    private $tabdepense;

    function __construct($id, $description, $value, $tabdepense) {
        $this->id = $id;
        $this->description = $description;
        $this->value = $value;
		if ($tabdepense != null){
			usort($tabdepense, "cmp");
		}
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
