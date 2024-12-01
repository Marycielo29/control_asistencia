<?php
require '../../model/model_agencia.php';
$MU = new Modelo_Agencia(); // Instancia del modelo

// Obtener datos de la solicitud
$id = strtoupper(htmlspecialchars($_POST['id'], ENT_QUOTES, 'UTF-8'));   
$nombre_agencia = strtoupper(htmlspecialchars($_POST['nombre_agencia'], ENT_QUOTES, 'UTF-8'));   

try {
    $consulta = $MU->Modificar_Agencia($id, $nombre_agencia);
    echo $consulta;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}

