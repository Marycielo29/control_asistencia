<?php
    require '../../model/model_bimestre.php';
    $MU = new Modelo_Bimestre();//Instaciamos
    $consulta = $MU->Listar_Bimestre();
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
