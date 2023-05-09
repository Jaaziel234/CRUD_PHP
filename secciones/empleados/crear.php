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
             <label for="primeranombre" class="form-label">Primer Nombre</label>
             <input type="text"
               class="form-control" name="primeranombre" id="primeranombre" aria-describedby="helpId" placeholder="Ejemplo: Carlos...">
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
               class="form-control" name="foto" id="foto" aria-describedby="helpId" placeholder="Foto. jpg">
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
                <option selected>Select one</option>
                <option value="">New Delhi</option>
                <option value="">Istanbul</option>
                <option value="">Jakarta</option>
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