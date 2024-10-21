<?php
include '../conf/conf.php';

function importarCSV($archivo, $pdo) {
    $file = fopen($archivo, "r");
    $headers = fgetcsv($file);
    $errores = [];

    $stmt = $pdo->prepare("INSERT INTO students (first_name_students, last_name_students, email_students, phone_students, carnet_students, program_id, study_mode_id)
            VALUES (:firstName, :lastName, :email, :phone, :carnet, :career, :studyMode)");

    while (($data = fgetcsv($file)) !== FALSE) {
        try {
            $stmt->bindParam(':firstName', $data[0]);
            $stmt->bindParam(':lastName', $data[1]);
            $stmt->bindParam(':email', $data[2]);
            $stmt->bindParam(':phone', $data[3]);
            $stmt->bindParam(':carnet', $data[4]);
            $stmt->bindParam(':career', $data[5]);
            $stmt->bindParam(':studyMode', $data[6]);
            $stmt->execute();
        } catch(PDOException $e) {
            $errores[] = "Error al insertar fila: " . $e->getMessage();
        }
    }

    fclose($file);
    return $errores;

}

function importarExcel($archivo, $pdo) {
    $errores = [];

    // Verificar si la extensión ZIP está disponible
    if (!class_exists('ZipArchive')) {
        return ["La extensión ZIP no está disponible. No se puede procesar el archivo XLSX."];
    }

    $zip = new ZipArchive;
    if ($zip->open($archivo) === TRUE) {
        // Leer sharedStrings.xml para obtener los valores de texto
        $sharedStringsXML = $zip->getFromName('xl/sharedStrings.xml');
        $sharedStrings = [];
        if ($sharedStringsXML !== false) {
            $sharedStringsData = new SimpleXMLElement($sharedStringsXML);
            foreach ($sharedStringsData->si as $si) {
                $sharedStrings[] = (string)$si->t;
            }
        }

        // Leer el contenido de la hoja de cálculo
        $content = $zip->getFromName('xl/worksheets/sheet1.xml');
        $zip->close();

        $xml = new SimpleXMLElement($content);
        $sheetData = $xml->sheetData;

        $stmt = $pdo->prepare("INSERT INTO students (first_name_students, last_name_students, email_students, phone_students, carnet_students, program_id, study_mode_id)
            VALUES (:firstName, :lastName, :email, :phone, :carnet, :career, :studyMode)");

        $rowCount = 0;
        foreach ($sheetData->row as $row) {
            if ($rowCount++ == 0) continue; // Saltar la fila del encabezado

            $rowData = [];
            foreach ($row->c as $cell) {
                // Verificar si la celda hace referencia a sharedStrings
                $value = (string)$cell->v;
                if (isset($cell['t']) && $cell['t'] == 's') {
                    // El valor es un índice en sharedStrings
                    $value = $sharedStrings[(int)$value];
                }
                $rowData[] = $value;
            }

            try {
                $stmt->bindParam(':firstName', $rowData[0]);
                $stmt->bindParam(':lastName', $rowData[1]);
                $stmt->bindParam(':email', $rowData[2]);
                $stmt->bindParam(':phone', $rowData[3]);
                $stmt->bindParam(':carnet', $rowData[4]);
                $stmt->bindParam(':career', $rowData[5]);
                $stmt->bindParam(':studyMode', $rowData[6]);
                $stmt->execute();
            } catch(PDOException $e) {
                $errores[] = "Error al insertar fila $rowCount: " . $e->getMessage();
            }
        }
    } else {
        $errores[] = "No se pudo abrir el archivo XLSX.";
    }

    return $errores;
}


// Manejo de la subida del archivo
// Manejo de la subida del archivo
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si el archivo ha sido subido correctamente
    if (isset($_FILES["archivo"]) && $_FILES["archivo"]["error"] == UPLOAD_ERR_OK) {
        $archivo = $_FILES["archivo"]["tmp_name"];
        $extension = strtolower(pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION));

        try {
            // Asegúrate de que $connection esté definida antes de este bloque
            $connection->beginTransaction();
            $errores = [];

            if ($extension == "csv") {
                $errores = importarCSV($archivo, $connection);
                $mensaje = 'Importación de CSV completada.';
            } elseif ($extension == "xlsx") {
                $errores = importarExcel($archivo, $connection);
                $mensaje = 'Importación de Excel completada.';
            } else {
                $errores[] = 'Formato de archivo no soportado.';
            }

            if (empty($errores)) {
                $connection->commit();
                echo "<script>alert('$mensaje'); </script>";
            } else {
                $connection->rollBack();
                $erroresEscapados = implode("\\n", array_map('addslashes', $errores)); // Escapar errores para evitar romper el JavaScript
                echo "<script>alert('Se encontraron errores durante la importación:\\n$erroresEscapados'); window.location.href = '../views/students.php';</script>";
            }
        } catch (Exception $e) {
            $connection->rollBack();
            $mensajeError = addslashes($e->getMessage()); // Escapar el mensaje de error
            echo "<script>alert('Error durante la importación: $mensajeError'); window.location.href = '../views/students.php';</script>";
        }
    } else {
        echo "<script>alert('Error al subir el archivo.'); window.location.href = '../views/students.php';</script>";
    }
}

?>