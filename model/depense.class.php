<?php

class depense {
    private $id;
    private $description;
    private $value;

    function __construct($id, $description, $value) {
        $this->setId($id);
        $this->description = $description;
        $this->value = $value;
    }
    
    function setId($id) {
        $this->id = $id;;
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

}

?>
