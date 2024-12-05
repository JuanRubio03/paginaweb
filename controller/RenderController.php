<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 29/08/2019
 * Time: 17:41
 */

include_once($_SERVER['DOCUMENT_ROOT']."/inventario/config/ConfigBD.php");
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/model/TipoMovimiento.php");
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/model/Producto.php");
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/model/Usuarios.php");

class RenderController{

    function DrawSelectTipoMovi($idSelect, $entradasalida){
        try {
            $TipoMovimient = new TipoMovimiento();
            $TipoMovimient->entradasalida = $entradasalida;
            $data = $TipoMovimient->ConsultarTiposMovimientoPerEntradaSalida();
            $opciones = "<label for='".$idSelect."'>Tipo de Movimiento</label>
            <select id='".$idSelect."' name='".$idSelect."' class='form-control' style='width:95%;'>";
            foreach ($data as $mov) {
                $opciones .= "<option value='".$mov["idtipo"]."' >".$mov["nombre"]."</option>";
            }
            $opciones .= "</select>";
            echo $opciones;
        }
        catch (Exception $e){
            $opciones = "<label for='".$idSelect."'>Tipo de Movimiento</label>
            <select id='".$idSelect."' name='".$idSelect."' class='form-control' style='width:95%;'>";
            $opciones .= "</select>";
            echo $opciones;
        }
    }

    function DrawSelectUsuario($idSelect){
        try {
            $Usuario = new Usuarios();
            $data = $Usuario->consultarAllUsuarios();
            $opciones = "<label for='".$idSelect."'>Usuario Asignado</label>
            <select id='".$idSelect."' name='".$idSelect."' class='form-control' style='width:95%;'>";
            foreach ($data as $mov) {
                $opciones .= "<option value='".$mov["id"]."' >".$mov["cuenta"]."</option>";
            }
            $opciones .= "</select>";
            echo $opciones;
        }
        catch (Exception $e){
            $opciones = "<label for='".$idSelect."'>Tipo de Movimiento</label>
            <select id='".$idSelect."' name='".$idSelect."' class='form-control' style='width:95%;'>";
            $opciones .= "</select>";
            echo $opciones;
        }
    }

    function DrawProductos(){
        $Producto = new Producto();
        $data = $Producto->ConsultarProductos();

        ?>
        <div class="container-fluid">
            <div class='table-responsive'>
                <table id='ConsultaProductos'  class='dataTable table table-bordered' cellspacing='0' width='100%' >
                    <thead style='margin-bottom: 10px;' >
                        <tr>
                            <th><div class='centrar'><label>Producto</label></div></th>
                            <th><div class='centrar'><label>Descripci&oacute;n</label></div></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while ($row = $data->fetch_assoc()){
                            ?>
                            <tr>
                                <td><?php echo ($row["producto"]); ?></td>
                                <td><?php echo ($row["descripcion"]); ?></td>
                                <td class="text-center">
                                    <button class="btn btn-default" onclick="seleccion(<?php echo $row["id"]; ?>,'<?php echo ($row["producto"]);?>')">
                                        <span class="glyphicon glyphicon-plus-sign"></span>
                                    </button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>

        </div>
        <script>
            $("#ConsultaProductos").DataTable();
        </script>
        <?php
    }
}