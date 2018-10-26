<?php
ob_start();
include("../Config/library.php"); 
function check_in_range($start_date, $end_date, $evaluame) {
    $start_ts = strtotime($start_date);
    $end_ts = strtotime($end_date);
    $user_ts = strtotime($evaluame);
    return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
}
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$totalUser=new Usuario();
$totalUser->obtenerIdu($con);
$id=$totalUser->regresaIdu();

$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$idYo=$Yo->regresaIdu();
$nsup=$Yo->regresaNombre();
$apsu=$Yo->regresaApaterno();
$amsu=$Yo->regresaAmaterno();
$tipo=$_GET['option_search'];
$mi=$_GET['mes'];
$yi=$_GET['anio'];
var_dump($_GET);
//echo "DATOS DE ENTRADA=============================<BR>";
//echo "Tipo:".$tipo." DI".$di." MI".$mi." YI".$yi."  -df".$df." mf".$mf." yf".$yf."<br>";
if($tipo==1){
    $like="/".$mi."/".$yi;
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $hoy = $dia." ".$mes." ".$aaaa;
    $nombre_archivo="../filtro/Pagado MONTH ".$mi." YEAR ".$yi.".csv";
    if(file_exists($nombre_archivo)){
        //unlink($nombre_archivo);
        unlink($nombre_archivo);
        $archivo = fopen($nombre_archivo, "a");
        $mensaje = "ID MOS,COPE,EXPEDIENTE,FECHA DE PAGO,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE OS,DISTRITO,ZONA,SUPERVISOR";
        fwrite($archivo,$mensaje. "\n");
    }else{
        $archivo = fopen($nombre_archivo, "a");
        $mensaje = "ID MOS,COPE,EXPEDIENTE,FECHADE PAGO,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE OS,DISTRITO,ZONA,SUPERVISOR";
        fwrite($archivo,$mensaje. "\n");
    }
    /*$sql2="SELECT * FROM validar_os INNER JOIN os INNER JOIN dataos
    WHERE id_folio_pisa=folio_pisa AND idmos=id_orden AND id_folio_pisa<>0";*/
    $sql2n="SELECT * FROM validar_os WHERE
    id_folio_pisa<>0 AND mmos='$mi' and yearos='$yi'";//fecha_cobranza LIKE '%".$like."%'";
    $resultado2n=$con->query($sql2n);
    while($rown = $resultado2n->fetch_assoc())
    {
        $foliopago=$rown['id_folio_pisa'];
        $date=$rown['fecha_cobranza'];
        $sql2="SELECT * FROM os INNER JOIN dataos 
        WHERE idmos=id_orden 
        AND folio_pisa='$foliopago'";
        $resultado2=$con->query($sql2);
        while($row = $resultado2->fetch_assoc())
        {
            $cope=$row['cope'];
            $expediente=$row['expediente'];
            $zona=$row['zona'];
            $usuarioidu=$rowos['usuario_idu'];
            $usuarioiduT=$rowos['asignado'];
            $folio_pisaplex=$row['folio_pisaplex'];
            $folio_pis=$row['folio_pisa'];
            $tel=$row['telefono'];
            $cliente=$row['cliente'];
            $distrito=$row['distrito'];
            $dos=$row['ddos'];
            $mos=$row['mmos'];
            $yos=$row['yearos'];
            $hos=$row['horaos'];
            $tipo_tarea=$row['tipo_os'];    
            
            $sqls="SELECT * FROM usuario WHERE idu='$usuarioidu'";
            $resultados=$con->query($sqls);
            while($rows = $resultados->fetch_assoc())
            {
                //$Super=new Usuario();
                //$Super->obtenerUsuarioBD($usuarioidu,$con);
                $nmt=$rows['nombre'];
                $apmt=$rows['apaterno'];
                $ammt=$rows['amaterno'];
            }
            $nomsuper=$nmt." ".$apmt." ".$ammt;
            $sqlt="SELECT * FROM usuario WHERE idu='$usuarioiduT'";
            $resultadot=$con->query($sqlt);
            while($rowt = $resultadot->fetch_assoc())
            {
                //$Super=new Usuario();
                //$Super->obtenerUsuarioBD($usuarioidu,$con);
                $nmtt=$rowt['nombre'];
                $apmtt=$rowt['apaterno'];
                $ammtt=$rowt['amaterno'];
            }
            $nomtec=$nmtt." ".$apmtt." ".$ammtt;
            //if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
            $idmos=$row['idmos'];
        }
        $mensaje = $idmos.",".$cope.",".$expediente.",".$date.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$nomtec.",".$nomsuper;
        $archivo = fopen($nombre_archivo, "a");
        fwrite($archivo,$mensaje. "\n");
        fclose($archivo);
    }
    //echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
}
/*****************************************************************************************/
if($tipo==2){
    $like="/".$mi."/".$yi;
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $hoy = $dia." ".$mes." ".$aaaa;
    //$nombre_archivo="../filtro/xPago ".$hoy.".csv";
    $nombre_archivo="../filtro/xPago MONTH".$mi." YEAR".$yi.".csv";
    if(file_exists($nombre_archivo)){
        //unlink($nombre_archivo);
        unlink($nombre_archivo);
        $archivo = fopen($nombre_archivo, "a");
        $mensaje = "No,ID MOS,COPE,EXPEDIENTE,ESTATUS,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE OS,DISTRITO,ZONA,TECNICO,SUPERVISOR";
        fwrite($archivo,$mensaje. "\n");
    }else{
        /*
        $archivo = fopen($nombre_archivo, "a");
        $mensaje = "ID MOS,COPE,EXPEDIENTE,ESTATUS,FOLIO PISAPLEX,FOLIO PISA,TELEFONO,CLIENTE,TIPO DE OS,DISTRITO,ZONA,TECNICO,SUPERVISOR";
        fwrite($archivo,$mensaje. "\n");
        */
    }

    echo $mi."---".$yi."<br>";
    $con1s = Conectarse();
    $date="PENDIENTE DE PAGO";

    $contar=0;
    $con1 = Conectarse();
    $sql="SELECT * FROM os inner join dataos where idmos=id_orden and mmos='$mi' and yearos='$yi' and estatus=2 ORDER BY folio_pisa ASC,mmos DESC, yearos DESC, ddos DESC";
    $resultado=$con1->query($sql);
    while($row = $resultado->fetch_assoc())
    {
        $idmos=$row['idmos'];
        $cope=$row['cope'];
        $folio_pisa=$row['folio_pisa'];
        $folio_pis=$row['folio_pisa'];
        $tipo_os=$row['tipo_os'];
        $ddos=$row['ddos'];
        $mmos=$row['mmos'];
        $expediente=$row['expediente'];
        $folio_pisaplex=$row['folio_pisaplex'];
        $tel=$row['telefono'];
        $cliente=$row['cliente'];
        $tipo_tarea=$row['tipo_tarea'];
        $distrito=$row['distrito'];
        $zona=$row['zona'];
        $yearos=$row['yearos'];
        $horaos=$row['horaos'];
        $supervisor_idu=$row['supervisor_idu'];
        $tecnico_asignado_idu=$row['tecnico_asignado_idu'];
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
        $nomsuper=$noms." ".$apats." ".$amats;
        $con3 = Conectarse();
        $sql3="SELECT * FROM usuario WHERE idu='$tecnico_asignado_idu'";
        $resultado3=$con3->query($sql3);
        while($row3 = $resultado3->fetch_assoc())
        {
            $nomt=$row3['nombre'];
            $apatt=$row3['apaterno'];
            $amatt=$row3['amaterno'];
        }
        $nomtec=$nomt." ".$apatt." ".$amatt;
        if($folio_pisa=='' or $folio_pisa=='0'){
        }else{
            //echo $folio_pisa."- ";
            ?>
            <tr>
                
                <?php
                $con4 = Conectarse();
                $sql4="SELECT * FROM validar_os WHERE id_folio_pisa='$folio_pisa'";
                $resultado4=$con4->query($sql4);
                while($row4 = $resultado4->fetch_assoc())
                {
                    $fecha_sup=$row4['fecha_sup'];
                    $fecha_calidad=$row4['fecha_calidad'];
                    $fecha_coordinador=$row4['fecha_coordinador'];
                    $fecha_cobranza=$row4['fecha_cobranza'];
                    $a_cobro=$row4['a_cobro'];
                }
                if(!isset($fecha_cobranza) or $fecha_cobranza==''){
                $contar=$contar+1; 
                $mensaje = $contar.",".$idmos.",".$cope.",".$expediente.",".$date.",".$folio_pisaplex.",".$folio_pis.",".$tel.",".$cliente.",".$tipo_tarea.",".$distrito.",".$zona.",".$nomtec.",".$nomsuper; 
               
                    $archivo = fopen($nombre_archivo, "a");
                    fwrite($archivo,$mensaje. "\n");
                    fclose($archivo);
                }
                unset($fecha_sup);
                unset($fecha_calidad);
                unset($fecha_coordinador);
                unset($fecha_cobranza);
                ?>
            </tr>   
            <?php
            
        }
    }
}
//header("Location: ../filtro/".$nombre_archivo);
//echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
ob_end_flush();
?>