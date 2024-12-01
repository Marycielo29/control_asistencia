<script src="../js/console_asistencia.js?rev=<?php echo time(); ?>"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">MANTENIMIENTO ASISTENCIA</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item active">Asistencia</li>
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
            
            <h3 class="card-title"><b>Listado de Asistencias</b></h3>

          </div>

          <div class="card-body">
            <table id="tabla_asistencia" class="display" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Dni</th>
                  <th>Fecha</th>
                  <th>Hora</th>
                  <th>Nombre</th>
                  <th>Grado</th>
                  <th>Seccion</th>
                  <th>Bimestre</th>
                  <th>Asistencia</th>
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



<script>
  $(document).ready(function() {
    // Asegúrate de que la función listar_difunto esté definida
    listar_asistencia();

    // Evento para cuando se muestra el modal
    $('#modal_registro').on('shown.bs.modal', function() {
      $('#txt_seccion').trigger('focus');
    });
  });

  // $(document).ready(function() {
  //   $('.js-example-basic-single').select2();
  //   Cargar_Select_Agencia();
  // });
</script>