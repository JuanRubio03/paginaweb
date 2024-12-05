<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 03/09/2019
 * Time: 16:41
 */
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/controller/EntradaController.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 text-center">
            <h3>Consulta de Entradas de Inventario</h3>
        </div>
    </div>
    <div class="row">
        <br>
        <div class="table-responsive">
            <table id="tableEntradaConsulta" class="table table-striped table-condensed table-bordered">
                <thead>
                    <tr>
                        <td>Fecha</td>
                        <td>Movimiento</td>
                        <td>Registrada</td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                <?php
                    $ControllerEntrada = new EntradaController();
                    $data = $ControllerEntrada->ConsutarEntradas();
                    while($row = $data->fetch_assoc()){
                        ?>
                        <tr>
                            <td><?php echo $row["fecha"]; ?></td>
                            <td><?php echo $row["mov"]; ?></td>
                            <td><?php echo $row["usuario"]; ?></td>
                            <td><button class="btn btn-default" onclick="CargaDetalle(<?php echo $row["identrada"]; ?>)"><span class="glyphicon glyphicon-search"></span></button></td>
                        </tr>
                        <?php
                    }
                    
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $('#tableEntradaConsulta').DataTable();
    function CargaDetalle(id) {
        $("#pagina").load("views/consultaEntradaDetalle.php?dato="+id);
    }
</script>
