<script src="../js/console_reporte.js?rev=<?php echo time(); ?>"></script>
<style>
  .card-body {
    overflow-x: auto;
    /* Permite desplazamiento horizontal */
  }

  table.dataTable {
    width: 100% !important;
    /* Asegúrate de que la tabla use el ancho completo */
  }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">REPORTES</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item active">Reportes</li>
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
            <div class="row"> 
              <div class="col-2">
                <label for="">Ingrese el Dni</label>
                <input class="form-control" type="text" id="dni">
              </div>
              <div class="col-4">
                <label for="">Seleccione Fecha Inicio</label>
              <input class="form-control" type="date" id="fecha_inicio">
              </div>
              <div class="col-4">
                <label for="id_area_reporte">Seleccione Fecha Fin</label>
              <input class="form-control" type="date" id="fecha_fin">
              </div>
              <div class="col-2">
                <label for="">&nbsp;</label><br>
                <button class="btn btn-info btn-sm" onclick="Listar_Reporte();">
                  <i class="fas fa-search"></i> Buscar
                </button>
              </div>
            </div> <!-- Fin de la fila -->
          </div>
          <div class="card-body">
              <table id="tabla_reportes" class="display" style="width:100%">
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
                <tbody>
                  <!-- Cuerpo de la tabla se llenará dinámicamente -->
                </tbody>
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
    listar_report();

    // Evento para cuando se muestra el modal
    $('.js-example-basic-single').select2();
    Cargar_Select_Agencia();
    Cargar_Select_Area();

    
  });
</script>

