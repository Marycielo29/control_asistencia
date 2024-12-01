<?php
session_start();

if (!isset($_SESSION['S_ID'])) {
    header('Location: views/index.php');
} else {
}

?>
<!DOCTYPE html>

<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Control de Asistencia | ASISTENCIA</title>


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../plantilla/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../plantilla/dist/css/adminlte.min.css">
    <link rel="stylesheet" type="text/css" href="../utilitarios/DataTables/datatables.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="shortcut icon" href="logo/logo_circulo.png" type="image/x-icon">
</head>

</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>

            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->



                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-expanded="false">
                        <i class="fas fa-user"></i>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right">

                        <a href="../controller/usuario/controlador_cerrar_sesion.php" class="dropdown-item">
                            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                        </a>
                    </div>
                </li>


            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
                <img src="logo/logo_circulo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                <span class="brand-text font-weight-light"><strong>CONTROL ASISTENCIA</strong></span>
            </a>
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image">
                        <img src="logo/mani.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info">
                        <a href="#" class="d-block"><strong><?php echo $_SESSION['S_USUARIO'] ?></strong></a>

                    </div>
                </div>
                <!-- Sidebar -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                     

                            <!-- Dashboard -->
                            <li class="nav-item">
                                <a href="#" class="nav-link" onclick="window.location.href='index.php'">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>Dashboard</p>
                                </a>
                            </li>


                            <!-- Agencias -->
                            <li class="nav-item">
                                <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','grados/view_grados.php')">
                                    <i class="nav-icon fas fa-graduation-cap"></i>
                                    <p>Grados</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','secciones/view_secciones.php')">
                                    <i class="nav-icon fas fa-th-list"></i>
                                    <p>Secciones</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','bimestres/view_bimestres.php')">
                                    <i class="nav-icon fas fa-th-list"></i>
                                    <p>Trimestres</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','alumnos/view_alumnos.php')">
                                    <i class="nav-icon fas fa-user-graduate"></i>
                                    <p>Alumnos</p>
                                </a>
                            </li>

                            <!-- Reportes -->
                            <li class="nav-item">
                                <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','asistencias/view_asistencias.php')">
                                    <i class="nav-icon fas fa-check-circle"></i>
                                    <p>Asistencias</p>
                                </a>
                            </li>


                            <li class="nav-item">
                                <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','usuarios/view_usuarios.php')">
                                    <i class="nav-icon fas fa-users"></i>
                                    <p>Usuarios</p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link" onclick="cargar_contenido('contenido_principal','reportes/view_reporte.php')">
                                    <i class="nav-icon fas fa-chart-line"></i>
                                    <p>Reportes</p>
                                </a>
                            </li>


                    </ul>
                </nav>
                <!-- /.sidebar -->
        </aside>
        <!-- <input type="text" id="txtprincipalidid" value="<?php echo $_SESSION['S_ID'] ?> " hidden>
        <input type="text" id="txtprincipalnombre" value="<?php echo $_SESSION['S_USUARIO'] ?> " hidden>
        <input type="text" id="txtprincipal" value="<?php echo $_SESSION['S_USU'] ?> " hidden>
        <input type="text" id="txtprincipal" value="<?php echo $_SESSION['S_ROL'] ?> " hidden>
        <input type="text" id="txtprincipal" value="<?php echo $_SESSION['S_AGENCIA'] ?> " hidden> -->
        <!-- Content Wrapper. Contains page content -->
     <div class="content-wrapper" id="contenido_principal">
            <!-- Content Header (Page header) -->


            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Inicio</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>

            <section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <!-- Grado -->
            <div class="col-lg-3 col-6">
                <div class="small-box" style="background-color: #28a745; color: white; font-weight: bold;"> <!-- Verde oscuro -->
                    <div class="inner">
                        <h3 id="lbl_grado">0</h3>
                        <p>Grado</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <a href="#" class="small-box-footer" style="color: white; font-weight: bold;" onclick="cargar_contenido('contenido_principal','grado/view_grado.php')">Ver más... <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Secciones -->
            <div class="col-lg-3 col-6">
                <div class="small-box" style="background-color: #ffc107; color: white; font-weight: bold;"> <!-- Amarillo -->
                    <div class="inner">
                        <h3 id="lbl_secciones">0</h3>
                        <p>Secciones</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-th-list"></i>
                    </div>
                    <a href="#" class="small-box-footer" style="color: white; font-weight: bold;" onclick="cargar_contenido('contenido_principal','secciones/view_secciones.php')">Ver más... <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Alumnos -->
            <div class="col-lg-3 col-6">
                <div class="small-box" style="background-color: #dc3545; color: white; font-weight: bold;"> <!-- Rojo oscuro -->
                    <div class="inner">
                        <h3 id="lbl_alumnos">0</h3>
                        <p>Alumnos</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-user-graduate"></i>
                    </div>
                    <a href="#" class="small-box-footer" style="color: white; font-weight: bold;" onclick="cargar_contenido('contenido_principal','alumnos/view_alumnos.php')">Ver más... <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Asistencias -->
            <div class="col-lg-3 col-6">
                <div class="small-box" style="background-color: #6c757d; color: white; font-weight: bold;"> <!-- Gris oscuro -->
                    <div class="inner">
                        <h3 id="lbl_asistencias">0</h3>
                        <p>Asistencias</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-check-circle"></i>
                    </div>
                    <a href="#" class="small-box-footer" style="color: white; font-weight: bold;" onclick="cargar_contenido('contenido_principal','asistencias/view_asistencias.php')">Ver más... <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <!-- Usuarios -->
            <div class="col-lg-3 col-6">
                <div class="small-box" style="background-color: #007bff; color: white; font-weight: bold;"> <!-- Azul -->
                    <div class="inner">
                        <h3 id="lbl_usuarios">0</h3>
                        <p>Total Usuarios</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-users"></i>
                    </div>
                    <a href="#" class="small-box-footer" style="color: white; font-weight: bold;" onclick="cargar_contenido('contenido_principal','usuarios/view_usuarios.php')">Ver más... <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>

      

        </div>
    </div>
    <!-- /.container-fluid -->
