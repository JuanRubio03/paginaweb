<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 03/09/2019
 * Time: 17:57
 */

class Salida{
    public $idsalida;
    public $fecha;
    public $fechacaptura;
    public $idmovimiento;
    public $movimiento;
    public $idusuarioregistra;
    public $usuarioregistra;
    public $idusuarioasigna;
    public $usuarioasigna;
    public $observaciones;
    private $conexion;

    function __construct()
    {
        $this->conexion = new conexion();
    }

    function InsertarSalida(){
        try
        {
            $this->conexion->query = "INSERT INTO ".$this->conexion->BD.".salida 
                                      (fecha, fechacaptura, idmovimiento, idusuarioregistra, idusuarioasigna, observaciones)
                                      VALUES ('".$this->fecha."',NOW(), ".$this->idmovimiento.",".$this->idusuarioregistra.",'".$this->idusuarioasigna."','".$this->observaciones."')";
            $this->idsalida = $this->conexion->realizarInsert();
            return $this->idsalida;
        }
        catch (Exception $x)
        {
            return 0;
        }
    }

    function ConsultarAllSalidas(){
        try
        {
            $this->conexion->query = "SELECT E.idsalida, E.fecha, E.fechacaptura,
                                        E.idmovimiento, E.idusuarioregistra, E.idusuarioasigna, E.observaciones,
                                        (SELECT M.nombre FROM tiposmov AS M WHERE M.idtipo = E.idmovimiento) AS mov,
                                        (SELECT M.usuario FROM usuario AS M WHERE M.idusuario = E.idusuarioasigna) AS usuarioasigna,
                                        (SELECT M.usuario FROM usuario AS M WHERE M.idusuario = E.idusuarioregistra) AS usuarioregistra
                                        FROM ".$this->conexion->BD.".salida AS E ";
            return $this->conexion->consultarDatos();
        }
        catch (Exception $x)
        {
            throw $x;
        }

    }

    function ConsultarPerIdSalida(){
        try
        {
            $this->conexion->query = "SELECT E.idsalida, E.fecha, E.fechacaptura,
                                        E.idmovimiento, E.idusuarioregistra, E.idusuarioasigna, E.observaciones,
                                        (SELECT M.nombre FROM tiposmov AS M WHERE M.idtipo = E.idmovimiento) AS mov,
                                        (SELECT M.usuario FROM usuario AS M WHERE M.idusuario = E.idusuarioasigna) AS usuarioasigna,
                                        (SELECT M.usuario FROM usuario AS M WHERE M.idusuario = E.idusuarioregistra) AS usuarioregistra
                                        FROM ".$this->conexion->BD.".salida AS E
                                        WHERE E.idsalida = ".$this->idsalida;
            $data =$this->conexion->consultarDatos();
            $row = $data->fetch_assoc();
            $this->idsalida = $row["idsalida"];
            $this->fecha = $row["fecha"];
            $this->fechacaptura = $row["fechacaptura"];
            $this->idmovimiento = $row["idmovimiento"];
            $this->idusuarioregistra = $row["idusuarioregistra"];
            $this->idusuarioasigna = $row["idusuarioasigna"];
            $this->observaciones = $row["observaciones"];
            $this->movimiento = $row["mov"];
            $this->usuarioasigna = $row["usuarioasigna"];
            $this->usuarioregistra = $row["usuarioregistra"];
        }
        catch (Exception $x)
        {
            throw $x;
        }

    }
}