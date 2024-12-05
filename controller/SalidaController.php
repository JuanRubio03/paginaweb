<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 03/09/2019
 * Time: 17:57
 */

include_once($_SERVER['DOCUMENT_ROOT']."/inventario/config/ConfigBD.php");
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/model/Salida.php");
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/model/Usuarios.php");
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/model/SalidaDetalle.php");
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/model/EntradaDetalle.php");
session_start();
class SalidaController{

    public $Salida;

    function AgregarSalida($tipomov,$fecha,$observaciones,$usuarioAsignaid, $password){
        try{
            //valida Usuario
            $Usuario = new Usuarios();
            $Usuario->usuarioid = $usuarioAsignaid;
            $Usuario->constrasena = $password;
            if($Usuario->consultarUsuarioPerId()>0) {
                //Realiza Salida
                $Salida = new Salida();
                $Salida->observaciones = $observaciones;
                $Salida->fecha = $fecha;
                $Salida->idmovimiento = $tipomov;
                $Salida->idusuarioregistra = $_SESSION["usuario"];
                $Salida->idusuarioasigna = $usuarioAsignaid;
                if ($Salida->InsertarSalida() > 0) {
                    $this->drawTablaDetalleSalida($Salida->idsalida, false);
                } else {
                    ?>
                    <div class="alert alert-danger">Ocurrio un error. Intentelo m&aacute;s tarde.</div>
                    <?php
                }
            }else{
                ?>
                <div class="alert alert-danger">Contraseña incorrecta. No se registrará la Salida de Inventario.</div>
                <?php
            }
        }catch (Exception $e){

        }
    }

    function AgregarDetalleSalida($prodId, $salidaId, $cantidad){
        $objEntradaDetalle = new EntradaDetalle();
        $objSalidaDetalle = new SalidaDetalle();
        $objEntradaDetalle->idproducto = $prodId;
        $existencia = $objEntradaDetalle->ConsultarExistenciaByProducto();
        if($existencia>=$cantidad){
            $objEntradaDetalle->idproducto = $prodId;
            $detalleEntradaByProducto = $objEntradaDetalle->ConsultarDetalleEntradaByProducto();
            while($row = $detalleEntradaByProducto->fetch_assoc()){
                if($cantidad>0) {
                    if ($row["existencia"] >= $cantidad) {
                        $objEntradaDetalle->iddetalle = $row["iddetalle"];
                        $objEntradaDetalle->existencia = $row["existencia"] - $cantidad;
                        $objEntradaDetalle->ActualizarExistenciaByIdEntradaDetalle();
                        $objSalidaDetalle->idsalida = $salidaId;
                        $objSalidaDetalle->idproducto = $prodId;
                        $objSalidaDetalle->cantidad = $cantidad;
                        $objSalidaDetalle->precio = $row["precio"];
                        $objSalidaDetalle->observaciones = $row["observaciones"];
                        $objSalidaDetalle->InsertarSalidaDetalle();
                        $cantidad = 0;
                    } else {
                        $cantidad = $cantidad - $row["existencia"];
                        $objEntradaDetalle->iddetalle = $row["iddetalle"];
                        $objEntradaDetalle->existencia = 0;
                        $objEntradaDetalle->ActualizarExistenciaByIdEntradaDetalle();
                        $objSalidaDetalle->idsalida = $salidaId;
                        $objSalidaDetalle->idproducto = $prodId;
                        $objSalidaDetalle->cantidad = $row["existencia"];
                        $objSalidaDetalle->precio = $row["precio"];
                        $objSalidaDetalle->observaciones = $row["observaciones"];
                        $objSalidaDetalle->InsertarSalidaDetalle();
                    }
                }else{
                    break;
                }
            }
        }else{

        }
        //checar primero sobre PEPS luego se genera la salida
        $this->drawTablaDetalleSalida($salidaId,false);
    }

    function ConsutarSalidas(){
        try {
            $objSalida = new Salida();
            return $objSalida->ConsultarAllSalidas();
        }catch (Exception $e){
            return null;
        }
    }

    function ConsultarSalidaPerId($SalidaId){
        try {
            $this->Salida = new Salida();
            $this->Salida->idsalida = $SalidaId;
            $this->Salida->ConsultarPerIdSalida();
        }catch (Exception $e){
            return null;
        }
    }

    function drawTablaDetalleSalida($idSalida, $consulta = false){
        ?>
        <input id="txtIdSalida" type="hidden" value="<?php echo $idSalida; ?>">
        <table border='0' style="width:100%;" class='table table-striped table-bordered' >
             <thead>
            <tr>
                <th style="width:2%;" >&nbsp;</th>
                <th style="width:34%;" >Descripción</th>
                <th  style="width:2%;" ></th>
                <th style="width:12.5%;" >Cantidad</th>
                <th style="width:13%;" >Costo</th>
                <th style="width:2%;" >&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if($idSalida>0){

                $objDetalle = new SalidaDetalle();
                $objDetalle->idsalida = $idSalida;
                $detalles = $objDetalle->ConsultarDetallesPerIdSalida();
                foreach  ($detalles as $d){
                    ?>
                    <tr>
                        <td></td>
                        <td colspan="2">
                            <?php echo $d["producto"]; ?>
                        </td>
                        <td><?php echo $d["cantidad"]; ?></td>
                        <td><?php echo $d["precio"]; ?></td>
                        <td></td>
                    </tr>
                    <?php
                }
            }
            if($consulta){

            }else {
                ?>
                <tr>
                    <td style="width:2%;"></td>
                    <td style="width:34%;">
                        <input type="text" class="form-control" id="txtProducto" name="txtProducto"
                               readonly=""/>
                        <input type="hidden" id="txtIdProducto" name="txtIdProducto"/>
                    </td>
                    <td style="width:2%;">
                        <button type="button"  name="btnMas" id="btnMas"
                                data-toggle="modal" data-target="#SeleccionProducto"><span class="glyphicon glyphicon-search"></span>
                        </button>
                    </td>
                    <td >
                        <input value="0" type="number" class="form-control" id="txtCantidad" name="txtCantidad" min="0" />
                    </td>
                    <td style="width:13%;">
                            <input value="0" type="number" class="form-control" id="txtPrecio" name="txtPrecio" min="0" />
                    </td>
                    <td style="width:2%;">
                        <button type="button" id="btnGuardar" class="btn btn-success"
                                onclick="registrarDetalleSalida()">
                            <span class="glyphicon glyphicon-save"></span></button>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }
}

if(isset($_POST["operacion"])) {
    switch ($_POST["operacion"]) {
        case "agregarSalida":
            $Controller = new SalidaController();
            $Controller->AgregarSalida($_POST["TipoMov"],$_POST["fecha"],$_POST["observaciones"],$_POST["usuarioasignaid"],$_POST["password"]);
            break;
        case "agregarDetalleSalida":
            $Controller = new SalidaController();
            $Controller->AgregarDetalleSalida($_POST["prodId"],$_POST["salidaId"],$_POST["cantidad"]);
            break;
        default:
            echo '{"success":false}';
            break;
    }
}