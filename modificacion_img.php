<?php
$ruta = __DIR__;
//echo $ruta; 
    
$ruta_archivo_json = $ruta.'/imagenes_base64.json';// // Ruta al archivo JSON
//$ruta_archivo_json ='C:\xampp\htdocs\imagenes_data.json';
// Leer el contenido del archivo JSON
$contenido = file_get_contents($ruta_archivo_json);

// Decodificar el contenido JSON
$data = json_decode($contenido, true);

?>



<?php  ob_start();?>
<!DOCTYPE html>
<html>
<head>

      <link rel="icon" href="/img/remi.ico">
      <title>Formulario de selección y carga de archivo</title>
      <link rel="stylesheet" type="text/css" href="css/body.css" /> 
    
    <!--//los estilos convertirlos en un archivo CSS     margin: 0 auto;-->
</head>
<body background="img/remi.jpg">

<!--Espacio de seleccion de pestaña-->
<div>
          <ul>
            
            <li><a href="index.php" >Convertir PDF a Excel</a></li>
            <li><a href="productos.php">Productos</a></li>
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
<br>

<div >
<table  class="default" style = "border: 0px solid #000; justify-content: center; margin: 0 auto;"> 
    <!--Fila 1-->
    <tr>
        <!--Columna 1-->
        <th scope="row" style = "border: 5px solid #000;">
            <!--SUBIR IMAGEN-->
            <h5>Subir imagen </h5>
                <form  method="post" enctype="multipart/form-data" id="subirForm">
                    <input type="file" name="imagen" id="imagen">
                    <input type="button" value="Subir imagen" onclick="subirImagen()">
                </form>
        </th>
        <!--Columna 2-->
            <th scope="row" style = "border: 5px solid #000;"> 
            <!--ELIMINAR IMAGEN-->
            <h1>Seleccione una imagen a eliminar</h1>
            <form method="post" for="eliminar" id="eliminarForm" >
                    ID del sector a eliminar: 
                        <select name="eliminar" id="eliminar">
                                <?php
                                // Recorrer los datos y crear las opciones del select
                                    // Recorrer los datos y crear las opciones del select
                                    foreach ($data as $nombre_imagen => $datos_imagen) {
                                        echo '<option value="' . $nombre_imagen . '">' . $nombre_imagen . '</option>';
                                    }
                                ?>
                        </select>
                    <input type="button" value="Eliminar" onclick="eliminarImagen()">
                </form>
        </th>
    </tr>
</table>
</div>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!-- Este Scrip menaja el selector de imagenes, aplicando la opcion de que si solo Se eliminna o se visualiza la imagen -->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!-- Script de jQuery -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function subirImagen() {
        // Lógica para subir la imagen utilizando AJAX
        var formData = new FormData($('#subirForm')[0]);

        $.ajax({
            type: 'POST',
            url: 'subir_imagen.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert(response); // Muestra la respuesta del servidor (puedes cambiar esto según tus necesidades)
            }
        });
    }

    function eliminarImagen() {
        // Lógica para eliminar la imagen utilizando AJAX
        var formData = $('#eliminarForm').serialize();

        $.ajax({
            type: 'POST',
            url: 'eliminar_imagen.php',
            data: formData,
            success: function(response) {
                alert(response); // Muestra la respuesta del servidor (puedes cambiar esto según tus necesidades)
            }
        });
    }
</script>
</body>
</html>