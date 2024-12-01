<?php
    require '../../model/model_alumno.php';
    $MU = new Modelo_Alumno();//Instaciamos
    $consulta = $MU->Listar_Alumno();
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
