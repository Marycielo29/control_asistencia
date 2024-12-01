<?php 
  session_start();
?>
<script src="../js/console_usuario.js?rev=<?php echo time(); ?>"></script>
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
        <h1 class="m-0">MANTENIMIENTO USUARIOS</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item active">Usuarios</li>
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
            <h3 class="card-title"><b>Listado de Usuarios</b></h3>
            <button class="btn btn-danger btn-sm float-right" onclick="AbrirRegistro()">
              <i class="fas fa-plus"></i> Nuevo Registro
            </button>
          </div>
          <div class="card-body">
            <table id="tabla_usuario" class="display" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre de Usuario</th>
                  <th>Usuario</th>
                  <th>Rol</th>
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
        <h5 class="modal-title" id="exampleModalLabel">REGISTRO DE USUARIOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

     
          <div class="col-6">
            <label for="">Nombre de Usuario</label>
            <input type="text" class="form-control" id="nombre_usuario">
          </div>

          <div class="col-6">
            <label for="">Usuario</label>
            <input type="text" class="form-control" id="usuario">
          </div>

          <div class="col-6">
            <label for="">Password</label>
            <input type="password" class="form-control" id="contrasena_usuario">
          </div>

          <div class="col-6 form-group">
            <label for="" style="font-size:small;">Rol</label>
            <select class="js-example-basic-single" id="usu_rol" style="width:100%">
              <!-- Aquí puedes añadir las opciones dinámicamente -->
            </select>
          </div>

   

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="Registrar_Usuario()">REGISTRAR</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal para editar datos -->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MODIFICAR USUARIOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">

     
          <div class="col-6">
            <label for="">Nombre de Usuario</label>
            <input type="text" class="form-control" id="nombre_usuario_editar">

          </div>

          <div class="col-6">
            <label for="">Usuario</label>
            <input type="text" class="form-control" id="usuario_editar">
          </div>

          <div class="col-6">
            <label for="">Password</label>
            <input type="password" class="form-control" id="contrasena_usuario_editar">
          </div>

          <div class="col-6 form-group">
            <label for="" style="font-size:small;">Rol</label>
            <select class="js-example-basic-single" id="usu_rol_editar" style="width:100%">
              <!-- Aquí puedes añadir las opciones dinámicamente -->
            </select>
            <input type="text" id="txt_idusuario" hidden> <!-- Cambié a hidden para que no se vea -->

          </div>

          <div class="col-6 form-group">
            <label for="" style="font-size:small;">Agencia</label>
            <select class="js-example-basic-single" id="nombre_agencia_editar" style="width:100%">
              <!-- Aquí puedes añadir las opciones dinámicamente -->
            </select>
          </div>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="Modificar_Usuario()">Modificar</button>
      </div>
    </div>
  </div>
</div>

<script>
  $(document).ready(function() {
    // Asegúrate de que la función listar_usuario esté definida
    listar_usuario();

    // Configuración para el Select2 en los elementos con la clase .js-example-basic-single
    $('.js-example-basic-single').select2();

    // Cargar datos para el Select de Agencia
    Cargar_Select_Rol();

    // Evento para cuando se muestra el modal
    $('#modal_registro').on('shown.bs.modal', function() {
      $('#txt_usuario').trigger('focus');
    });
  });
</script>
