<?php

namespace com\leartik\daw24aiet\detaileak;

class Detailea {
    
    private $id;
    private $produktua;
    private $kopurua;
    private $prezioa;
    
    public function __construct($id = 0, $produktua = null, $kopurua = 0, $prezioa = 0) {
        $this->id = $id;
        $this->produktua = $produktua;
        $this->kopurua = $kopurua;
        $this->prezioa = $prezioa;
        
        if ($this->prezioa == 0 && $this->produktua != null) {
            $this->prezioa = $this->produktua->getPrezioa();
        }
    }
    public function getId() {
        return $this->id;
    }
    public function setId($id) {
        $this->id = $id;
    }
    public function getProduktua() {
        return $this->produktua;
    }

    public function setProduktua($produktua) {
        $this->produktua = $produktua;
    }

    public function getKopurua() {
        return $this->kopurua;
    }

    public function setKopurua($kopurua) {
        $this->kopurua = $kopurua;
    }

    public function getPrezioa() {
        return $this->prezioa;
    }

    public function setPrezioa($prezioa) {
        $this->prezioa = $prezioa;
    }

    public function getGuztira() {
        return $this->prezioa * $this->kopurua;
    }
}