<?php include("../Config/fpdf.php");
$manejador="mysql";
$host="db690630991.db.1and1.com";
$user="dbo690630991";
$psw="QzAfqx2X8yEGJVUd";
$bd="db690630991";
/*
$manejador="mysql";
$host="db690630991.db.1and1.com";
$user="dbo690630991";
$psw="QzAfqx2X8yEGJVUd";
$bd="db690630991";
*/
$cadena="$manejador:host=$host;dbname=$bd";
$cnx = new PDO($cadena,$user,$psw);
function Conectarse()  
{  
/*    
$host="db690630991.db.1and1.com";
$user="dbo690630991";
$psw="QzAfqx2X8yEGJVUd";
$bd="db690630991";
*/
    $manejador="mysql";
$host="db690630991.db.1and1.com";
$user="dbo690630991";
$psw="QzAfqx2X8yEGJVUd";
$bd="db690630991"; 
   $con = new mysqli($host,$user,$psw,$bd);
    if($con -> connect_errno){
        header("Location: login.html");
    }
    else{
        //echo "Conectado...";
    }
   return $con;  
} 
/*------------------------------------------------------------------------------*/

/*------------------------------------------------------------------------------*/
$_idmos=$_POST['idmos'];
$con = Conectarse();
$con1 = Conectarse();
$con2 = Conectarse();
$con3 = Conectarse();
$con4 = Conectarse();
$con5 = Conectarse();
$sql="SELECT * FROM os WHERE idmos='$_idmos'";
$resultado=$con->query($sql);
while($row = $resultado->fetch_assoc())
{
    $idmos=$row['idmos'];
    $cope=$row['cope'];
    $expediente=$row['expediente'];
    $ddcarga=$row['ddcarga'];
    $mmcarga=$row['mmcarga'];
    $yearcarga=$row['yearcarga'];
    $folio_pisaplex=$row['folio_pisaplex'];
    $folio_pisa=$row['folio_pisa'];
    $telefono=$row['telefono'];
    $cliente=$row['cliente'];
    $tipo_tarea=$row['tipo_tarea'];
    $tecnologia=$row['tecnologia'];
    $distrito=$row['distrito'];
    $zona=$row['zona'];
    $dilacion_etapa=$row['dilacion_etapa'];
    $dilacion=$row['dilacion'];
    $usuario_idu=$row['usuario_idu'];
    $pagados=$row['pagados'];
    $asignado=$row['asignado'];
    $estado_os=$row['estado_os'];
}
$sql1="SELECT * FROM dataos WHERE id_orden='$_idmos'";
$resultado1=$con1->query($sql1);
while($row1 = $resultado1->fetch_assoc())
{
    $iddataos=$row1['iddataos'];
    $supervisor_idu=$row1['supervisor_idu'];
    $tecnico_asignado_idu=$row1['tecnico_asignado_idu'];
    $estatus=$row1['estatus'];
    $observaciones=$row1['observaciones'];
    $ddos=$row1['ddos'];
    $mmos=$row1['mmos'];
    $yearos=$row1['yearos'];
    $horaos=$row1['horaos'];
    $id_orden=$row1['id_orden'];
    $ddasig=$row1['ddasig'];
    $mmasig=$row1['mmasig'];
    $yearasig=$row1['yearasig'];
    $principal=$row1['principal'];
    $secundario=$row1['secundario'];
    $claro_video=$row1['claro_video'];
    $tipo_os=$row1['tipo_os'];
    $alfanumerico=$row1['alfanumerico'];
    $serie=$row1['serie'];
}
$sql2="SELECT * FROM material WHERE idos='$_idmos'";
$resultado2=$con2->query($sql2);
while($row2 = $resultado2->fetch_assoc())
{
    $modem=$row2['modem'];
    $rosetas=$row2['rosetas'];
    $metraje=$row2['metraje'];
    $tipo_in=$row2['tipo_instalacion'];
}
$sql3="SELECT * FROM usuario WHERE idu='$usuario_idu'";
$resultado3=$con3->query($sql3);
while($row3 = $resultado3->fetch_assoc())
{
    $nomS=$row3['nombre'];
    $apS=$row3['apaterno'];
    $amS=$row3['amaterno'];
}
$sql4="SELECT * FROM usuario WHERE idu='$asignado'";
$resultado4=$con4->query($sql4);
while($row4 = $resultado4->fetch_assoc())
{
    $nomT=$row4['nombre'];
    $apT=$row4['apaterno'];
    $amT=$row4['amaterno'];
}
$pdf = new FPDF();
$title = $folio_pisa;
$pdf->SetTitle($title);
$pdf->SetAuthor('Mos Proyectos');



$pdf->AddPage();
$pdf->SetFont('Arial','B',15);

