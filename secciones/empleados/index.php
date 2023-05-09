<?php include("../../templates/header.php");?>

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
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Foto</th>
                        <th scope="col">CV</th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Fecha de ingreso</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td scope="row">Oscar Uh</td>
                        <td>imagen.jpg</td>
                        <td>CV.pfd</td>
                        <td>Programador sr</td>
                        <td>12/12/2023</td>
                        <td>
                            <a name="" id="" class="btn btn-primary" href="#" role="button">Carta</a>
                            <a name="" id="btneditar" class="btn btn-info" href="#" role="button">Editar</a>
                            <a name="" id="btnborrar" class="btn btn-danger" href="#" role="button">Eliminar</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        
    </div>
</div>
<?php include("../../templates/footer.php");?>