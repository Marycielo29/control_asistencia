<?php 
	//comunica con el servidor para consultar
	require_once 'model_conexion.php';

	/**
	 * 
	 */
	class Modelo_Reporte extends conexionBD
	{
		
		 /**************************************************
 		       LISTAR VENTAS POR MES Y AÑO
 		  **************************************************/
		 public function Listar_Reporte($dni,$fecha_inicio,$fecha_fin)
		 {
			$c = conexionBD:: conexionPDO();
			$sql = "CALL FiltrarAsistencias(?,?,?)";
			$arreglo = array();
			$query = $c->prepare($sql);//mandamos el precedure
			$query ->bindParam(1,$dni);//enviamos los parametros seguun la posicion
			$query ->bindParam(2,$fecha_inicio);
			$query ->bindParam(3,$fecha_fin);
			$query ->execute();
			$resultado = $query->fetchAll(PDO::FETCH_ASSOC);
			foreach ($resultado as $resp) {
			        $arreglo["data"][]=$resp;//almacenando los datos del arreglo
			}
			return $arreglo;
			conexionBD::cerrar_conexion();
		 }

}


 ?>