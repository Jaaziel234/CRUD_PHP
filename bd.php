<?php

$servidor="localhost"; //127.0.0.1
$baseDeDatos="AppWeb";
$usuario="root";
$contrasenia="";

try {
    //code...
    $conexion = new PDO("mysql:host=$servidor;dbname=$baseDeDatos",$usuario,$contrasenia);
    /* echo 'conexion correcta'; */
} catch (Exception $ex)
{
    echo $ex->getMessage();
}

?>