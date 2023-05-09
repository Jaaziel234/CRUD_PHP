<?php
include("../../bd.php");

//vamos  recibir los registros enviados en POST(Formulario)
if ($_POST) {
    # code...
 /*   print_r($_POST);  */
   //recolectamos los datos del metodo POST
   $nombredelpuesto=(isset($_POST["nombredelpuesto"])? $_POST["nombredelpuesto"]:""); //validamos que existe la informacion enviada, sino existe va a dejarlo en blanco
    //preparamos la insercion de los datos
    $sentencia=$conexion->prepare("INSERT INTO tbl_puestos(id,nombredelpuesto) 
    VALUES (null, :nombredelpuesto)");

    //asignando los valores que tiene el metodo POST (los que vienen del formulario)
    $sentencia->bindParam(":nombredelpuesto", $nombredelpuesto); //
    $sentencia->execute();

    //redireccionaremos al index
    header("Location:index.php");

}

?>

<?php include("../../templates/header.php"); ?>

<!-- bs5cardheadfoot -->
<div class="card mt-4">
    <div class="card-header">
        Datos del Puesto
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
           <!-- bs5forminput -->
           <div class="mb-3">
             <label for="nombredelpuesto" class="form-label">Nombre del puesto</label>
             <input type="text"
               class="form-control" name="nombredelpuesto" id="nombredelpuesto" aria-describedby="helpId" placeholder="Ejemplo: ...">
           </div>

           <!-- bs5button-default -->
           <button type="submit" class="btn btn-success">Agregar registro</button>
           <!-- bs5button-a -->
           <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php include("../../templates/footer.php"); ?>