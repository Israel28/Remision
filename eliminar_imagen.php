<?php
$ruta = __DIR__;
//echo $ruta; 
    
$ruta_archivo_json = $ruta.'/imagenes_base64.json';// // Ruta al archivo JSON
//$ruta_archivo_json ='C:\xampp\htdocs\imagenes_data.json';
// Leer el contenido del archivo JSON
$contenido = file_get_contents($ruta_archivo_json);

// Decodificar el contenido JSON
$data = json_decode($contenido, true);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtener el ID seleccionado para eliminar
    $id_eliminar = $_POST['eliminar'];

    // Cargar los datos existentes desde el archivo JSON
    $archivo_json = 'imagenes_base64.json';
    $imagenes_data = [];

    if (file_exists($archivo_json)) {
        $json_content = file_get_contents($archivo_json);
        $imagenes_data = json_decode($json_content, true);
    }

    // Verificar si el ID seleccionado existe en los datos
    if (isset($imagenes_data[$id_eliminar])) {
        // Eliminar la imagen correspondiente al ID
        unset($imagenes_data[$id_eliminar]);

        // Convertir el array final en formato JSON
        $jsonData = json_encode($imagenes_data);

        // Guardar los datos en el archivo JSON
        file_put_contents($archivo_json, $jsonData);

        // Puedes imprimir un mensaje de éxito si lo deseas
        echo "Imagen eliminada con éxito.";
    } else {
        // Si el ID no existe, muestra un mensaje de error
        echo "Error: ID no válido.";
    }
}
?>