<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 05/09/2019
 * Time: 18:22
 */
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/controller/SalidaController.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-xs-12 text-center">
            <h3>Consulta de Salidas de Inventario</h3>
        </div>
    </div>
    <div class="row">
        <br>
        <div class="table-responsive">
            <table id="tableSalidaConsulta" class="table table-striped table-condensed table-bordered">
                <thead>
                <tr>
                    <td>Fecha</td>
                    <td>Movimiento</td>
                    <td>Registrada</td>
                    <td>Asignada</td>
                    <td></td>
                </tr>
                </thead>
                <tbody>
                <?php
                $SalidaController = new SalidaController();
                $data = $SalidaController->ConsutarSalidas();
                while($row = $data->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $row["fecha"]; ?></td>
                        <td><?php echo $row["mov"]; ?></td>
                        <td><?php echo $row["usuarioregistra"]; ?></td>
                        <td><?php echo $row["usuarioasigna"]; ?></td>
                        <td><button class="btn btn-default" onclick="CargaDetalleSalida(<?php echo $row["idsalida"]; ?>)"><span class="glyphicon glyphicon-search"></span></button></td>
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
    $('#tableSalidaConsulta').DataTable();
    function CargaDetalleSalida(id) {
        $("#pagina").load("views/consultaSalidaDetalle.php?dato="+id);
    }
</script>
