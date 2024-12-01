<?php 
require '../../model/model_seccion.php';

$MU = new Modelo_Seccion();
$id_seccion = htmlspecialchars($_POST['id_seccion'], ENT_QUOTES, 'UTF-8'); // Cambié el nombre a $id_area para que sea consistente
$consulta = $MU->Eliminar_Seccion($id_seccion); // Usar $id_area en lugar de $id
echo $consulta;
?>
