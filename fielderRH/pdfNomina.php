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
$pdf = new PDF();
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
        $pdf->AddPage();
		//$pdf->Cell(190,50,'',1);
		/*-----------*/
			$pdf->SetFillColor(190, 190,190);
			$pdf->Ln();
			$pdf->Line(10,35, 200, 35);
			$pdf->Image('../syspic/logo.jpg',12,12,30,20);

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
			$pdf->Cell(190,6,'',0,1,'L');
		/*===========================*/
			$no_trabajador=$row['idu'];
			$puesto=$row['tipo'];
			$nombre=$row['nombre']." ".$row['apaterno']." ".$row['amaterno'];
			//$slogan="SERVICIO DE COMEDOR";
			$vigencia="17-04-2018";
			$no_nomina=$_POST['nonomina'];;
			$curp=$row['curp'];
			$periodo=$del." al ".$final;
			$rfc=$row['rfc'];
			$dias_trabajados=$_POST['dias_t'];
		/**************/

			$per_1c='SALARIO FIJO';
			$per_2c=$_POST['com1'];
			$per_3c=$_POST['com2'];
			$per_4c=$_POST['com3'];
			$per_5c=$_POST['com4'];
			$per_6c=$_POST['com5'];;
			$per_7c=$_POST['com6'];
			$per_1=$row['salario'];;
			$per_2=$_POST['cant1'];
			$per_3=$_POST['cant2'];
			$per_4=$_POST['cant3'];
			$per_5=$_POST['cant4'];
			$per_6=$_POST['cant5'];
			$per_7=$_POST['cant6'];
			$ded_1c=$_POST['com7'];
			$ded_2c=$_POST['com8'];
			$ded_3c=$_POST['com9'];
			$ded_4c=$_POST['com10'];
			$ded_5c=$_POST['com11'];
			$ded_6c=$_POST['com12'];
			$ded_7c='';
			$ded_1=$_POST['cant7'];
			$ded_2=$_POST['cant8'];
			$ded_3=$_POST['cant9'];
			$ded_4=$_POST['cant10'];
			$ded_5=$_POST['cant11'];
			$ded_6=$_POST['cant12'];
			$ded_7=$_POST['cant13'];

			$total_per=$per_1+$per_2+$per_3+$per_4+$per_5+$per_6+$per_7;
			$total_dedu=$ded_1+$ded_2+$ded_3+$ded_4+$ded_5+$ded_6+$ded_7;
			//$total_per='';
			//$total_dedu='';
			$neto=$total_per-$total_dedu;
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
			$pdf->Cell(53,6,utf8_decode($no_nomina),0,0,'L');
			$pdf->Ln();
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(30,6,utf8_decode('CURP:'),0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(65,6,utf8_decode($curp),0,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(42,6,utf8_decode('Período del:'),0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(53,6,utf8_decode($periodo),0,0,'L');
			$pdf->Ln();
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(30,6,utf8_decode('RFC:'),0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(65,6,utf8_decode($rfc),0,0,'L');
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(42,6,utf8_decode('Días trabajados:'),0,0,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(53,6,utf8_decode($dias_trabajados),0,0,'L');
			$pdf->Ln();
			$pdf->Ln();
			$pdf->SetTextColor(255,255,255);
			$pdf->SetFont('Arial','B',15);
			$pdf->Cell(95,20,utf8_decode('Total neto: '),0,0,'C',true);
			$pdf->Cell(95,20,utf8_decode('$'.$pago),0,1,'C',true);
		/**************/
			$pdf->SetFont('Arial','',8);
			$pdf->SetTextColor(0,0,0); 
			$pdf->Cell(180,100,'',0,0);
			/*
			$pdf->Cell(70,6,utf8_decode($per_1c),1,0,'L');
			$pdf->Cell(25,6,utf8_decode($per_1),1,0,'C');
			$pdf->Cell(70,6,utf8_decode($ded_1c),1,0,'C');
			$pdf->Cell(25,6,utf8_decode($ded_1),1,1,'C');

			$pdf->Cell(70,6,utf8_decode($per_2c),1,0,'L');
			$pdf->Cell(25,6,utf8_decode($per_2),1,0,'C');
			$pdf->Cell(70,6,utf8_decode($ded_2c),1,0,'C');
			$pdf->Cell(25,6,utf8_decode($ded_2),1,1,'C');

			$pdf->Cell(70,6,utf8_decode($per_3c),1,0,'L');
			$pdf->Cell(25,6,utf8_decode($per_3),1,0,'C');
			$pdf->Cell(70,6,utf8_decode($ded_3c),1,0,'C');
			$pdf->Cell(25,6,utf8_decode($ded_3),1,1,'C');

			$pdf->Cell(70,6,utf8_decode($per_4c),1,0,'L');
			$pdf->Cell(25,6,utf8_decode($per_4),1,0,'C');
			$pdf->Cell(70,6,utf8_decode($ded_4c),1,0,'C');
			$pdf->Cell(25,6,utf8_decode($ded_4),1,1,'C');

			$pdf->Cell(70,6,utf8_decode($per_5c),1,0,'L');
			$pdf->Cell(25,6,utf8_decode($per_5),1,0,'C');
			$pdf->Cell(70,6,utf8_decode($ded_5c),1,0,'C');
			$pdf->Cell(25,6,utf8_decode($ded_5),1,1,'C');

			$pdf->Cell(70,6,utf8_decode($per_6c),1,0,'L');
			$pdf->Cell(25,6,utf8_decode($per_6),1,0,'C');
			$pdf->Cell(70,6,utf8_decode($ded_6c),1,0,'C');
			$pdf->Cell(25,6,utf8_decode($ded_6),1,1,'C');

			$pdf->Cell(70,6,utf8_decode($per_7c),1,0,'L');
			$pdf->Cell(25,6,utf8_decode($per_7),1,0,'C');
			$pdf->Cell(70,6,utf8_decode($ded_7c),1,0,'C');
			$pdf->Cell(25,6,utf8_decode($ded_7),1,1,'C');
			
			$pdf->SetFont('Arial','B',8);
			$pdf->Cell(70,6,utf8_decode('Total de Percepciones'),1,0,'R');
			$pdf->Cell(25,6,utf8_decode($total_per),1,0,'C');
			$pdf->Cell(70,6,utf8_decode('Total de Deducciones'),1,0,'R');
			$pdf->Cell(25,6,utf8_decode($total_dedu),1,1,'C');
			*/

		/**************/
			$pdf->Cell(70,20,utf8_decode(''),0,1,'L');
			$pdf->SetFont('Times','',8);
			$pdf->Cell(70,5,utf8_decode('RECIBÍ DE CONFORMIDAD LA '),0,0,'L');
			$pdf->Cell(70,5,utf8_decode(' '),0,0,'R');
			//$pdf->Cell(70,5,utf8_decode('NETO A PAGAR: '),0,0,'R');
			$pdf->SetFont('Times','',10);
			$pdf->Cell(50,5,utf8_decode(''),0,1,'C'); 
			//$pdf->Cell(50,5,utf8_decode($neto),1,1,'C');
			$pdf->SetFont('Times','',8);
			$pdf->Cell(70,5,utf8_decode('CANTIDAD ESPECIFICADA EN '),0,0,'L');
			$pdf->Cell(70,5,utf8_decode(''),0,0,'L');
			$pdf->Cell(50,5,utf8_decode(''),0,1,'L');
			$pdf->Cell(70,5,utf8_decode('NETO A PAGAR CON LO QUE '),0,0,'L');
			$pdf->Cell(70,5,utf8_decode(''),0,0,'L');
			$pdf->Cell(50,5,utf8_decode(''),0,1,'L');
			$pdf->Cell(70,5,utf8_decode('QUEDAN LIQUIDADAS TODAS LAS '),0,0,'L');
			$pdf->Cell(70,5,utf8_decode(''),0,0,'L');
			$pdf->Cell(50,5,utf8_decode(''),0,1,'L');
			$pdf->Cell(70,5,utf8_decode('PERCEPCIONES HASTA LA FECHA '),0,0,'L');
			$pdf->Cell(70,5,utf8_decode('FIRMA'),0,0,'R');
			$pdf->Cell(50,5,utf8_decode('____________________________'),0,1,'L');
			$pdf->Cell(70,5,utf8_decode('QUE SE INDICA.'),0,1,'L');
		/*-----------*/
		}
    } 
	$valor = $valor+1;
}
$pdf->Output();
?>