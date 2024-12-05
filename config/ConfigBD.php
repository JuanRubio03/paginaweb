<?php
class ConfigBD
{
    function getConexion()
    {
        $servidor = "localhost";
        $basedatos = "inventaios";
        $usuario = "root";
        $contrasenia = "";

        try {
            $conexionMysqli = new mysqli($servidor, $usuario, $contrasenia, $basedatos);
            
            if ($conexionMysqli->connect_errno) {
                echo "Falló la conexión con MySQL: (" . $conexionMysqli->connect_errno . ") "
                    . $conexionMysqli->connect_error;
                throw new Exception('No se pudo generar conexión con la base de datos de inventario.');
            } else {
                // Configurar la codificación de caracteres a utf8mb4
                if (!$conexionMysqli->set_charset("utf8mb4")) {
                    die("Error al configurar la codificación UTF-8: " . $conexionMysqli->error);
                }
                return $conexionMysqli;
            }
        } catch (Exception $e) {
            echo $e;
        }
    }
}
?>
