<?php 
require '../../model/model_bimestre.php';

$MU = new Modelo_Bimestre();
$id_bimestre = htmlspecialchars($_POST['id_bimestre'], ENT_QUOTES, 'UTF-8'); // Cambié el nombre a $id_area para que sea consistente
$consulta = $MU->Eliminar_Bimestre($id_bimestre); // Usar $id_area en lugar de $id
echo $consulta;
?>
