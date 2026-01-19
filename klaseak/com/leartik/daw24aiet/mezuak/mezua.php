<?php

namespace com\leartik\daw24aiet\mezuak;

class Mezua {
    
    private $id;
    private $izena;
    private $email;
    private $mezua_testua;
    private $erantzunda;
    private $sortze_data;
    
    public function __construct($id = null, $izena = '', $email = '', $mezua_testua = '', $erantzunda = false, $sortze_data = null) {
        $this->id = $id;
        $this->izena = $izena;
        $this->email = $email;
        $this->mezua_testua = $mezua_testua;
        $this->erantzunda = $erantzunda;
        $this->sortze_data = $sortze_data;
    }
    
    public function getIdMezua() {
        return $this->id;
    }
    
    public function getIzena() {
        return $this->izena;
    }
    
    public function getEmail() {
        return $this->email;
    }
    
    public function getMezua() {
        return $this->mezua_testua;
    }
    
    public function getErantzunda() {
        return $this->erantzunda;
    }

    public function getSortzeData() {
        return $this->sortze_data;
    }

    public function setIdMezua($id) {
        $this->id = $id;
    }

    public function setIzena($izena) {
        $this->izena = $izena;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setMezua($mezua_testua) {
        $this->mezua_testua = $mezua_testua;
    }

    public function setErantzunda($erantzunda) {
        $this->erantzunda = $erantzunda;
    }

    public function setSortzeData($sortze_data) {
        $this->sortze_data = $sortze_data;
    }
}