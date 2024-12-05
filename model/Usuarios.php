<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 31/08/2018
 * Time: 12:37 PM
 */
class Usuarios{

    public $usuarioid;
    public $usuario;
    public $constrasena;
    public $perfilid;
    public $perfil;

    private $conexion;

    function __construct()
    {
        $this->conexion = new conexion();
    }

    function consultarUsuario(){
        try
        {
            $this->conexion->query = "SELECT U.idusuario AS id, U.usuario AS cuenta, U.contrasena AS passw, 
                                        U.idperfil AS idperfil, (SELECT P.perfil FROM ".$this->conexion->BD.".perfil AS P
                                        WHERE P.idperfil = U.idperfil) AS perfil
                                        FROM ".$this->conexion->BD.".usuario AS U
                                        WHERE U.usuario = '".$this->usuario."' AND U.contrasena = '".$this->constrasena."'";
            echo $this->conexion->query;
            $datosUsuario = $this->conexion->consultarDatos();
            if($datosUsuario->num_rows>0){
                $row = $datosUsuario->fetch_assoc();
                $this->usuarioid = $row["id"];
                $this->usuario = $row["cuenta"];
                $this->constrasena = $row["passw"];
                $this->perfilid = $row["idperfil"];
                $this->perfil = $row["perfil"];

            }
        }
        catch (Exception $x)
        {
            echo $x;
        }
    }

    function consultarUsuarioPerId(){
        try
        {
            $this->conexion->query = "SELECT U.idusuario AS id, U.usuario AS cuenta, U.contrasena AS passw
                                        FROM ".$this->conexion->BD.".usuario AS U
                                        WHERE U.idusuario = '".$this->usuarioid."' AND U.contrasena = '".$this->constrasena."'";

            $datosUsuario = $this->conexion->consultarDatos();
            if($datosUsuario->num_rows>0){
                return 1;
            }else{
                return 0;
            }
        }
        catch (Exception $x)
        {
            echo $x;
        }
    }

    function consultarAllUsuarios(){
        try
        {
            $this->conexion->query = "SELECT U.idusuario AS id, U.usuario AS cuenta, U.contrasena AS passw, 
                                        U.idperfil AS idperfil, (SELECT P.perfil FROM ".$this->conexion->BD.".perfil AS P
                                        WHERE P.idperfil = U.idperfil) AS perfil
                                        FROM ".$this->conexion->BD.".usuario AS U ";

            return $this->conexion->consultarDatos();

        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

}