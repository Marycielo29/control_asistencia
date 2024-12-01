var tbl_alumno;

function listar_alumno() {
    tbl_alumno = $("#tabla_alumno").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/alumno/controlador_listar_alumno.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "dni" },
            { "data": "nombre_alumno" },
            { "data": "nombre_grado" },
            { "data": "nombre_seccion" },
            { "data": "nombre_bimestre" },
           
            { "defaultContent": "<center><span class='editar text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar'><i class='fa fa-edit'></i></span> <span class='eliminar text-danger px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar'><i class='fa fa-trash'></i></span></center>" }
        ],
        "language": idioma_espanol,
        select: true
    });

    tbl_alumno.on('draw.td', function () {
        var PageInfo = $("#tabla_alumno").DataTable().page.info();
        tbl_alumno.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });

    // Evento para abrir el archivo en una nueva ventana al hacer click en el botón
    $('#tabla_alumno tbody').on('click', '.ver', function () {
        const archivo = $(this).data('archivo');
        if (archivo) {
            window.open('../' + archivo, '_blank');
        }
    });
}


function AbrirRegistro() {
    $("#modal_registro").modal({ backdrop: 'static', keyboard: false })
    $("#modal_registro").modal('show');
}



/********************************************************************
                        CARGAR SELECT AGENCIA
********************************************************************/
function Cargar_Select_Grado() {
    $.ajax({
        "url": "../controller/grado/controlador_cargar_select_grado.php",
        type: 'POST'
    }).done(function (resp) {
        let data = JSON.parse(resp);
        let cadena = "<option value=''>SELECCIONAR GRADO</option>";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }
        } else {
            cadena += "<option value=''>No hay agencias disponibles</option>";
        }
        document.getElementById('nombre_grado').innerHTML = cadena;
        document.getElementById('nombre_grado_editar').innerHTML = cadena;
  
    });
}

function Cargar_Select_Seccion() {
    $.ajax({
        "url": "../controller/grado/controlador_cargar_select_seccion.php",
        type: 'POST'
    }).done(function (resp) {
        let data = JSON.parse(resp);
        let cadena = "<option value=''>SELECCIONAR SECCION</option>";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }
        } else {
            cadena += "<option value=''>No hay agencias disponibles</option>";
        }
        document.getElementById('nombre_seccion').innerHTML = cadena;
        document.getElementById('nombre_seccion_editar').innerHTML = cadena;

  
    });
}


function Cargar_Select_Bimestre() {
    $.ajax({
        "url": "../controller/grado/controlador_cargar_select_bimestre.php",
        type: 'POST'
    }).done(function (resp) {
        console.log(resp);
        let data = JSON.parse(resp);
        let cadena = "<option value=''>SELECCIONAR BIMESTRE</option>";
        if (data.length > 0) {
            for (let i = 0; i < data.length; i++) {
                cadena += "<option value='" + data[i][0] + "'>" + data[i][1] + "</option>";
            }
        } else {
            cadena += "<option value=''>No hay agencias disponibles</option>";
        }
        document.getElementById('nombre_bimestre').innerHTML = cadena;
        document.getElementById('nombre_bimestre_editar').innerHTML = cadena;
  
    });
}





/********************************************************************
                        REGISTRAR ALUMNO
********************************************************************/

function Registrar_Alumno() {

    let dni = document.getElementById('dni').value;
    let nombre_alumno = document.getElementById('nombre_alumno').value;
    let nombre_grado = document.getElementById('nombre_grado').value;
    let nombre_seccion = document.getElementById('nombre_seccion').value;
    let nombre_bimestre = document.getElementById('nombre_bimestre').value;
 
    if (dni.length == 0 || nombre_alumno.length == 0 || nombre_grado.length == 0 || nombre_seccion.length == 0 || nombre_bimestre.length == 0) {
        return Swal.fire("Mensaje de Advertencia", "Tiene campos vacíos", "warning");
    }

    $.ajax({
        url: "../controller/alumno/controlador_registrar_alumno.php",
        type: 'POST',
        data: {
            dni: dni,
            nombre_alumno: nombre_alumno,
            nombre_grado: nombre_grado,
            nombre_seccion: nombre_seccion,
            nombre_bimestre: nombre_bimestre
        }
    }).done(function(resp) {
        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("Mensaje de Confirmación", "Nueva Grado Registrado", "success").then((value) => {
                    document.getElementById('dni').value = "";
                    document.getElementById('nombre_alumno').value = "";
                    document.getElementById('nombre_grado').value = "";
                    document.getElementById('nombre_seccion').value = "";
                    document.getElementById('nombre_bimestre').value = "";
                    tbl_alumno.ajax.reload();
                    $("#modal_registro").modal('hide');
                });
            } else {
                Swal.fire("Mensaje de Advertencia", "El grado ingresado ya se encuentra en la base de datos", "warning");
            }
        } else {
            return Swal.fire("Mensaje de Error", "No se completó el registro", "error");
        }
    });
}





