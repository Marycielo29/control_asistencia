<?php
    require '../../model/model_bimestre.php';
    $MU = new Modelo_Bimestre();//Instaciamos
    $consulta = $MU->Traer_Widget();
    echo json_encode($consulta);

?>