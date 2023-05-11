<?php
include("../../bd.php");

/* cuando vamos a eliminar el registro necesitamos que el id de eliminacion 
de registro no aparezca en la URL es por ello que realizamos lo sigiente */

if (isset($_GET['txtID'])) {  //si recibimos ese dato
    # code...
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:""; // vamos a alamcenar el id

    //vamos a ocupar la instruccion prepare
    $sentencia=$conexion->prepare("DELETE FROM tbl_puestos WHERE id=:id");
    //asignando los valores que tiene el metodo POST (los que vienen del formulario)
    $sentencia->bindParam(":id", $txtID); //parametro para borrado
    $sentencia->execute(); //eliminamos

    //redireccionaremos al index
    header("Location:index.php");
}

$sentencia = $conexion->prepare("SELECT * FROM tbl_puestos");
//VAMOS A EJECUTAR ESTA INSTRUCCION
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

/* print_r($lista_tbl_puestos); */

?>
<?php include("../../templates/header.php"); ?>

<div class="title mt-4">
    <h4>PUESTOS</h4>
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
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre del puesto</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($lista_tbl_puestos as $registro) { ?>
                        <tr class="">
                            <td scope="row"><?php  echo $registro['id'];?></td>
                            <td><?php  echo $registro['nombredelpuesto'];?></td>
                            <!-- <td>Programador sr</td> -->
                            <td>
                                <!-- <a name="" id="btneditar" class="btn btn-info" href="editar.php" role="button">Editar</a> -->
                                <a class="btn btn-primary" href="editar.php?txtID=<?php  echo $registro['id']; ?>" role="button">Editar</a>
                                <a class="btn btn-danger" href="index.php?txtID=<?php  echo $registro['id']; ?>" role="button">Eliminar</a>
                            </td>
                        </tr>
                    <?php } ?>
                    
                </tbody>
            </table>
        </div>

    </div>
</div>
<?php include("../../templates/footer.php"); ?>