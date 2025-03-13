<?php require_once "vistas/parte_superior.php"; ?>


<div class="container">


    <div style="float: left; width: 60%;">
        <h1 id="labelEmpresas" style="float: left;">Gestion de usuarios</h1>


        <button style="margin-top: 10px; margin-left: 50px;" type="button" class="btn btn-primary"
            id="btnEmpresaNuevo"><i class="fas fa-plus"></i> Agregar nuevo elemento</button>




        <table id="tablaEmpresas" class="table table-sm table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Acciones</th>

                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < 10; $i++) {

                    ?>
                    <tr>
                        <td style="width:15px"><?php echo $i ?></td>
                        <td>juan carlos bodoque <?php $i ?></td>
                        <td>juan.bodoque@31minutos.com</td>
                        <td>000000000</td>
                        <td>
                            <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-eye"></i></button>
                            <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-file"></i></button>
                            <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </td>

                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
    <div style="float: right; width: 35%; margin-left: 20px;">
        <h1>Usuario</h1>
        <div class="card">
            <div class="card-header">
                <div style="float: left; width: 65%;">
                    <h5 class="card-title">Datos de Usuario</h5>
                    <h6 class="card-subtitle">Juan carlos bodoque</h6>
                </div>

            </div>
            <div class="card-body" style="line-height: .8;">
                <p><strong>Nombre: </strong>Juan carlos bodoque</p>
                <p><Strong>Correo: </Strong>juan.bodoque@31minutos.com</p>
                <p><strong>Telefono: </strong>000000000</p>
                <p><strong>Permisos de usuario: </strong>
                    <select name="permiso" id="usuariosTipo">
                        <option value="activo">Administrador</option>
                        <option value="inactivo">Operador</option>
                    </select>
                </p>

            </div>
        </div>
        
        
    </div>
</div>
<?php require_once "vistas/parte_inferior.php" ?>