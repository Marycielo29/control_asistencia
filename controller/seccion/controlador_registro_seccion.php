<?php
      require '../../model/model_seccion.php';
      $MU = new Modelo_Seccion();//Instaciamos
    //DATOS DEL REMIENTE
    $nombre_seccion = strtoupper(htmlspecialchars($_POST['nombre_seccion'],ENT_QUOTES,'UTF-8'));
    

    $consulta = $MU->Registrar_Seccion($nombre_seccion);

        echo $consulta;
    
    

?>