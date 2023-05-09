<?php
include("../../bd.php");


if (isset($_GET['txtID'])) {  //si recibimos ese dato
    # code...
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:""; // vamos a alamcenar el id

    //vamos a ocupar la instruccion prepare
    $sentencia=$conexion->prepare("SELECT * FROM tbl_puestos WHERE id=:id");
    //asignando los valores que tiene el metodo POST (los que vienen del formulario)
    $sentencia->bindParam(":id", $txtID); //parametro para borrado
    $sentencia->execute(); //eliminamos

    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $nombredelpuesto=$registro["nombredelpuesto"];
}

if ($_POST) {
    # code...
   //recolectamos los datos del metodo POST
   $txtID=(isset($_POST['txtID']))?$_GET['txtID']:"";
   $nombredelpuesto=(isset($_POST["nombredelpuesto"])? $_POST["nombredelpuesto"]:""); //validamos que existe la informacion enviada, sino existe va a dejarlo en blanco
    //preparamos la insercion de los datos
    $sentencia=$conexion->prepare("UPDATE tbl_puestos SET nombredelpuesto=:nombredelpuesto
    WHERE id=:id "); 
    //asignando los valores que tiene el metodo POST (los que vienen del formulario)
    $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto); //
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    //redireccionaremos al index
    header("Location:index.php");
}


?>

<?php include("../../templates/header.php");?>


<!-- bs5cardheadfoot -->
<div class="card mt-4">
    <div class="card-header">
        Editar Datos del Puesto
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
            <!-- bs5form-input -->
            <div class="mb-3">
              <label for="txtID" class="form-label">ID:</label>
              <input type="text"
              value="<?php echo $txtID;?>"
                class="form-control" readonly name="txtID" id="txtID" aria-describedby="helpId" placeholder="ID">
            </div>

           <!-- bs5forminput -->
           <div class="mb-3">
             <label for="nombredelpuesto" class="form-label">Nombre del puesto</label>
             <input type="text"
             value="<?php echo $nombredelpuesto;?>"
               class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Ejemplo: ...">
           </div>

           <!-- bs5button-default -->
           <button type="submit" class="btn btn-success">Guardar</button>
           <!-- bs5button-a -->
           <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php include("../../templates/footer.php");?>