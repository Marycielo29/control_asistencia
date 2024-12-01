<?php
    require_once  'model_conexion.php';

    class Modelo_Bimestre extends conexionBD{
    

        public function Listar_Bimestre(){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_LISTAR_BIMESTRES()";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query->execute();
            $resultado = $query->fetchAll(PDO::FETCH_ASSOC);
            foreach($resultado as $resp){
                $arreglo["data"][]=$resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();
        }
      
        public function Cargar_Select_Agencia(){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_CARGAR_SELECT_AGENCIA()";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query->execute();
            $resultado = $query->fetchAll();
            foreach($resultado as $resp){
                $arreglo[]=$resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();
        }  

        public function Cargar_Select_Agencia_User(){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_CARGAR_SELECT_AGENCIA_USER()";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query->execute();
            $resultado = $query->fetchAll();
            foreach($resultado as $resp){
                $arreglo[]=$resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();
        }  


        
      

        public function Cargar_Select_Area($id_agencia) {
            $c = conexionBD::conexionPDO();
            // Modificar la consulta para que filtre por el ID de la agencia
            $sql = "SELECT id_area, nombre_area FROM areas WHERE id_agencia = :id_agencia";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query->bindParam(':id_agencia', $id_agencia, PDO::PARAM_INT); // Vincular el parámetro
            $query->execute();
            $resultado = $query->fetchAll();
            
            foreach ($resultado as $resp) {
                $arreglo[] = $resp;
            }
            
            return $arreglo;
            conexionBD::cerrar_conexion();
        }
        

        public function Traer_Widget(){
            $c = conexionBD::conexionPDO();
            $sql = "CALL DASHBOARD()";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query->execute();
            $resultado = $query->fetchAll();
            foreach($resultado as $resp){
                $arreglo[]=$resp;
            }
            return $arreglo;
            conexionBD::cerrar_conexion();
        }
        
        
        public function Registrar_Bimestre($nombre_bimestre){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_REGISTRAR_BIMESTRE(?)";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query -> bindParam(1,$nombre_bimestre);
            $query->execute();
            if($row = $query->fetchColumn()){
                    return $row;
            }
            conexionBD::cerrar_conexion();
        }


         public function Modificar_Bimestre($nombre_bimestre, $id_bimestre){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_MODIFICAR_BIMESTRE(?,?)";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query -> bindParam(1,$nombre_bimestre);
            $query -> bindParam(2,$id_bimestre);

            $query->execute();
            if($row = $query->fetchColumn()){
                    return $row;
            }
            conexionBD::cerrar_conexion();
        }

     
        
        public function Eliminar_Bimestre($id_bimestre)//viene del controlador
        {
           $c = conexionBD:: conexionPDO();

           $sql = "CALL SP_ELIMINAR_BIMESTRE(?)";
           $query = $c->prepare($sql);//mandamos el precedure
           $query ->bindParam(1,$id_bimestre);//enviamos los parametros seguun la posicion del procedure
           $resultado = $query ->execute();
           //solo de usa cuando no se retorna un valor en el procedure(actualizar)
           if($resultado){
               return 1;
           }else{
               return 0;
           }
           conexionBD::cerrar_conexion();
        }
        

    }

?>
