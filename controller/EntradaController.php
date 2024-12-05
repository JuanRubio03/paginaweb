<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 29/08/2019
 * Time: 17:37
 */

include_once($_SERVER['DOCUMENT_ROOT']."/inventario/config/ConfigBD.php");
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/model/Entrada.php");
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/model/EntradaDetalle.php");
session_start();
class EntradaController{

    public $Entrada;

    function AgregarEntrada($tipomov,$fecha,$observaciones){
        try{
            $Entrada = new Entrada();
            $Entrada->observaciones = $observaciones;
            $Entrada->fecha = $fecha;
            $Entrada->idmovimiento = $tipomov;
            $Entrada->idusuario = $_SESSION["usuario"];
            if($Entrada->InsertarEntrada()>0) {
                $this->drawTablaDetalleEntrada($Entrada->identrada, false);
            }else{
                ?>
                <div class="alert alert-danger">Ocurrio un error. Intentelo m&aacute;s tarde.</div>
                <?php
            }
        }catch (Exception $e){

        }
    }

    function AgregarDetalleEntrada($prodId, $entradaId, $cantidad, $precio){
        $DetalleEntrada = new EntradaDetalle();
        $DetalleEntrada->identrada = $entradaId;
        $DetalleEntrada->idproducto = $prodId;
        $DetalleEntrada->cantidad = $cantidad;
        $DetalleEntrada->precio = $precio;
        $DetalleEntrada->InsertarEntradaDetalle();
        $this->drawTablaDetalleEntrada($entradaId, false);
    }

    function ConsutarEntradas(){
        try {
            $objEntrada = new Entrada();
            return $objEntrada->ConsultarAllEntradas();
        }catch (Exception $e){
            return null;
        }
    }

    function ConsultarEntradaPerId($entradaId){
        try {
            $this->Entrada = new Entrada();
            $this->Entrada->identrada = $entradaId;
            $this->Entrada->ConsultarPerIdEntrada();
        }catch (Exception $e){
            return null;
        }
    }

    function drawTablaDetalleEntrada($idEntrada, $consulta = false){
        ?>
        <input id="txtIdEntrada" type="hidden" value="<?php echo $idEntrada; ?>">
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
            if($idEntrada>0){

                $objDetalle = new EntradaDetalle();
                $objDetalle->identrada = $idEntrada;
                $detalles = $objDetalle->ConsultarDetallesPerIdDetalle();
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
                    <td style="width:12.5%;"><input value="0" type="number" class="form-control"
                                                    id="txtCantidad" name="txtCantidad" min="0" /></td>
                    <td style="width:13%;">
                        <input value="0" type="number" class="form-control" id="txtPrecio" name="txtPrecio" min="0" />
                    </td>
                    <td style="width:2%;">
                        <button type="button" id="btnGuardar" class="btn btn-success"
                                onclick="registrarDetalle()">
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
        case "agregarEntrada":
            $Controller = new EntradaController();
            $Controller->AgregarEntrada($_POST["TipoMov"],$_POST["fecha"],$_POST["observaciones"]);
            break;
        case "agregarDetalleEntrada":
            $Controller = new EntradaController();
            $Controller->AgregarDetalleEntrada($_POST["prodId"],$_POST["entradaId"],$_POST["cantidad"],$_POST["precio"]);
            break;
        default:
            echo '{"success":false}';
            break;
    }
}