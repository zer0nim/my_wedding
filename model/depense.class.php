<?php

class depense {
    private $id;
    private $idbudget;
    private $description;
    private $value;

    function __construct() {
    }
    
    function setAll($id, $idbudget, $description, $value){
        $this->setId($id);
        $this->setIdbudget($idbudget);
        $this->description = $description;
        $this->value = $value;
    }
    
    function setId($id) {
        $this->id = $id;;
    }
    
    function setIdbudget($idbudget) {
        $this->idbudget = $idbudget;
    }

    function getId() {
        return $this->id;
    }

    function getIdbudget() {
        return $this->idbudget;
    }

    function getDescription() {
        return $this->description;
    }

    function getValue() {
        return $this->value;
    }

  
}

?>
