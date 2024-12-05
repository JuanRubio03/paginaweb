<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 29/08/2019
 * Time: 18:08
 */
class Entrada{
    public $identrada;
    public $fecha;
    public $fechacaptura;
    public $idmovimiento;
    public $movimiento;
    public $idusuario;
    public $usuario;
    public $observaciones;
    private $conexion;

    function __construct()
    {
        $this->conexion = new conexion();
    }

    function InsertarEntrada(){
        try
        {
            $this->conexion->query = "INSERT INTO ".$this->conexion->BD.".entrada 
                                      (fecha, fechacaptura, idmovimiento, idusuario, observaciones)
                                      VALUES ('".$this->fecha."',NOW(), ".$this->idmovimiento.",".$this->idusuario.",'".$this->observaciones."')";
            $this->identrada = $this->conexion->realizarInsert();
            return $this->identrada;
        }
        catch (Exception $x)
        {
            return 0;
        }
    }

    function ConsultarAllEntradas(){
        try
        {
            $this->conexion->query = "SELECT E.identrada, E.fecha, E.fechacaptura,
                                        E.idmovimiento, E.idusuario, E.observaciones,
                                        (SELECT M.nombre FROM tiposmov AS M WHERE M.idtipo = E.idmovimiento) AS mov,
                                        (SELECT M.usuario FROM usuario AS M WHERE M.idusuario = E.idusuario) AS usuario
                                        FROM ".$this->conexion->BD.".entrada AS E ";
            return $this->conexion->consultarDatos();
        }
        catch (Exception $x)
        {
            throw $x;
        }

    }

    function ConsultarPerIdEntrada(){
        try
        {
            $this->conexion->query = "SELECT E.identrada, E.fecha, E.fechacaptura,
                                        E.idmovimiento, E.idusuario, E.observaciones,
                                        (SELECT M.nombre FROM tiposmov AS M WHERE M.idtipo = E.idmovimiento) AS mov,
                                        (SELECT M.usuario FROM usuario AS M WHERE M.idusuario = E.idusuario) AS usuario
                                        FROM ".$this->conexion->BD.".entrada AS E 
                                        WHERE E.identrada = ".$this->identrada;
            $data =$this->conexion->consultarDatos();
            $row = $data->fetch_assoc();
            $this->identrada = $row["identrada"];
            $this->fecha = $row["fecha"];
            $this->fechacaptura = $row["fechacaptura"];
            $this->idmovimiento = $row["idmovimiento"];
            $this->idusuario = $row["idusuario"];
            $this->observaciones = $row["observaciones"];
            $this->movimiento = $row["mov"];
            $this->usuario = $row["usuario"];
        }
        catch (Exception $x)
        {
            throw $x;
        }

    }
}