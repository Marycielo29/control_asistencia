<script src="../js/console_reporte.js?rev=<?php echo time(); ?>"></script>

<style>
  .card-body {
    overflow-x: auto;
  }
  table.dataTable {
    width: 100% !important;
  }
</style>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">Mantenimiento de Reportes</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item active">Reportes</li>
        </ol>
      </div>
    </div>
  </div>
</div>

<!-- Main content -->
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title"><b>Listado de reportes</b></h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-5">
                <label for="">Seleccione una Agencia</label>
                <select class="js-example-basic-single" id="id_agencia_reporte" style="width:100%" onchange="Cargar_Select_Area(this.value)">
                  <!-- Opciones dinámicamente -->
                </select>
              </div>
              <div class="col-5">
                <label for="">Seleccione un Area</label>
                <select class="js-example-basic-single" id="id_area_reporte" style="width:100%">
                  <!-- Opciones dinámicamente -->
                </select>
              </div>
              <div class="col-2">
                <label for="">&nbsp;</label><br>
                <button class="btn btn-info btn-sm" onclick="Listar_Reporte();"><i class="fas fa-search">  Buscar</i></button>
              </div>
            </div>

            <div class="card-body">
              <table id="tabla_reportes" class="display" style="width:100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Agencia</th>
                    <th>Área</th>
                    <th>Reporte</th>
                    <th>Modelo</th>
                    <th>Cantidad</th>
                    <th>Estado</th>
                    <th>F. Solicitud</th>
                    <th>F. Entrega</th>
                    <th>F. Finalización</th>
                    <th>Tiempo Uso</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Cuerpo de la tabla se llenará dinámicamente -->
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    tabla_reportes();

    // Inicializar select2 y cargar selects
    $('.js-example-basic-single').select2();
    Cargar_Select_Agencia();
    Cargar_Select_Area();
  });
</script>
