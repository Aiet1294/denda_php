<?php

namespace com\leartik\daw24aiet\eskariak;

use PDO;
use PDOException;
use com\leartik\daw24aiet\bezeroak\Bezeroa;
use com\leartik\daw24aiet\detaileak\Detailea;
use com\leartik\daw24aiet\produktuak\ProduktuaDB;

require_once __DIR__ . '/eskaria.php';
require_once dirname(__DIR__) . '/bezeroak/bezeroa.php';
require_once dirname(__DIR__) . '/detaileak/detailea.php';
require_once dirname(__DIR__) . '/produktuak/produktua_db.php';
require_once dirname(dirname(dirname(dirname(dirname(__DIR__))))) . '/index.php';

class EskariaDB {

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

    public static function selectEskaria($id) {
        $sql = "SELECT * FROM Eskariak WHERE id = ?";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return null;
            
            $kontsulta = $konexioa->prepare($sql);
            $kontsulta->execute([$id]);
            
            $emaitza = $kontsulta->fetch(PDO::FETCH_ASSOC);
            if ($emaitza) {
                // Bezeroa sortu datu-baseko datuekin (Eskariak taulatik zuzenean)
                $bezeroa = new Bezeroa(
                    0,
                    $emaitza['izena'],
                    $emaitza['abizena'],
                    $emaitza['helbidea'],
                    $emaitza['herria'],
                    $emaitza['postaKodea'],
                    $emaitza['probintzia'],
                    $emaitza['emaila']
                );
                
                // Detaileak lortu
                $detaileak = self::selectDetaileak($konexioa, $id);
                
                return new Eskaria(
                    $emaitza['id'],
                    $emaitza['data'],
                    $bezeroa,
                    $detaileak,
                    $emaitza['balidatu']
                );
            }
        } catch (PDOException $e) {
            error_log("Errorea eskaria lortzean: " . $e->getMessage());
        }
        return null;
    }

    public static function selectEskariak() {
        $eskariak = [];
        $sql = "SELECT * FROM Eskariak ORDER BY data DESC";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return $eskariak;
            
            $kontsulta = $konexioa->prepare($sql);
            $kontsulta->execute();
            
            while ($emaitza = $kontsulta->fetch(PDO::FETCH_ASSOC)) {
                $bezeroa = new Bezeroa(
                    0,
                    $emaitza['izena'],
                    $emaitza['abizena'],
                    $emaitza['helbidea'],
                    $emaitza['herria'],
                    $emaitza['postaKodea'],
                    $emaitza['probintzia'],
                    $emaitza['emaila']
                );
                $detaileak = self::selectDetaileak($konexioa, $emaitza['id']);
                
                $eskariak[] = new Eskaria(
                    $emaitza['id'],
                    $emaitza['data'],
                    $bezeroa,
                    $detaileak,
                    $emaitza['balidatu']
                );
            }
        } catch (PDOException $e) {
            error_log("Errorea eskariak lortzean: " . $e->getMessage());
        }
        return $eskariak;
    }

    public static function insertEskaria($eskaria) {
        $sql = "INSERT INTO Eskariak (izena, abizena, helbidea, herria, postaKodea, probintzia, emaila) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return 0;
            
            $konexioa->beginTransaction();
            
            $stmt = $konexioa->prepare($sql);
            $bezeroa = $eskaria->getBezeroa();
            
            $stmt->execute([
                $bezeroa->getIzena(),
                $bezeroa->getAbizena(),
                $bezeroa->getHelbidea(),
                $bezeroa->getHerria(),
                $bezeroa->getPostaKodea(),
                $bezeroa->getProbintzia(),
                $bezeroa->getEmaila()
            ]);
            
            $eskariaId = $konexioa->lastInsertId();
            
            // Detaileak gorde
            $sqlDetailea = "INSERT INTO Detaileak (id_eskaria, id_produktua, kopurua, prezioa) VALUES (?, ?, ?, ?)";
            $stmtDetailea = $konexioa->prepare($sqlDetailea);
            
            foreach ($eskaria->getDetaileak() as $detailea) {
                $stmtDetailea->execute([
                    $eskariaId,
                    $detailea->getProduktua()->getId(),
                    $detailea->getKopurua(),
                    $detailea->getPrezioa()
                ]);
            }
            
            $konexioa->commit();
            return $eskariaId;
            
        } catch (PDOException $e) {
            if (isset($konexioa)) $konexioa->rollBack();
            error_log("Errorea eskaria gordetzean: " . $e->getMessage());
            return 0;
        }
    }

    public static function updateEskaria($eskaria) {
        $sql = "UPDATE Eskariak SET izena=?, abizena=?, helbidea=?, herria=?, postaKodea=?, probintzia=?, emaila=? WHERE id = ?";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return 0;
            
            $konexioa->beginTransaction();
            
            $stmt = $konexioa->prepare($sql);
            $bezeroa = $eskaria->getBezeroa();
            
            $stmt->execute([
                $bezeroa->getIzena(),
                $bezeroa->getAbizena(),
                $bezeroa->getHelbidea(),
                $bezeroa->getHerria(),
                $bezeroa->getPostaKodea(),
                $bezeroa->getProbintzia(),
                $bezeroa->getEmaila(),
                $eskaria->getId()
            ]);
            
            // Detaileak eguneratu (ezabatu eta berriro sortu)
            $sqlDelete = "DELETE FROM Detaileak WHERE id_eskaria = ?";
            $stmtDelete = $konexioa->prepare($sqlDelete);
            $stmtDelete->execute([$eskaria->getId()]);
            
            $sqlInsert = "INSERT INTO Detaileak (id_eskaria, id_produktua, kopurua, prezioa) VALUES (?, ?, ?, ?)";
            $stmtInsert = $konexioa->prepare($sqlInsert);
            
            foreach ($eskaria->getDetaileak() as $detailea) {
                $stmtInsert->execute([
                    $eskaria->getId(),
                    $detailea->getProduktua()->getId(),
                    $detailea->getKopurua(),
                    $detailea->getPrezioa()
                ]);
            }
            
            $konexioa->commit();
            return 1;
            
        } catch (PDOException $e) {
            if (isset($konexioa)) $konexioa->rollBack();
            error_log("Errorea eskaria eguneratzean: " . $e->getMessage());
            return 0;
        }
    }

    public static function deleteEskaria($id) {
        $sql = "DELETE FROM Eskariak WHERE id = ?";
        
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return 0;
            
            $konexioa->beginTransaction();
            
            $sqlDetaileak = "DELETE FROM Detaileak WHERE id_eskaria = ?";
            $stmtDetaileak = $konexioa->prepare($sqlDetaileak);
            $stmtDetaileak->execute([$id]);
            
            $stmt = $konexioa->prepare($sql);
            $stmt->execute([$id]);
            
            $konexioa->commit();
            return $stmt->rowCount();
            
        } catch (PDOException $e) {
            if (isset($konexioa)) $konexioa->rollBack();
            error_log("Errorea eskaria ezabatzean: " . $e->getMessage());
            return 0;
        }
    }
    
    private static function selectDetaileak($konexioa, $id_eskaria) {
        $detaileak = [];
        $sql = "SELECT * FROM Detaileak WHERE id_eskaria = ?";
        $stmt = $konexioa->prepare($sql);
        $stmt->execute([$id_eskaria]);
        
        while ($d = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $produktua = ProduktuaDB::selectProduktu($d['id_produktua']);
            if ($produktua) {
                $detaileak[] = new Detailea(0, $produktua, $d['kopurua'], $d['prezioa']);
            }
        }
        return $detaileak;
    }

    public static function updateBalidatu($id, $balidatu) {
        $sql = "UPDATE Eskariak SET balidatu = ? WHERE id = ?";
        try {
            $konexioa = self::getConnection();
            if (!$konexioa) return false;
            
            $stmt = $konexioa->prepare($sql);
            return $stmt->execute([$balidatu, $id]);
        } catch (PDOException $e) {
            error_log("Errorea updateBalidatu: " . $e->getMessage());
            return false;
        }
    }
}
