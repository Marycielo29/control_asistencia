<?php
      require '../../model/model_asistencia.php';
      $MU = new Modelo_Asistencia();//Instaciamos
    //DATOS DEL REMIENTE
    $txt_dni = strtoupper(htmlspecialchars($_POST['txt_dni'],ENT_QUOTES,'UTF-8'));
    

    $consulta = $MU->Registrar_Asistencia($txt_dni);

   
        echo $consulta;
    
    

?>