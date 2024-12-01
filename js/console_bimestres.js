var tbl_bimestre;
function listar_bimestre() {
    tbl_bimestre = $("#tabla_bimestre").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/bimestre/controlador_listar_bimestre.php",
            type: 'POST'
        },
        "columns": [
            { "defaultContent": "" },
            { "data": "nombre_bimestre" },
            { "defaultContent": "<center><span class='editar text-primary px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar'><i class='fa fa-edit'></i></span> <span class='eliminar text-danger px-1' style='cursor:pointer;' data-bs-toggle='tooltip' data-bs-placement='top' title='Eliminar'><i class='fa fa-trash'></i></span></center>" }
        ],
        "language": idioma_espanol,
        select: true
    });

    tbl_bimestre.on('draw.td', function () {
        var PageInfo = $("#tabla_bimestre").DataTable().page.info();
        tbl_bimestre.column(0, { page: 'current' }).nodes().each(function (cell, i) {
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






/********************************************************************
                        REGISTRAR BIMESTRE
********************************************************************/
function Registrar_Bimestre() {
    let nombre_bimestre = document.getElementById('nombre_bimestre').value;

    if (nombre_bimestre.length == 0) {ç

        return Swal.fire("Mensaje de Advertencia", "Tiene campos vacíos", "warning");
    }

    $.ajax({
        url: "../controller/bimestre/controlador_registro_bimestre.php",
        type: 'POST',
        data: {
            nombre_bimestre: nombre_bimestre,
        }
    }).done(function(resp) {
        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("Mensaje de Confirmación", "Nuevo Bimestre Registrado", "success").then((value) => {
                    document.getElementById('nombre_bimestre').value = "";
                    tbl_bimestre.ajax.reload();
                    $("#modal_registro").modal('hide');
                });
            } else {
                Swal.fire("Mensaje de Advertencia", "El Bimestre ingresado ya se encuentra en la base de datos", "warning");
            }
        } else {
            return Swal.fire("Mensaje de Error", "No se completó el registro", "error");
        }
    });
}

/********************************************************************
                        MODIFICAR AREA
********************************************************************/


$('#tabla_bimestre').on('click', '.editar', function () {
    var data = tbl_bimestre.row($(this).parents('tr')).data();//En tamaño escritorio
    if (tbl_bimestre.row(this).child.isShown()) {
        var data = tbl_bimestre.row(this).data();

    }
    console.log(data);

    $("#modal_editar").modal('show');
    
    document.getElementById('txt_idbimestre').value = data.id_bimestre;
    document.getElementById('txt_bimestre_editar').value = data.nombre_bimestre;
})


function Modificar_Bimestre() {
   
    let id_bimestre = document.getElementById('txt_idbimestre').value; 
    let nombre_bimestre = document.getElementById('txt_bimestre_editar').value; 

    if (nombre_bimestre.length === 0 || id_bimestre.length === 0) {
        return Swal.fire("Mensaje de Advertencia", "Tiene campos vacíos", "warning");
    }

    $.ajax({
        url: "../controller/bimestre/controlador_modificar_bimestre.php", 
        type: 'POST',
        data: {
            id_bimestre: id_bimestre, 
            nombre_bimestre: nombre_bimestre
        }
    }).done(function(resp) {
        if (resp > 0) {
            if (resp == 1) {
                Swal.fire("Mensaje de Confirmación", "Datos Actualizados", "success").then((value) => {
                    tbl_bimestre.ajax.reload();
                    $("#modal_editar").modal('hide');
                });
            } else {
                Swal.fire("Mensaje de Advertencia", "El grado ingresado ya se encuentra en la base de datos", "warning");
            }
        } else {
            return Swal.fire("Mensaje de Error", "No se completó la modificación", "error");
        }
    });
}




$('#tabla_bimestre').on('click', '.eliminar', function () {
    var data = tbl_bimestre.row($(this).parents('tr')).data();
    if (tbl_bimestre.row(this).child.isShown()) {
        data = tbl_bimestre.row(this).data();
    }
    
    Swal.fire({
        title: '¿Desea eliminar el Bimestre?',
        text: "Se borrará el registro de la base de datos.",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sí, confirmar'
    }).then((result) => {
        if (result.isConfirmed) {
            Eliminar_Bimestre(data.id_bimestre);
        }
    });
});

/********************************************************************
            METODO ELIMINAR AREA
********************************************************************/
function Eliminar_Bimestre(id_bimestre) {
    $.ajax({
        url: '../controller/bimestre/controlador_eliminar_bimestre.php',
        type: 'POST',
        data: {
            id_bimestre: id_bimestre
        }
    }).done(function (resp) {
        if (resp > 0) {
            Swal.fire("Mensaje de Confirmación", "Area eliminado Satisfactoriamente", "success").then(() => {
                tbl_bimestre.ajax.reload(); // Recargar dataTable
            });
        } else {
            Swal.fire("Mensaje de Error", "No se puede eliminar el área", "error");
        }
    }).fail(function () {
        Swal.fire("Mensaje de Error", "Error en la solicitud AJAX", "error");
    });
}

