<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 29/08/2019
 * Time: 18:55
 */

class EntradaDetalle{
    public $iddetalle;
    public $identrada;
    public $idproducto;
    public $cantidad;
    public $precio;
    public $existencia;
    public $observaciones;

    private $conexion;

    function __construct()
    {
        $this->conexion = new conexion();
    }

    function InsertarEntradaDetalle(){
        try
        {
            $this->conexion->query = "INSERT INTO ".$this->conexion->BD.".entradadetalle 
                                      (identrada, idproducto, cantidad, existencia,precio, observaciones)
                                      VALUES (".$this->identrada.",".$this->idproducto.",'".$this->cantidad."','".$this->cantidad."','".$this->precio."','".$this->observaciones."')";

            $this->iddetalle = $this->conexion->realizarInsert();
            return $this->iddetalle;
        }
        catch (Exception $x)
        {
            return 0;
        }
    }

    function ConsultarDetallesPerIdDetalle(){
        try
        {
            $this->conexion->query = "SELECT P.iddetalle,P.identrada, P.idproducto, P.existencia,
                                            (SELECT PR.nombre AS producto 
                                                FROM inventarios.producto AS PR
                                                WHERE PR.idproducto = P.idproducto) AS producto,
                                            P.cantidad, P.precio, P.observaciones
                                    FROM ".$this->conexion->BD.".entradadetalle AS P
                                    WHERE P.identrada = ".$this->identrada;
            return $this->conexion->consultarDatos();
        }
        catch (Exception $x)
        {
            throw $x;
        }

    }

    public function ConsultarExistenciaByProducto(){
        try {
            $this->conexion->query = "Select SUM(P.existencia) AS Total
                                    FROM ".$this->conexion->BD.".entradadetalle AS P
                                    WHERE P.idproducto = ".$this->idproducto;

            $data = $this->conexion->consultarDatos();
            if($data->num_rows>0) {
                $row = $data->fetch_assoc();
                return $row['Total'];
            }else{
                return 0;
            }
        }
        catch (Exception $e)
        {
            return 0;
        }
    }

    public function ActualizarExistenciaByIdEntradaDetalle(){
        try{
            $this->conexion->query = "UPDATE ".$this->conexion->BD.".entradadetalle 
                                      SET existencia = '".$this->existencia."' 
                                      Where iddetalle = '".$this->iddetalle."'";
            return $this->conexion->realizarUpdate();
        }catch (Exception $e){

        }
    }

    public function ConsultarDetalleEntradaByProducto(){
        try {
            $this->conexion->query = "SELECT P.iddetalle,P.identrada, P.idproducto, P.existencia,
                                            (SELECT PR.nombre AS producto 
                                                FROM ".$this->conexion->BD.".producto AS PR
                                                WHERE PR.idproducto = P.idproducto) AS producto,
                                            P.cantidad, P.precio, P.observaciones
                                    FROM ".$this->conexion->BD.".entradadetalle AS P
                                    WHERE P.existencia > 0 AND P.idproducto = ".$this->idproducto."
                                    ORDER BY (SELECT E.fecha FROM ".$this->conexion->BD.".Entrada AS E
                                                WHERE E.identrada = P.identrada)";


            $data = $this->conexion->consultarDatos();
            return $data;
        }
        catch (Exception $e)
        {
            return 0;
        }
    }


}