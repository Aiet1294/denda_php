<?php

namespace com\leartik\daw24aiet\mezuak;

use PDO;
use PDOException;

require_once __DIR__ . '/mezua.php';
require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))) . '/index.php';


class MezuaDB {

    private static function getConnection() {
        try {
            $pdo = new PDO('sqlite:' . DB_PATH);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            $pdo->exec('PRAGMA foreign_keys = ON');
            
            return $pdo;
        } catch (PDOException $e) {
            error_log("Konexio errorea: " . $e->getMessage());
            return null;
        }
    }

    public static function selectMezua($id) {
        $sql = "SELECT * FROM Mezuak WHERE id = ?";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return null;
            
            $kontsulta = $konexioa->prepare($sql);
            $kontsulta->execute([$id]);
            
            $emaitza = $kontsulta->fetch(PDO::FETCH_ASSOC);
            if ($emaitza) {
                return new Mezua(
                    $emaitza['id'],
                    $emaitza['izena'],
                    $emaitza['email'],
                    $emaitza['mezua'],
                    $emaitza['erantzunda'],
                    $emaitza['sortze_data']
                );
            }
        } catch (PDOException $e) {
            error_log("Errorea mezua lortzean: " . $e->getMessage());
        }
        return null;
    }

    public static function selectMezuak() {
        $mezuak = []; 
        $sql = "SELECT * FROM Mezuak ORDER BY id ASC";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return $mezuak;
            $kontsulta = $konexioa->query($sql);
            $emaitzak = $kontsulta->fetchAll(PDO::FETCH_ASSOC);
            foreach ($emaitzak as $emaitza) {
                $mezuak[] = new Mezua(
                    $emaitza['id'],
                    $emaitza['izena'],
                    $emaitza['email'],
                    $emaitza['mezua'],
                    $emaitza['erantzunda'],
                    $emaitza['sortze_data']
                );
            }
        } catch (PDOException $e) {
            error_log("Errorea mezuak lortzean: " . $e->getMessage());
        }
        return $mezuak;
    }

    public static function insertMezua($mezua) {
        $sql = "INSERT INTO Mezuak (izena, email, mezua, erantzunda, sortze_data) VALUES (?, ?, ?, ?, ?)";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return false;
            
            $kontsulta = $konexioa->prepare($sql);
            $kontsulta->execute([
                $mezua->getIzena(),
                $mezua->getEmail(),
                $mezua->getMezua(),
                $mezua->getErantzunda() ? 1 : 0,
                $mezua->getSortzeData()
            ]);
            $mezua->setIdMezua($konexioa->lastInsertId());
            return true;
        } catch (PDOException $e) {
            error_log("Errorea mezua sartzean: " . $e->getMessage());
            return false;
        }
    }

    public static function updateMezua(Mezua $mezua) {
        $sql = "UPDATE Mezuak SET izena = ?, email = ?, mezua = ?, erantzunda = ? WHERE id = ?";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return false;
            
            $kontsulta = $konexioa->prepare($sql);
            $kontsulta->execute([
                $mezua->getIzena(),
                $mezua->getEmail(),
                $mezua->getMezua(),
                $mezua->getErantzunda() ? 1 : 0,
                $mezua->getIdMezua()
            ]);
            return $kontsulta->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Errorea mezua eguneratzean: " . $e->getMessage());
            return false;
        }
    }

    public static function deleteMezua($id) {
        $sql = "DELETE FROM Mezuak WHERE id = ?";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return false;
            
            $kontsulta = $konexioa->prepare($sql);
            $kontsulta->execute([$id]);
            return $kontsulta->rowCount() > 0;
        } catch (PDOException $e) {
            error_log("Errorea mezua ezabatzean: " . $e->getMessage());
            return false;
        }
    }
}