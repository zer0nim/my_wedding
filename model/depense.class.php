<?php

class depense {
    private $id;
    private $idbudget;
    private $description;
    private $value;

    function __construct($id, $idbudget, $description, $value) {
        $this->id = $id;
        $this->idbudget = $idbudget;
        $this->description = $description;
        $this->value = $value;
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
