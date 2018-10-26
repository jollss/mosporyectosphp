<?php
include("../Config/fpdf.php");
$manejador="mysql";
$host="db690630991.db.1and1.com";
$user="dbo690630991";
$psw="QzAfqx2X8yEGJVUd";
$bd="db690630991";
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
class PDF extends FPDF
{
    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Page '.$this->PageNo().'',0,0,'C');
    }
}
/*======================================================================================*/
$con = Conectarse();
//var_dump($_POST);

$del=$_POST['inicial'];
$final=$_POST['final'];
$pago=$_POST['pago'];

$del2=$_POST['inicial2'];
$final2=$_POST['final2'];
$pago2=$_POST['pago2'];
$pdf = new PDF();
$pdf->AddPage();
foreach ($_POST['array_selecion'] as $valor) {  
	$id_user=$valor;   
	//$id_user=$_POST['idu'];
    $sql="SELECT * FROM usuario inner join tipo inner join infuser
    where idtipo=tipo_idtipo and usuario_iduu=idu and activo='1' and idu='$id_user'";
    $con1 = Conectarse();
    $resultado=$con1->query($sql);
    while($row = $resultado->fetch_assoc())
    {
    	for ($i=0; $i <=1 ; $i++) { 
        
		//$pdf->Cell(190,50,'',1);
		/*-----------*/
			$pdf->SetFillColor(190, 190,190);
			$pdf->Line(10,35, 200, 35);
			$pdf->Image('../syspic/logo.jpg',12,12,30,20);
			/*----------*/
			$pdf->Line(0,140, 500, 140);
			/*----------*/
			$pdf->SetFillColor(190, 190,190);
			$pdf->Line(10,175, 200, 175);
			$pdf->Image('../syspic/logo.jpg',12,150,30,20);
			/*---------*/
			$pdf->Cell(190,35,'',0,0,'C');
			$pdf->Ln();
			$pdf->SetFont('Arial','B',12);
			$pdf->Cell(100,6,'MOS PROYECTOS, S.A. DE C.V.',0,0,'L');
			$pdf->Cell(90,6,'',0,1,'L',true);

			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(100,6,utf8_decode('VALENTÍN GÓMEZ FARÍAS 619 COL. LA MERCED'),0,0,'L');
			$pdf->Cell(90,6,'',0,1,'L',true);

			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(100,6,utf8_decode('C. P. 50080, TOLUCA, MÉXICO'),0,0,'L');
			$pdf->SetTextColor(255,255,255);
			$pdf->SetFont('Arial','B',20);

			$pdf->Cell(90,6,utf8_decode('RECIBO DE NÓMINA'),0,1,'C',true);
			$pdf->SetTextColor(0,0,0);
			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(100,6,'Tel. 7222073316',0,0,'L');
			$pdf->Cell(90,6,'',0,1,'L',true);

			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(100,6,'RFC: MPR151123TP3',0,0,'L');
			$pdf->Cell(90,6,'',0,1,'L',true);

			$pdf->SetFont('Arial','B',10);
			$pdf->Cell(190,2,'',0,1,'L');
			
		/*===========================*/
			$no_trabajador=$row['idu'];
			$puesto=$row['tipo'];
			$nombre=$row['nombre']." ".$row['apaterno']." ".$row['amaterno'];
			//$slogan="SERVICIO DE COMEDOR";
			$vigencia="17-04-2018";
			$no_nomina=$_POST['nonomina'];
			$no_nomina2=$_POST['nonomina2'];
			$curp=$row['curp'];
			$periodo=$del." al ".$final;
			$periodo2=$del2." al ".$final2;
			$rfc=$row['rfc'];
			$dias_trabajados=$_POST['dias_t'];
			$dias_trabajados2=$_POST['dias_t2'];
			$tipo_pago=$row['tipo_pago'];
		/**************/
		/**************/
		/*===========================*/
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(30,6,utf8_decode('No. de trabajador:'),0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(65,6,utf8_decode($no_trabajador),0,0,'L');
			$pdf->SetFont('Arial','B',8);
			//$pdf->Cell(42,6,utf8_decode('Puesto:'),0,0,'L');
			$pdf->SetFont('Arial','',8);
			//$pdf->Cell(53,6,utf8_decode($puesto),0,0,'L');
			$pdf->Ln();
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(30,6,utf8_decode('Nombre:'),0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(65,6,utf8_decode($nombre),0,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(42,6,utf8_decode('No. de Nómina:'),0,0,'L');
			$pdf->SetFont('Arial','',8);
			
			if($i==0){
				$pdf->Cell(53,6,utf8_decode($no_nomina),0,0,'L');
			}if($i==1){
				$pdf->Cell(53,6,utf8_decode($no_nomina2),0,0,'L');
			}
			$pdf->Ln();
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(30,6,utf8_decode('CURP:'),0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(65,6,utf8_decode($curp),0,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(42,6,utf8_decode('Período del:'),0,0,'L');
			$pdf->SetFont('Arial','',8);
			if($i==0){
				$pdf->Cell(53,6,utf8_decode($periodo),0,0,'L');
			}if($i==1){
				$pdf->Cell(53,6,utf8_decode($periodo2),0,0,'L');
			}
			$pdf->Ln();
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(30,6,utf8_decode('RFC:'),0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(65,6,utf8_decode($rfc),0,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(42,6,utf8_decode('Días trabajados:'),0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(53,6,utf8_decode($dias_trabajados2),0,0,'L');
			$pdf->Ln();
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(30,6,utf8_decode(''),0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(65,6,utf8_decode(''),0,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(42,6,utf8_decode('Tipo de Pago:'),0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(53,6,utf8_decode($tipo_pago),0,0,'L');
			$pdf->Ln();
			$pdf->SetTextColor(255,255,255);
			$pdf->SetFont('Arial','B',15);
			$pdf->Cell(95,10,utf8_decode('Total neto: '),0,0,'C',true);
			if($i==0){
				$pdf->Cell(95,10,utf8_decode('$'.$pago),0,1,'C',true);
			}if($i==1){
				$pdf->Cell(95,10,utf8_decode('$'.$pago2),0,1,'C',true);
			}
		/**************/
			$pdf->SetFont('Arial','',8);
			$pdf->SetTextColor(0,0,0); 
			//$pdf->Cell(180,100,'',1,0);

		/**************/
			$pdf->Cell(180,5,utf8_decode(''),0,1,'L');
			$pdf->SetFont('Times','',8);
			$pdf->Cell(70,5,utf8_decode('RECIBÍ DE CONFORMIDAD LA CANTIDAD ESPECIFICADA EN NETO A PAGAR CON LO QUE'),0,0,'L');
			$pdf->Cell(70,5,utf8_decode(' '),0,0,'R');
			//$pdf->Cell(70,5,utf8_decode('NETO A PAGAR: '),0,0,'R');
			$pdf->SetFont('Times','',10);
			$pdf->Cell(50,5,utf8_decode(''),0,1,'C'); 
			//$pdf->Cell(50,5,utf8_decode($neto),1,1,'C');
			$pdf->SetFont('Times','',8);
			$pdf->Cell(70,5,utf8_decode('QUEDAN LIQUIDADAS TODAS LAS PERCEPCIONES HASTA LA FECHA QUE SE INDICA.'),0,0,'L');
			$pdf->Cell(70,5,utf8_decode(''),0,0,'L');
			$pdf->Cell(50,5,utf8_decode(''),0,1,'L');
			$pdf->Cell(70,5,utf8_decode(' '),0,0,'L');
			$pdf->Cell(70,5,utf8_decode('FIRMA'),0,0,'R');
			$pdf->Cell(50,5,utf8_decode('____________________________'),0,1,'L');
			$pdf->Cell(70,5,utf8_decode(''),0,1,'L');
		/*-----------*/
		}
    } 
	$valor = $valor+1;
}
$pdf->Output();
?>