<?php
include("../../bd.php");

//vamos  recibir los registros enviados en POST(Formulario)
if ($_POST) {
    
   //recolectamos los datos del metodo POST
   $usuario=(isset($_POST["usuario"])? $_POST["usuario"]:"");
   $password=(isset($_POST["password"])? $_POST["password"]:"");
   $correo=(isset($_POST["correo"])? $_POST["correo"]:"");  
    
   //preparamos la insercion de los datos
    $sentencia=$conexion->prepare("INSERT INTO tbl_usuarios(id,usuario,password,correo) 
    VALUES (null, :usuario,:password,:correo)");

    //asignando los valores que tiene el metodo POST (los que vienen del formulario)
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password); 
    $sentencia->bindParam(":correo", $correo);
    $sentencia->execute();

    //redireccionaremos al index
    header("Location:index.php");

}

?>


<?php include("../../templates/header.php"); ?>

<!-- bs5cardheadfoot -->
<div class="card mt-4">
    <div class="card-header">
        Datos del Usuario
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
           <!-- bs5forminput -->
           <div class="mb-3">
             <label for="usuario" class="form-label">Nombre del usuario</label>
             <input type="text"
               class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Ejemplo: Joel...">
           </div>

           <div class="mb-3">
             <label for="password" class="form-label">Password</label>
             <input type="password"
               class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Escriba su contrase...">
           </div>

           <div class="mb-3">
             <label for="correo" class="form-label">Correo</label>
             <input type="email"
               class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="carlos@gmail.com">
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