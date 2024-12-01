<?php
  session_start();
?>
<script src="../js/console_grado.js?rev=<?php echo time(); ?>"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0">MANTENIMIENTO GRADOS</h1>
      </div><!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a href="#">Inicio</a></li>
          <li class="breadcrumb-item active">Grados</li>
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
            <h3 class="card-title"><b>Listado de Grados</b></h3>
           
            <button class="btn btn-danger btn-sm float-right" onclick="AbrirRegistro()">
              <i class="fas fa-plus"></i> Nuevo Registro
            </button>
            
          </div>
          <div class="card-body">
            <table id="tabla_grado" class="display" style="width:100%">
              <thead>
                <tr>
                  <th>#</th>
                  <th>Nombre</th>
                  <th>Acción</th>
                  
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
        <h5 class="modal-title" id="exampleModalLabel">REGISTRO DE GRADOS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
            <div class="col-12">
                <label for="">Grados</label>
                <input type="text" class="form-control" id="nombre_grado" style="text-transform: uppercase;">
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-success" onclick="Registrar_Grado()">REGISTRAR</button>
      </div>
    </div>
  </div>
</div>    


<!-- Modal para editar datos -->
<div class="modal fade" id="modal_editar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDITAR DATOS DE GRADO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <label for="txt_agencia_editar">Grado</label>
                        <input type="text" class="form-control" id="txt_grado_editar">
                       
                        <input type="text" id="txt_idgrado" hidden>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-success" onclick="Modificar_Grado()">MODIFICAR</button>
            </div>
        </div>
    </div>
</div>


<script>
  $(document).ready(function() {
    // Asegúrate de que la función listar_difunto esté definida
    listar_grado();

    // Evento para cuando se muestra el modal
    $('#modal_registro').on('shown.bs.modal', function() {
      $('#txt_grado').trigger('focus');
    });
  });
</script>

