<?php
    require_once  'model_conexion.php';

    class Modelo_Seccion extends conexionBD{
    

        public function Listar_Seccion(){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_LISTAR_SECCIONES()";
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
        
        
        public function Registrar_Seccion($nombre_seccion){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_REGISTRAR_SECCION(?)";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query -> bindParam(1,$nombre_seccion);         
            $query->execute();
            if($row = $query->fetchColumn()){
                    return $row;
            }
            conexionBD::cerrar_conexion();
        }


         public function Modificar_Seccion($nombre_seccion, $id_seccion){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_MODIFICAR_SECCION(?,?)";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query -> bindParam(1,$nombre_seccion);
            $query -> bindParam(2,$id_seccion);
          

            $query->execute();
            if($row = $query->fetchColumn()){
                    return $row;
            }
            conexionBD::cerrar_conexion();
        }

     
        public function Eliminar_Seccion($id_seccion)//viene del controlador
        {
           $c = conexionBD:: conexionPDO();

           $sql = "CALL SP_ELIMINAR_SECCION(?)";
           $query = $c->prepare($sql);//mandamos el precedure
           $query ->bindParam(1,$id_seccion);//enviamos los parametros seguun la posicion del procedure
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
