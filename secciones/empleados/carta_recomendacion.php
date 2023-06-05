<?php
include("../../bd.php");

if (isset($_GET['txtID'])) { //si recibimos ese dato
    # code...
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : ""; // vamos a almacenar el id
  
    //vamos a ocupar la instruccion prepare
    $sentencia = $conexion->prepare("SELECT * FROM tbl_empleados WHERE id=:id");
    //asignando los valores que tiene el metodo POST (los que vienen del formulario)
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $primernombre = $registro["primernombre"];
    $segundonombre = $registro["segundonombre"];
    $primerapellido = $registro["primerapellido"];
    $segundoapellido = $registro["segundoapellido"];
    $foto = $registro["foto"];
    $cv = $registro["cv"];
  
    $idpuesto = $registro["idpuesto"];
    $fechadeingreso = $registro["fechadeingreso"];
  
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carta de recomendacion</title>
</head>
<body>
    <h1>Carta de recomendacion laboral</h1>
    <br><br>
    Merdia Yucatan, Mexico a <strong>27/09/2023</strong>
    <br></br>
    A quien le pueda interesar:
    <br></br>
    Reciba un cordial y respetuoso saludo
    <br><br>
    A traves de estas lineas deseo hacer de su conocimiento que la Sr(a) <strong>Oscar Uh</strong>
    quien laboro en mi oprganizacion durate <strong>10 años</strong>
    Es un ciuidado con una conducta intachable. Ha demostrado ser un excelente gran trabajadpr comprometido,
    responsable y fiel cumplidor de sus tareas.
    Siempre ha manifestado preocupacion por mejorar, capacitarse y actualizar sus conocimientos. 
    <br><br>
    Duranrt
</body>
</html>
