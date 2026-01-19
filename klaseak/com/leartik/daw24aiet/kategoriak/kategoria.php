<?php

namespace com\leartik\daw24aiet\kategoriak;

class Kategoria {
    
    private $id;
    private $izena;
    private $deskribapena;
    private $sortze_data;
    
    public function __construct($id = null, $izena = '', $deskribapena = '', $sortze_data = null) {
        $this->id = $id;
        $this->izena = $izena;
        $this->deskribapena = $deskribapena;
        $this->sortze_data = $sortze_data;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getIzena() {
        return $this->izena;
    }
    
    public function getDeskribapena() {
        return $this->deskribapena;
    }
    
    public function getSortzeData() {
        return $this->sortze_data;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setIzena($izena) {
        $this->izena = $izena;
    }
    
    public function setDeskribapena($deskribapena) {
        $this->deskribapena = $deskribapena;
    }
    
    public function setSortzeData($sortze_data) {
        $this->sortze_data = $sortze_data;
    }
    
    public function __toString() {
        return $this->izena;
    }
}
?> 
