
<?php
for ($row = 2; $row <= max($highestRowB, $highestRowD); $row++) {
    $valor_Clave_Codigo = $worksheet1->getCell("B$row")->getValue();
    $valor_Clave_Codigo = strval($valor_Clave_Codigo);
    //echo '<br>'. gettype($valor_Clave_Codigo). '  '. $valor_Clave_Codigo.'<br><br>';
    $valor_Dato_Lote = $worksheet1->getCell("D$row")->getValue();
    //echo '<br>'.$valor_Dato_Lote.'<br>';
    $dato_lote = $worksheet1->getCell('B'.$row)->getCalculatedValue();
    $dato_lote = strval($dato_lote);
    
    foreach($resultado as $iteracion){
        $Lote = $iteracion['Lote']; 
        $Codigo = $iteracion['Codigo'];
        //echo '<br>'.
        $piezas = $iteracion['Piezas']; 
        //echo '<br>'. gettype($Codigo = $iteracion['Codigo']). '  '. $Codigo = $iteracion['Codigo'].'<br><br>';
        //echo 'Codigos '. $Codigo. ' es igual '. $valor_Clave_Codigo. '<br>'; 
        //echo 'Lotes' . $Lote. ' es igual '. $valor_Dato_Lote. '<br><br>'; 
        //$worksheet1->setCellValue("I$row", $piezas);
        if($Lote === $valor_Dato_Lote ){
            /*echo '<br><br>Codigos '. $valor_Dato_Lote; //' es igual '. $valor_Clave_Codigo. '<br>'; 
            echo '<br>Lotes   ' . $Lote; //' es igual '. $valor_Dato_Lote. '<br><br>'; //*/
            //$worksheet1->setCellValue("I$row", $piezas);
            
            if($dato_lote){
                //echo '<br>'.$ubicacion_Celda = 'SE ENCUENTRA EN LA FILA '.'B'.$row;
            }
            if( $valor_Clave_Codigo === "N/A"){
                echo '<br>'.$ubicacion_Celda = 'I'.$row;
            }
            //echo '<br>'.
        }
    }
}

?>