<?php
include("../Config/fpdf.php");
/*
$manejador="mysql";
$host="localhost";
$user="root";
$psw="QzAfqx2X8yEGJVUd";
$bd="actual";
*/
//include("../Config/library.php"); 

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
    /*
    $host="localhost";
    $user="root";
    $psw="QzAfqx2X8yEGJVUd";
    $bd="actual";
    */
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
    // Cabecera de página
    function Header()
    {
        $encabezado="LISTA DE ASISTENCIA DEL PERSONAL ADSCRITO A LA EMPRESA MOS PROYECTOS S.A DE C.V.";
        $inicio=$_POST['lunes'];
        $fin=$_POST['sabado'];
        $lunes=$_POST['lunes'];
        $martes=$_POST['martes'];
        $miercoles=$_POST['miercoles'];
        $jueves=$_POST['jueves'];
        $viernes=$_POST['viernes'];
        $sabado=$_POST['sabado'];
        $fecha="SEMANA COMPRENDIDA DEL ".$inicio." AL ".$fin." ";
        // Logo
        $this->Image('../syspic/logo.jpg',10,8,33);
        //$pdf->Image('../syspic/logo.jpg',60,10,80,40);
        // Arial bold 15
        $this->SetFont('Arial','B',12);
        // Movernos a la derecha
        $this->Cell(35,10,'',0);
        // Título
        $this->Cell(235,6,$encabezado,0,0,'C');
        // Salto de línea
        $this->Ln(5);
        $this->Cell(35,10,'',0);
        $this->Cell(235,6,$fecha,0,1,'C');
        
        $this->SetFont('Arial','I',10);
        // Título
        $this->Cell(60,6,"",0,0,'C');
        $this->Cell(10,6,"",0,0,'C');
        $this->Cell(20,6,"",0,0,'C');
        $this->Cell(20,6,"",1,0,'C');
        $this->Cell(20,6,"LUNES",1,0,'C');
        $this->Cell(20,6,"MARTES",1,0,'C');
        $this->Cell(20,6,"MIERCOLES",1,0,'C');
        $this->Cell(20,6,"JUEVES",1,0,'C');
        $this->Cell(20,6,"VIERNES",1,0,'C');
        $this->Cell(20,6,"",0,0,'C');
        $this->Cell(20,6,"",0,0,'C');
        $this->Cell(20,6,"SABADO",1,0,'C');
        $this->Ln(6);
        $this->Cell(60,6,"NOMBRE",1,0,'C');
        $this->Cell(10,6,"ID",1,0,'C');
        //$this->Cell(20,6,"",0,0,'C');
        $this->Cell(40,6,"HORARIO",1,0,'C');
         
        $this->Cell(20,6,$lunes,1,0,'C');
        $this->Cell(20,6,$martes,1,0,'C');
        $this->Cell(20,6,$miercoles,1,0,'C');
        $this->Cell(20,6,$jueves,1,0,'C');
        $this->Cell(20,6,$viernes,1,0,'C');
        //$this->Cell(20,6,"",0,0,'C');
        //$this->Cell(20,6,"",0,0,'C');
        $this->Cell(40,6,"HORARIO",1,0,'C');
        $this->Cell(20,6,$sabado,1,1,'C');
        //
    }

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


//var_dump($_POST['array_selecion']);
$pdf = new PDF('L');
$pdf->AddPage();
//$pdf->Ln(8);
//$pdf->Cell(270,2,"",1,0,'C');
$title = "Firmas Asistencia";
// Título
//$pdf->Cell(235,6,"",0,0,'C');
$title = "Firmas Asistencia";

// Salto de línea
$entrada=$_POST['entrada'];
$salida_comida=$_POST['salida_comida'];
$entrada_comida=$_POST['entrada_comida'];
$salida=$_POST['salida'];

