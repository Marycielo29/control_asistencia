var tbl_seccion;
function listar_seccion() {
    tbl_seccion = $("#tabla_seccion").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/seccion/controlador_listar_seccion.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "nombre_seccion" },
            { "defaultContent": "<center><span class='editar text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar'><i class='fa fa-edit'></i></span> <span class='eliminar text-danger px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar'><i class='fa fa-trash'></i></span></center>" }
        ],
        "language": idioma_espanol,
        select: true
    });

    tbl_seccion.on('draw.td', function () {
        var PageInfo = $("#tabla_seccion").DataTable().page.info();
        tbl_seccion.column(0, { page: 'current' }).nodes().each(function (cell, i) {
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
            document.getElementById('nombre_seccion').innerHTML = cadena;
            document.getElementById('nombre_seccion_editar').innerHTML = cadena;

        } else {
            cadena += "<option value=''>No hay areas disponibles</option>";
            document.getElementById('nombre_seccion').innerHTML = cadena;
            document.getElementById('nombre_seccion_editar').innerHTML = cadena;

        }
    })
}




/********************************************************************
                        REGISTRAR AREA
********************************************************************/
function Registrar_Seccion(){

    let nombre_seccion = document.getElementById('nombre_seccion').value;

    if (nombre_seccion.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Tiene campos vacíos", "warning");
    }

    $.ajax({
        url: "../controller/seccion/controlador_registro_seccion.php",
        type: 'POST',
        data: {
            nombre_seccion: nombre_seccion,
        }
    }).done(function(resp) {
        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("Mensaje de Confirmación", "Nueva Seccion Registrada", "success").then((value) => {
                    document.getElementById('nombre_seccion').value = "";
                    tbl_seccion.ajax.reload();
                    $("#modal_registro").modal('hide');
                });
            } else {
                Swal.fire("Mensaje de Advertencia", "La seccion ingresado ya se encuentra en la base de datos", "warning");
            }
        } else {
            return Swal.fire("Mensaje de Error", "No se completó el registro", "error");
        }
    });
}

/********************************************************************
                        MODIFICAR AREA
********************************************************************/


$('#tabla_seccion').on('click', '.editar', function () {
    var data = tbl_seccion.row($(this).parents('tr')).data();//En tamaño escritorio
    if (tbl_seccion.row(this).child.isShown()) {
        var data = tbl_seccion.row(this).data();

    }
    console.log(data);

    $("#modal_editar").modal('show');
    
    document.getElementById('txt_idseccion').value = data.id_seccion;
    document.getElementById('nombre_seccion_editar').value = data.nombre_seccion;
})


function Modificar_Seccion() {

    let nombre_seccion = document.getElementById('nombre_seccion_editar').value; // ID de la agencia
    let id_seccion = document.getElementById('txt_idseccion').value; // Nombre de la agencia

    if (nombre_seccion.length === 0 || id_seccion.length === 0) {
        return Swal.fire("Mensaje de Advertencia", "Tiene campos vacíos", "warning");
    }

    $.ajax({
        url: "../controller/seccion/controlador_modificar_seccion.php",
        type: 'POST',
        data: {
            nombre_seccion: nombre_seccion,
            id_seccion: id_seccion,
        }
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("Mensaje de Confirmación", "Datos Actualizados", "success").then((value) => {
                    tbl_seccion.ajax.reload();
                    $("#modal_editar").modal('hide');
                });
            } else {
                Swal.fire("Mensaje de Advertencia", "La seccion ingresado ya se encuentra en la base de datos", "warning");
            }
        } else {
            return Swal.fire("Mensaje de Error", "No se completó la modificación", "error");
        }
    });
}



$('#tabla_seccion').on('click', '.eliminar', function () {
    var data = tbl_seccion.row($(this).parents('tr')).data();
    if (tbl_seccion.row(this).child.isShown()) {
        data = tbl_seccion.row(this).data();
    }
    
    Swal.fire({
        title: '¿Desea eliminar la seccion?',
        text: "Se borrará el registro de la base de datos.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Si, confirmar'
    }).then((result) => {
        if (result.isConfirmed) {
            Eliminar_Seccion(data.id_seccion);
        }
    });
});

/********************************************************************
            METODO ELIMINAR AREA
********************************************************************/
function Eliminar_Seccion(id_seccion) {
    $.ajax({
        url: '../controller/seccion/controlador_eliminar_seccion.php',
        type: 'POST',
        data: {
            id_seccion: id_seccion
        }
    }).done(function (resp) {
        if (resp > 0) {
            Swal.fire("Mensaje de Confirmación", "Seccion eliminado Satisfactoriamente", "success").then(() => {
                tbl_seccion.ajax.reload(); // Recargar dataTable
            });
        } else {
            Swal.fire("Mensaje de Error", "No se puede eliminar la seccion", "error");
        }
    }).fail(function () {
        Swal.fire("Mensaje de Error", "Error en la solicitud AJAX", "error");
    });
}

