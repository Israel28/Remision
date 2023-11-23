<?php
$ruta = __DIR__;
//echo $ruta; 
    
$ruta_archivo_json = $ruta.'/imagenes_base64.json';// // Ruta al archivo JSON
//$ruta_archivo_json ='C:\xampp\htdocs\imagenes_data.json';
// Leer el contenido del archivo JSON
$contenido = file_get_contents($ruta_archivo_json);

// Decodificar el contenido JSON
$data = json_decode($contenido, true);


// Verificar si se ha enviado un archivo
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Manejar la subida de la imagen
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        // Obtener la información del archivo
        $nombre_archivo = $_FILES['imagen']['name'];
        $tipo_archivo = $_FILES['imagen']['type'];
        $ruta_temporal = $_FILES['imagen']['tmp_name'];
        
        // Obtener el nombre de archivo sin la extensión
        $nombre_archivo = pathinfo($nombre_archivo, PATHINFO_FILENAME);

        // Tu código para cargar el archivo JSON
        $archivo_json = 'imagenes_base64.json';
        $imagenes_data = [];

        if (file_exists($archivo_json)) {
            $json_content = file_get_contents($archivo_json);
            $imagenes_data = json_decode($json_content, true);
        }

        // Verificar si el nombre de la imagen ya existe
        if (isset($imagenes_data[$nombre_archivo])) {
            // Si el nombre de la imagen ya existe, muestra un mensaje de error
            echo "Error: El nombre de la imagen ya existe.";
            exit();
        }

        // Obtener el último ID numérico
        $ultimo_id = 1;
        foreach ($imagenes_data as $nombres => $datos_id) {
                if ($datos_id['id'] > $ultimo_id) {
                    $ultimo_id = $datos_id['id'];
                }
        }
        $nuevo_id = $ultimo_id + 1;
        //codificar la imagen en base64
        $imagen_base64 = base64_encode(file_get_contents($ruta_temporal));
        //Guardar la fecha de cuando se guardo la imagen
        $fecha_subida = date('Y-m-d H:i:s');
        // Agregar los datos de la imagen al array
        $imagenes_datos = array(
            'id' => $nuevo_id,
            'fecha_subida' => $fecha_subida,
            'base64' => $imagen_base64
        );

        $imagenes_data[$nombre_archivo] = $imagenes_datos;

        // Convertir el array final en formato JSON
        $jsonData = json_encode($imagenes_data);

        // Guardar los datos en el archivo JSON
        file_put_contents($archivo_json, $jsonData);

        // Puedes imprimir un mensaje de éxito si lo deseas
        echo "Imagen subida con éxito.";
    } else {
        //echo "Error al subir la imagen.";
    }
}
?>