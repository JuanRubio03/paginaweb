<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 03/09/2019
 * Time: 17:57
 */
class SalidaDetalle{
    public $iddetallesalida;
    public $idsalida;
    public $idproducto;
    public $cantidad;
    public $precio;
    public $observaciones;

    private $conexion;

    function __construct()
    {
        $this->conexion = new conexion();
    }

    function InsertarSalidaDetalle(){
        try
        {
            $this->conexion->query = "INSERT INTO ".$this->conexion->BD.".salidadetalle
                                      (idsalida, idproducto, cantidad, precio, observaciones)
                                      VALUES (".$this->idsalida.",".$this->idproducto.",'".$this->cantidad."','".$this->precio."','".$this->observaciones."')";
 
            $this->iddetallesalida = $this->conexion->realizarInsert();
            return $this->iddetallesalida;
        }
        catch (Exception $x)
        {
            return 0;
        }
    }

    function ConsultarDetallesPerIdSalida(){
        try
        {
            $this->conexion->query = "SELECT P.iddetallesalida,P.idsalida, P.idproducto,
                                            (SELECT PR.nombre AS producto 
                                                FROM ".$this->conexion->BD.".producto AS PR
                                                WHERE PR.idproducto = P.idproducto) AS producto,
                                            P.cantidad, P.precio, P.observaciones
                                    FROM ".$this->conexion->BD.".salidadetalle AS P
                                    WHERE P.idsalida = ".$this->idsalida;
            return $this->conexion->consultarDatos();
        }
        catch (Exception $x)
        {
            return null;
        }

    }

}