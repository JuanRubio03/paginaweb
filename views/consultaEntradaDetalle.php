<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 03/09/2019
 * Time: 17:22
 */
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/controller/EntradaController.php");
$idEntrada = $_GET["dato"];

$controller = new EntradaController();
$controller->ConsultarEntradaPerId($idEntrada);

?>

<div class="container-fluid" style="padding-top: 20px;">
    <form id="frmEntrada" name="frmEntrada" method="post">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Registro de Entrada de Inventario
            </div>
            <div class="panel-body">


                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <label for="txtTipo">Tipo de Movimiento: </label>
                        <input class="form-control" type="text" name="txtTipo" id="txtTipo" value="<?php echo $controller->Entrada->movimiento; ?>" readonly=""/>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <label for="txtFecha">Fecha de Entrada: </label>
                        <input class="form-control" type="text" name="txtFecha" id="txtFecha" value="<?php echo $controller->Entrada->fecha; ?>" readonly=""/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <label for="txtUsuario">Tipo de Movimiento: </label>
                        <input class="form-control" type="text" name="txtUsuario" id="txtUsuario" value="<?php echo $controller->Entrada->usuario; ?>" readonly=""/>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <label for="txtFechaC">Fecha de Captura: </label>
                        <input class="form-control" type="text" name="txtFechaC" id="txtFechaC" value="<?php echo $controller->Entrada->fechacaptura; ?>" readonly=""/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <label for="txtNotas" >Observaciones</label>
                        <textarea id="txtNotas" name="txtNotas" class="form-control"  maxlength="500" readonly ><?php echo $controller->Entrada->observaciones; ?></textarea>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body text-center" id="divBotones" >
                    <?php
                    $controller->drawTablaDetalleEntrada($idEntrada,true);
                    ?>
                    <button type="button" class="btn btn-primary" onclick="generar_EntradaPDF();">
                        Generar PDF
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function generar_EntradaPDF() {
    // Redirige a un script PHP encargado de generar el PDF para la entrada.
    window.location.href = 'generar_entradapdf.php?idEntrada=<?php echo $idEntrada; ?>';
}
</script>

