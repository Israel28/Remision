<?php

$ruta = __DIR__;
//echo $ruta; 
    
$ruta_archivo_json = $ruta.'/imagenes_base64.json';// // Ruta al archivo JSON
//$ruta_archivo_json ='C:\xampp\htdocs\imagenes_data.json';
// Leer el contenido del archivo JSON
$contenido = file_get_contents($ruta_archivo_json);

// Decodificar el contenido JSON
$data = json_decode($contenido, true);
// Verificar si se ha enviado el formulario de selección

/**//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
/**////////////////////////////////-----------METODO PARA ELIMINAR--------------/////////////////////////////////////////// */
/**//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
// Leer el contenido del archivo JSON
$jsonString = file_get_contents($ruta_archivo_json);

// Decodificar el JSON a un arreglo asociativo
$datos = json_decode($jsonString, true);

// Función para obtener el contenido del archivo JSON y decodificarlo
function obtenerDatosDesdeJSON($ruta_archivo_json) {
    $contenido = file_get_contents($ruta_archivo_json);
    return json_decode($contenido, true);
}

// Función para guardar los datos actualizados en el archivo JSON
function guardarDatosEnJSON($ruta_archivo_json, $data) {
    $jsonData = json_encode($data);
    file_put_contents($ruta_archivo_json, $jsonData);
}

// Función para eliminar un elemento del JSON por su nombre
function eliminarElementoDelJSON($ruta_archivo_json, $nombre_elemento) {
    $data = obtenerDatosDesdeJSON($ruta_archivo_json);

    if (isset($data[$nombre_elemento])) {
        unset($data[$nombre_elemento]);
        guardarDatosEnJSON($ruta_archivo_json, $data);
        return true;
    }

    return false;
}

// Ejemplo de uso de la función para eliminar un elemento del JSON
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['eliminar'])) {
        $elemento_a_eliminar = $_POST['eliminar'];
        $resultado = eliminarElementoDelJSON($ruta_archivo_json, $elemento_a_eliminar);
        if ($resultado) {
            //echo "El elemento '$elemento_a_eliminar' ha sido eliminado del JSON.";
        } else {
            echo "El elemento '$elemento_a_eliminar' no existe en el JSON.";
        }
    }
}
/**//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
/**////////////////////////////////-----------METODO PARA MOSTRAR--------------/////////////////////////////////////////// */
/**//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
function obtenerContenidoBase64($nombre_imagen) {
    global $data;
    if (isset($data[$nombre_imagen]['base64'])) {
        return $data[$nombre_imagen]['base64'];
    }
    return '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['imagen_seleccionada'])) {
        $imagen_seleccionada = $_POST['imagen_seleccionada'];
        $contenido_base64 = obtenerContenidoBase64($imagen_seleccionada);
    } else {
        echo '<p>Debes seleccionar una imagen válida.</p>';
    }
}
/**//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
/**////////////////////////////////-----------METODO PARA AGREGAR--------------/////////////////////////////////////////// */
/**//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////// */
//crear una array nuevo donde se guarde todo

