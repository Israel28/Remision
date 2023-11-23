<?PHP
// Ruta al archivo 
$jsonFile = 'Codigos.json';

// Verificar si el archivo JSON existe
if (!file_exists($jsonFile)) {
    die('El archivo JSON no existe.');
}

// Leer el contenido del archivo JSON
$data = file_get_contents($jsonFile);
$datos = json_decode($data, true);

?>
<!DOCTYPE html>
<html>
<head>
    <style>
        .styled-table { border-collapse: collapse; margin: 25px 0; font-size: 1em; font-family: sans-serif; min-width: 450px; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); }
        .styled-table thead tr { background-color: #980081; color: #ffffff; text-align: middle; }
        .styled-table th, .styled-table td { padding: 12px 15px; }
        .styled-table tbody tr { border-bottom: 1px solid #dddddd; } 
        .styled-table tbody tr:nth-of-type(even) { background-color: #f3f3f3; } 
        .styled-table tbody tr:last-of-type { border-bottom: 2px solid #009879; }
        p{color: #00FFE4; font-size: 140%; font-weight: bold; letter-spacing: 10px; text-align: center; text-shadow: rgb(255, 2, 2) 6px 6px 6px; text-transform: uppercase;}
        h1 {
          font-family: "Avant Garde", Avantgarde, "Century Gothic", CenturyGothic, "AppleGothic", sans-serif;
          font-size: 50px;
          padding: 50px 50px;
          text-align: center;
          /*text-transform: uppercase;*/
          text-rendering: optimizeLegibility;
        }
        h1.elegantshadow {
          color: #81FF0B;
          /*background-color: #e7e5e4;*/
          letter-spacing: 0.05em;
          text-shadow: 1px -1px 0 #767676, -1px 1px 1px #737272, -2px 4px 1px #767474, -3px 6px 1px #787777, -4px 8px 1px #7b7a7a, -5px 10px 1px #7f7d7d, -6px 12px 1px #828181, -7px 14px 1px #868585, -8px 16px 1px #8b8a89, -9px 18px 1px #8f8e8d, -10px 20px 1px #949392, -11px 22px 1px #999897, -12px 24px 1px #9e9c9c, -13px 26px 1px #a3a1a1, -14px 28px 1px #a8a6a6, -15px 30px 1px #adabab, -16px 32px 1px #b2b1b0, -17px 34px 1px #b7b6b5, -18px 36px 1px #bcbbba, -19px 38px 1px #c1bfbf, -20px 40px 1px #c6c4c4, -21px 42px 1px #cbc9c8, -22px 44px 1px #cfcdcd, -23px 46px 1px #d4d2d1, -24px 48px 1px #d8d6d5, -25px 50px 1px #dbdad9, -26px 52px 1px #dfdddc, -27px 54px 1px #e2e0df, -28px 56px 1px #e4e3e2;
        
        }
        h1.deepshadow {
          color: #e0dfdc;
          background-color: #333;
          letter-spacing: 0.1em;
          text-shadow: 0 -1px 0 #fff, 0 1px 0 #2e2e2e, 0 2px 0 #2c2c2c, 0 3px 0 #2a2a2a, 0 4px 0 #282828, 0 5px 0 #262626, 0 6px 0 #242424, 0 7px 0 #222, 0 8px 0 #202020, 0 9px 0 #1e1e1e, 0 10px 0 #1c1c1c, 0 11px 0 #1a1a1a, 0 12px 0 #181818, 0 13px 0 #161616, 0 14px 0 #141414, 0 15px 0 #121212, 0 22px 30px rgba(0, 0, 0, 0.9);
        }
        h1.insetshadow {
          color: #202020;
          background-color: #2d2d2d;
          letter-spacing: 0.1em;
          text-shadow: -1px -1px 1px #111, 2px 2px 1px #363636;
        }
        h1.retroshadow {
          color: #2c2c2c;
          background-color: #d5d5d5;
          letter-spacing: 0.05em;
          text-shadow: 4px 4px 0px #d5d5d5, 7px 7px 0px rgba(0, 0, 0, 0.2);
        }
    </style>
    <title>Manipulación de JSON con PHP</title>
    <link rel="stylesheet" type="text/css" href="css/body.css" /> 

</head>
<body background="img/b.jpg">

    <div>
        <ul>
          <li><a href="index.php" >Convertir PDF a Excel</a></li>
          <li><a href="modificacion_img.php">Subir imagenes</a></li>
          <li>    <a href="javascript:history.back()">Regresar a la página anterior</a></li>
          <lu>
              <li style="float:right; color: white; text-transform: uppercase; padding: 10px 16px;">
                <h4>
                    <?php include "inc/timezone.php"; ?>
                </h4>
              </li>    
          </lu>  
      </ul> 
    </div>

    <div style="text-align:center;" >
    <table  style="margin: 0 auto;">
        <form action="" method="post"><!--Inicio de FORM-->
        <tr>
            <td colspan="2">
                <p>
                    <label for="codigo">Código:</label>
                    <input type="text" name="codigo" required><br>
                </p>
                <p>
                    <label for="cajas">Cajas:  </label>
                    <input type="number" name="cajas" required><br>
                </p>
                <p>    
                    <label for="piezas">Piezas:  </label>
                    <input type="number" name="piezas" required><br>
                </p>
            </td>
        </tr>
        <tr>
            <td>  <button type="submit" name="add">Agregar</button>  </td>
            <td>  <button type="submit" name="actualizar">Actualizar</button>  </td>
        </tr>
        </form><!--fin form-->
    </table>
    </div>
    <br>
    <br>
    <div style="text-align:center;">
        <table style="margin: 0 auto;">
        <form action="" method="post"><!--Inicio de FORM-->
            <tr>
                <td colspan="2">
                    <p>
                        <label for="codigo">Código:</label>
                        <input type="text" name="codigo" required><br>
                    </p>
                </td>
            </tr>
            <tr>    
                    <td>   
                        <button type="submit" name="eliminar">Eliminar</button>
                    </td>
                    <td>
                        <label for="codigo"></label>
                        <button type="submit" name="ver">Visualizar datos</button>
                    </td>   

            </tr>
        </form>
        </table>
    </div>
    <table style="margin: 0 auto;">
        <tr>
            <td>
                <h1 class='elegantshadow'>
                <?php
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        if (isset($_POST['add'])) {
                            // Agregar un nuevo elemento al JSON
                            $codigo = $_POST['codigo'];
                            $cajas = (int)$_POST['cajas'];
                            $piezas = (int)$_POST['piezas'];
                    
                            $nuevoDato = [
                                'Codigo' => $codigo,
                                'cajas' => $cajas,
                                'piezas' => $piezas
                            ];
                    
                            $datos[] = $nuevoDato;
                    
                            // Guardar el JSON actualizado
                            file_put_contents($jsonFile, json_encode($datos));
                    
                            echo 'Dato agregado correctamente.';
                        } 
                        elseif (isset($_POST['actualizar'])) {
                            // Actualizar un elemento del JSON
                            $codigo = $_POST['codigo'];
                            $cajas = (int)$_POST['cajas'];
                            $piezas = (int)$_POST['piezas'];
                    
                            foreach ($datos as $key => $dato) {
                                if ($dato['Codigo'] === $codigo) {
                                    $datos[$key]['cajas'] = $cajas;
                                    $datos[$key]['piezas'] = $piezas;
                                }
                            }
                    
                            // Guardar el JSON actualizado
                            file_put_contents($jsonFile, json_encode($datos));
                    
                            echo '<span>Dato actualizado correctamente.<span>';
                        }
                        elseif (isset($_POST['ver'])) {
                            // Agregar un nuevo elemento al JSON
                            $codigo = $_POST['codigo'];     
                            foreach ($datos as $key => $dato) {
                                if ($dato['Codigo'] === $codigo) {
                                    
                                    echo "Codigo: ".$dato['Codigo'].", Cajas: ".$dato['cajas'].", Piezas:".$dato['piezas'];
                                    
                                }
                            }
                        }elseif (isset($_POST['eliminar'])) {
                            // Eliminar un elemento del JSON
                            $codigo = $_POST['codigo'];
                            foreach ($datos as $key => $dato) {
                                if ($dato['Codigo'] === $codigo) {
                                    unset($datos[$key]);
                                }
                            }
                        
                            // Reindexar el array
                            $datos = array_values($datos);
                        
                            // Guardar el JSON actualizado
                            file_put_contents($jsonFile, json_encode($datos));
                        
                            echo '<span>Dato eliminado correctamente.<span>';
                        }

                        
                    }
                ?>
                </h1>
            </td>
        </tr>
    </table>
        
</body>
</html>
