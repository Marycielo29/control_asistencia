<?php
    require '../../model/model_grado.php';
    $MU = new Modelo_Grado();//Instaciamos
    $nombre_grado = strtoupper(htmlspecialchars($_POST['nombre_grado'],ENT_QUOTES,'UTF-8'));  
    $consulta = $MU->Registrar_Grado($nombre_grado);
    echo $consulta;

?>
