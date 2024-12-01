<?php
require '../../model/model_bimestre.php';
$MU = new Modelo_Bimestre(); // Instancia del modelo

// Obtener datos de la solicitud
$id_bimestre = strtoupper(htmlspecialchars($_POST['id_bimestre'], ENT_QUOTES, 'UTF-8'));   
$nombre_bimestre = strtoupper(htmlspecialchars($_POST['nombre_bimestre'], ENT_QUOTES, 'UTF-8'));   

try {
    $consulta = $MU->Modificar_Bimestre($id_bimestre, $nombre_bimestre);
    echo $consulta;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}