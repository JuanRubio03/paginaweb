<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 31/08/2018
 * Time: 12:36 PM
 */


include_once($_SERVER['DOCUMENT_ROOT']."/inventario/config/ConfigBD.php");
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/model/conexion.php");
include_once($_SERVER['DOCUMENT_ROOT']."/inventario/model/Usuarios.php");
session_start();
$Usuario = $_POST["Usuario"];
$Contrasena = $_POST["Contrasena"];

try {
    $AccesoUsuarios = new Usuarios();
    $AccesoUsuarios->usuario = $Usuario;
    $AccesoUsuarios->constrasena = $Contrasena;
    $AccesoUsuarios->consultarUsuario();

    if($AccesoUsuarios->usuarioid>0){
        $_SESSION["usuario"] = $AccesoUsuarios->usuarioid;
        $_SESSION["perfilid"] = $AccesoUsuarios->perfilid;
    }else{
        $_SESSION["usuario"] = true;
        $_SESSION["perfilid"] = true;
    }
    /*$host = $_SERVER['HTTP_HOST'];
    $ruta = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $html = 'index.php';
    $url = "http://$host$ruta/$html";*/
    header("Location: ../index.php");
}
catch (Exception $e)
{
    echo $e;
}
