var tbl_asistencia;
function listar_asistencia() {
    tbl_asistencia = $("#tabla_asistencia").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/asistencia/controlador_listar_asistencia.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "dni" },
            { "data": "fecha" },
            { "data": "hora" },
            { "data": "nombre_alumno" },
            { "data": "nombre_grado" },
            { "data": "nombre_seccion" },
            { "data": "nombre_bimestre" },
            {
                "data": "estado_asistencia",
                "render": function (data) {
                    if (data === 'ASISTIO') {
                        return '<span class="badge bg-success">ASISTIO</span>';
                    } else if (data === 'TARDE') {
                        return '<span class="badge bg-warning">TARDE</span>';
                    } else if (data === 'NO ASISTIO') {
                        return '<span class="badge bg-danger">NO ASISTIO</span>';
                    }
                }
            }
        ],
        "language": idioma_espanol,
        select: true
    });

    tbl_asistencia.on('draw.td', function () {
        var PageInfo = $("#tabla_asistencia").DataTable().page.info();
        tbl_asistencia.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}



function AbrirRegistro() {
    $("#modal_registro").modal({ backdrop: 'static', keyboard: false })
    $("#modal_registro").modal('show');
}


/********************************************************************
                        CARGAR SELECT AGENCIA
********************************************************************/

function Cargar_Select_Agencia() {
    $.ajax({
        "url": "../controller/area/controlador_cargar_select_agencia.php",
        type: 'POST'
    }).done(function (resp) {
        let data = JSON.parse(resp);
        if (data.length > 0) {
            let cadena = "<option value=''>SELECCIONAR AREA</option>";
            for (let i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }
            document.getElementById('nombre_agencia').innerHTML = cadena;
            document.getElementById('nombre_agencia_editar').innerHTML = cadena;

        } else {
            cadena += "<option value=''>No hay areas disponibles</option>";
            document.getElementById('nombre_agencia').innerHTML = cadena;
            document.getElementById('nombre_agencia_editar').innerHTML = cadena;

        }
    })
}




/********************************************************************
                        REGISTRAR AREA
********************************************************************/
function Registrar_Asistencia() {
    let txt_dni = document.getElementById('txt_dni').value;

    if (txt_dni.length == 0) {
        return Swal.fire({
            position: "top-end",
            icon: "warning",
            title: "Tiene campos vacíos",
            showConfirmButton: false,
            timer: 1500
        });
    }

    $.ajax({
        url: "controller/asistencia/controlador_registrar_asistencia.php",
        type: 'POST',
        data: {
            txt_dni: txt_dni,
        }
    }).done(function(resp) {
        if (resp > 0) {
            if (resp == 1) {
                Swal.fire({
                    position: "top-end",
                    icon: "success",
                    title: "Nueva Asistencia Registrada",
                    showConfirmButton: false,
                    timer: 1500
                }).then(() => {
                    document.getElementById('txt_dni').value = "";
                    tbl_bimestre.ajax.reload();
                    $("#modal_registro").modal('hide');
                });
            } else {
                Swal.fire({
                    position: "top-end",
                    icon: "warning",
                    title: "El DNI ingresado ya se encuentra registrado",
                    showConfirmButton: false,
                    timer: 1500
                });
            }
        } else {
            Swal.fire({
                position: "top-end",
                icon: "error",
                title: "No se completó el registro",
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
}

/********************************************************************
                        MODIFICAR AREA
********************************************************************/


$('#tabla_asistencia').on('click', '.editar', function () {
    var data = tbl_asistencia.row($(this).parents('tr')).data();//En tamaño escritorio
    if (tbl_asistencia.row(this).child.isShown()) {
        var data = tbl_asistencia.row(this).data();

    }
    console.log(data);

    $("#modal_editar").modal('show');
    document.getElementById('txt_idarea').value = data.id_area;
    $("#nombre_agencia_editar").select2().val(data.id_agencia).trigger('change.select2');
    document.getElementById('nombre_area_editar').value = data.nombre_area;
})


function Modificar_Area() {
    let nombre_agencia_editar = document.getElementById('nombre_agencia_editar').value; // ID de la agencia
    let txt_idarea = document.getElementById('txt_idarea').value; // Nombre de la agencia
    let nombre_area_editar = document.getElementById('nombre_area_editar').value;

    if (nombre_agencia_editar.length === 0 || txt_idarea.length === 0 || nombre_area_editar.length === 0) {
        return Swal.fire("Mensaje de Advertencia", "Tiene campos vacíos", "warning");
    }

    $.ajax({
        url: "../controller/area/controlador_modificar_area.php",
        type: 'POST',
        data: {
            nombre_agencia_editar: nombre_agencia_editar,
            txt_idarea: txt_idarea,
            nombre_area_editar: nombre_area_editar
        }
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("Mensaje de Confirmación", "Datos Actualizados", "success").then((value) => {
                    tbl_asistencia.ajax.reload();
                    $("#modal_editar").modal('hide');
                });
            } else {
                Swal.fire("Mensaje de Advertencia", "El area ingresado ya se encuentra en la base de datos", "warning");
            }
        } else {
            return Swal.fire("Mensaje de Error", "No se completó la modificación", "error");
        }
    });
}



$('#tabla_asistencia').on('click', '.eliminar', function () {
    var data = tbl_asistencia.row($(this).parents('tr')).data();
    if (tbl_asistencia.row(this).child.isShown()) {
        data = tbl_asistencia.row(this).data();
    }
    
    Swal.fire({
        title: '¿Desea eliminar el área?',
        text: "Se borrará el registro de la base de datos.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, confirmar'
    }).then((result) => {
        if (result.isConfirmed) {
            Eliminar_Area(data.id_area);
        }
    });
});

/********************************************************************
            METODO ELIMINAR AREA
********************************************************************/
function Eliminar_Area(id_area) {
    $.ajax({
        url: '../controller/area/controlador_eliminar_area.php',
        type: 'POST',
        data: {
            id_area: id_area
        }
    }).done(function (resp) {
        if (resp > 0) {
            Swal.fire("Mensaje de Confirmación", "Area eliminado Satisfactoriamente", "success").then(() => {
                tbl_asistencia.ajax.reload(); // Recargar dataTable
            });
        } else {
            Swal.fire("Mensaje de Error", "No se puede eliminar el área", "error");
        }
    }).fail(function () {
        Swal.fire("Mensaje de Error", "Error en la solicitud AJAX", "error");
    });
}