$arrayFinal = array();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_FILES["imagen"]) && $_FILES["imagen"]["error"] == 0) {
        $imagen_tmp = $_FILES["imagen"]["tmp_name"];

        $archivo_json = 'imagenes_base64.json';
        $imagenes_data = array();
        if (file_exists($archivo_json)) {
            $json_content = file_get_contents($archivo_json);
            $imagenes_data = json_decode($json_content, true);
        }
/************************************************************************* */
//Datos que se guardaran en las variables

        // Obtener el último ID numérico
        $ultimo_id = 1;
        foreach ($imagenes_data as $nombres => $datos_id) {
                if ($datos_id['id'] > $ultimo_id) {
                    $ultimo_id = $datos_id['id'];
                }
        }
        $nuevo_id = $ultimo_id + 1;
        //codificar la imagen en base64
        $imagen_base64 = base64_encode(file_get_contents($imagen_tmp));
        //Guardar el nombre dle archivo
        $nombre_archivo = $_FILES["imagen"]["name"];
        //Guardar la fecha de cuando se guardo la imagen
        $fecha_subida = date('Y-m-d H:i:s');

        // Cargar el archivo JSON si existe
        $archivo_json = 'imagenes_base64.json';
        $imagenes_data = [];
        if (file_exists($archivo_json)) {
            $json_content = file_get_contents($archivo_json);
            $imagenes_data = json_decode($json_content, true);
        }

        // Verificar si el nombre de la imagen ya existe
        foreach ($imagenes_data as $datos) {
            if ($datos === $nombre_archivo) {
                // Si el nombre de la imagen ya existe, muestra un mensaje de error
                echo "Error: El nombre de la imagen ya existe.";
                exit();
            }
        }      

        // Agregar los datos de la imagen al array
        $imagenes_datos = array(
            'id' => $nuevo_id,
            'fecha_subida' => $fecha_subida,
            'base64' => $imagen_base64
        );

        //$imagenes_data[] = $imagen_data;
        //creamos un nuevo array y los guardamos
        $imagenes_data[$nombre_archivo] = $imagenes_datos;

        // Convertir el array final en formato JSON
        $jsonData = json_encode($imagenes_data);
/************************************************************************* */
/************************************************************************* */
#         Este codigo debe de ponerse en otro archivo PHP para que no choque con el codigo de arriva porque el de arriva es para subir 
#         imagenes y ponerlas en el archivo json

        // Guardar el array de imágenes en el archivo JSON
        file_put_contents($archivo_json, $jsonData);
        // Muestra la imagen codificada en BASE64 en la página (solo para propósitos de demostración)
        echo "<h2>Imagen codificada en BASE64:</h2>";
        //echo "<img src='data:image/jpeg;base64," . $imagen_base64 . "' />";

    } else {
        //echo "Error al subir la imagen.";
    }
}
?>
<!--*********************************************NOTA*************************************-->
<!--Poner cada una de estas tablas estos select dentro de una tabla para que se vea mas organizado-->
<!--*********************************************NOTA*************************************-->
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
                <form  method="post" enctype="multipart/form-data" onsubmit="return ejecutarAccion()">
                    <input type="file" name="imagen" id="imagen">
                    <input type="submit" value="Subir imagen">
                </form>
                <div id="resultado"></div>
        </th>
        <!--Columna 2-->
            <th scope="row" style = "border: 5px solid #000;"> 
            <h1>Eliminar imagen</h1>
            <!--ELIMINAR IMAGEN-->
            <h1>Seleccione una imagen a eliminar</h1>
            <form method="post" for="eliminar">
                    ID del sector a eliminar: 
                        <select name="eliminar" id="eliminar">
                                <?php
                                // Recorrer los datos y crear las opciones del select
                                foreach ($data as $nombre_imagen => $datos_imagen) {
                                    echo '<option value="' . $nombre_imagen . '">' . $nombre_imagen . '</option>';
                                }
                                ?>
                        </select>
                    <input type="submit" value="Eliminar">
                </form>
        </th>
    </tr>
    <!--Fila 2-->
    <tr>
        <!--columna 1-->
        <th scope="row" style = "border: 5px solid #000;"> 
                <!--MOSTRAR IMAGEN-->
                <h3>Seleecione una Imagen<h3>
                    <form id="myForm" method="POST">
                        <label for="imagen_seleccionada"></label>
                        <select name="imagen_seleccionada" id="imagen_seleccionada">
                                <?php
                                // Recorrer los datos y crear las opciones del select
                                foreach ($data as $nombre_imagen => $datos_imagen) {
                                    echo '<option value="' . $nombre_imagen . '">' . $nombre_imagen . '</option>';
                                }
                                ?>
                            </select>
                        
                        <input type="submit" value="Seleccionar">
                    </form>
        </th>
        <!--columna 2-->
        <th style = "border: 5px solid #000;">
            <h1>Imagen</h1>
            <?php
                if (!empty($contenido_base64)) {
                    //echo '<h2>Imagen seleccionada:</h2>';
                    echo '<img width="350" height="175"  src="data:image/jpeg;base64,' . $contenido_base64 . '" />';
                } else {
                    echo '<p>La imagen seleccionada no tiene contenido en base64.</p>';
                
                }
            ?>
        </th>
    <tr>
    <!--Fila 3-->
    <tr>
        <!--columna 1-->
        <th> 
        </th>
        <!--columna 2-->
        <th>
        </th>
    <tr>
</table>
</div>

<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<!-- Este Scrip menaja el selector de imagenes, aplicando la opcion de que si solo Se eliminna o se visualiza la imagen -->
<!--++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++-->
<script>
//checa porque no se puede generar el archivo dentro de chrome asi como en el subir la imagen dentor de chorme 
//existen esos 2 problemas para poder mnejar la informacion
//ya si no tiene porblema al manejar otroa navegador pues no existe o no se extiene esa poribilidad
        document.getElementById("myForm").onsubmit = function() {
            var accionSeleccionada = document.getElementById("accion").value;
            if (accionSeleccionada === "imagen_seleccionada") {
                // Visualizar imágenes (aquí debes poner tu código para visualizar las imágenes)
                var resultadoDiv = document.getElementById("resultado");
                resultadoDiv.innerHTML = "<h2>Imágenes visualizadas</h2>";
                
                // Devuelve false para detener el envío del formulario
                return false;
            } else if (accionSeleccionada === "eliminar") {
                // El formulario se enviará normalmente para ejecutar el método de eliminación en el servidor
                return true;
            }
        };

        function actualizarPagina() {
            location.reload();
        }
        
        // Manejador de clic para el botón manual
        document.getElementById("imagen").addEventListener("click", actualizarPagina);
        
        // Actualizar automáticamente cada 2 minutos
        setInterval(actualizarPagina, 2 * 60 * 1000); // 5 minutos en milisegundos
   
    </script>

</body>
</html>