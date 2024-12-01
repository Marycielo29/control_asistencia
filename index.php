<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Control de Entrada</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plantilla/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plantilla/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="plantilla/dist/css/adminlte.min.css">
  <link rel="shortcut icon" href="views/logo/logo_circulo.png" type="image/x-icon">

  <style>
    body {
      background-color: #e0f2f1;
    }
    .login-page {
      display: flex;
      align-items: center;
      justify-content: center;
      height: 100vh;
      background-color: #e0f2f1;
    }
    .login-box {
      width: 400px;
    }
    .card {
      border-top: 3px solid #138A6F;
    }
    .card-header img {
      width: 280px; /* Ajusta el tamaño de la imagen */
      margin-bottom: 10px;
    }
    .btn-primary {
      background-color: #138A6F;
      border-color: #138A6F;
    }
    .btn-primary:hover {
      background-color: #0f705d;
      border-color: #0f705d;
    }
    .footer-text {
      text-align: center;
      font-size: 0.85em;
      color: #666;
      margin-top: 10px;
    }
    #hora {
      font-size: 1.2em;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
      color: #138A6F;
    }
    #dni-input {
      margin-top: 10px;
    }

    /* Modal */
    .modal-content {
      padding: 20px;
    }
    #video {
      width: 100%;
      height: 240px;
    }
  </style>
</head>
<body class="login-page">
<div class="login-box">
  <div class="card card-outline">
    <div class="card-header text-center">
      <img src="views/logo/logo_horizontal.png" alt="Logo"> <!-- Cambia la ruta de la imagen -->
      <h1><b>Control de Entrada</b> <br> ASISTENCIA</h1>
    </div>
    <div class="card-body">
      <!-- Hora en tiempo real -->
      <div id="hora"></div>

      <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Ingrese su DNI" id="txt_dni" required>
        <div class="input-group-append">
          <div class="input-group-text">
            <span class="fas fa-id-card"></span>
          </div>
        </div>
      </div>

     

      <!-- Modal para escanear -->
      <div class="modal fade" id="qrModal" tabindex="-1" aria-labelledby="qrModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="qrModalLabel">Escanear Código</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar" onclick="detenerCamara()">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <!-- Video para escanear QR -->
              <video id="video" autoplay></video>
            </div>
          </div>
        </div>
      </div>

      <button type="button" class="btn btn-outline-success btn-block" id="btn_registrar" onclick="Registrar_Asistencia()">Registrar Hora de Entrada</button>
       <!-- Botón para abrir el modal -->
       <button type="button" class="btn btn-outline-success btn-block" data-toggle="modal" data-target="#qrModal">
        Escanear Código
      </button>
      <a href="login.php">INGRESAR AL SISTEMA</a>

     
    </div>
  </div>
</div>

<!-- jQuery -->
<script src="plantilla/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plantilla/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="plantilla/dist/js/adminlte.min.js"></script>
<script src="js/console_asistencia.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://unpkg.com/@zxing/library@0.18.5"></script>
<script>

document.addEventListener('DOMContentLoaded', function () {
    const txtDni = document.getElementById('txt_dni');
    const btnRegistrar = document.getElementById('btn_registrar');

    // Detecta el evento de cambio en el input
    txtDni.addEventListener('input', function () {
        // Verifica si el valor tiene exactamente 8 caracteres
        if (txtDni.value.length === 8) {
            // Simula el clic en el botón de registro
            btnRegistrar.click();
            
            // Limpia el campo de entrada (opcional)
            txtDni.value = '';  // Esto vacía el input después de registrar
        }
    });
});

  // Función para mostrar la hora en tiempo real
  function actualizarHora() {
    var fecha = new Date();
    var horas = String(fecha.getHours()).padStart(2, '0');
    var minutos = String(fecha.getMinutes()).padStart(2, '0');
    var segundos = String(fecha.getSeconds()).padStart(2, '0');
    var horaActual = horas + ':' + minutos + ':' + segundos;
    document.getElementById('hora').textContent = 'Hora Actual: ' + horaActual;
  }
  
  // Actualizar la hora cada segundo
  setInterval(actualizarHora, 1000);

  // Variables de la cámara y escaneo
  let videoElement = document.getElementById('video');
  let scanner;
  let sonido = new Audio('barcode.mp3'); // Ruta del archivo MP3

  // Función para iniciar la cámara y escanear QR
  function iniciarCamara() {
    scanner = new ZXing.BrowserMultiFormatReader();
    scanner.decodeFromVideoDevice(null, videoElement, (result, err) => {
      if (result) {
        document.getElementById('txt_dni').value = result.getText();
        sonido.play(); // Reproducir sonido
        if (document.getElementById('txt_dni').value.length === 8) {
          Registrar_Asistencia(); // Llamar a la función de registro al detectar 8 dígitos
        }
      }
    });
  }

  // Función para detener la cámara
  function detenerCamara() {
    if (scanner) {
      scanner.reset();
    }
  }

  // Iniciar cámara cuando el modal se abre
  $('#qrModal').on('shown.bs.modal', function () {
    iniciarCamara();
  });

  // Detener cámara cuando el modal se cierra
  $('#qrModal').on('hidden.bs.modal', function () {
    detenerCamara();
  });
</script>


</body>
</html>
