<?php
include("../../bd.php");

if (isset($_GET['txtID'])) {  //si recibimos ese dato
    # code...
    $txtID=(isset($_GET['txtID']))?$_GET['txtID']:""; // vamos a alamcenar el id

    //vamos a ocupar la instruccion prepare
    $sentencia=$conexion->prepare("SELECT * FROM tbl_empleados WHERE id=:id");
    //asignando los valores que tiene el metodo POST (los que vienen del formulario)
    $sentencia->bindParam(":id", $txtID); //parametro para borrado
    $sentencia->execute(); //eliminamos

    $registro=$sentencia->fetch(PDO::FETCH_LAZY);
    $primernombre=$registro["primernombre"];
    $segundonombre=$registro["segundonombre"];
    $primerapellido=$registro["primerapellido"];
    $segundoapellido=$registro["segundoapellido"];
    $foto=$registro["foto"];
    $cv=$registro["cv"];
    $puesto=$registro["puesto"];
    $fechadeingreso=$registro["fechadeingreso"];
}


?>

<?php include("../../templates/header.php");?>

    <!-- bs5cardheadfoot -->
<div class="card mt-4">
    <div class="card-header">
        Editar Datos del empleado
    </div>
    <div class="card-body">
        <form action="" method="post" enctype="multipart/form-data">
           <!-- bs5forminput -->
           <div class="mb-3">
             <label for="primernombre" class="form-label">Primer Nombre</label>
             <input type="text"
               class="form-control" name="primernombre" id="primernombre" aria-describedby="helpId" placeholder="Ejemplo: Carlos...">
           </div>
           <div class="mb-3">
             <label for="segundonombre" class="form-label">Segundo Nombre</label>
             <input type="text"
               class="form-control" name="segundonombre" id="segundonombre" aria-describedby="helpId" placeholder="Ejemplo: Isaac...">
           </div>
           <div class="mb-3">
             <label for="primerapellido" class="form-label">Primer Apellido</label>
             <input type="text"
               class="form-control" name="primerapellido" id="primerapellido" aria-describedby="helpId" placeholder="Ejemplo: Hernandez...">
           </div>
           <div class="mb-3">
             <label for="segundoapellido" class="form-label">Segundo Apellido</label>
             <input type="text"
               class="form-control" name="segundoapellido" id="segundoapellido" aria-describedby="helpId" placeholder="Ejemplo: Cubias...">
           </div>
           <div class="mb-3">
             <label for="foto" class="form-label">Foto:</label>
             <input type="file"
               class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto.jpg">
           </div>
           <div class="mb-3">
             <label for="cv" class="form-label">CV(PDF)</label>
             <input type="file"
               class="form-control" name="cv" id="cv" aria-describedby="helpId" placeholder="CV">
           </div>


           <!-- bs5formselect-custom -->
           <div class="mb-3">
            <label for="idpuesto" class="form-label">Puesto</label>
            <select class="form-select form-select-sm" name="idpuesto" id="idpuesto">
            
            <?php foreach ($lista_tbl_puestos as $registro) { ?>
              <option value="<?php echo $registro['id']?>">
              <?php echo $registro['nombredelpuesto']?></option>
            <?php } ?>
                
            </select>
           </div>

           <!-- bs5form-email -->
           <div class="mb-3">
             <label for="fechadeingreso" class="form-label">Fecha de ingreso:</label>
             <input type="date" class="form-control" name="fechadeingreso" id="fechadeingreso" aria-describedby="emailHelpId" placeholder="">
           </div>

           <!-- bs5button-default -->
           <button type="submit" class="btn btn-success">Agregar registro</button>
           <!-- bs5button-a -->
           <a name="" id="" class="btn btn-danger" href="#" role="button">Cancelar</a>

        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php include("../../templates/footer.php");?>