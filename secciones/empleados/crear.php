<?php
include("../../bd.php");

//vamos  recibir los registros enviados en POST(Formulario)
if ($_POST) {
    /* print_r($_POST);
    print_r($_FILES); */
  //recolectamos los datos del metodo POST
   $primernombre=(isset($_POST["primernombre"])? $_POST["primernombre"]:"");
   $segundonombre=(isset($_POST["segundonombre"])? $_POST["segundonombre"]:"");
   $primerapellido=(isset($_POST["primerapellido"])? $_POST["primerapellido"]:""); 
   $segundoapellido=(isset($_POST["segundoapellido"])? $_POST["segundoapellido"]:"");
   $foto=(isset($_FILES["foto"]['name'])?$_FILES["foto"]['name']:"");
   $cv=(isset($_FILES["cv"]['name'])?$_FILES["cv"]['name']:"");
   $idpuesto=(isset($_POST["idpuesto"])? $_POST["idpuesto"]:"");
   $fechadeingreso=(isset($_POST["fechadeingreso"])? $_POST["fechadeingreso"]:"");   
    
   //preparamos la insercion de los datos
    $sentencia=$conexion->prepare("INSERT INTO 
    tbl_empleados (id,primernombre,segundonombre,primerapellido,segundoapellido,foto,cv,idpuesto,fechadeingreso) 
    VALUES (NULL,:primernombre,:segundonombre,:primerapellido,:segundoapellido,:foto,:cv,:idpuesto,:fechadeingreso);");

    //asignando los valores que tiene el metodo POST (los que vienen del formulario)
    $sentencia->bindParam(":primernombre", $primernombre);
    $sentencia->bindParam(":segundonombre", $segundonombre); 
    $sentencia->bindParam(":primerapellido", $primerapellido);
    $sentencia->bindParam(":segundoapellido", $segundoapellido);
    $sentencia->bindParam(":foto", $foto);
    $sentencia->bindParam(":cv", $cv);
    $sentencia->bindParam(":idpuesto", $idpuesto);
    $sentencia->bindParam(":fechadeingreso", $fechadeingreso);
    $sentencia->execute();

}

$sentencia = $conexion->prepare("SELECT * FROM tbl_puestos");
//VAMOS A EJECUTAR ESTA INSTRUCCION
$sentencia->execute();
$lista_tbl_puestos = $sentencia->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include("../../templates/header.php"); ?>

<!-- bs5cardheadfoot -->
<div class="card mt-4">
    <div class="card-header">
        Datos del empleado
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
<?php include("../../templates/footer.php"); ?>