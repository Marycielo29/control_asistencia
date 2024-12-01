<?php 

	require '../../model/model_agencia.php';
	$MU = new Modelo_Agencia();//instaciamops
	$id= htmlspecialchars($_POST['id'],ENT_QUOTES,'UTF-8');	
	$consulta = $MU->Eliminar_Agencia($id);//llamamos al metodo del modelo
	echo $consulta;

 ?>