</section>


        </div>
        <!-- /.content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
            <div class="p-3">
                <h5>Title</h5>
                <p>Sidebar content</p>
            </div>
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                I.E.P "PILOTO"
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2024-2025 ASISTENCIA</strong> Todos los Derechos Reservados.
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- REQUIRED SCRIPTS -->

    <script>
        function cargar_contenido(id, vista) {
            $("#" + id).load(vista);
        }

        var idioma_espanol = {
            select: {
                rows: "%d fila seleccionada"
            },
            "sProcessing": "Procesando...",
            "sLengthMenu": "Mostrar _MENU_ registros",
            "sZeroRecords": "No se encontraron resultados",
            "sEmptyTable": "Ning&uacute;n dato disponible en esta tabla",
            "sInfo": "Registros del (_START_ al _END_) total de _TOTAL_ registros",
            "sInfoEmpty": "Registros del (0 al 0) total de 0 registros",
            "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix": "",
            "sSearch": "Buscar:",
            "sUrl": "",
            "sInfoThousands": ",",
            "sLoadingRecords": "<b>No se encontraron datos</b>",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "oAria": {
                "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
            }
        }

        function soloNumeros(e) {
            tecla = (document.all) ? e.keyCode : e.which;
            if (tecla == 8) {
                return true;
            }
            // Patron de entrada, en este caso solo acepta numeros
            patron = /[0-9]/;
            tecla_final = String.fromCharCode(tecla);
            return patron.test(tecla_final);
        }

        function soloLetras(e) {
            key = e.keyCode || e.which;
            tecla = String.fromCharCode(key).toLowerCase();
            letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
            especiales = "8-37-39-46";
            tecla_especial = false
            for (var i in especiales) {
                if (key == especiales[i]) {
                    tecla_especial = true;
                    break;
                }
            }
            if (letras.indexOf(tecla) == -1 && !tecla_especial) {
                return false;
            }
        }

        function filterFloat(evt, input) {
            var key = window.Event ? evt.which : evt.keyCode;
            var chark = String.fromCharCode(key);
            var tempValue = input.value + chark;
            if (key >= 48 && key <= 57) {
                if (filter(tempValue) === false) {
                    return false;
                } else {
                    return true;
                }
            } else {
                if (key == 8 || key == 13 || key == 0) {
                    return true;
                } else if (key == 46) {
                    if (filter(tempValue) === false) {
                        return false;
                    } else {
                        return true;
                    }
                } else {
                    return false;
                }
            }
        }

        function filter(__val__) {
            var preg = /^([0-9]+\.?[0-9]{0,2})$/;
            if (preg.test(__val__) === true) {
                return true;
            } else {
                return false;
            }
        }
    </script>




    <!-- jQuery -->
    <script src="../plantilla/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../plantilla/dist/js/adminlte.min.js"></script>
    <script type="text/javascript" src="../utilitarios/DataTables/datatables.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>



        Traer_Widget();

        function Traer_Widget() {
            $.ajax({
                "url": "../controller/bimestre/traer_widget.php",
                type: 'POST'
            }).done(function(resp) {
                let data = JSON.parse(resp);
                if (data.length > 0) {
                    document.getElementById('lbl_grado').innerHTML = data[0][0];
                    document.getElementById('lbl_secciones').innerHTML = data[0][1];
                    document.getElementById('lbl_alumnos').innerHTML = data[0][2];
                    document.getElementById('lbl_asistencias').innerHTML = data[0][3];
                    document.getElementById('lbl_usuarios').innerHTML = data[0][4];

                }
            })
        }
    </script>

</body>

</html>