$entrada_s=$_POST['entrada_s'];
$salida_s=$_POST['salida_s'];
//$pdf->Cell(270,2,"",1,1,'C');
foreach ($_POST['array_selecion'] as $valor) {  
	$id_user=$valor;   
    $sql="SELECT * FROM usuario where activo='1' and idu='$id_user'";
    $con1 = Conectarse();
    $resultado=$con1->query($sql);
    while($row = $resultado->fetch_assoc())
    {
        $nombreFull=$row['nombre']." ".$row['apaterno']." ".$row['amaterno'];
    } 
    $pdf->SetFont('Arial','B',7);
    $pdf->Cell(60,40,$nombreFull,1,0,'C');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(10,40,$id_user,1,0,'C'); 
    $pdf->SetFont('Arial','I',5);
    $pdf->Cell(20,10,"ENTRADA",1,0,'C');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20,10,$entrada,1,0,'C');
    $pdf->SetFont('Arial','I',5);

    $pdf->Cell(20,10,"",1,0,'C',FALSE);
    $pdf->Cell(20,10,"",1,0,'C',FALSE);
    $pdf->Cell(20,10,"",1,0,'C',FALSE);
    $pdf->Cell(20,10,"",1,0,'C',FALSE);
    $pdf->Cell(20,10,"",1,0,'C',FALSE);

    $pdf->Cell(20,10,"ENTRADA",1,0,'C');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20,10,$entrada_s,1,0,'C');
    $pdf->SetFont('Arial','I',5);
    $pdf->Cell(20,10,"",1,1,'C');
    //$pdf->Ln(10);
    $pdf->Cell(70,10,"",0,0,'C');
    $pdf->Cell(20,10,"SALIDA COMIDA",1,0,'C');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20,10,$salida_comida,1,0,'C');
    $pdf->SetFont('Arial','I',5);
    $pdf->SetFillColor(190, 190,190);
    $pdf->Cell(20,10,"",1,0,'C',FALSE);
    $pdf->Cell(20,10,"",1,0,'C',FALSE);
    $pdf->Cell(20,10,"",1,0,'C',FALSE);
    $pdf->Cell(20,10,"",1,0,'C',FALSE);
    $pdf->Cell(20,10,"",1,0,'C',FALSE);

    $pdf->Cell(20,10,"",1,0,'C',TRUE);
    $pdf->Cell(20,10,"",1,0,'C',TRUE);
    $pdf->Cell(20,10,"",1,1,'C',TRUE);
    //$pdf->Ln(10);
     
    $pdf->Cell(70,10,"",0,0,'C');
    $pdf->Cell(20,10,"ENTRADA COMIDA",1,0,'C');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20,10,$entrada_comida,1,0,'C');
    $pdf->SetFont('Arial','I',5);
    
    $pdf->Cell(20,10,"",1,0,'C',FALSE);
    $pdf->Cell(20,10,"",1,0,'C',FALSE);
    $pdf->Cell(20,10,"",1,0,'C',FALSE);
    $pdf->Cell(20,10,"",1,0,'C',FALSE);
    $pdf->Cell(20,10,"",1,0,'C',FALSE);
 
    $pdf->Cell(20,10,"",1,0,'C',TRUE);
    $pdf->Cell(20,10,"",1,0,'C',TRUE);
    $pdf->Cell(20,10,"",1,1,'C',TRUE);
    //$pdf->Ln(50);
    
    $pdf->Cell(70,10,"",0,0,'C');
    $pdf->Cell(20,10,"SALIDA",1,0,'C');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20,10,$salida,1,0,'C');
    $pdf->SetFont('Arial','I',5);

    $pdf->Cell(20,10,"",1,0,'C',FALSE);
    $pdf->Cell(20,10,"",1,0,'C',FALSE);
    $pdf->Cell(20,10,"",1,0,'C',FALSE);
    $pdf->Cell(20,10,"",1,0,'C',FALSE);
    $pdf->Cell(20,10,"",1,0,'C',FALSE);

    $pdf->Cell(20,10,"SALIDA",1,0,'C');
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(20,10,$salida_s,1,0,'C');
    $pdf->SetFont('Arial','I',5);
    $pdf->Cell(20,10,"",1,0,'C');
    $pdf->Ln(10);
    //$pdf->Ln(40);
$valor = $valor+1;
}

$pdf->Output();
//echo "<script> document.location=('os_spaqo.php?month=".$mes1."&year=".$aaaa."&option_search=1'); </script>"; 
//echo "FIN";
?>