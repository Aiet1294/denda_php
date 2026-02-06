<?php

namespace com\leartik\daw24aiet\kategoriak;
use PDO;
use PDOException;

require_once __DIR__ . '/kategoria.php';
require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))) . '/index.php';

class KategoriaDB {

    private static function getConnection() {
        return \getDbConnection();
    }

    public static function selectKategoria($id) {
        $sql = "SELECT * FROM Kategoriak WHERE id = ?";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return null;
            
            $kontsulta = $konexioa->prepare($sql);
            $kontsulta->execute([$id]);
            
            $emaitza = $kontsulta->fetch(PDO::FETCH_ASSOC);
            if ($emaitza) {
                return new Kategoria(
                    $emaitza['id'],
                    $emaitza['izena'],
                    $emaitza['deskribapena'],
                    $emaitza['sortze_data']
                );
            }
        } catch (PDOException $e) {
            error_log("Errorea kategoria lortzean: " . $e->getMessage());
        }
        return null;
    }

    public static function selectKategoriaByIzena($izena) {
        $sql = "SELECT * FROM Kategoriak WHERE izena = ?";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return null;
            
            $kontsulta = $konexioa->prepare($sql);
            $kontsulta->execute([$izena]);
            
            $emaitza = $kontsulta->fetch(PDO::FETCH_ASSOC);
            if ($emaitza) {
                return new Kategoria(
                    $emaitza['id'],
                    $emaitza['izena'],
                    $emaitza['deskribapena'],
                    $emaitza['sortze_data']
                );
            }
        } catch (PDOException $e) {
            error_log("Errorea kategoria lortzean izenaren arabera: " . $e->getMessage());
        }
        return null;
    }

    public static function selectKategoriak() {
        $kategoriak = [];
        $sql = "SELECT * FROM Kategoriak ORDER BY id ASC";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return $kategoriak;
            
            $kontsulta = $konexioa->prepare($sql);
            $kontsulta->execute();
            
            while ($emaitza = $kontsulta->fetch(PDO::FETCH_ASSOC)) {
                $kategoriak[] = new Kategoria(
                    $emaitza['id'],
                    $emaitza['izena'],
                    $emaitza['deskribapena'],
                    $emaitza['sortze_data']
                );
            }
        } catch (PDOException $e) {
            error_log("Errorea kategoriak lortzean: " . $e->getMessage());
        }
        return $kategoriak;
    }

    public static function insertKategoria($kategoria) {
        $sql = "INSERT INTO Kategoriak (izena, deskribapena) VALUES (?, ?)";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return false;
            
            $kontsulta = $konexioa->prepare($sql);
            $emaitza = $kontsulta->execute([
                $kategoria->getIzena(),
                $kategoria->getDeskribapena()
            ]);
            
            if ($emaitza) {
                $kategoria->setId($konexioa->lastInsertId());
                return true;
            }
        } catch (PDOException $e) {
            error_log("Errorea kategoria txertatzen: " . $e->getMessage());
        }
        return false;
    }

    public static function updateKategoria($kategoria) {
        $sql = "UPDATE Kategoriak SET izena = ?, deskribapena = ? WHERE id = ?";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return false;
            
            $kontsulta = $konexioa->prepare($sql);
            return $kontsulta->execute([
                $kategoria->getIzena(),
                $kategoria->getDeskribapena(),
                $kategoria->getId()
            ]);
        } catch (PDOException $e) {
            error_log("Errorea kategoria eguneratzen: " . $e->getMessage());
        }
        return false;
    }

    public static function deleteKategoria($id) {
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return false;
            
            $konexioa->exec('PRAGMA foreign_keys = ON');
            
            $sql = "DELETE FROM Kategoriak WHERE id = ?";
            $kontsulta = $konexioa->prepare($sql);
            $result = $kontsulta->execute([$id]);
            
            if ($result) {
                error_log("Kategoria ezabatu da (ID: $id) - CASCADE bidez produktuak ere ezabatu dira");
            }
            
            return $result;
            
        } catch (PDOException $e) {
            error_log("Errorea kategoria ezabatzen: " . $e->getMessage());
        }
        return false;
    }
    
    public static function kategoriakanProdukturikBaDu($id) {
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return false;
            
            $sql = "SELECT COUNT(*) as total FROM Produktuak WHERE id_kategoria = ?";
            $stmt = $konexioa->prepare($sql);
            $stmt->execute([$id]);
            $emaitza = $stmt->fetch();
            
            return $emaitza['total'] > 0;
        } catch (PDOException $e) {
            error_log("Errorea produktu kopurua egiaztatzen: " . $e->getMessage());
        }
        return false;
    }
    
    public static function getProduktuKopuruaKategorian($id) {
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return 0;
            
            $sql = "SELECT COUNT(*) as total FROM Produktuak WHERE id_kategoria = ?";
            $stmt = $konexioa->prepare($sql);
            $stmt->execute([$id]);
            $emaitza = $stmt->fetch();
            
            return (int)$emaitza['total'];
        } catch (PDOException $e) {
            error_log("Errorea produktu kopurua lortzean: " . $e->getMessage());
        }
        return 0;
    }
}
?> 
