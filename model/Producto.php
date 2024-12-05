<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 28/08/2019
 * Time: 16:07
 */
class Producto{

    public $idproducto;
    public $nombre;
    public $descripcion;
    public $stockminimo;
    public $stockmaximo;
    private $conexion;

    function __construct()
    {
        $this->conexion = new conexion();
    }

    function InsertarProyecto(){
        try
        {
            $this->conexion->query = "INSERT INTO ".$this->conexion->BD.".producto 
                                      (nombre, descripcion, stockminimo, stockmaximo)
                                      VALUES ('".$this->nombre."','".$this->descripcion."', ".$this->stockminimo.",".$this->stockmaximo.")";

            $this->idproducto = $this->conexion->realizarInsert();
            return $this->idproducto;
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

    function ConsultarProductos(){
        try
        {
            $this->conexion->query = "SELECT P.idproducto AS id, 
                                            P.nombre AS producto, P.descripcion AS descripcion, 
                                            P.stockminimo AS minimo, P.stockmaximo AS maximo
                                    FROM ".$this->conexion->BD.".producto AS P";
            return $this->conexion->consultarDatos();
        }
        catch (Exception $x)
        {
            throw $x;
        }

    }

}