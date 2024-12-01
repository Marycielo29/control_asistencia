<?php
      require '../../model/model_bimestre.php';
      $MU = new Modelo_Bimestre();//Instaciamos
    //DATOS DEL REMIENTE
    $nombre_bimestre = strtoupper(htmlspecialchars($_POST['nombre_bimestre'],ENT_QUOTES,'UTF-8'));
    

    $consulta = $MU->Registrar_Bimestre($nombre_bimestre);

   
        echo $consulta;
    
    

?>