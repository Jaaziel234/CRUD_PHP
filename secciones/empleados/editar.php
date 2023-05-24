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

  $sentencia = $conexion->prepare("SELECT * FROM tbl_puestos");
  $sentencia->execute();
  $lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

}

if ($_POST) {
  $txtID = (isset($_POST['txtID'])) ? $_POST['txtID'] : ""; // vamos a almacenar el id
  $primernombre = (isset($_POST["primernombre"]) ? $_POST["primernombre"] : "");
  $segundonombre = (isset($_POST["segundonombre"]) ? $_POST["segundonombre"] : "");
  $primerapellido = (isset($_POST["primerapellido"]) ? $_POST["primerapellido"] : "");
  $segundoapellido = (isset($_POST["segundoapellido"]) ? $_POST["segundoapellido"] : "");
  $idpuesto = (isset($_POST["idpuesto"]) ? $_POST["idpuesto"] : "");
  $fechadeingreso = (isset($_POST["fechadeingreso"]) ? $_POST["fechadeingreso"] : "");

  //preparamos la insercion de los datos
  $sentencia = $conexion->prepare("
 UPDATE tbl_empleados 
 SET
   primernombre = :primernombre,
   segundonombre = :segundonombre,
   primerapellido = :primerapellido,
   segundoapellido = :segundoapellido,
   idpuesto = :idpuesto,
   fechadeingreso = :fechadeingreso
 WHERE id = :id
");


  //asignando los valores que tiene el metodo POST (los que vienen del formulario)
  $sentencia->bindParam(":primernombre", $primernombre);
  $sentencia->bindParam(":segundonombre", $segundonombre);
  $sentencia->bindParam(":primerapellido", $primerapellido);
  $sentencia->bindParam(":segundoapellido", $segundoapellido);
  $sentencia->bindParam(":idpuesto", $idpuesto);
  $sentencia->bindParam(":fechadeingreso", $fechadeingreso);
  $sentencia->bindParam(":id", $txtID); //nos servira para actualizar ese dato y al final tener recolectada esa informacion
  $sentencia->execute();

  $foto = (isset($_FILES["foto"]['name']) ? $_FILES["foto"]['name'] : "");

  $fecha_ = new DateTime(); //obtenemos el tiempo

  $nombreArchivo_foto = ($foto != '') ? $fecha_->getTimestamp() . "_" . $_FILES["foto"]['name'] : "";
  $tmp_foto = $_FILES["foto"]['tmp_name']; //utilizar un archivo temporal 

  if ($tmp_foto != '') {
    move_uploaded_file($tmp_foto, "./" . $nombreArchivo_foto);
    //Buscar el archivo realacionado con el empleado
    $sentencia = $conexion->prepare("SELECT foto FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY); //nos va a devolver un registro

    if (isset($registro_recuperado["foto"]) && $registro_recuperado["foto"] != "") {
      if (file_exists("./" . $registro_recuperado["foto"])) {
        unlink("./" . $registro_recuperado["foto"]);

      }
    }

    $sentencia = $conexion->prepare("UPDATE tbl_empleados SET foto = :foto WHERE id = :id");
    $sentencia->bindParam(":foto", $nombreArchivo_foto);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
  }

  $cv = (isset($_FILES["cv"]['name']) ? $_FILES["cv"]['name'] : "");
  $nombreArchivo_cv = ($cv != '') ? $fecha_->getTimestamp() . "_" . $_FILES["cv"]['name'] : ""; //armar el nuevo nombre con el tiempo para que no se sobreescriba con otros
  $tmp_cv = $_FILES["cv"]['tmp_name']; //utilizar un archivo temporal 

  if ($tmp_cv != '') {
    move_uploaded_file($tmp_cv, "./" . $nombreArchivo_cv); // para que podamos mover el archivo temporal a un nuevo destino

    //Buscar el archivo realacionado con el empleado
    $sentencia = $conexion->prepare("SELECT cv FROM tbl_empleados WHERE id=:id");
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
    $registro_recuperado = $sentencia->fetch(PDO::FETCH_LAZY); //nos va a devolver un registro

    if (isset($registro_recuperado["cv"]) && $registro_recuperado["cv"] != "") {
      if (file_exists("./" . $registro_recuperado["cv"])) {
        unlink("./" . $registro_recuperado["cv"]);

      }
    }

    $sentencia = $conexion->prepare("UPDATE tbl_empleados SET cv=:cv WHERE id = :id");
    $sentencia->bindParam(":cv", $nombreArchivo_cv);
    $sentencia->bindParam(":id", $txtID);
    $sentencia->execute();
  }


  //redireccionaremos al index
  header("Location:index.php");
}


?>

<?php include("../../templates/header.php"); ?>

<!-- bs5cardheadfoot -->
<div class="card mt-4">
  <div class="card-header">
    Editar Datos del empleado
  </div>
  <div class="card-body">
    <form action="" method="post" enctype="multipart/form-data">
      <!-- bs5form-input -->
      <div class="mb-3">
        <label for="txtID" class="form-label">ID:</label>
        <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID"
          aria-describedby="helpId" placeholder="ID">
      </div>
      <!-- bs5forminput -->
      <div class="mb-3">
        <label for="primernombre" class="form-label">Primer Nombre</label>
        <input type="text" value="<?php echo $primernombre; ?>" class="form-control" name="primernombre"
          id="primernombre" aria-describedby="helpId" placeholder="Ejemplo: Carlos...">
      </div>
      <div class="mb-3">
        <label for="segundonombre" class="form-label">Segundo Nombre</label>
        <input type="text" value="<?php echo $segundonombre; ?>" class="form-control" name="segundonombre"
          id="segundonombre" aria-describedby="helpId" placeholder="Ejemplo: Isaac...">
      </div>
      <div class="mb-3">
        <label for="primerapellido" class="form-label">Primer Apellido</label>
        <input type="text" value="<?php echo $primerapellido; ?>" class="form-control" name="primerapellido"
          id="primerapellido" aria-describedby="helpId" placeholder="Ejemplo: Hernandez...">
      </div>
      <div class="mb-3">
        <label for="segundoapellido" class="form-label">Segundo Apellido</label>
        <input type="text" value="<?php echo $segundoapellido; ?>" class="form-control" name="segundoapellido"
          id="segundoapellido" aria-describedby="helpId" placeholder="Ejemplo: Cubias...">
      </div>
      <div class="mb-3">
        <label for="foto" class="form-label">Foto:</label>
        <br />
        <img width="100" src="<?php echo $foto; ?>" class="rounded" alt="">
        <br />
        <br />
        <input type="file" class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto.jpg">
      </div>

      <div class="mb-3">
        <label for="cv" class="form-label">CV(PDF)</label>
        <br>
        <a href="<?php echo $cv; ?>"><?php echo $cv; ?></a>
        <input type="file" class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="CV">
      </div>


      <!-- bs5formselect-custom -->
      <div class="mb-3">
        <label for="idpuesto" class="form-label">Puesto</label>
        <!-- "<?php echo $idpuesto; ?>" -->
        <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
          <?php foreach ($lista_tbl_puestos as $registro) { ?>

            <option <?php echo ($idpuesto == $registro['id']) ? "selected" : ""; ?> value="<?php echo $registro['id'] ?>">
              <?php echo $registro['nombredelpuesto'] ?>
            </option>

          <?php } ?>

        </select>
      </div>

      <!-- bs5form-email -->
      <div class="mb-3">
        <label for="fechadeingreso" class="form-label">Fecha de ingreso:</label>
        <input type="date" value="<?php echo $fechadeingreso; ?>" class="form-control" name="fechadeingreso"
          id="fechadeingreso" aria-describedby="emailHelpId" placeholder="">
      </div>

      <!-- bs5button-default -->
      <button type="submit" class="btn btn-success">Actualizar</button>
      <!-- bs5button-a -->
      <a name="" id="" class="btn btn-danger" href="index.php" role="button">Cancelar</a>

    </form>
  </div>
  <div class="card-footer text-muted"></div>
</div>
<?php include("../../templates/footer.php"); ?>