<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 28/08/2019
 * Time: 16:03
 */

include_once($_SERVER['DOCUMENT_ROOT']."/inventario/config/ConfigBD.php");
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/model/Producto.php");

class ProductoController{
    function InsertaProducto($nombre, $descripcion, $minimo, $maximo){
        try{
            $Producto = new Producto();
            $Producto->nombre = $nombre;
            $Producto->descripcion = $descripcion;
            $Producto->stockminimo = $minimo;
            $Producto->stockmaximo = $maximo;
            if($Producto->InsertarProyecto()>0){
                echo '{"success":true}';
            }else{
                echo '{"success":false}';
            }
        }catch (Exception $e){
            echo '{"success":false}';
        }
    }

    function ConsultarProductos(){
        try{
            $Producto = new Producto();
            $dataProducto = $Producto->ConsultarProductos();
            return $dataProducto;
        }catch (Exception $e){

        }
    }


}

if(isset($_POST["operacion"])) {
    switch ($_POST["operacion"]) {
        case "agregarProducto":
            $Controller = new ProductoController();
            $Controller->InsertaProducto($_POST["txtnombre"], $_POST["txtdescripcion"], $_POST["minimo"], $_POST["maximo"]);
            break;
        default:
            echo '{"success":false}';
            break;
    }
}