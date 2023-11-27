<?php
class selecionar{
    public static function Busca($cedula){
        include_once("conexion.php");
        $objeto = new Conexion();
        $respuesta=$objeto->Conectar();
        $sql="SELECT * FROM transaccion WHERE cuenta=(SELECT cuenta FROM cuenta WHERE cedula='$cedula')";
        $resultado=$respuesta->prepare($sql);
        $resultado->execute();
        $datos=$resultado->fetchAll(PDO::FETCH_ASSOC);
        echo json_encode($datos);
    }
}

?>