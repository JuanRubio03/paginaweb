<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 04/09/2019
 * Time: 18:33
 */
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/controller/RenderController.php");
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
                        <?php
                        $RenderController = new RenderController();
                        $RenderController->DrawSelectTipoMovi("txtTipoMov","S");
                        ?>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <label for="txtFecha">Fecha de Entrada: </label>
                        <input class="form-control" type="date" name="txtFecha" id="txtFecha" style="width: 80%"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <?php
                        $RenderController->DrawSelectUsuario("txtUsuario");
                        ?>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <label for="txtPassword">Contrase&ntilde;a: </label>
                        <input class="form-control" type="password" name="txtPassword" id="txtPassword" style="width: 80%"/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12">
                        <label for="txtNotas" >Observaciones</label>
                        <textarea id="txtNotas" name="txtNotas" class="form-control"  maxlength="500" ></textarea>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body text-center" id="divBotones" >
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-floppy-disk"></span>
                        &nbsp;Capturar Productos </button>
                </div>
            </div>
        </div>
    </form>
</div>
<div class="modal fade" id="SeleccionProducto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h5 class="text-center">Seleccionar producto</h5>
            </div>
            <div class="modal-body">
                <div id="cuerpo" >
                    <?php
                    $RenderController->DrawProductos();
                    ?>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<script src="resources/js/salida.js"></script>