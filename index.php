<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 23/08/2018
 * Time: 04:51 PM
 */
$perfil="";
$usuario="";
session_start();
if(isset($_SESSION["usuario"]) && isset($_SESSION["perfilid"])) {
    $perfil = $_SESSION["perfilid"];
    $usuario = $_SESSION["usuario"];
}else{
    ?>
    <br/>
    <table align="center" border="0">
        <tr>
            <td>
                <h3>No tienes permiso para accesar a esta secci&oacute;n.</h3>
            </td>
        </tr>
    </table>
    <meta http-equiv='refresh' content='2; url=login.php'>
    <?php
    die();
}

?>



<html>
<head>
    <title>Sistema de Inventarios DICIVA</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
    <link href="resources/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <link href="resources/css/menuprincipal.css" rel="stylesheet" >
    <link href="resources/css/datatables.min.css" rel="stylesheet">
    <script src="resources/js/jQuery3.3.1.js"></script>
    <script src="resources/js/bootstrap.min.js"></script>
    <script src="resources/js/bootstrapvalidator.js"></script>
    <script src="resources/js/DataTable.js"></script>


    <!------ Include the above in your HEAD tag ---------->

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <script src="resources/js/funciones.js" type="text/javascript"></script>
</head>
<body>
    <div class="row">
        <div class="col-xs-3" id="menuprincipal">
            <div class="nav-side-menu">
                <div class="brand">
                    <img src="resources/img/itesiLogo.png" height="80px">
                </div>
                <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

                <div class="menu-list">

                    <ul id="menu-content" class="menu-content collapse out">
                        <li class="text-center">
                            Sistema de Inventarios
                        </li>
                        <li  data-toggle="collapse" data-target="#producto" class="collapsed">
                            <a href="#"><i class="fa fa-gift fa-lg"></i> Productos<span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="producto">

                            <li id="prod1"><a href="#" onclick="cargarPaginaMenu('pagina','views/producto.php','prod1')">Ingresar Productos</a></li>
                            <li  id="prod2"><a href="#" onclick="cargarPaginaMenu('pagina','views/consultaproducto.php','prod2')">Consultar Productos</a></li>

                        </ul>
                        <li  data-toggle="collapse" data-target="#proyecto" class="collapsed">
                            <a href="#"><i class="fa fa-gift fa-lg"></i> Entradas<span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="proyecto">

                            <li id="proy1"><a href="#" onclick="cargarPaginaMenu('pagina','views/entrada.php','proy1')">Entrada de Inventario</a></li>
                            <li  id="proy2"><a href="#" onclick="cargarPaginaMenu('pagina','views/consultarentrada.php','proy2')">Consultar Entradas</a></li>

                        </ul>

                        <li data-toggle="collapse" data-target="#tablas" class="collapsed">
                            <a href="#"><i class="fa fa-file fa-lg"></i> Salidas <span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="tablas">
                            <li id="tabla1"><a href="#" onclick="cargarPaginaMenu('pagina','views/salida.php','tabla1')">Salida de Inventario</a></li>
                            <li id="tabla2"><a href="#" onclick="cargarPaginaMenu('pagina','views/consultarsalida.php','tabla2')">Consultar Salidas</a></li>
                        </ul>


                        <li data-toggle="collapse" data-target="#user" class="collapsed">
                            <a href="#"><i class="fa fa-user fa-lg"></i> Usuario <span class="arrow"></span></a>
                        </li>
                        <ul class="sub-menu collapse" id="user">
                            <li id="user1"><a href="logout.php">Cerrar Sesi&oacute;n</a></li>
                        </ul>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-xs-1"></div>
        <div class="col-xs-7" id="pagina">

        </div>
    </div>


</body>
</html>
