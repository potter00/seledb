<?php require_once "vistas/parte_superior.php"?>

<!-- INICIO del cont principal -->
<div class="container">
    <h1>Gestión de Inventario de Reactivos</h1>
    
    <div class="container">
        <div class="row">
            <div class="col-lg-12">            
                <button id="btnNuevoReactivo" type="button" class="btn btn-primary" data-toggle="modal">
                    <i class="fas fa-plus"></i> Agregar Reactivo
                </button>    
            </div>    
        </div>    
    </div>    
    <br>  
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">        
                    <table id="tablaReactivos" class="table table-striped table-bordered table-condensed" style="width:100%">
                        <thead class="text-center">
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Unidad</th>
                                <th>Existencia</th>
                                <th>Punto de Reorden</th>
                                <th>Inventario en Días</th>
                                <th>Días para Surtir</th>
                                <th>Gasto por Día</th>                                
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>                           
                        </tbody>        
                    </table>               
                </div>
            </div>
        </div>  
    </div>    
      
    <!--Modal para CRUD-->
    <div class="modal fade" id="modalReactivo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="formReactivos">    
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="nombre" class="col-form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre" required>
                                </div>
                                <div class="form-group">
                                    <label for="unidad" class="col-form-label">Unidad:</label>
                                    <input type="text" class="form-control" id="unidad" required>
                                </div>
                                <div class="form-group">
                                    <label for="inventario_inicial" class="col-form-label">Inventario Inicial:</label>
                                    <input type="number" step="0.01" class="form-control" id="inventario_inicial">
                                </div>
                                <div class="form-group">
                                    <label for="compras" class="col-form-label">Compras:</label>
                                    <input type="number" step="0.01" class="form-control" id="compras">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="consumo" class="col-form-label">Consumo:</label>
                                    <input type="number" step="0.01" class="form-control" id="consumo">
                                </div>
                                <div class="form-group">
                                    <label for="existencia" class="col-form-label">Existencia:</label>
                                    <input type="number" step="0.01" class="form-control" id="existencia">
                                </div>
                                <div class="form-group">
                                    <label for="inventario_muestras" class="col-form-label">Inventario Muestras:</label>
                                    <input type="number" step="0.01" class="form-control" id="inventario_muestras">
                                </div>
                                <div class="form-group">
                                    <label for="gasto_por_dia" class="col-form-label">Gasto por Día:</label>
                                    <input type="number" step="0.01" class="form-control" id="gasto_por_dia">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="inventario_en_dias" class="col-form-label">Inventario en Días:</label>
                                    <input type="number" class="form-control" id="inventario_en_dias">
                                </div>
                                <div class="form-group">
                                    <label for="dias_en_surtir" class="col-form-label">Días en Surtir:</label>
                                    <input type="number" class="form-control" id="dias_en_surtir">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="inventario_al_llegar" class="col-form-label">Inventario al Llegar:</label>
                                    <input type="number" step="0.01" class="form-control" id="inventario_al_llegar">
                                </div>
                                <div class="form-group">
                                    <label for="punto_reorden" class="col-form-label">Punto de Reorden:</label>
                                    <input type="number" class="form-control" id="punto_reorden">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="btnGuardar" class="btn btn-dark">Guardar</button>
                    </div>
                </form>    
            </div>
        </div>
    </div>  
</div>
<!-- FIN del cont principal -->

<?php require_once "vistas/parte_inferior.php"?>

