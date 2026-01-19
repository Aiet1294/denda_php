<?php

namespace com\leartik\daw24aiet\eskariak;

class Eskaria {
    
    private $id;
    private $data;
    private $bezeroa;
    private $detaileak;
    private $balidatu;
    
    public function __construct($id = 0, $data = null, $bezeroa = null, $detaileak = [], $balidatu = 0) {
        $this->id = $id;
        $this->data = $data;
        $this->bezeroa = $bezeroa;
        $this->detaileak = $detaileak;
        $this->balidatu = $balidatu;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function getData() {
        return $this->data;
    }
    
    public function setData($data) {
        $this->data = $data;
    }
    
    public function getBezeroa() {
        return $this->bezeroa;
    }
    
    public function setBezeroa($bezeroa) {
        $this->bezeroa = $bezeroa;
    }
    
    public function getDetaileak() {
        return $this->detaileak;
    }
    
    public function setDetaileak($detaileak) {
        $this->detaileak = $detaileak;
    }

    public function getBalidatu() {
        return $this->balidatu;
    }

    public function setBalidatu($balidatu) {
        $this->balidatu = $balidatu;
    }
}
