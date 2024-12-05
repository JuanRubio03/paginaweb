<?php
/**
 * Created by PhpStorm.
 * User: anlozano
 * Date: 08/06/2018
 * Time: 02:28 PM
 */

 include_once($_SERVER['DOCUMENT_ROOT']."/inventario/config/ConfigBD.php");

class conexion{

    private $conectorBD;
    private $conexion;
    public $query;
    
    public $BD="inventaios";

    function __construct()
    {
        $this->conectorBD = new ConfigBD();
        $this->conexion = $this->conectorBD->getConexion();

        
    }



    function realizarInsert(){
        try
        {
            $Resultado = $this->conexion->query($this->query);
            if($Resultado){
                return $this->conexion->insert_id;
            }else{
                return 0;
            }
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

    function realizarUpdate(){
        try
        {
            $Resultado = $this->conexion->query($this->query);
            if($Resultado){
                return 1;
            }else{
                return 0;
            }
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

    function consultarDatos(){
        try
        {
            $Resultado = $this->conexion->query($this->query);
            return $Resultado;
        }
        catch (Exception $x)
        {
            throw $x;
        }
    }

}