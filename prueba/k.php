<?php
require '../vendor/autoload.php'; // Asegúrate de tener la librería PhpSpreadsheet instalada

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['archivo_excel']) && isset($_POST['hoja_numero'])) {
        $hojaIndex = (int)$_POST['hoja_numero'];
        
        $archivoTmp = $_FILES['archivo_excel']['tmp_name'];

        $reader = IOFactory::createReader('Xlsx');
        $spreadsheet = $reader->load($archivoTmp);

        $hojas = $spreadsheet->getSheetNames();

        if ($hojaIndex < count($hojas)) {
            $nombreHoja = $hojas[$hojaIndex];
            //echo "El nombre de la hoja seleccionada es: $nombreHoja";
            // Suponiendo que $nombreHoja contiene el nombre de la hoja seleccionada
            $worksheet = $spreadsheet->getSheetByName($nombreHoja);
            $valorCeldaK8 = $worksheet->getCell('K8')->getValue();

            //echo "El valor de la celda K8 en la hoja $nombreHoja es: $valorCeldaK8";

            // Suponiendo que $nombreHoja contiene el nombre de la hoja seleccionada
            $worksheet = $spreadsheet->getSheetByName($nombreHoja);
            $valorCeldaK8 = $worksheet->getCell('K8')->getValue();
                    
            echo "El valor de la celda K8 en la hoja $nombreHoja es: $valorCeldaK8";
                    
            // Insertar "Hola mundo" en la celda K10
            $worksheet->setCellValue('K10', 'Hola mundo');
            //$spreadsheet_Excel_Lotes->getActiveSheet()->calculateFormulas();
            $write = new Xlsx($spreadsheet);
            //$write->save("excel/Concentrado_Lotes.xlsm");
            $write->save("Concentrado_Lotes.xlsx");
        } else {
            echo "El índice de la hoja seleccionada es inválido.";
        }
    } else {
        echo "Por favor, sube un archivo Excel y selecciona una hoja.";
    }
}
?>
