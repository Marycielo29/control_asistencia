<?php 

	require '../../model/model_alumno.php';
	$MU = new Modelo_Alumno();//instaciamops
	$id_alumno= htmlspecialchars($_POST['id_alumno'],ENT_QUOTES,'UTF-8');	
	$consulta = $MU->Eliminar_Alumno($id_alumno);//llamamos al metodo del modelo
	echo $consulta;

 ?>


