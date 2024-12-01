<?php
    require_once  'model_conexion.php';

    class Modelo_Grado extends conexionBD{
    

        public function Listar_Grado(){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_LISTAR_GRADO()";
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
        public function Registrar_Grado($nombre_grado){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_REGISTRAR_GRADO(?)";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query -> bindParam(1,$nombre_grado);
            $query->execute();
            if($row = $query->fetchColumn()){
                    return $row;
            }
            conexionBD::cerrar_conexion();
        }

        public function Modificar_Grado($id_grado,$nombre_grado){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_MODIFICAR_GRADO(?,?)";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query -> bindParam(1,$id_grado);
            $query -> bindParam(2,$nombre_grado);
          
            $query->execute();
            if($row = $query->fetchColumn()){
                    return $row;
            }
            conexionBD::cerrar_conexion();
        }

        
        public function Eliminar_Grado($id_grado)//viene del controlador
        {
           $c = conexionBD:: conexionPDO();

           $sql = "CALL SP_ELIMINAR_GRADO(?)";
           $query = $c->prepare($sql);//mandamos el precedure
           $query ->bindParam(1,$id_grado);//enviamos los parametros seguun la posicion del procedure
           $resultado = $query ->execute();
           //solo de usa cuando no se retorna un valor en el procedure(actualizar)
           if($resultado){
               return 1;
           }else{
               return 0;
           }
           conexionBD::cerrar_conexion();
        }


        public function Cargar_Select_Grado(){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_CARGAR_SELECT_GRADO()";
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

        public function Cargar_Select_Seccion(){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_CARGAR_SELECT_SECCIONES()";
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

        public function Cargar_Select_Bimestre(){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_CARGAR_SELECT_BIMESTRE()";
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
        
        


    }

    

?>
