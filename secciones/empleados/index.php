<?php
include("../../bd.php");

/* cuando vamos a eliminar el registro necesitamos que el id de eliminacion 
de registro no aparezca en la URL es por ello que realizamos lo sigiente */

if (isset($_GET['txtID'])) { //si recibimos ese dato
    # code...
    $txtID = (isset($_GET['txtID'])) ? $_GET['txtID'] : ""; // vamos a alamcenar el id

    //Buscar el archivo realacionado con el empleado
    $sentencia = $conexion->prepare("SELECT foto,cv FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY); //nos va a devolver un registro
    /* print_r($registro_recuperado); */

    if (isset($registro_recuperado["foto"]) && $registro_recuperado["foto"] != "") {
        if (file_exists("./" . $registro_recuperado["foto"])) {
            unlink("./" . $registro_recuperado["foto"]);

        }
    }

    if (isset($registro_recuperado["cv"]) && $registro_recuperado["cv"] != "") {
        if (file_exists("./" . $registro_recuperado["cv"])) {
            unlink("./" . $registro_recuperado["cv"]);

        }
    }



    $sentencia = $conexion->prepare("DELETE FROM tbl_empleados WHERE id=:id");
    //asignando los valores que tiene el metodo POST (los que vienen del formulario)
    $sentencia->bindParam(":id", $txtID); //parametro para borrado
    $sentencia->execute(); //eliminamos
    //redireccionaremos al index
    header("Location:index.php");
}

//vamos a trabajar con una subconsulta para mostrar el nombre del puesto.
$sentencia = $conexion->prepare("SELECT *,
(SELECT nombredelpuesto 
FROM tbl_puestos 
WHERE tbl_puestos.id=tbl_empleados.idpuesto limit 1) as puesto /* Le decimos que toda la consulta de puesto equivalea a: puesto mostrada como 1 registro */
FROM `tbl_empleados`");
//VAMOS A EJECUTAR ESTA INSTRUCCION
$sentencia->execute();
$lista_tbl_empleados = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>



<?php include("../../templates/header.php"); ?>

<div class="title mt-4">
    <h4>EMPLEADOS</h4>
</div>

<!-- bs5cardheadfoot -->
<div class="card mt-4">
    <div class="card-header">
        <!-- bs5button-a -->
        <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar</a>
    </div>
    <div class="card-body">
        <!-- bs5tabledefault -->
        <div class="table-responsive-sm">
            <table class="table" id="tabla_id"> <!-- tabla_id para que funciones datatables -->
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellidos</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_tbl_empleados as $registro) { ?>
                        <tr class="">
                            <td scope="row">
                                <?php echo $registro['id']; ?>
                            </td>
                            <td>
                                <?php echo $registro['primernombre']; ?>
                                <?php echo $registro['segundonombre']; ?>
                            </td>

                            <td>
                                <?php echo $registro['primerapellido']; ?>
                                <?php echo $registro['segundoapellido']; ?>
                            </td>

                            <td>
                                <img width="50" src="<?php echo $registro['foto']; ?>" class="img-fluid rounded" alt="">
                            </td>
                            <td>
                                <a href=" <?php echo $registro['cv']; ?>">
                                <?php echo $registro['cv']; ?>
                                </a>
                            </td>
                            <td>
                                <?php echo $registro['puesto']; ?>
                            </td> <!-- como puesto. Gracias a la subconsulta -->
                            <td>
                                <?php echo $registro['fechadeingreso']; ?>
                            </td>

                            <!-- <td>Programador sr</td> -->
                            <td>
                                <div class="d-flex justify-content-between">
                                    <a class="btn btn-primary me-2" href="carta_recomendacion.php?txtID=<?php echo $registro['id']; ?>"role="button">Carta</a>
                                    <a class="btn btn-primary me-2" href="editar.php?txtID=<?php echo $registro['id']; ?>"
                                        role="button">Editar</a>
                                    <a class="btn btn-danger" href="index.php?txtID=<?php echo $registro['id']; ?>"
                                        role="button">Eliminar</a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?php include("../../templates/footer.php"); ?>