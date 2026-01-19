<?php

namespace com\leartik\daw24aiet\produktuak;

class Produktua {
    
    private $id;
    private $id_kategoria;
    private $izena;
    private $prezioa;
    private $deskontua;
    private $nobedadea;
    private $pisua;
    private $urtea;
    private $sortze_data;
    
    public function __construct($id = null, $id_kategoria = null, $izena = '', $prezioa = 0, $deskontua = 0, $nobedadea = '', $pisua = 0, $urtea = null, $sortze_data = null) {
        $this->id = $id;
        $this->id_kategoria = $id_kategoria;
        $this->izena = $izena;
        $this->prezioa = $prezioa;
        $this->deskontua = $deskontua;
        $this->nobedadea = $nobedadea;
        $this->pisua = $pisua;
        $this->urtea = $urtea;
        $this->sortze_data = $sortze_data;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getIdKategoria() {
        return $this->id_kategoria;
    }
    
    public function getIzena() {
        return $this->izena;
    }
    
    public function getPrezioa() {
        return $this->prezioa;
    }
    
    public function getDeskontua() {
        return $this->deskontua;
    }

    public function getNobedadea() {
        return $this->nobedadea;
    }
    
    public function getPisua() {
        return $this->pisua;
    }
    
    public function getUrtea() {
        return $this->urtea;
    }
    
    public function getSortzeData() {
        return $this->sortze_data;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setIdKategoria($id_kategoria) {
        $this->id_kategoria = $id_kategoria;
    }
    
    public function setIzena($izena) {
        $this->izena = $izena;
    }
    
    public function setPrezioa($prezioa) {
        $this->prezioa = $prezioa;
    }
    
    public function setDeskontua($deskontua) {
        $this->deskontua = $deskontua;
    }

    public function setNobedadea($nobedadea) {
        $this->nobedadea = $nobedadea;
    }
    
    public function setPisua($pisua) {
        $this->pisua = $pisua;
    }
    
    public function setUrtea($urtea) {
        $this->urtea = $urtea;
    }
    
    public function setSortzeData($sortze_data) {
        $this->sortze_data = $sortze_data;
    }
    
    public function getPrezioaDeskontuarekin() {
        if ($this->deskontua > 0) {
            return $this->prezioa - ($this->prezioa * $this->deskontua / 100);
        }
        return $this->prezioa;
    }
    
    public function getAurreztutakoDirua() {
        if ($this->deskontua > 0) {
            return $this->prezioa * $this->deskontua / 100;
        }
        return 0;
    }
    
    public function __toString() {
        return $this->izena;
    }
}
?> 
