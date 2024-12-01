<?php
require '../../model/model_seccion.php';
$MU = new Modelo_Seccion(); // Instancia del modelo

// Obtener datos de la solicitud
$nombre_seccion = strtoupper(htmlspecialchars($_POST['nombre_seccion'], ENT_QUOTES, 'UTF-8'));   
$id_seccion = strtoupper(htmlspecialchars($_POST['id_seccion'], ENT_QUOTES, 'UTF-8'));   

try {
    $consulta = $MU->Modificar_Seccion($id_seccion, $nombre_seccion);
    echo $consulta;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