<!-- Script específico para la gestión de reactivos -->
<script>
$(document).ready(function() {
    var id, opcion;
    opcion = 4;
    
    // DataTable
    tablaReactivos = $('#tablaReactivos').DataTable({  
        "ajax":{            
            "url": "bd/crud_reactivos.php", 
            "method": 'POST',
            "data":{opcion:opcion},
            "dataSrc":""
        },
        "columns":[
            {"data": "id"},
            {"data": "nombre"},
            {"data": "unidad"},
            {"data": "existencia"},
            {"data": "punto_reorden"},
            {"data": "inventario_en_dias"},
            {"data": "dias_en_surtir"},
            {"data": "gasto_por_dia"},
            {"defaultContent": "<div class='text-center'><div class='btn-group'><button class='btn btn-primary btn-sm btnEditar'><i class='fas fa-pencil-alt'></i></button><button class='btn btn-danger btn-sm btnBorrar'><i class='fas fa-trash'></i></button></div></div>"}
        ],
        language: {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast":"Último",
                "sNext":"Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing":"Procesando...",
        }
    });

    // Nuevo reactivo
    $("#btnNuevoReactivo").click(function(){
        $("#formReactivos").trigger("reset");
        $(".modal-header").css("background-color", "#1cc88a");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Nuevo Reactivo");            
        $("#modalReactivo").modal("show");        
        id=null;
        opcion = 1; // alta
    });    
        
    // Submit form
    $('#formReactivos').submit(function(e){                         
        e.preventDefault();
        
        var nombre = $.trim($("#nombre").val());
        var unidad = $.trim($("#unidad").val());
        var inventario_inicial = $.trim($("#inventario_inicial").val());
        var compras = $.trim($("#compras").val());
        var consumo = $.trim($("#consumo").val());
        var existencia = $.trim($("#existencia").val());
        var inventario_muestras = $.trim($("#inventario_muestras").val());
        var gasto_por_dia = $.trim($("#gasto_por_dia").val());
        var inventario_en_dias = $.trim($("#inventario_en_dias").val());
        var dias_en_surtir = $.trim($("#dias_en_surtir").val());
        var inventario_al_llegar = $.trim($("#inventario_al_llegar").val());
        var punto_reorden = $.trim($("#punto_reorden").val());
            
        $.ajax({
            url: "bd/crud_reactivos.php",
            type: "POST",
            dataType: "json",
            data: {
                id:id, 
                nombre:nombre, 
                unidad:unidad,
                inventario_inicial:inventario_inicial,
                compras:compras,
                consumo:consumo,
                existencia:existencia,
                inventario_muestras:inventario_muestras,
                gasto_por_dia:gasto_por_dia,
                inventario_en_dias:inventario_en_dias,
                dias_en_surtir:dias_en_surtir,
                inventario_al_llegar:inventario_al_llegar,
                punto_reorden:punto_reorden,
                opcion:opcion
            },
            success: function(data){  
                tablaReactivos.ajax.reload(null, false);
             }        
        });
        $("#modalReactivo").modal("hide");    
    });
        
    // Editar        
    $(document).on("click", ".btnEditar", function(){
        fila = $(this).closest("tr");
        id = parseInt(fila.find('td:eq(0)').text());
        
        // Hacer una petición AJAX para obtener todos los datos del reactivo
        $.ajax({
            url: "bd/crud_reactivos.php",
            type: "POST",
            dataType: "json",
            data: {
                id: id,
                opcion: 5 // nueva opción para obtener un registro específico
            },
            success: function(data){
                if(data.length > 0) {
                    let reactivo = data[0];
                    $("#nombre").val(reactivo.nombre);
                    $("#unidad").val(reactivo.unidad);
                    $("#inventario_inicial").val(reactivo.inventario_inicial);
                    $("#compras").val(reactivo.compras);
                    $("#consumo").val(reactivo.consumo);
                    $("#existencia").val(reactivo.existencia);
                    $("#inventario_muestras").val(reactivo.inventario_muestras);
                    $("#gasto_por_dia").val(reactivo.gasto_por_dia);
                    $("#inventario_en_dias").val(reactivo.inventario_en_dias);
                    $("#dias_en_surtir").val(reactivo.dias_en_surtir);
                    $("#inventario_al_llegar").val(reactivo.inventario_al_llegar);
                    $("#punto_reorden").val(reactivo.punto_reorden);
                }
            }
        });
        
        opcion = 2; // editar
        
        $(".modal-header").css("background-color", "#4e73df");
        $(".modal-header").css("color", "white");
        $(".modal-title").text("Editar Reactivo");            
        $("#modalReactivo").modal("show");  
    });

    // Borrar
    $(document).on("click", ".btnBorrar", function(){    
        fila = $(this);
        id = parseInt($(this).closest("tr").find('td:eq(0)').text());
        opcion = 3 // borrar
        var respuesta = confirm("¿Está seguro de eliminar el registro?");
        if(respuesta){
            $.ajax({
                url: "bd/crud_reactivos.php",
                type: "POST",
                dataType: "json",
                data: {opcion:opcion, id:id},
                success: function(){
                    tablaReactivos.row(fila.parents('tr')).remove().draw();
                }
            });
        }   
    });
});
</script> 