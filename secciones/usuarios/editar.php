<?php
include("../../bd.php");


if (isset($_GET['txtID'])) {  //si recibimos ese dato
    # code...
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:""; // vamos a alamcenar el id

    //vamos a ocupar la instruccion prepare
    $sentencia=$conexion->prepare("SELECT * FROM tbl_usuarios WHERE id=:id");
    //asignando los valores que tiene el metodo POST (los que vienen del formulario)
    $sentencia->bindParam(":id", $txtID); //parametro para borrado
    $sentencia->execute(); //eliminamos

    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $usuario=$registro["usuario"];
    $password=$registro["password"];
    $correo=$registro["correo"];
}

if ($_POST) {
    # code...

   //recolectamos los datos del metodo POST
   $txtID=(isset($_POST['txtID']))?$_GET['txtID']:"";
   $usuario=(isset($_POST["usuario"])? $_POST["usuario"]:"");
   $password=(isset($_POST["password"])? $_POST["password"]:""); 
   $correo=(isset($_POST["correo"])? $_POST["correo"]:""); 
    //preparamos la insercion de los datos
    $sentencia=$conexion->prepare("UPDATE tbl_usuarios SET usuario=:usuario,password=:password,correo=:correo
    WHERE id=:id "); 
    //asignando los valores que tiene el metodo POST (los que vienen del formulario)
    $sentencia->bindParam(":id", $txtID);
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":password", $password);
    $sentencia->bindParam(":correo", $correo);
    $sentencia->execute();
    //redireccionaremos al index
    header("Location:index.php");
}


?>

<?php include("../../templates/header.php");?>


<!-- bs5cardheadfoot -->
<div class="card mt-4">
    <div class="card-header">
        Editar Datos del Usuario
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
             <label for="usuario" class="form-label">Nombre del Usuario</label>
             <input type="text"
             value="<?php echo $usuario;?>"
               class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Ejemplo: ...">
           </div>
           <div class="mb-3">
             <label for="password" class="form-label">Contraseña</label>
             <input type="password"
             value="<?php echo $password;?>"
               class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Ejemplo: ...">
           </div>
           <div class="mb-3">
             <label for="email" class="form-label">Correo</label>
             <input type="email"
             value="<?php echo $correo;?>"
               class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Ejemplo: ...">
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