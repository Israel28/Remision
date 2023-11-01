<!DOCTYPE html>
<html>
<head>
    <title>Mensaje en nueva pestaña</title>
</head>
<body>
    <button onclick="abrirNuevaPestana()">Abrir Nueva Pestaña</button>

    <script>
        function abrirNuevaPestana() {
            // Abrir una nueva ventana o pestaña
            var nuevaVentana = window.open('', '', 'width=400,height=200');

            // Escribir el mensaje en la nueva ventana
            nuevaVentana.document.write('<html><head><title>Mensaje</title></head><body>');
            nuevaVentana.document.write('<h1>Mensaje para el usuario</h1>');
            nuevaVentana.document.write('<p>Este es un mensaje en una nueva pestaña o ventana.</p>');
            nuevaVentana.document.write('</body></html>');
        }
    </script>
</body>
</html>
