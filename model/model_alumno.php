<?php
    require_once  'model_conexion.php';

    class Modelo_Alumno extends conexionBD{
    

        public function Listar_Alumno(){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_LISTAR_ALUMNO()";
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

     




      
        public function Registrar_Alumno($dni,$nombre_alumno,$nombre_grado,$nombre_seccion,$nombre_bimestre){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_REGISTRAR_ALUMNO(?,?,?,?,?)";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query -> bindParam(1,$dni);
            $query -> bindParam(2,$nombre_alumno);   
            $query -> bindParam(3,$nombre_grado);  
            $query -> bindParam(4,$nombre_seccion);  
            $query -> bindParam(5,$nombre_bimestre);  

            if ($query->execute()) {
                return 1; 
            } else {
                return 0; 
            }
            conexionBD::cerrar_conexion();
        }

        public function Modificar_Alumno($dni, $nombre_alumno,$nombre_grado,$nombre_seccion,$nombre_bimestre){
            $c = conexionBD::conexionPDO();
            $sql = "CALL SP_MODIFICAR_ALUMNO(?,?,?,?,?)";
            $arreglo = array();
            $query  = $c->prepare($sql);
            $query -> bindParam(1,$dni);
            $query -> bindParam(2,$nombre_alumno);
            $query -> bindParam(3,$nombre_grado);
            $query -> bindParam(4,$nombre_seccion);
            $query -> bindParam(5,$nombre_bimestre);
          
            $query->execute();
            if($row = $query->fetchColumn()){
                    return $row;
            }
            conexionBD::cerrar_conexion();
        }

        public function Eliminar_Alumno($id_alumno)//viene del controlador
        {
           $c = conexionBD:: conexionPDO();

           $sql = "CALL SP_ELIMINAR_ALUMNO(?)";
           $query = $c->prepare($sql);//mandamos el precedure
           $query ->bindParam(1,$id_alumno);//enviamos los parametros seguun la posicion del procedure
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
