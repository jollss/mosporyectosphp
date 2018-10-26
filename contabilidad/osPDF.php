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
$pdf->SetFont('Arial','B',16);
$pdf->Image('../syspic/logo.jpg',60,10,80,40);
$pdf->Cell(180,50,'',0);
$pdf->Ln();
$pdf->Cell(60,10,utf8_decode('Folio Pisa: '.$folio_pisa),0);
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(45,8,utf8_decode('IDMOS: '.$idmos),1);
$pdf->Cell(45,8,utf8_decode('Cope: '.$cope),1);
$pdf->Cell(45,8,utf8_decode('Folio Pisa: '.$folio_pisa),1);
$pdf->Cell(45,8,utf8_decode('Expediente: '.$expediente),1);
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(45,8,utf8_decode('Fecha de Carga: '.$ddcarga."/".$mmcarga."/".$yearcarga),1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(45,8,utf8_decode('Folio Pisaplex: '.$folio_pisaplex),1);
$pdf->Cell(45,8,utf8_decode('Tipo de Tarea: '.$tipo_tarea),1);
$pdf->Cell(45,8,utf8_decode('Telefono: '.$telefono),1);
$pdf->Ln();
$pdf->Cell(90,8,utf8_decode('Cliente: '.$cliente),1);
$pdf->Cell(45,8,utf8_decode('Distrito: '.$distrito),1);
$pdf->Cell(45,8,utf8_decode('Zona: '.$zona),1);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
if($estatus==0){
	$estadodeor="ABIERTA";
}if($estatus==1){
	$estadodeor="OBJETADA";
}if($estatus==2){
	$estadodeor="LIQUIDADA";
}
$pdf->Cell(45,8,utf8_decode('Estatus: '.$estadodeor),1);
$pdf->SetFont('Arial','',10);
$pdf->Cell(135,8,utf8_decode('Obseraciones: '.$observaciones),1);
$pdf->Ln();
$pdf->Cell(60,8,utf8_decode('Fecha de cierre: '.$ddos."/".$mmos."/".$yearos." ".$horaos),1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(60,8,utf8_decode('Principal: '.$principal),1);
$pdf->Cell(60,8,utf8_decode('Secundario: '.$secundario),1);
$pdf->Ln();
$pdf->Cell(40,8,utf8_decode('Claro Video: '.$claro_video),1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(40,8,utf8_decode('Tipo de Orden: '.$tipo_os),1);
$pdf->SetFont('Arial','',9);
$pdf->Cell(50,8,utf8_decode('Alfanumerico: '.$alfanumerico),1);
$pdf->Cell(50,8,utf8_decode('Serie: '.$serie),1);
$pdf->Ln();
$pdf->Ln();
$pdf->SetFont('Arial','B',10);
$pdf->Cell(180,8,utf8_decode('MATERIAL'),0,0,'C');
$pdf->SetFont('Arial','',9);
$pdf->Ln();
$pdf->Cell(30,8,utf8_decode('Modem: '.$modem),1);
$pdf->Cell(30,8,utf8_decode('Rosetas: '.$rosetas),1);
$pdf->Cell(30,8,utf8_decode('Metraje: '.$metraje),1);
$pdf->Cell(90,8,utf8_decode('Tipo de Instalacion: '.$tipo_in),1);
$pdf->Ln();
$pdf->Ln();
$pdf->Cell(180,8,utf8_decode('Supervisor:  '.$nomS." ".$apS." ".$amS),0,0); 
$pdf->Ln();
$pdf->Cell(180,8,utf8_decode('Tecnico:  '.$nomT." ".$apT." ".$amT),0,0); 
$conta=0;
$sql3="SELECT * FROM adjunto_os WHERE os_idos='$_idmos'";
$resultado3=$con3->query($sql3);
while($row3 = $resultado3->fetch_assoc())
{

	$aux=10;
	$auy=160;
	$idadjunto=$row3['idadjunto'];
    $nombreimg=$row3['nombreimg'];
    $os_idos=$row3['os_idos'];    
    if($conta==0){
    	$pdf->Cell(50,50,$pdf->Image('../os/'.$nombreimg,$aux,180,50,40),0);
    }
    if($conta==1){
    	$pdf->Cell(50,8,$pdf->Image('../os/'.$nombreimg,$aux+50,180,50,40),0);
    }
    if($conta==2){
    	$pdf->Cell(50,8,$pdf->Image('../os/'.$nombreimg,110,180,50,40),0);
    }
    if($conta==3){
    	$pdf->Cell(50,8,$pdf->Image('../os/'.$nombreimg,10,220,50,40),0);
    }
    if($conta==4){
    	$pdf->Cell(50,8,$pdf->Image('../os/'.$nombreimg,60,220,50,40),0);
    }if($conta==5){
    	$pdf->Cell(50,8,$pdf->Image('../os/'.$nombreimg,110,220,50,40),0);
    }else{

    }
	$conta=$conta+1;
}
/*------------------------------------------------------------------------------*/
$pdf->Output();
?>