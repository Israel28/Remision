<?php
if (isset($_FILES['archivo'])) {
    $numero_seleccionado = $_POST["numero_hoja"];
    
    // Obtener el contenido de la celda B2 sin mover el archivo
    $spreadsheet_Excel_Lotes = IOFactory::load($_FILES['archivo']['tmp_name']);
    
    // Realiza las modificaciones necesarias en el archivo
    // Obtiene la hoja de cálculo activa (puedes cambiarlo si deseas verificar en una hoja específica)
    $sheet = $spreadsheet_Excel_Lotes->getActiveSheet();

    // Obtiene todas las filas con datos en la hoja
    $rows = $sheet->toArray();
    // Obtiene el número de la última fila con datos
    $ultimaFilaConDatos = count($rows);

/************************************************************************************************************************************************ */
/**   extraccion de Datos para actualizar el mismo */
/************************************************************************************************************************************************ */
    $contador = 1;
    $bandera_B = False;
    $bandera_D = False;
    $valor_Clave_Codigo = null;
    $valor_Dato_Lote = null;
    $hoja_seleccionada = intval($numero_seleccionado) - 1; 
    // Índice de la hoja que deseas seleccionar    
    $hoja_Lotes = $spreadsheet_Excel_Lotes->getSheet($hoja_seleccionada); //guardamos solo la hoja seleccionada
    $Dato_Encontrado = Null;
    foreach ($hoja_Lotes->getRowIterator() as $fila) {//
        foreach ($fila->getCellIterator() as $celda) {
            $columnaCelda = $celda->getColumn(); // Obtener la columna de la celda
            $filaCelda = $celda->getRow(); // Obtener la fila de la celda
            // Extraigo "B" para traer la "Clave", la Letra "D" para el "LOTE", y la letra "H"  

            if ($celda->getColumn() === 'B' ){
                $bandera_B = True;
                /* echo '<br>2.- '.*/$valor_Clave_Codigo = $celda->getValue();// obtener el valor de la celda "B"
                /* echo '<br>'. */$ubicacion_Celda_B = 'B' . $filaCelda. '-->'. $valor_Clave_Codigo;
                $fila_fila = $filaCelda;
            }
            //Obtener el numero de LOTE dentro de archivo para 
            elseif ($celda->getColumn() === 'D' ) {
                    $bandera_D = True;
                    $valor_Dato_Lote = $celda->getValue();// obtener el valor de la celda "I"
                    /*echo '<br>4.- '. */$ubicacion_Celda_D = 'D' . $filaCelda. '-->'. $valor_Dato_Lote;
            }
        }
        if($valor_Clave_Codigo != null && $valor_Dato_Lote != null){
            foreach($resultado as $iteracion){
                $Lote = $iteracion['Lote']; 
                $Codigo = $iteracion['Codigo'];
                $piezas = $iteracion['Piezas']; 
                if($Codigo === $valor_Clave_Codigo && $Lote === $valor_Dato_Lote){
                    echo '<br>'.
                    $ubicacion_Celda = 'I'.$fila_fila;
                    $sheet->setCellValue($ubicacion_Celda, $piezas);
                }else{
                    echo '<form action="mensaje.php">';
                }

            }
        }

        if ($bandera_B === True && !$bandera_D === True){
            //echo '<br>2.-Clave: '.$ubicacion_Celda_B.", Lote: ".$ubicacion_Celda_D;// imprimimos el contenido de la celda "B y D"
        }
    }
    $sheet->setCellValue('K8', 'Hola mundo');

    //$spreadsheet_Excel_Lotes->getActiveSheet()->calculateFormulas();
    $write = new Xlsx($spreadsheet_Excel_Lotes);
    $write->save("excel/Concentrado_Lotes.xlsm");
    $write->save("excel/Concentrado_Lotes.xlsx");
    //$write->save("excel/123456.xlsx");
}