<?php

try {
    $db = new PDO('sqlite:../../db/denda.db');

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {

        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            // ID-a balidatu: zenbakia izan behar du
            if (!is_numeric($id)) {
                http_response_code(400);
                echo json_encode(['error' => 'IDa baliogabea da. Zenbakia izan behar du.']);
                exit;
            }

            $sql = "SELECT * FROM produktuak WHERE id=" . $_GET['id'];
            $erregistroak = $db->query($sql);

            if ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {

                $produktua = array();
                $produktua['id'] = $erregistroa['id'];
                $produktua['id_kategoria'] = $erregistroa['id_kategoria'];
                $produktua['izena'] = $erregistroa['izena'];
                $produktua['prezioa'] = $erregistroa['prezioa'];
                $produktua['deskontua'] = $erregistroa['deskontua'];
                $produktua['nobedadea'] = $erregistroa['nobedadea'];
                $produktua['pisua'] = $erregistroa['pisua'];
                $produktua['urtea'] = $erregistroa['urtea'];
                $produktua['sortze_data'] = $erregistroa['sortze_data'];

                echo json_encode($produktua, JSON_UNESCAPED_UNICODE);
            } else {
                // Albistea ez da aurkitu
                http_response_code(404); // Not Found
                echo json_encode(['error' => 'Ez da aurkitu ' . $id . ' IDa duen albisterik.']);
            }
        } else {
            $sql = "SELECT * FROM produktuak";

            if (isset($_GET['mota'])) {
                if ($_GET['mota'] === 'nobedadeak') {
                    $sql .= " WHERE nobedadea = 1";
                } elseif ($_GET['mota'] === 'eskaintzak') {
                    $sql .= " WHERE deskontua > 0";
                }
            }

            $sql .= " order by id desc";
            $erregistroak = $db->query($sql);

            if ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC)) {

                $produktuak = array();
                $i = 0;
                do {
                    $produktuak[$i]['id'] = $erregistroa['id'];
                    $produktuak[$i]['id_kategoria'] = $erregistroa['id_kategoria'];
                    $produktuak[$i]['izena'] = $erregistroa['izena'];
                    $produktuak[$i]['prezioa'] = $erregistroa['prezioa'];
                    $produktuak[$i]['deskontua'] = $erregistroa['deskontua'];
                    $produktuak[$i]['nobedadea'] = $erregistroa['nobedadea'];
                    $produktuak[$i]['pisua'] = $erregistroa['pisua'];
                    $produktuak[$i]['urtea'] = $erregistroa['urtea'];
                    $produktuak[$i]['sortze_data'] = $erregistroa['sortze_data'];
                    $i++;
                } while ($erregistroa = $erregistroak->fetch(PDO::FETCH_ASSOC));
                echo json_encode($produktuak, JSON_UNESCAPED_UNICODE);
            }
        }
    }


    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = json_decode(file_get_contents('php://input'), true);

        // Datuak balidatu
        $errors = [];
        if (!isset($data['id_kategoria'])) {
            $errors[] = 'id_kategoria falta da.';
        }
        if (!isset($data['izena'])) {
            $errors[] = 'izena falta da.';
        }
        if (!isset($data['prezioa'])) {
            $errors[] = 'prezioa falta da.';
        }

        if (empty($errors)) {
            $id_kategoria = $data['id_kategoria'];
            $izena = $data['izena'];
            $prezioa = $data['prezioa'];
            $deskontua = isset($data['deskontua']) ? $data['deskontua'] : 0;
            $nobedadea = isset($data['nobedadea']) ? $data['nobedadea'] : 0;
            $pisua = isset($data['pisua']) ? $data['pisua'] : 0;
            $urtea = isset($data['urtea']) ? $data['urtea'] : date('Y');

            $sortze_data = date('Y-m-d H:i:s');

            $sql = "INSERT INTO produktuak (id_kategoria, izena, prezioa, deskontua, nobedadea, pisua, urtea, sortze_data) 
                    VALUES (:id_kategoria, :izena, :prezioa, :deskontua, :nobedadea, :pisua, :urtea, :sortze_data)";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id_kategoria', $id_kategoria);
            $stmt->bindParam(':izena', $izena);
            $stmt->bindParam(':prezioa', $prezioa);
            $stmt->bindParam(':deskontua', $deskontua);
            $stmt->bindParam(':nobedadea', $nobedadea);
            $stmt->bindParam(':pisua', $pisua);
            $stmt->bindParam(':urtea', $urtea);
            $stmt->bindParam(':sortze_data', $sortze_data);

            if ($stmt->execute()) {
                http_response_code(201);
                echo json_encode(['id' => $db->lastInsertId()]);
            } else {
                http_response_code(500);
                // Garapenean soilik: eman errorearen xehetasunak. Ekoizpenean mezu generikoago bat erabili.
                $errorInfo = $stmt->errorInfo();
                echo json_encode(['error' => 'Errorea produktua sortzean.', 'db_error' => $errorInfo[2]]);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Datu falta edo baliogabeak.', 'details' => $errors]);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
        $data = json_decode(file_get_contents('php://input'), true);

        // Datuak eta IDa balidatu
        $errors = [];
        if (!isset($_GET['id'])) {
            $errors[] = 'Produkturen IDa falta da URLan (?id=...).';
        }
        if (!isset($data['id_kategoria'])) {
            $errors[] = 'id_kategoria falta da.';
        }
        if (!isset($data['izena'])) {
            $errors[] = 'izena falta da.';
        }
        if (!isset($data['prezioa'])) {
            $errors[] = 'prezioa falta da.';
        }

        if (empty($errors)) {
            $id = $_GET['id'];
            if (!is_numeric($id)) {
                http_response_code(400);
                echo json_encode(['error' => 'IDa baliogabea da. Zenbakia izan behar du.']);
                exit;
            }

            $id_kategoria = $data['id_kategoria'];
            $izena = $data['izena'];
            $prezioa = $data['prezioa'];
            $deskontua = isset($data['deskontua']) ? $data['deskontua'] : 0;
            $nobedadea = isset($data['nobedadea']) ? $data['nobedadea'] : 0;
            $pisua = isset($data['pisua']) ? $data['pisua'] : 0;
            $urtea = isset($data['urtea']) ? $data['urtea'] : date('Y');

            $sql = "UPDATE produktuak SET 
                        id_kategoria = :id_kategoria, 
                        izena = :izena, 
                        prezioa = :prezioa, 
                        deskontua = :deskontua, 
                        nobedadea = :nobedadea, 
                        pisua = :pisua, 
                        urtea = :urtea 
                    WHERE id = :id";

            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':id_kategoria', $id_kategoria);
            $stmt->bindParam(':izena', $izena);
            $stmt->bindParam(':prezioa', $prezioa);
            $stmt->bindParam(':deskontua', $deskontua);
            $stmt->bindParam(':nobedadea', $nobedadea);
            $stmt->bindParam(':pisua', $pisua);
            $stmt->bindParam(':urtea', $urtea);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    http_response_code(200);
                    echo json_encode(['message' => 'Produktua ondo aldatu da.']);
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Ez da aurkitu ' . $id . ' IDa duen produkturik.']);
                }
            } else {
                http_response_code(500);
                $errorInfo = $stmt->errorInfo();
                echo json_encode(['error' => 'Errorea produktua aldatzean.', 'db_error' => $errorInfo[2]]);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'Datu falta edo baliogabeak.', 'details' => $errors]);
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if (!is_numeric($id)) {
                http_response_code(400);
                echo json_encode(['error' => 'IDa baliogabea da. Zenbakia izan behar du.']);
                exit;
            }

            $sql = "DELETE FROM produktuak WHERE id = :id";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':id', $id);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    http_response_code(200);
                    echo json_encode(['message' => 'Produktua ondo ezabatu da.']);
                } else {
                    http_response_code(404);
                    echo json_encode(['error' => 'Ez da aurkitu ' . $id . ' IDa duen produkturik.']);
                }
            } else {
                http_response_code(500);
                echo json_encode(['error' => 'Errorea produktua ezabatzean.']);
            }
        } else {
            http_response_code(400);
            echo json_encode(['error' => 'IDa beharrezkoa da.']);
        }
    }

    if (!in_array($_SERVER['REQUEST_METHOD'], ['GET', 'POST', 'PUT', 'DELETE'])) {
        http_response_code(405);
        echo json_encode(['error' => 'Metodo ez onartua.']);
    }
} catch (Exception $e) {
    echo 'Konektatu ezin izan da: ' . $e->getMessage();
} catch (PDOException $e) {
    echo 'Datu-basearen errorea: ' . $e->getMessage();
}
