<?php 

	require '../../model/model_grado.php';
	$MU = new Modelo_Grado();//instaciamops
	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');	
	$consulta = $MU->Eliminar_Grado($id);//llamamos al metodo del modelo
	echo $consulta;

 ?>


