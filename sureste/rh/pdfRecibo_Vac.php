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
			$pdf->Cell(190,6,utf8_decode('RECIBO DE PAGO DE VACACIÓNES Y PRIMA VACACIONAL'),0,0,'C');

			
			$pdf->Cell(190,6,'',0,1,'L');
		/*===========================*/
			$no_trabajador=$row['idu'];
			$nombre=$row['nombre']." ".$row['apaterno']." ".$row['amaterno'];
			//$slogan="SERVICIO DE COMEDOR";
			$vigencia="17-04-2018";
			$area=strtoupper($_POST['area']);
			$periodo=$del." al ".$final;
			$dias=0;//$_POST['dias_t'];
			$visto=strtoupper($_POST['visto_bueno']);
			$dira=strtoupper($_POST['dir_area']);
			$DG="ING. GUILLERMO MONTES DE OCA SIERRA";
			date_default_timezone_set('America/Mexico_City');
		    $dia=date('j');
		    $mesactual=date('n');
		    $aaaa=date('Y');
		    $bueno=$_POST['bueno'];
		    $bueno_l=$_POST['bueno_letra'];
		    $anios=$_POST['anios'];
		    $mes=$_POST['mes'];
		    $salario=$_POST['salario'];
		    $salario_letra=$_POST['salario_letra'];
		    $vacaciones=$_POST['vacaciones'];
		    $prima=$_POST['prima'];
		    $total=$_POST['total'];
		    $neto=$_POST['neto']; 
		/*===========================*/
			
		/**************/
			$pdf->Cell(190,10,"",0,1,'L');
			$pdf->SetFont('Arial','B',10);
			$pdf->SetTextColor(0,0,0); 
			//$pdf->Cell(180,100,'',0,0);
			
			$pdf->Cell(150,8,utf8_decode("BUENO POR: $".$bueno),0,1,'L');
			$pdf->SetFont('Arial','',10);
			$pdf->Cell(20,8,"",0,0,'L');
			$pdf->Cell(170,8,utf8_decode("En Toluca, México a ".$dia." del mes de ".$mesactual." del año ".$aaaa),0,1,'L');
			$pdf->Cell(20,8,utf8_decode(" recibí de "),0,0,'L');
			$pdf->Cell(130,8,utf8_decode($visto),1,0,'C');
			$pdf->Cell(40,8," cantidad de $ ".$bueno,0,1,'L');
			$pdf->Cell(75,8,"(".$bueno_l.") ",1,0,'C');
			$pdf->Cell(115,8,"correspondiente al pago de VACACIONES Y PRIMA VACACIONAL del",0,1,'L');
			$pdf->Cell(190,8,"periodo comprendido de ".$del." a ".$final."; de conformidad con el articulo 76, 80 y 81 de la Ley Federal del",0,1,'L');
			$pdf->Cell(190,8,utf8_decode("Trabajo, cantidad que recibo a mi entera satisfacción y firmo al calce para constancia."),0,1,'L');
			$pdf->Cell(190,10,"",0,1,'L');
			$pdf->Cell(20,8,"",0,0,'L');
			$pdf->Cell(170,8,utf8_decode("Así mismo hago constar que mi antiguedad en la empresa es de ".$anios." años y ".$mes." meses"),0,1,'L');
			$pdf->Cell(190,8,utf8_decode(", el salario diario que sirve para la presente cuantificación es $".$salario),0,1,'L');
			$pdf->Cell(190,8," (".$salario_letra.").",1,1,'C');
			$pdf->Cell(190,20,"",0,1,'L');
			$pdf->Cell(63.3,9,utf8_decode(""),0,0,'C');
			$pdf->Cell(63.3,9,utf8_decode("VACACIONES $".$vacaciones),0,0,'C');
			$pdf->Cell(63.3,9,utf8_decode(""),0,1,'L');
			$pdf->Cell(63.3,9,utf8_decode(""),0,0,'C');
			$pdf->Cell(63.3,9,utf8_decode("PRIMA VACACIONAL $".$prima),0,0,'C');
			$pdf->Cell(63.3,9,utf8_decode(""),0,1,'L');
			$pdf->Cell(190,20,"",0,1,'L');
			$pdf->Cell(63.3,9,utf8_decode(""),0,0,'C');
			$pdf->Cell(63.3,9,utf8_decode("TOTAL $".$total),0,0,'C');
			$pdf->Cell(63.3,9,utf8_decode(""),0,1,'L');
			$pdf->Cell(63.3,9,utf8_decode(""),0,0,'C');
			$pdf->Cell(63.3,9,utf8_decode("NETO RECIBIDO $".$neto),0,0,'C');
			$pdf->Cell(63.3,9,utf8_decode(""),0,1,'L');
			$pdf->Cell(190,20,"",0,1,'L');
			$pdf->Cell(63.3,9,utf8_decode(""),0,0,'C');
			$pdf->Cell(63.3,9,utf8_decode("____________________________"),0,0,'C');
			$pdf->Cell(63.3,9,utf8_decode(""),0,1,'L');
			$pdf->Cell(63.3,9,utf8_decode(""),0,0,'C');
			$pdf->Cell(63.3,9,utf8_decode($nombre),0,0,'C');
			$pdf->Cell(63.3,9,utf8_decode(""),0,1,'L');
			$pdf->SetFont('Arial','',7);
			$pdf->Cell(63.3,5,utf8_decode(""),0,0,'C');
			$pdf->Cell(63.3,5,utf8_decode("Recibí de Conformidad"),0,0,'C');
			$pdf->Cell(63.3,5,utf8_decode(""),0,1,'L');
			/*
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
			$pdf->Cell(95,10,utf8_decode("C. ____________________________"),1,0,'C');
			$pdf->Cell(95,10,utf8_decode($DG),1,1,'C');
			*/ 
		}
    } 
	$valor = $valor+1;
}
$pdf->Output();
?>