<?php
    require '../../model/model_asistencia.php';
    $MU = new Modelo_Asistencia();//Instaciamos
    $consulta = $MU->Listar_Asistencia();
    if($consulta){
        echo json_encode($consulta);
    }else{
        echo '{
            "sEcho": 1,
            "iTotalRecords": "0",
            "iTotalDisplayRecords": "0",
            "aaData": []
        }';
    }
?>