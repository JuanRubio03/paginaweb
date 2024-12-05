<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 29/08/2019
 * Time: 17:37
 */
class TipoMovimiento{

    public $idtipo;
    public $nombre;
    public $entradasalida;

    private $conexion;

    function __construct()
    {
        $this->conexion = new conexion();
    }

    function ConsultarTiposMovimientoPerEntradaSalida(){
        try
        {
            $this->conexion->query = "SELECT T.idtipo, T.nombre, T.entradasalida
                                    FROM ".$this->conexion->BD.".tiposmov AS T
                                    WHERE T.entradasalida = '".$this->entradasalida."'";
            return $this->conexion->consultarDatos();
        }
        catch (Exception $x)
        {
            throw $x;
        }

    }

}