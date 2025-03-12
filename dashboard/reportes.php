<?php require_once "vistas/parte_superior.php" ?>


<div class="container">


    <div style="float: left; width: 60%;">
        <h1 id="labelEmpresas" style="float: left;">Generacion de reportes</h1>
        <br>
        <br>
        <hr>
        <button style="margin-top: 10px;" type="button" class="btn btn-primary" id="btnEmpresaNuevo"><i
                class="fas fa-plus"></i> Subir Excel</button>
        <br>
        <hr>
        <button style="margin-top: 10px;" type="button" class="btn btn-primary" id="btnEmpresaNuevo"><i
                class="fas fa-plus"></i> Agregar nuevo elemento</button>
        <button style="margin-top: 10px; float: right;" type="button" class="btn btn-primary"><i
                class="fas fa-plus"></i> Eliminar elemento</button>
        
        <hr>

        <table id="tablaEmpresas" class="table table-sm table-striped table-bordered table-condensed">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Tipo</th>
                    <th>Fecha de generacion</th>

                </tr>
            </thead>
            <tbody>
                <?php for ($i = 0; $i < 10; $i++) {

                    ?>
                    <tr>
                        <td style="width:15px"><?php echo $i ?></td>
                        <td>Reporte <?php $i ?></td>
                        <td>Inventario</td>
                        <td>10-15-25</td>

                    </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
    <div style="float: right; width: 35%; margin-left: 20px;">
        <h1>Reportes</h1>
        <div class="card">
            <div class="card-header">
                <div style="float: left; width: 65%;">
                    <h5 class="card-title">Reporte inventario</h5>
                    <h6 class="card-subtitle">Reporte 2554</h6>
                </div>

            </div>
            <div class="card-body" style="line-height: .8;">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas, sequi iusto? Architecto, possimus!
                Iste quos nemo laborum nam incidunt earum voluptates, asperiores mollitia possimus sunt consectetur
                odit. Fugiat, impedit voluptates.
            </div>
        </div>
        <br>
        <hr>
        <br>
        <div class="card">
            <div class="card-header">
                <div style="float: left; width: 65%;">
                    <h5 class="card-title">Reporte movimiento</h5>
                    <h6 class="card-subtitle">Reporte 2554</h6>
                </div>

            </div>
            <div class="card-body" style="line-height: .8;">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas, sequi iusto? Architecto, possimus!
                Iste quos nemo laborum nam incidunt earum voluptates, asperiores mollitia possimus sunt consectetur
                odit. Fugiat, impedit voluptates.
            </div>
        </div>
    </div>
</div>
<?php require_once "vistas/parte_inferior.php" ?>