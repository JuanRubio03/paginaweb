<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 24/08/2018
 * Time: 02:07 PM
 */

include_once($_SERVER['DOCUMENT_ROOT']."/inventario/controller/ProductoController.php");
?>
<h3 class="text-center text-primary">Consulta de Productos </h3>
<hr width="5px">
<div class="table-responsive">
    <table id="tablaProductos" class="display table table-bordered" width='100%'>
        <thead>
        <tr>
            <th>Nombre del<br> producto</th>
            <th>Descripci&oacute;n</th>
            <th>Stock M&iacute;nimo</th>
            <th>Stock M&aacute;ximo</th>
            <th>Operaciones<br> &nbsp;&nbsp;</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $ProductoController = new ProductoController();
        $productos = $ProductoController->ConsultarProductos();

        while ($row = $productos->fetch_assoc()){
            ?>
            <tr>
                <td><?php echo ($row["producto"]); ?></td>
                <td><?php echo ($row["descripcion"]); ?></td>
                <td><?php echo $row["minimo"]; ?></td>
                <td><?php echo $row["maximo"]; ?></td>
                <td class="text-center">

                </td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
        $("#tablaProductos").DataTable();
</script>