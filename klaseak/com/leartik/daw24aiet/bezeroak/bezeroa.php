<?php

namespace com\leartik\daw24aiet\bezeroak;

class Bezeroa {
    
    private $id;
    private $izena;
    private $abizena;
    private $helbidea;
    private $herria;
    private $postaKodea;
    private $probintzia;
    private $emaila;
    
    public function __construct($id = 0, $izena = "", $abizena = "", $helbidea = "", $herria = "", $postaKodea = 0, $probintzia = "", $emaila = "") {
        $this->id = $id;
        $this->izena = $izena;
        $this->abizena = $abizena;
        $this->helbidea = $helbidea;
        $this->herria = $herria;
        $this->postaKodea = $postaKodea;
        $this->probintzia = $probintzia;
        $this->emaila = $emaila;
    }
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getIzena() {
        return $this->izena;
    }

    public function setIzena($izena) {
        $this->izena = $izena;
    }

    public function getAbizena() {
        return $this->abizena;
    }

    public function setAbizena($abizena) {
        $this->abizena = $abizena;
    }

    public function getHelbidea() {
        return $this->helbidea;
    }

    public function setHelbidea($helbidea) {
        $this->helbidea = $helbidea;
    }

    public function getHerria() {
        return $this->herria;
    }

    public function setHerria($herria) {
        $this->herria = $herria;
    }

    public function getPostaKodea() {
        return $this->postaKodea;
    }

    public function setPostaKodea($postaKodea) {
        $this->postaKodea = $postaKodea;
    }

    public function getProbintzia() {
        return $this->probintzia;
    }

    public function setProbintzia($probintzia) {
        $this->probintzia = $probintzia;
    }

    public function getEmaila() {
        return $this->emaila;
    }

    public function setEmaila($emaila) {
        $this->emaila = $emaila;
    }
}