/********************************************************************
            JALAMOS LOS DATOS AL MODAL PARA MODIFICAR
********************************************************************/

$('#tabla_alumno').on('click', '.editar', function () {
    var data = tbl_alumno.row($(this).parents('tr')).data();//En tamaño escritorio
    if (tbl_alumno.row(this).child.isShown()) {
        var data = tbl_alumno.row(this).data();

    }
    console.log(data);

    $("#modal_editar").modal('show');
    
    document.getElementById('dni_editar').value = data.dni;
    document.getElementById('nombre_alumno_editar').value = data.nombre_alumno;
    $("#nombre_grado_editar").select2().val(data.id_grado).trigger('change.select2');
    $("#nombre_seccion_editar").select2().val(data.id_seccion).trigger('change.select2');
    $("#nombre_bimestre_editar").select2().val(data.id_bimestre).trigger('change.select2');

})


function Modificar_Alumno() {

    let dni = document.getElementById('dni_editar').value; // ID de la agencia
    let nombre_alumno = document.getElementById('nombre_alumno_editar').value; // Nombre de la agencia
    let nombre_grado = document.getElementById('nombre_grado_editar').value;
    let nombre_seccion = document.getElementById('nombre_seccion_editar').value;
    let nombre_bimestre = document.getElementById('nombre_bimestre_editar').value;

    if (dni.length === 0 || nombre_alumno.length === 0 || nombre_grado.length === 0 || nombre_seccion.length === 0 || nombre_bimestre.length === 0) {
        return Swal.fire("Mensaje de Advertencia", "Tiene campos vacíos", "warning");
    }

    $.ajax({
        url: "../controller/alumno/controlador_modificar_alumno.php",
        type: 'POST',
        data: {
            dni: dni,
            nombre_alumno: nombre_alumno,
            nombre_grado: nombre_grado,
            nombre_seccion: nombre_seccion,
            nombre_bimestre: nombre_bimestre
        }
    }).done(function (resp) {
        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("Mensaje de Confirmación", "Datos Actualizados", "success").then((value) => {
                    tbl_alumno.ajax.reload();
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



/********************************************************************
            LLAMAMOS AL SWEETALERT2 DE ELIMINAR REQUERIMIENTO
********************************************************************/

$('#tabla_alumno').on('click', '.eliminar', function () {
    
    var data = tbl_alumno.row($(this).parents('tr')).data();
    if (tbl_alumno.row(this).child.isShown()) {
        data = tbl_alumno.row(this).data();
    }
    
    Swal.fire({
        title: '¿Desea eliminar el Requerimiento?',
        text: "Se borrará el registro de la base de datos.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, confirmar'
    }).then((result) => {
        if (result.isConfirmed) {
            Eliminar_Alumno(data.id_alumno);
        }
    });
});

/********************************************************************
            METODO ELIMINAR REQUERIMIENTO
********************************************************************/
function Eliminar_Alumno(id_alumno) {
    $.ajax({
        url: '../controller/alumno/controlador_eliminar_alumno.php',
        type: 'POST',
        data: {
            id_alumno: id_alumno
        }
    }).done(function (resp) {
        if (resp > 0) {
            Swal.fire("Mensaje de Confirmación", "Requerimiento eliminada", "success").then(() => {
                tbl_alumno.ajax.reload(); // Recargar dataTable
            });
        } else {
            Swal.fire("Mensaje de Error", "No se puede eliminar el Requerimiento", "error");
        }
    }).fail(function () {
        Swal.fire("Mensaje de Error", "Error en la solicitud AJAX", "error");
    });
}
