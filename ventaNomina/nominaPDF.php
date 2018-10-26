<?php include("../Config/fpdf.php");
$manejador="mysql";
$host="db690630991.db.1and1.com";
$user="dbo690630991";
$psw="QzAfqx2X8yEGJVUd";
$bd="db690630991";
/*
$manejador="mysql";
$host="localhost";
$user="root";
$psw="QzAfqx2X8yEGJVUd";
$bd="pruebas";
*/
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
$manejador="mysql";
$host="localhost";
$user="root";
$psw="QzAfqx2X8yEGJVUd";
$bd="pruebas";    
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
function tipoUsuario($dato){
    $cargo='';
    if($dato==21){
        $cargo="PROMOTOR";
    }if($dato==24){
        $cargo="SUPERVISOR";
    }if($dato==32){
        $cargo= "LIDER";
    }if($dato==35){
        $cargo= "GERENCIA";
    }
    return $cargo;
}
function cantidadPago($dato,$monto,$tipov){
    if($dato==21){
        //$cargo="PROMOTOR";
        if($tipov==1){
            //xsoli
            $monto=$monto+132;
        }if($tipov==2){
            //xpos
            $monto=$monto+48;
        }if($tipov==3){
            //xflotante
            $monto=$monto+200;
        }
    }if($dato==24){
        //$cargo="SUPERVISOR";
        if($tipov==1){
            //xsoli
            $monto=$monto+142;
        }if($tipov==2){
            //xpos
            $monto=$monto+85;
        }if($tipov==3){
            //xflotante
            $monto=$monto+250;
        }
    }if($dato==32){
        //$cargo= "LIDER";
        if($tipov==1){
            //xsoli
            $monto=$monto+212;
        }if($tipov==2){
            //xpos
            $monto=$monto+100;
        }if($tipov==3){
            //xflotante
            $monto=$monto+370;
        }
    }if($dato==35){
        //$cargo= "GERENCIA";
        if($tipov==1){
            //xsoli
            $monto=$monto+227;
        }if($tipov==2){
            //xpos
            $monto=$monto+100;
        }if($tipov==3){
            //xflotante
            $monto=$monto+420;
        }
    }
    return $monto;
}
function cantidadPago2($dato,$tipov){
    $monto=0;
    if($tipov==0){
        $monto=0;
    }
    if($dato==21){
        //$cargo="PROMOTOR";
        if($tipov==1){
            //xsoli
            $monto=132;
           // echo $monto;
        }if($tipov==2){
            //xpos
            $monto=48;
            //echo $monto;
        }if($tipov==3){
            //xflotante
            $monto=200;
            //return $monto;
        }
    }if($dato==24){
        //$cargo="SUPERVISOR";
        if($tipov==1){
            //xsoli
            $monto=142;
            //return $monto;
        }if($tipov==2){
            //xpos
            $monto=85;
            //return $monto;
        }if($tipov==3){
            //xflotante
            $monto=250;
            //return $monto;
        }
    }if($dato==32){
        //$cargo= "LIDER";
        if($tipov==1){
            //xsoli
            $monto=212;
            //return $monto;
        }if($tipov==2){
            //xpos
            $monto=100;
            //return $monto;
        }if($tipov==3){
            //xflotante
            $monto=370;
            //return $monto;
        }
    }if($dato==35){
        //$cargo= "GERENCIA";
        if($tipov==1){
            //xsoli
            $monto=227;
            //return $monto;
        }if($tipov==2){
            //xpos
            $monto=100;
            //return $monto;
        }if($tipov==3){
            //xflotante
            $monto=420;
            //return $monto;
        }
    }
    return $monto;
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
/*------------------------------------------------------------------------------*/
$fecha=$_POST['fecha'];
$area=$_POST['area'];
$con = Conectarse();
date_default_timezone_set('America/Mexico_City');
$dia=date('j');
$mesactual=date('n');
$aaaa=date('Y');
$fecha=$dia."/".$mesactual."/".$aaaa;
$total=0;
//$pdf = new FPDF();
$pdf = new PDF();
$title = "Nomina";
$pdf->SetTitle($title);
$pdf->SetAuthor('Mos Proyectos');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Image('../syspic/logo.jpg',60,10,80,40);
$pdf->Cell(180,50,'',0);
$pdf->Ln();
$pdf->SetFont('Arial','',10);
$pdf->Cell(20,10,utf8_decode($fecha),0,1);
$pdf->Cell(190,8,utf8_decode('RECIBÍ DEL INGENIERO GUILLERMO MONTES DE OCA SIERRA, REPRESENTANTE LEGAL DE MOS '),0,1);
$pdf->Cell(190,8,utf8_decode('PROYECTOS S.A. DE C.V., LA CANTIDAD QUE SE MENCIONA A CONTINUACIÓN POR CONCEPTO DE '),0,1);
$pdf->Cell(190,8,utf8_decode('PAGO  A LAS SOLICITUDES  DE VENTA DE SERVICIO DE TELÉFONOS DE MÉXICO S.A. DE C.V., '),0,1);
$pdf->Cell(190,8,utf8_decode('DEBIDAMENTE AUTORIZADA Y VALIDADA.'),0,1);
$pdf->Cell(190,5,utf8_decode(''),0,1);
//$pdf->Cell(30,10,utf8_decode('FLOTANTES'),1,1);
//$pdf->Cell(30,10,utf8_decode('FLOTANTES'),1,1);
//equipos_fielder.id_area,idarea,idu,id_fielder,nom_area,idventa,validar_venta.fecha_pago,xsol,xpos,xflotante,tipo_idtipo,folio_siac,folio_ventas F
$sql2="SELECT equipos_fielder.id_area,idarea,idu,id_fielder,nom_area,idventa,validar_venta.fecha_pago,xsol,xpos,xflotante,tipo_idtipo,venta.folio_siac,venta.folio_ventas FROM usuario inner join equipos_fielder inner join areas_fielder inner join venta inner join validar_venta WHERE equipos_fielder.id_fielder=usuario.idu and equipos_fielder.id_area=idarea and activo=1 and idu=idvendedor and idventa=folio_solicitud and validar_venta.fecha_pago='".$fecha."'
    and equipos_fielder.id_area='".$area."'";
    
$resultado2=$con->query($sql2);
$i=1;
$pdf->SetFont('Arial','B',8);
    $pdf->Cell(5,10,utf8_decode(''),1,0);
    $pdf->Cell(10,10,utf8_decode('MOS'),1,0);
    $pdf->Cell(20,10,utf8_decode(''),1,0);
    $pdf->Cell(30,10,utf8_decode('AREA'),1,0);
    $pdf->Cell(20,10,utf8_decode('SIAC'),1,0);
    $pdf->Cell(20,10,utf8_decode('SOLICITUD'),1,0);
    $pdf->Cell(20,10,utf8_decode('FECHA'),1,0);
    $pdf->Cell(20,10,utf8_decode('SOLICITUD'),1,0);
    $pdf->Cell(18,10,utf8_decode('POSTEO'),1,0);
    $pdf->Cell(22,10,utf8_decode('FLOTANTES'),1,1);
$pdf->SetFont('Arial','',10);   
while($row2 = $resultado2->fetch_assoc())
{
    
    $cargo=tipoUsuario($row2['tipo_idtipo']);
    $pdf->Cell(5,10,utf8_decode($i),1,0,"C");
    $pdf->Cell(10,10,utf8_decode($row2['idventa']),1,0,"C");
    $pdf->Cell(20,10,utf8_decode($cargo),1,0,"C");
    $pdf->Cell(30,10,utf8_decode($row2['nom_area']),1,0,"C");
    $pdf->Cell(20,10,utf8_decode($row2['folio_siac']),1,0,"C");
    $pdf->Cell(20,10,utf8_decode($row2['folio_ventas']),1,0,"C");
    $pdf->Cell(20,10,utf8_decode($row2['fecha_pago']),1,0,"C");
    $pdf->Cell(20,10,utf8_decode($row2['xsol']),1,0,"C");
//    $pdf->Cell(20,10,utf8_decode(cantidadPago2($row2['tipo_idtipo'],1)),1,0,"C");
    $pdf->Cell(18,10,utf8_decode($row2['xpos']),1,0,"C");
//    $pdf->Cell(20,10,utf8_decode(cantidadPago2($row2['tipo_idtipo'],2)),1,0,"C");
    $pdf->Cell(22,10,utf8_decode($row2['xflotante']),1,1,"C");
//    $pdf->Cell(20,10,utf8_decode(cantidadPago2($row2['tipo_idtipo'],3)),1,1,"C");
    if($row2['xsol']==1){
        $total=cantidadPago($row2['tipo_idtipo'],$total,1);
    }if($row2['xpos']==1){
        $total=cantidadPago($row2['tipo_idtipo'],$total,2);
    }if($row2['xflotante']==1){
        $total=cantidadPago($row2['tipo_idtipo'],$total,3);
    }
    $i++;
}
$pdf->SetFont('Arial','B',8);
$pdf->Cell(190,10,utf8_decode("Total= $".$total),0,1,"C");
$pdf->Cell(150,5,utf8_decode("Recibí de conformidad."),0,1,"C");
$pdf->Cell(150,5,utf8_decode("Nombre Completo y Firma"),0,0,"C");
$pdf->Cell(30,30,utf8_decode("Huella"),1,1,"C");
/*------------------------------------------------------------------------------*/
$pdf->Output();
?>