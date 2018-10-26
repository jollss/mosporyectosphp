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
        $this->SetY(-20);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,1,"___________________________________________________________________",0,1,'C');
        $this->Cell(0,5,utf8_decode('Página '.$this->PageNo().''),0,1,'C');
        $this->Cell(0,5,utf8_decode("Valentin GómezFarías 619 Col. La Merced C.P. 50080, Toluca, México, Tel. 7222073316"),0,0,'C');
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
    	for ($i=0; $i <1 ; $i++) { 
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
			$pdf->Cell(190,6,'SOLICITUD DE VACACIONES',0,0,'C');

			
			$pdf->Cell(190,6,'',0,1,'L');
		/*===========================*/
			$no_trabajador=$row['idu'];
			$nombre=$row['nombre']." ".$row['apaterno']." ".$row['amaterno'];
			//$slogan="SERVICIO DE COMEDOR";
			date_default_timezone_set('America/Mexico_City');
		    $dia=date('j');
		    $mesactual=date('n');
		    $aaaa=date('Y');
			$vigencia=$dia." / ".$mesactual." / ".$aaaa;
			$area=strtoupper($_POST['area']);
			$periodo=$del." al ".$final;
			$dias=0;//$_POST['dias_t'];
			$visto=strtoupper($_POST['visto_bueno']);
			$dira=strtoupper($_POST['dir_area']);
			$DG="ING. GUILLERMO MONTES DE OCA SIERRA";
		/**************/

		/**************/
		/*===========================*/
			
		/**************/
			$pdf->Cell(190,10,"",0,1,'L');
			$pdf->SetFont('Arial','',10);
			$pdf->SetTextColor(0,0,0); 
			//$pdf->Cell(180,100,'',0,0);
			
			$pdf->Cell(150,9,utf8_decode("NOMBRE DEL TRABAJADOR: ".$nombre),1,0,'L');
			$pdf->Cell(40,9,utf8_decode("FECHA: ".$vigencia),1,1,'L');
			$pdf->Cell(190,9,"",0,1,'L');
			$pdf->Cell(190,9,utf8_decode("ÁREA DE ADSCRIPCIÓN: ".$area),1,1,'L');
			$pdf->Cell(190,9,"",0,1,'L');
			$pdf->SetFont('Arial','',8);
			$pdf->Cell(190,9,utf8_decode("NÚMERO DE DÍAS HÁBILES SOLICITADOS CONFORME AL ARTÍCULO 76 DE LA LEY FEDERAL DEL TRABAJO: ".$dias),1,1,'L');
			$pdf->Cell(190,9,"",0,1,'L');
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(63.3,9,utf8_decode("DESDE: DIA ".date("d", strtotime($del))." MES ".date("m", strtotime($del))." AÑO ".date("Y", strtotime($del))),1,0,'L');
			$pdf->Cell(63.3,9,utf8_decode(""),0,0,'L');
			$pdf->Cell(63.3,9,utf8_decode("AL: DIA ".date("d", strtotime($final))." MES ".date("m", strtotime($final))." AÑO ".date("Y", strtotime($final))),1,1,'L');
			$pdf->Cell(190,10,"",0,1,'L');
			$pdf->Cell(63.3,9,utf8_decode("VISTO BUENO"),0,0,'C');
			$pdf->Cell(63.3,9,utf8_decode(""),0,0,'L');
			$pdf->Cell(63.3,9,utf8_decode(""),0,1,'L');
			$pdf->Cell(190,20,"",0,1,'L');
			$pdf->Cell(63.3,9,utf8_decode("____________________________"),0,0,'C');
			$pdf->Cell(63.3,9,utf8_decode(""),0,0,'L');
			$pdf->Cell(63.3,9,utf8_decode("____________________________"),0,1,'C');
			$pdf->Cell(190,1,"",0,1,'L');
			$pdf->SetFont('Arial','',9);
			$pdf->Cell(63.3,9,utf8_decode($visto),1,0,'C');
			$pdf->Cell(63.3,9,utf8_decode(""),0,0,'L');
			$pdf->Cell(63.3,9,utf8_decode("FIRMA DEL SOLICITANTE"),1,1,'C');
			$pdf->Cell(190,10,"",0,1,'L');
			$pdf->Cell(95,9,utf8_decode("APROBACIÓN DEL DIRECTOR DEL ÁREA"),1,0,'C');
			$pdf->Cell(95,9,utf8_decode("APROBACIÓN DEL DIRECTOR GENERAL"),1,1,'C');
			$pdf->Cell(95,20,utf8_decode(""),1,0,'C');
			$pdf->Cell(95,20,utf8_decode(""),1,1,'C');
			$pdf->Cell(95,10,utf8_decode($dira),1,0,'C');
			$pdf->Cell(95,10,utf8_decode($DG),1,1,'C');
			/*
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
			//$pdf->Cell(190,5,utf8_decode('_________________________________________________'),0,1,'C');
			//$pdf->Cell(70,5,utf8_decode('QUE SE INDICA.'),0,1,'L');
		/*-----------*/
		}
    } 
	$valor = $valor+1;
}
$pdf->Output();
?>