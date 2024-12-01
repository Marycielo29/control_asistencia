<?php
require '../../model/model_grado.php';
$MU = new Modelo_Grado(); // Instancia del modelo

// Obtener datos de la solicitud
$id_grado = strtoupper(htmlspecialchars($_POST['id_grado'], ENT_QUOTES, 'UTF-8'));   
$nombre_grado = strtoupper(htmlspecialchars($_POST['nombre_grado'], ENT_QUOTES, 'UTF-8'));   

try {
    $consulta = $MU->Modificar_Grado($id_grado, $nombre_grado);
    echo $consulta;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

