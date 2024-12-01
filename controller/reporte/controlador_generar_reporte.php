<?php
require '../../model/model_reporte.php';
$MU = new Modelo_Reporte(); // Instanciamos

// Verifica si los parámetros están establecidos
$dni = isset($_POST['dni']) ? htmlspecialchars($_POST['dni'], ENT_QUOTES, 'UTF-8') : '';
$fecha_inicio = isset($_POST['fecha_inicio']) ? htmlspecialchars($_POST['fecha_inicio'], ENT_QUOTES, 'UTF-8') : '';
$fecha_fin = isset($_POST['fecha_fin']) ? htmlspecialchars($_POST['fecha_fin'], ENT_QUOTES, 'UTF-8') : '';

// Comprueba si los valores no están vacíos
if (empty($dni) || empty($fecha_inicio) || empty($fecha_fin)) {
    echo json_encode([
        "sEcho" => 1,
        "iTotalRecords" => 0,
        "iTotalDisplayRecords" => 0,
        "aaData" => []
    ]);
    exit; // Termina el script
}

$consulta = $MU->Listar_Reporte($dni, $fecha_inicio, $fecha_fin);
if ($consulta) {
    echo json_encode($consulta);
} else {
    echo json_encode([
        "sEcho" => 1,
        "iTotalRecords" => 0,
        "iTotalDisplayRecords" => 0,
        "aaData" => []
    ]);
}
?>
