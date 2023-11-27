<?php

class Conexion{
    public function Conectar(){
        define("host","localhost");
        define("dbname","cuentas");
        define("username","root");
        define("password","");
        
        try{
$conectar=new PDO("mysql:host=".host.";dbname=".dbname,username,password);
return $conectar;
        }catch(PDOException $e){
            die("Error ".$e);
        }
    }
}
?>