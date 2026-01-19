<?php

namespace com\leartik\daw24aiet\saskiak;

use com\leartik\daw24aiet\detaileak\Detailea;

class Saskia {
    
    private $detaileak;
    
    public function __construct() {
        $this->detaileak = array();
    }
    
    public function getDetaileak() {
        return $this->detaileak;
    }

    public function setDetaileak($detaileak) {
        $this->detaileak = $detaileak;
    }

    public function detaileaGehitu($detailea) {
        // Check if product already exists in cart to update quantity
        $found = false;
        foreach ($this->detaileak as $d) {
            if ($d->getProduktua()->getId() == $detailea->getProduktua()->getId()) {
                $d->setKopurua($d->getKopurua() + $detailea->getKopurua());
                $found = true;
                break;
            }
        }
        if (!$found) {
            $this->detaileak[] = $detailea;
        }
    }

    public function detaileaAldatu($detailea) {
        foreach ($this->detaileak as $key => $d) {
            if ($d->getProduktua()->getId() == $detailea->getProduktua()->getId()) {
                $this->detaileak[$key] = $detailea;
                break;
            }
        }
    }

    public function detaileaEzabatu($detailea) {
        foreach ($this->detaileak as $key => $d) {
            if ($d->getProduktua()->getId() == $detailea->getProduktua()->getId()) {
                unset($this->detaileak[$key]);
                // Re-index array
                $this->detaileak = array_values($this->detaileak);
                break;
            }
        }
    }

    public function getDetaileKopurua() {
        return count($this->detaileak);
    }
}
