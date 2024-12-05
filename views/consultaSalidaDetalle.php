<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 05/09/2019
 * Time: 18:44
 */

include_once($_SERVER['DOCUMENT_ROOT']."/inventario/controller/SalidaController.php");
$idSalida = $_GET["dato"];

$controller = new SalidaController();
$controller->ConsultarSalidaPerId($idSalida);

?>
<div class="container-fluid" style="padding-top: 20px;">
    <form id="frmSalida" name="frmSalida" method="post">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Registro de Salida de Inventario
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <label for="txtTipo">Tipo de Movimiento: </label>
                        <input class="form-control" type="text" name="txtTipo" id="txtTipo" value="<?php echo $controller->Salida->movimiento; ?>" readonly=""/>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <label for="txtFecha">Fecha de Entrada: </label>
                        <input class="form-control" type="text" name="txtFecha" id="txtFecha" value="<?php echo $controller->Salida->fecha; ?>" readonly=""/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <label for="txtUsuario">Usuario que Registro: </label>
                        <input class="form-control" type="text" name="txtUsuarioR" id="txtUsuarioR" value="<?php echo $controller->Salida->usuarioregistra; ?>" readonly=""/>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <label for="txtUsuario">Usuario que Asigno: </label>
                        <input class="form-control" type="text" name="txtUsuarioS" id="txtUsuarioS" value="<?php echo $controller->Salida->usuarioasigna; ?>" readonly=""/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <label for="txtNotas" >Observaciones</label>
                        <textarea id="txtNotas" name="txtNotas" class="form-control"  maxlength="500" readonly ><?php echo $controller->Salida->observaciones; ?></textarea>
                    </div>
                </div>
                
            </div>
            <div class="panel panel-default">
    <div class="panel-body text-center" id="divBotones" >
        <?php
        $controller->drawTablaDetalleSalida($idSalida, true);
        ?>
        <button type="button" class="btn btn-primary" onclick="generarPDF();">
            Generar PDF
        </button>
    </div>
</div>
        </div>
    </form>
</div>


<script>
function generarPDF() {
    // Redirige a un script PHP encargado de generar el PDF.
    window.location.href = 'generarpdf.php?idSalida=<?php echo $idSalida; ?>';
}
</script>