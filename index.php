<?php
//$ruta_archivo_json = $ruta.'/imagenes_base64.json';// // Ruta al archivo JSON
$ruta_archivo_json = 'imagenes_base64.json';

// Leer el contenido del archivo JSON
$contenido = file_get_contents($ruta_archivo_json);

// Decodificar el contenido JSON en un array asociativo
$data = json_decode($contenido, true);

?>
<!DOCTYPE html>
<html>
  <head>
    <style>
        @import url("https://fonts.googleapis.com/css?family=Monoton");

        h2 {
          display: inline;
          font-size: 8vw;
          text-transform: uppercase;
          color: #F49E4C;
        }
        @media (min-width: 700px) {
          h2 {
            font-size: 2vw; /* Tamaño de las letras "solo mover de 1 en 1, cambia a gran escala"-*/
          }
        }
        @media (min-width: 1400px) {
          h2 {
            font-size: 150px;
          }
        }

        @supports (-webkit-background-clip: text) {
          h2 {
            color: transparent;
            background: linear-gradient(3deg, #F5EE9E 50%, #F49E4C 0);
            -webkit-background-clip: text;
          }
        }
    </style>


      <link rel="icon" href="/img/1683146412863.jpeg">
      <title>DYA Manufacturas convertidor de PDFs</title>
      <link rel="stylesheet" type="text/css" href="css/body.css" /> 
  </head>
  <body background="img/lomi.jpg">
<!--Espacio de seleccion de pestaña-->
        <div>
          <ul>
            <li><a href="index.php" >Convertir PDF a Excel</a></li>
            <li><a href="productos.php">Productos</a></li>
            <li><a href="modificacion_img.php">Subir imagenes</a></li>
            <li><a href="excel">Carpeta Lotes</a></li>
            <li><a href="Concentrado_Remision">Carpeta de PDFs</a></li>
            <lu>
                <li style="float:right; color: white; text-transform: uppercase; padding: 10px 16px;">
                    <p><?php include "inc/timezone.php"; ?>
                    </p>
                </li>    
            </lu>  
        </ul> 
      </div>
    <!--<a><?php 
                    date_default_timezone_set('America/Mexico_City');
                    #$fechaActual = date("d-m-Y");
                    $horaActual = date("h:i:s");
                    #echo "La fecha es: $fechaActual y la hora es $horaActual " ;
                    echo $horaActual;
                    # El resultado es: La fecha es: 11-02-2023 y la hora es 06:25:06
                    ?></a>  -->
<!--Espacio para el nombre de la empresa-->
      <div class="container">
          <div class="row">
              <div class="col-sm-12">
                  <div class="page-header", >
                        
                      <h2>DYA MANUFACTURAS</h2>
                            
                      <div class="logo">
                            <span class="label label-danger" >DYA MANUFACTURAS SA DE CV</span>
                      </div>  
                            
                  </div>
              </div>
          </div>
      </div>
<br><br>
<!--Eapacio para el convertidor-->
      <div class="main" >
        
            <span><h1>Ingresa el archivo de Remisiones</h1></span>
            <form action="AB1.php" method="POST" enctype="multipart/form-data">
            <!--form action="procesar_excel.php" method="post" enctype="multipart/form-data"-->
            <!--SELECCIONAR EL NUMERO DE HOJA QUE SE QUIERE IMPRIMIR-->
                <label for="numero">Selecciona un número un numero de Hoja</label>
                <select name="numero" required>
                    <?php
                    for ($i = 1; $i <= 15; $i++) {
                        echo "<option value=\"$i\">$i</option>";
                    }
                    ?>
                </select>
                <br>
                <!--SELECCIONAR UNA IMAGEN-->
                <label for="imagen_seleccionada">Seleccionar contenido:</label>
                    <select name="imagen_seleccionada" id="imagen_seleccionada">
                    <?php

                    // Recorrer los datos y crear las opciones del select
                    foreach ($data as $key => $value) {
                        $value['id'] = $value['id'] - 1;
                        echo '<option value="' . $key . '">' . $key. '</option>';
                    }
                    ?>

                <!--SUBIR EL ARCHIVO EXCEL-->
                <h1>Ingrese Archivo de REMISIONES</h1><br>
                <label for="excel_file">Selecciona un archivo de Excel:</label><br>
                <input type="file" name="excel_file" id="excel_file" accept=".xlsx">
                <br>
                <!------------------------------------------------------------->
                <span><h1>Ingresa el Archivo de LOTES</h1></span><br>
                <br>
                <label for="archivo">Selecciona un archivo de Excel:</label><br>
                <!--form action="procesar.php" method="post" enctype="multipart/form-data"-->
                    <input type="file" name="archivo_excel_1" accept=".xlsx"><br>
                    <label for="hoja_1">Selecciona una hoja:</label>
                    <select name="hoja_1" id="hoja_1">
                        <option value="0">Enero</option>
                        <option value="1">Febrero</option>
                        <option value="2">Marzo</option>
                        <option value="3">Abril</option>
                        <option value="4">Mayo</option>
                        <option value="5">Junio</option>
                        <option value="6">Julio</option>
                        <option value="7">Agosto</option>
                        <option value="8">Septiembre</option>
                        <option value="9">Octubre</option>
                        <option value="10">Noviembre</option>
                        <option value="11">Diciembre</option>
                    </select>
                <br><br>
                <input type="submit" name="submit" value="Cargar y Mostrar">
            </form>
      </div>

  </body>
  <!--<script src="js/hour.js"></script>-->
</html>