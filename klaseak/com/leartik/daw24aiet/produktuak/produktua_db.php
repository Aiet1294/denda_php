<?php

namespace com\leartik\daw24aiet\produktuak;
use PDO;
use PDOException;

require_once __DIR__ . '/produktua.php';
require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))) . '/index.php';

class ProduktuaDB {

    private static function getConnection() {
        return \getDbConnection();
    }

    public static function selectProduktu($id) {
        $sql = "SELECT * FROM Produktuak WHERE id = ?";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return null;
            
            $kontsulta = $konexioa->prepare($sql);
            $kontsulta->execute([$id]);
            
            $emaitza = $kontsulta->fetch(PDO::FETCH_ASSOC);
            if ($emaitza) {
                return new Produktua(
                    $emaitza['id'],
                    $emaitza['id_kategoria'],
                    $emaitza['izena'],
                    $emaitza['prezioa'],
                    $emaitza['deskontua'],
                    $emaitza['nobedadeak'],
                    $emaitza['pisua'],
                    $emaitza['urtea'],
                    $emaitza['sortze_data']
                );
            }
        } catch (PDOException $e) {
            error_log("Errorea produktua lortzean: " . $e->getMessage());
        }
        return null;
    }

    public static function selectProduktuak() {
        $produktuak = []; 
        $sql = "SELECT * FROM Produktuak ORDER BY id ASC";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return $produktuak;
            
            $kontsulta = $konexioa->prepare($sql);
            $kontsulta->execute();
            
            while ($emaitza = $kontsulta->fetch(PDO::FETCH_ASSOC)) {
                $produktuak[] = new Produktua(
                    $emaitza['id'],
                    $emaitza['id_kategoria'],
                    $emaitza['izena'],
                    $emaitza['prezioa'],
                    $emaitza['deskontua'],
                    $emaitza['nobedadeak'],
                    $emaitza['pisua'],
                    $emaitza['urtea'],
                    $emaitza['sortze_data']
                );
            }
        } catch (PDOException $e) {
            error_log("Errorea produktuak lortzean: " . $e->getMessage());
        }
        return $produktuak;
    }

    public static function selectNobedadeak($limitea = 6) {
        $produktuak = [];
        $sql = "SELECT * FROM Produktuak WHERE nobedadeak = 1 LIMIT " . (int)$limitea;
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return $produktuak;
            
            $kontsulta = $konexioa->prepare($sql);
            $kontsulta->execute();
            
            while ($emaitza = $kontsulta->fetch(PDO::FETCH_ASSOC)) {
                $produktuak[] = new Produktua(
                    $emaitza['id'],
                    $emaitza['id_kategoria'],
                    $emaitza['izena'],
                    $emaitza['prezioa'],
                    $emaitza['deskontua'],
                    $emaitza['nobedadeak'],
                    $emaitza['pisua'],
                    $emaitza['urtea'],
                    $emaitza['sortze_data']
                );
            }
        } catch (PDOException $e) {
            error_log("Errorea nobedadeak lortzean: " . $e->getMessage());
        }
        return $produktuak;
    }

    public static function selectEskaintzak($limitea = 6) {
        $produktuak = [];
        $sql = "SELECT * FROM Produktuak WHERE deskontua > 0 LIMIT " . (int)$limitea;
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return $produktuak;
            
            $kontsulta = $konexioa->prepare($sql);
            $kontsulta->execute();
            
            while ($emaitza = $kontsulta->fetch(PDO::FETCH_ASSOC)) {
                $produktuak[] = new Produktua(
                    $emaitza['id'],
                    $emaitza['id_kategoria'],
                    $emaitza['izena'],
                    $emaitza['prezioa'],
                    $emaitza['deskontua'],
                    $emaitza['nobedadeak'],
                    $emaitza['pisua'],
                    $emaitza['urtea'],
                    $emaitza['sortze_data']
                );
            }
        } catch (PDOException $e) {
            error_log("Errorea eskaintzak lortzean: " . $e->getMessage());
        }
        return $produktuak;
    }


    public static function selectProduktuakKategoriarenArabera($id_kategoria) {
        $produktuak = [];
        $sql = "SELECT * FROM Produktuak WHERE id_kategoria = ? ORDER BY izena";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return $produktuak;
            
            $kontsulta = $konexioa->prepare($sql);
            $kontsulta->execute([$id_kategoria]);
            
            while ($emaitza = $kontsulta->fetch(PDO::FETCH_ASSOC)) {
                $produktuak[] = new Produktua(
                    $emaitza['id'],
                    $emaitza['id_kategoria'],
                    $emaitza['izena'],
                    $emaitza['prezioa'],
                    $emaitza['deskontua'],
                    $emaitza['nobedadeak'],
                    $emaitza['pisua'],
                    $emaitza['urtea'],
                    $emaitza['sortze_data']
                );
            }
        } catch (PDOException $e) {
            error_log("Errorea kategoriako produktuak lortzean: " . $e->getMessage());
        }
        return $produktuak;
    }

    public static function selectProduktuakByKategoriaAndTerm($id_kategoria, $term) {
        $produktuak = [];
        $sql = "SELECT * FROM Produktuak WHERE id_kategoria = ? AND izena LIKE ? ORDER BY izena";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return $produktuak;
            
            $kontsulta = $konexioa->prepare($sql);
            $kontsulta->execute([$id_kategoria, "%" . $term . "%"]);
            
            while ($emaitza = $kontsulta->fetch(PDO::FETCH_ASSOC)) {
                $produktuak[] = new Produktua(
                    $emaitza['id'],
                    $emaitza['id_kategoria'],
                    $emaitza['izena'],
                    $emaitza['prezioa'],
                    $emaitza['deskontua'],
                    $emaitza['nobedadeak'],
                    $emaitza['pisua'],
                    $emaitza['urtea'],
                    $emaitza['sortze_data']
                );
            }
        } catch (PDOException $e) {
            error_log("Errorea produktuak bilatzean: " . $e->getMessage());
        }
        return $produktuak;
    }

    public static function selectProduktuakByTerm($term) {
        $produktuak = [];
        $sql = "SELECT * FROM Produktuak WHERE izena LIKE ? ORDER BY izena LIMIT 5";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return $produktuak;
            
            $kontsulta = $konexioa->prepare($sql);
            $kontsulta->execute(["%" . $term . "%"]);
            
            while ($emaitza = $kontsulta->fetch(PDO::FETCH_ASSOC)) {
                $produktuak[] = new Produktua(
                    $emaitza['id'],
                    $emaitza['id_kategoria'],
                    $emaitza['izena'],
                    $emaitza['prezioa'],
                    $emaitza['deskontua'],
                    $emaitza['nobedadeak'],
                    $emaitza['pisua'],
                    $emaitza['urtea'],
                    $emaitza['sortze_data']
                );
            }
        } catch (PDOException $e) {
            error_log("Errorea produktuak bilatzean: " . $e->getMessage());
        }
        return $produktuak;
    }

    public static function insertProduktu($produktua) {
        $sql = "INSERT INTO Produktuak (id_kategoria, izena, prezioa, deskontua, nobedadeak, pisua, urtea) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return false;
            
            $kontsulta = $konexioa->prepare($sql);
            $emaitza = $kontsulta->execute([
                $produktua->getIdKategoria(),
                $produktua->getIzena(),
                $produktua->getPrezioa(),
                $produktua->getDeskontua(),
                $produktua->getNobedadea(),
                $produktua->getPisua(),
                $produktua->getUrtea()
            ]);
            
            if ($emaitza) {
                $produktua->setId($konexioa->lastInsertId());
                return true;
            }
        } catch (PDOException $e) {
            error_log("Errorea produktua txertatzen: " . $e->getMessage());
        }
        return false;
    }

    public static function updateProduktu($produktua) {
        $sql = "UPDATE Produktuak SET id_kategoria = ?, izena = ?, prezioa = ?, deskontua = ?, nobedadeak = ?, pisua = ?, urtea = ? WHERE id = ?";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return false;
            
            $kontsulta = $konexioa->prepare($sql);
            return $kontsulta->execute([
                $produktua->getIdKategoria(),
                $produktua->getIzena(),
                $produktua->getPrezioa(),
                $produktua->getDeskontua(),
                $produktua->getNobedadea(),
                $produktua->getPisua(),
                $produktua->getUrtea(),
                $produktua->getId()
            ]);
        } catch (PDOException $e) {
            error_log("Errorea produktua eguneratzen: " . $e->getMessage());
        }
        return false;
    }

    public static function deleteProduktu($id) {
        $sql = "DELETE FROM Produktuak WHERE id = ?";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return false;
            
            $kontsulta = $konexioa->prepare($sql);
            return $kontsulta->execute([$id]);
        } catch (PDOException $e) {
            error_log("Errorea produktua ezabatzen: " . $e->getMessage());
        }
        return false;
    }
}
?> 
