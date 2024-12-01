function listar_report() {
    tbl_reports = $("#tabla_reportes").DataTable({
        "ordering": false,
        "bLengthChange": true,
        "searching": { "regex": false },
        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
        "pageLength": 10,
        "destroy": true,
        "async": false,
        "processing": true,
        "ajax": {
            "url": "../controller/reporte/controlador_generar_reporte.php",
            "type": 'POST',
            "data": function(d) {
                // Añade los parámetros que necesitas enviar al controlador
                d.dni = $("#dni").val();
                d.fecha_inicio = $("#fecha_inicio").val();
                d.fecha_fin = $("#fecha_fin").val();
            }
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

    tbl_reports.on('draw.td', function () {
        var PageInfo = $("#tabla_reportes").DataTable().page.info();
        tbl_reports.column(0, { page: 'current' }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
    
}


function Listar_Reporte() {
    var dni = $('#dni').val();
    var fecha_inicio = $('#fecha_inicio').val();
    var fecha_fin = $('#fecha_fin').val();

    if (dni === '' || fecha_inicio === '' || fecha_fin === '') {
        Swal.fire("Mensaje de Advertencia", "Por favor, seleccione una agencia y un área para generar el reporte.", "warning");
        return;
    }

    $.ajax({
        url: '../controller/reporte/controlador_generar_reporte.php',
        type: 'POST',
        data: {
            dni: dni,
            fecha_inicio: fecha_inicio,
            fecha_fin: fecha_fin
        },
        success: function(response) {
            console.log("Response:", response);
            try {
                var data = JSON.parse(response);
                if (data.data && data.data.length > 0) {
                    tbl_reports.clear().rows.add(data.data).draw();
                } else {
                    Swal.fire("Mensaje de Aviso", "No se encontraron datos para el reporte.", "warning");
                }
            } catch (error) {
                console.error('Error al parsear la respuesta JSON:', error);
                Swal.fire("Mensaje de Error", "Error al generar el reporte. Revisa la consola para más detalles.", "error");
            }
        },
        error: function(error) {
            console.error('Error al generar el reporte:', error);
            alert('Error al generar el reporte. Revisa la consola para más detalles.');
        }
    });
}
