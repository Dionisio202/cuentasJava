<?php
include_once("Seleccionar.php");
$op=$_SERVER["REQUEST_METHOD"];
switch($op){
 case "GET":
    $cedula=$_GET["cedula"];
    selecionar::Busca($cedula);
}
?>