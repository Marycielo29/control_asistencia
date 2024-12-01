<?php
    require '../../model/model_grado.php';
    $MU = new Modelo_Grado();//Instaciamos
    $consulta = $MU->Cargar_Select_Seccion();
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