/*---------------------------------------------------------------------------------ENCABECADO*/
$pdf->Cell(50,10,$pdf->Image('../syspic/carso.JPG',10,10,50,20),0);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(80,10,'MEMORIA FOTOGRAFICA',0,0,'C',TRUE);
$pdf->SetFont('Arial','B',9);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(50,10,'FR -PE-15     REV. 02',0,'B','C');
$pdf->Ln();
$pdf->Cell(50,10,'',0);
$pdf->SetFont('Arial','',10);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(80,10,'Producto Bajantes FTTH',0,0,'C',TRUE);
$pdf->SetTextColor(0,0,0);
$pdf->Ln();
$pdf->Cell(180,2,'',0,'',TRUE);
$pdf->Ln();
/*---------------------------------------------------------RECTANGULOS DE PANEL SUPERIOR*/
$pdf->Rect(10,10, 180, 38,'D');
$pdf->Rect(10,32, 180, 16,'D');
/*---------------------------------------------------------------------------------DATOS*/
$pdf->SetFont('Arial','',6);
$pdf->SetTextColor(255,255,255);
$pdf->Cell(50,4,'DATOS DE LA OBRA:',0,0,'C',TRUE);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(100,4,utf8_decode('Identificación (OB; DTTO; ID; OT; SISA):'),0,0,'R');
$pdf->Cell(30,4,utf8_decode($telefono." - ".$folio_pisa),1,0,'C');
$pdf->Ln();
$pdf->Cell(20,4,utf8_decode('País/Div:'),0,0,'C');
$pdf->Cell(25,4,utf8_decode('METRO'),1,0,'C');
$pdf->Cell(20,4,utf8_decode('Area/Cd:'),0,0,'C');
$pdf->Cell(20,4,utf8_decode('TOLUCA'),1,0,'C');
$pdf->Cell(20,4,utf8_decode('Nom. Proy.:'),0,0,'C');
$pdf->Cell(35,4,utf8_decode('CONSTRUCCION BAJANTES'),1,0,'C');
$pdf->Cell(20,4,utf8_decode('Producto:'),0,0,'C');
$pdf->Cell(20,4,utf8_decode('FTTH'),1,0,'C');
$pdf->Ln();
$pdf->Cell(50,4,'Nombre Supervisor/Insp.:',0,0,'R');
$pdf->Cell(70,4,utf8_decode($nomS." ".$apS." ".$amS),1,0,'C');
$pdf->Cell(30,4,utf8_decode('Fecha Inicio:'),0,0,'C');
$pdf->Cell(30,4,utf8_decode($ddos." / ".$mmos." / ".$yearos),1,0,'C');
$pdf->Ln();
$pdf->Cell(50,4,'Nombre del Contratista:',0,0,'R');
$pdf->Cell(70,4,utf8_decode('MOS PROYECTOS SA DE CV'),1,0,'C');
$pdf->Cell(30,4,utf8_decode('Fecha Fin:'),0,0,'C');
$pdf->Cell(30,4,utf8_decode($ddos." / ".$mmos." / ".$yearos),1,0,'C');
$pdf->Ln();
/*---------------------------------------------------------------------------------DATOS*/ 
$conta=0;
$sql3="SELECT * FROM adjunto_os WHERE os_idos='$_idmos'";
$resultado3=$con3->query($sql3);
while($row3 = $resultado3->fetch_assoc())
{
    $aux=20;
    $auy=50;
    $idadjunto=$row3['idadjunto'];
    $nombreimg=$row3['nombreimg'];
    $os_idos=$row3['os_idos'];    
    /*if($conta==0){
        $pdf->Cell(50,50,$pdf->Image('../os/'.$nombreimg,$aux,180,50,40),0);
    }*/
    if($conta==1){
        $pdf->Image('../os/'.$nombreimg,$aux,$auy,50,50);
    }if($conta==2){
        $pdf->Image('../os/'.$nombreimg,$aux+60,$auy,50,50);
    }if($conta==3){
        $pdf->Image('../os/'.$nombreimg,$aux+120,$auy,50,50);
    }
    if($conta==4){
        $pdf->Image('../os/'.$nombreimg,$aux,$auy+60,50,50);
    }if($conta==5){
        $pdf->Image('../os/'.$nombreimg,$aux+60,$auy+60,50,50);
    }if($conta==6){
        $pdf->Image('../os/'.$nombreimg,$aux+120,$auy+60,50,50);
    }
    if($conta==7){
        $pdf->Image('../os/'.$nombreimg,$aux,$auy+120,50,50);
    }if($conta==8){
        $pdf->Image('../os/'.$nombreimg,$aux+60,$auy+120,50,50);
    }if($conta==9){
        $pdf->Image('../os/'.$nombreimg,$aux+120,$auy+120,50,50);
    }
    if($conta==10){
        $pdf->Image('../os/'.$nombreimg,$aux,$auy+180,50,50);
    }if($conta==11){
        $pdf->Image('../os/'.$nombreimg,$aux+60,$auy+180,50,50);
    }if($conta==12){
        $pdf->Image('../os/'.$nombreimg,$aux+120,$auy+180,50,50);
    }else{
    }
    
    $conta=$conta+1;
}
/*------------------------------------------------------------------------------*/
$pdf->Output();
?>