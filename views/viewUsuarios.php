<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 23/10/2019
 * Time: 17:51
 */
?>


<style>
    label{
        margin-top: 10px;
    }
</style>

<div class="container-fluid" style="padding-top: 20px;">
    <form id="frmUsuario" name="frmUsuario" role="form" method="post">
        <div class="panel panel-primary">
            <div class="panel-heading">
                Datos del Usuario
            </div>
            <div class="panel-body">

                <div class="row">
                    <div class="col-xs-12 text-left">
                        <label>Nombre del Producto</label><br>
                        <input type="text" id="txtnombre" name="txtnombre" class="form-control" maxlength="150" placeholder="Ingrese el nombre del producto">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-left">
                        <label>Descripción del Producto</label><br>
                        <input type="text" id="txtdescripcion" name="txtdescripcion" class="form-control" maxlength="350"  placeholder="Ingrese una descripci&oacute;n del producto">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-left">
                        <label>Stock M&iacute;nimo</label><br>
                        <input type="text" id="minimo"  name="minimo" class="form-control" maxlength="4" placeholder="Ingrese el stock m&iacute;nimo del producto">
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 text-left">
                        <label>Stock M&aacute;ximo</label><br>
                        <input type="text" id="maximo" name="maximo" class="form-control" maxlength="6" placeholder="Ingrese el stock m&aacute;ximo del producto">
                    </div>
                </div>

            </div>
        </div>

        <div class="panel panel-default">
            <div class="panel-body text-center" id="divBotones" >
                <button class="btn btn-success" type="submit"><span class="fa fa-save"></span>&nbsp;Guardar producto</button>
            </div>
        </div>
    </form>
</div>
<script src="resources/js/.js" type="text/javascript"></script>