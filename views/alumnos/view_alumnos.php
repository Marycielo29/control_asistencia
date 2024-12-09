<script src="../js/console_alumno.js?rev=<?php echo time(); ?>"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">MANTENIMIENTO ALUMNOS</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item active">Alumnos</li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            
            <h3 class="card-title"><b>Listado de Alumnos</b></h3>

            <button id="btnGenerarBarcode" class="btn btn-danger btn-sm float-right ml-3">
             <i class="fas fa-plus"></i> Generar Barcode
            </button>

            <button class="btn btn-danger btn-sm float-right" onclick="AbrirRegistro()">
              <i class="fas fa-plus"></i> Nuevo Registro
            </button>
          </div>

          <div class="card-body">
            <table id="tabla_alumno" class="display" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Dni</th>
                  <th>Nombre Alumno</th>
                  <th>Grado</th>
                  <th>Seccion</th>
                  <th>Bimestre</th>
                  <th>Acciones</th>
                </tr>
              </thead>
            </table>
          </div>
        </div>
      </div>
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content -->

<!-- Modal para nuevo registro -->
<div class="modal fade" id="modal_registro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">REGISTRO DE ALUMNOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

        <div class="col-6">
            <label for="">Dni</label>
            <input type="text" class="form-control" id="dni">
          </div>

          <div class="col-6">
            <label for="">Nombre de Alumno</label>
            <input type="text" class="form-control" id="nombre_alumno">
          </div>


          <div class="col-6 form-group">
            <label for="" style="font-size:small;">Grado</label>
            <select class="js-example-basic-single" id="nombre_grado" style="width:100%">
            </select>
          </div>

          <div class="col-6 form-group">
            <label for="" style="font-size:small;">Seccion</label>
            <select class="js-example-basic-single" id="nombre_seccion" style="width:100%">
            </select>
          </div>

          <div class="col-12 form-group">
            <label for="" style="font-size:small;">Bimestre</label>
            <select class="js-example-basic-single" id="nombre_bimestre" style="width:100%">
            </select>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="Registrar_Alumno()">REGISTRAR</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal para editar datos -->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">REGISTRO DE ALUMNOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

        <div class="col-6">
            <label for="">Dni</label>
            <input type="text" class="form-control" id="dni_editar">
          </div>

          <div class="col-6">
            <label for="">Nombre de Alumno</label>
            <input type="text" class="form-control" id="nombre_alumno_editar">
          </div>


          <div class="col-6 form-group">
            <label for="" style="font-size:small;">Grado</label>
            <select class="js-example-basic-single" id="nombre_grado_editar" style="width:100%">
            </select>
          </div>

          <div class="col-6 form-group">
            <label for="" style="font-size:small;">Seccion</label>
            <select class="js-example-basic-single" id="nombre_seccion_editar" style="width:100%">
            </select>
          </div>

          <div class="col-12 form-group">
            <label for="" style="font-size:small;">Bimestre</label>
            <select class="js-example-basic-single" id="nombre_bimestre_editar" style="width:100%">
            </select>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="Modificar_Alumno()">REGISTRAR</button>
      </div>
    </div>
  </div>
</div>


<script>
  // Función para abrir una nueva ventana
  function abrirNuevaVentana(url) {
    window.open(url, '_blank');
  }

  // Vincular el evento al botón
  document.getElementById('btnGenerarBarcode').addEventListener('click', function () {
    abrirNuevaVentana('https://barcode.tec-it.com/es');
  });
</script>

<script>
  $(document).ready(function() {
    // Asegúrate de que la función listar_difunto esté definida
    listar_alumno();

    // Evento para cuando se muestra el modal
    $('#modal_registro').on('shown.bs.modal', function() {
      $('#txt_estudiante').trigger('focus');
    });
  });

  $(document).ready(function() {
    $('.js-example-basic-single').select2();
    Cargar_Select_Grado();
    Cargar_Select_Seccion();
    Cargar_Select_Bimestre();
  });
</script>