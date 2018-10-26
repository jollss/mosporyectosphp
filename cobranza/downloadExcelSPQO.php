<?php
ob_start();
//include("../Config/library.php"); 
//$nombre_archivo="../filtro/SIN PQO.csv";
function igual($cadena_de_texto){
    //$posicion_coincidencia = strpos($cadena_de_texto, "A9");
    if (strlen(strstr($cadena_de_texto,'A9'))>0) {
      //echo "-/1\-";
      //return 1;
      $valor=1;
    }
    if (strlen(strstr($cadena_de_texto,'D2'))>0) {
      //echo "-/1\-";
      //return 1;
      $valor=1;
    }
    /*if (strpos($cadena_de_texto, 'A9') !== false) {
        echo '1';
    }*/
    else{
        $valor="";
    }
    return $valor;
}
//FIBRA
if($_GET['operacion']==1){
    include("../Config/library.php"); 
    $nombre_archivo="../filtro/SIN PQO.csv";
    $sql="SELECT * from os inner join dataos inner join validar_os inner join material
    where idmos=id_orden and folio_pisa=id_folio_pisa and idos=idmos
    and folio_pisa<>0 and paqo='' and estatus=2 AND tipo_os='FIBRA'";
    $contar=0;
    $con1 = Conectarse();

    $resultado=$con1->query($sql);
    if(file_exists($nombre_archivo)){
        unlink($nombre_archivo);
        $archivo = fopen($nombre_archivo, "a");
        //$mensaje = "NO,IDMOS,COPE,TIPO TAREA,FOLIO PISA,FECHA LIQUIDACION,SUPERVISOR,TECNICO,TIPO DE ORDEN,MODEM,ROSETAS,METRAJE,TIPO DE INSTALACION";
        $mensaje="FOLIO,Bajante aereo de 25m,Bajante aereo de 50m,Bajante aereo de 75,Bajante aereo de 100,Bajante aereo de 125,Bajante aereo de 150,Bajante aereo de 175,Bajante aereo de 200,Bajante aereo de 250,Bajante aereo de 300,ML por bajantes aereos mayor a 300m (metros totales de la instalacion),Bajante subterraneo de 25,Bajante subterraneo de 50,Bajante subterraneo de 75,Bajante subterraneo de 100,Bajante subterraneo de 125,Bajante subterraneo de 150,Bajante subterraneo de 175,Bajante subterraneo de 200,Bajante subterraneo de 250,Bajante subterraneo de 300,ML por bajantes subterraneos mayor a 300m (metros totales de la instalacion),Visitas adicionales por cada infraestructura nueva para bajantes mayores a 300mts,Conexion de bajante de F.O. por fusion,Radial en banqueta,Radial en cepa libre,Reparacion de tropezon en radial,Medicion de potencia,Pbas de navegacion,A9 o cambio de domicilio,Migracion exitosa de servicio de voz en cobre a voz en fibra optica (VSI), Migracion FTTH solo voz,asistencia,MEX";

        fwrite($archivo,$mensaje. "\n");
    }else{
        $archivo = fopen($nombre_archivo, "a");
        //$mensaje = "NO,IDMOS,COPE,TIPO TAREA,FOLIO PISA,FECHA LIQUIDACION,SUPERVISOR,TECNICO,TIPO DE ORDEN,MODEM,ROSETAS,METRAJE,TIPO DE INSTALACION";
        $mensaje="FOLIO,Bajante aereo de 25m,Bajante aereo de 50m,Bajante aereo de 75,Bajante aereo de 100,Bajante aereo de 125,Bajante aereo de 150,Bajante aereo de 175,Bajante aereo de 200,Bajante aereo de 250,Bajante aereo de 300,ML por bajantes aereos mayor a 300m (metros totales de la instalacion),Bajante subterraneo de 25,Bajante subterraneo de 50,Bajante subterraneo de 75,Bajante subterraneo de 100,Bajante subterraneo de 125,Bajante subterraneo de 150,Bajante subterraneo de 175,Bajante subterraneo de 200,Bajante subterraneo de 250,Bajante subterraneo de 300,ML por bajantes subterraneos mayor a 300m (metros totales de la instalacion),Visitas adicionales por cada infraestructura nueva para bajantes mayores a 300mts,Conexion de bajante de F.O. por fusion,Radial en banqueta,Radial en cepa libre,Reparacion de tropezon en radial,Medicion de potencia,Pbas de navegacion,A9 o cambio de domicilio,Migracion exitosa de servicio de voz en cobre a voz en fibra optica (VSI), Migracion FTTH solo voz,asistencia,MEX";
        fwrite($archivo,$mensaje. "\n");
    }
    
    while($row = $resultado->fetch_assoc())
    {
        $idmos=$row['idmos'];
        $folio_pisa=$row['folio_pisa'];
        $tipo_os=$row['tipo_os'];
        $modem=$row['modem'];
        $rosetas=$row['rosetas'];
        $metraje=$row['metraje'];
        $tipo_instalacion=$row['tipo_instalacion'];//aerea o sub
        $tipo_tarea=$row['tipo_tarea']; 

        $contar=$contar+1; 

        if($tipo_instalacion=='AEREA'){
            //$valor=igual($tipo_tarea);
            $tipo_os=1;
            if($metraje>300){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,,,,,,,".$metraje.",,,,,,,,,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";
            }if($metraje=='300'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,,,,,,".$metraje.",,,,,,,,,,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";   
            }
            
            if($metraje=='250'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,,,,,".$metraje.",,,,,,,,,,,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";      
            }
            if($metraje=='200'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,,,,".$metraje.",,,,,,,,,,,,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";         
            }
            if($metraje=='175'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,,,".$metraje.",,,,,,,,,,,,,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";
            }
            if($metraje=='150'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,,".$metraje.",,,,,,,,,,,,,,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";   
            }
            if($metraje=='125'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,".$metraje.",,,,,,,,,,,,,,,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";
            }
            if($metraje=='100'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,".$metraje.",,,,,,,,,,,,,,,,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";
            }
            if($metraje=='75'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,".$metraje.",,,,,,,,,,,,,,,,,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";
            }
            if($metraje=='50'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,".$metraje.",,,,,,,,,,,,,,,,,,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";
            }
            if($metraje==25){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",".$metraje.",,,,,,,,,,,,,,,,,,,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";   
            }
            /*
            else{
                $mensaje="";
            }*/
            //$mensaje = $folio_pisa.",".$metraje;
        }
        if($tipo_instalacion=='SUBTERRANEA'){
            //$valor=igual($tipo_tarea);
            $tipo_os=1;
            if($metraje>300){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,,,,,,,,,,,,,,,,,,".$metraje.",,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";
            }if($metraje=='300'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,,,,,,,,,,,,,,,,,".$metraje.",,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";
            }
            
            if($metraje=='250'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,,,,,,,,,,,,,,,,".$metraje.",,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";
            }
            if($metraje=='200'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,,,,,,,,,,,,,,,".$metraje.",,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";
            }
            if($metraje=='175'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,,,,,,,,,,,,,,".$metraje.",,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";
            }
            if($metraje=='150'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,,,,,,,,,,,,,".$metraje.",,,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";
            }
            if($metraje=='125'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,,,,,,,,,,,,".$metraje.",,,,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";
            }
            if($metraje=='100'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,,,,,,,,,,,".$metraje.",,,,,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";
            }
            if($metraje=='75'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,,,,,,,,,,".$metraje.",,,,,,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";
            }
            if($metraje=='50'){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,,,,,,,,,".$metraje.",,,,,,,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";
            }
            if($metraje==25){
                if ($tipo_os=='VOZ') { $tipo_os='1'; }if ($tipo_os<>'VOZ') { $tipo_os=''; }
                $mensaje=$folio_pisa.",,,,,,,,,,,,".$metraje.",,,,,,,,,,,,,,,,,,,".$tipo_tarea.",".$tipo_os.",,MEX";
            }
        }
        if($mensaje<>''){
            $archivo = fopen($nombre_archivo, "a");
            fwrite($archivo,$mensaje. "\n");
            fclose($archivo);
        }  
    }
} 
//OTROS
if($_GET['operacion']==2){
    include("../Config/library.php"); 
    $nombre_archivo="../filtro/SIN PQO.csv";
    $sql="SELECT * from os inner join dataos inner join validar_os inner join material
    where idmos=id_orden and folio_pisa=id_folio_pisa and idos=idmos
    and folio_pisa<>0 and paqo='' and estatus=2 AND tipo_os<>'FIBRA'";
    $contar=0;
    $con1 = Conectarse();

    $resultado=$con1->query($sql);
    if(file_exists($nombre_archivo)){
        unlink($nombre_archivo);
        $archivo = fopen($nombre_archivo, "a");
        //$mensaje="FOLIO, Construccion de linea de cliente basica de 1 par (bajante),Construccion de linea de cliente basica de 2 pares (bajante),Construccion de linea de cliente basica de 1 par blindado (bajante),Construccion de linea de cliente basica con cable autosoportado (bajante),plusvalia(METRAJE-50)/3,VACIO,VACIO,VACIO,VACIO,VACIO,VACIO,VACIO,VACIO,VACIO,VACIO,VACIO,VACIO,VACIO,PREGUNTAR TECNICO,VACIO,VACIO,MODEMS,ROSETAS-1,1,VACIO,VACIO,MEX";
        $mensaje="FOLIO, Construccion de linea de cliente basica de 1 par (bajante),Construccion de linea de cliente basica de 2 pares (bajante),Construccion de linea de cliente basica de 1 par blindado (bajante),Construccion de linea de cliente basica con cable autosoportado (bajante),Plusvalia por tramo adicional de 50m con bajante de 1 par,Plusvalia por tramo adicional de 50m con bajante 2 pares,Plusvalia por tramo adicional de 50m con bajante de 1 par blindado,Plusvalia por tramo adicional de 50m con cable autosoportado acreebgh (bajante),Reconcentracion sin cambio de cable sin dit,Reconcentracion sin cambio de cable con dit sellado,Reconcentracion con cambio de cable sin dit,Reconcentracion con cambio de cable con dit sellado,Instalacion de poste de 25 pies en cualquier tipo de terreno,Instalacion de poste con mufa de acometida en domicilio de cliente,Bonificacion por distancia y volumen de 1 a 5 os construidas,Bonificacion por distancia y volumen de 6 a 15 os construidas,Bonificacion por distancia y volumen de 16 a 25 os construidas,Bonificacion por distancia y volumen mas de 25 os construidas,Montaje de puente en distribuidor general,Instalacion de cadena de distribucion,Prueba de transmision en dit roseta cd o dg,Cableado interior 1 aparato y modem para infinitum (dit con splitter con proteccion),Cableado interior adicional para el dit con splitter con proteccion (extension),Prueba de transmision de datos vdsl en roseta de datos con equipo homologado,Ubicación del cliente y prueba de transmisión vdsl en terminal aerea,Prueba de transmision vdsl adicional en terminal aerea,MEX";
        fwrite($archivo,$mensaje. "\n");
    }else{
        $archivo = fopen($nombre_archivo, "a");
        //$mensaje="FOLIO, SI TIENE METRAJE,VACIO,VACIO,VACIO,plusvalia(METRAJE-50)/3,VACIO,VACIO,VACIO,VACIO,VACIO,VACIO,VACIO,VACIO,VACIO,VACIO,VACIO,VACIO,VACIO,PREGUNTAR TECNICO,VACIO,VACIO,MODEMS,ROSETAS-1,1,VACIO,VACIO,MEX";
        $mensaje="FOLIO, Construccion de linea de cliente basica de 1 par (bajante),Construccion de linea de cliente basica de 2 pares (bajante),Construccion de linea de cliente basica de 1 par blindado (bajante),Construccion de linea de cliente basica con cable autosoportado (bajante),Plusvalia por tramo adicional de 50m con bajante de 1 par,Plusvalia por tramo adicional de 50m con bajante 2 pares,Plusvalia por tramo adicional de 50m con bajante de 1 par blindado,Plusvalia por tramo adicional de 50m con cable autosoportado acreebgh (bajante),Reconcentracion sin cambio de cable sin dit,Reconcentracion sin cambio de cable con dit sellado,Reconcentracion con cambio de cable sin dit,Reconcentracion con cambio de cable con dit sellado,Instalacion de poste de 25 pies en cualquier tipo de terreno,Instalacion de poste con mufa de acometida en domicilio de cliente,Bonificacion por distancia y volumen de 1 a 5 os construidas,Bonificacion por distancia y volumen de 6 a 15 os construidas,Bonificacion por distancia y volumen de 16 a 25 os construidas,Bonificacion por distancia y volumen mas de 25 os construidas,Montaje de puente en distribuidor general,Instalacion de cadena de distribucion,Prueba de transmision en dit roseta cd o dg,Cableado interior 1 aparato y modem para infinitum (dit con splitter con proteccion),Cableado interior adicional para el dit con splitter con proteccion (extension),Prueba de transmision de datos vdsl en roseta de datos con equipo homologado,Ubicación del cliente y prueba de transmisión vdsl en terminal aerea,Prueba de transmision vdsl adicional en terminal aerea,MEX";
        fwrite($archivo,$mensaje. "\n");
    }
    
    while($row = $resultado->fetch_assoc())
    {
        $idmos=$row['idmos'];
        $folio_pisa=$row['folio_pisa'];
        $tipo_os=$row['tipo_os'];
        $modem=$row['modem'];
        $rosetas=$row['rosetas'];
        $metraje=$row['metraje'];
        $tipo_instalacion=$row['tipo_instalacion'];//aerea o sub
        $tipo_tarea=$row['tipo_tarea']; 
        $metraje2=$metraje;
        $contar=$contar+1; 
        if($metraje>50){$plusvalia=($metraje-50);}if($metraje<50){$plusvalia=0;}
        if($metraje>0){$metraje=1;}if($metraje<=0){$metraje=0;}
        
        if($rosetas<1){$nrosetas=0;}if($rosetas>1){$nrosetas=$rosetas-1;}
        $mensaje=$folio_pisa.",".$metraje.",,,,".$metraje2."-50/3,,,,,,,,,,,,,,PREGUNTAR TECNICO,,,".$modem.",".$nrosetas.",1,,,MEX";
        if($mensaje<>''){
            $archivo = fopen($nombre_archivo, "a");
            fwrite($archivo,$mensaje. "\n");
            fclose($archivo);
        }  
    }
}
//NORMAL
if($_GET['operacion']==3){
    include("../Config/library.php"); 
    $nombre_archivo="../filtro/SIN PQO.csv";
    $sql="SELECT * from os inner join dataos inner join validar_os inner join material
    where idmos=id_orden and folio_pisa=id_folio_pisa and idos=idmos
    and folio_pisa<>0 and paqo='' and estatus=2";
    $contar=0;
    $con1 = Conectarse();
    //                      $sql="SELECT * FROM os inner join dataos where idmos=id_orden and estatus=2 ORDER BY mmos DESC, yearos DESC, ddos DESC";
    //$sql="SELECT * FROM os inner join dataos where idmos=id_orden and estatus=2 and mmos=10 and ddos=19 ORDER BY mmos DESC, yearos DESC, ddos DESC";
    $resultado=$con1->query($sql);
    if(file_exists($nombre_archivo)){
            unlink($nombre_archivo);
            $archivo = fopen($nombre_archivo, "a");
            $mensaje = "NO,IDMOS,COPE,TIPO TAREA,FOLIO PISA,FECHA LIQUIDACION,SUPERVISOR,TECNICO,TIPO DE ORDEN,MODEM,ROSETAS,METRAJE,TIPO DE INSTALACION";
            fwrite($archivo,$mensaje. "\n");
        }else{
            $archivo = fopen($nombre_archivo, "a");
            $mensaje = "NO,IDMOS,COPE,TIPO TAREA,FOLIO PISA,FECHA LIQUIDACION,SUPERVISOR,TECNICO,TIPO DE ORDEN,MODEM,ROSETAS,METRAJE,TIPO DE INSTALACION";
            fwrite($archivo,$mensaje. "\n");
        }
    while($row = $resultado->fetch_assoc())
    {
        $idmos=$row['idmos'];
        $folio_pisa=$row['folio_pisa'];
        $tipo_os=$row['tipo_os'];
        $ddos=$row['ddos'];
        $mmos=$row['mmos'];
        $yearos=$row['yearos'];
        $horaos=$row['horaos'];
        $supervisor_idu=$row['supervisor_idu'];
        $tecnico_asignado_idu=$row['tecnico_asignado_idu'];
        $cope=$row['cope'];
        $modem=$row['modem'];
        $rosetas=$row['rosetas'];
        $metraje=$row['metraje'];
        $tipo_instalacion=$row['tipo_instalacion'];
        $tipo_tarea=$row['tipo_tarea']; 

        /*
        $fecha_sup=$row['fecha_sup'];
        $fecha_calidad=$row['fecha_calidad'];
        $fecha_coordinador=$row['fecha_coordinador'];
        $fecha_cobranza=$row['fecha_cobranza'];
        $a_cobro=$row['a_cobro'];
        */
        ?>

        <?php
        $con2 = Conectarse();
        $sql2="SELECT * FROM usuario WHERE idu='$supervisor_idu'";
        $resultado2=$con2->query($sql2);
        while($row2 = $resultado2->fetch_assoc())
        {
            $noms=$row2['nombre'];
            $apats=$row2['apaterno'];
            $amats=$row2['amaterno'];
        }
        $con3 = Conectarse();
        $sql3="SELECT * FROM usuario WHERE idu='$tecnico_asignado_idu'";
        $resultado3=$con3->query($sql3);
        while($row3 = $resultado3->fetch_assoc())
        {
            $nomt=$row3['nombre'];
            $apatt=$row3['apaterno'];
            $amatt=$row3['amaterno'];
        }
        $contar=$contar+1; 
        
            //$mensajeAux = $idmos.",".$folio_pisaplex.",".$folio_pis.",".$distrito.",".$tel.",".$cliente.",".$date.",".$tipo_os.",".$tipoins.",".$tarea.",".$cope.",".$fecha_cambio.",".$observa.",".$principal.",".$secundario.",".$claro_video.",".$modem.",".$rosetas.",".$metraje.",".$tecnicoa;"<bR>";
            //echo $mensajeAux;
            $mensaje = $contar.",".$idmos.",".$cope.",".$tipo_tarea.",".$folio_pisa.",".$ddos."/".$mmos."/".$yearos." ".$horaos.",".$noms." ".$apats." ".$amats.",".$nomt." ".$apatt." ".$amatt.",".$tipo_os.",".$modem.",".$rosetas.",".$metraje.",".$tipo_instalacion;
            $archivo = fopen($nombre_archivo, "a");
            fwrite($archivo,$mensaje. "\n");
             fclose($archivo);
    }
}
header("Location: ../filtro/".$nombre_archivo);
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
ob_end_flush();
?>