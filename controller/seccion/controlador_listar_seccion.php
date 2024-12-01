<?php
    require '../../model/model_seccion.php';
    $MU = new Modelo_Seccion();//Instaciamos
    $consulta = $MU->Listar_Seccion();
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
