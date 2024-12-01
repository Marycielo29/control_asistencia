<?php
    require '../../model/model_alumno.php';
    $MU = new Modelo_Alumno();//Instaciamos

    $dni = strtoupper(htmlspecialchars($_POST['dni'],ENT_QUOTES,'UTF-8'));
    $nombre_alumno = strtoupper(htmlspecialchars($_POST['nombre_alumno'],ENT_QUOTES,'UTF-8'));  
    $nombre_grado = strtoupper(htmlspecialchars($_POST['nombre_grado'],ENT_QUOTES,'UTF-8'));
    $nombre_seccion = strtoupper(htmlspecialchars($_POST['nombre_seccion'],ENT_QUOTES,'UTF-8'));
    $nombre_bimestre = strtoupper(htmlspecialchars($_POST['nombre_bimestre'],ENT_QUOTES,'UTF-8'));

    $consulta = $MU->Registrar_Alumno($dni,$nombre_alumno,$nombre_grado,$nombre_seccion,$nombre_bimestre);
    echo $consulta;

?>
