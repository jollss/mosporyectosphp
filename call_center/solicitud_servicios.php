<?php
require('../Config/WriteHTML.php');
//require('../Config/rotation.php');
include("../Config/conexion2.php");  
require_once '../Config/conexion.php';

$imgC="syspic/";
class PDF extends FPDF
{
  var $angle=0;
  function Header(){
    $this->SetFont('Arial','B',40);
      $this->SetTextColor(242,236,236);
      $this->RotatedText(15,290,utf8_decode('El tramite de esta solicitud no tiene ningún costo'),55);
      $this->SetTextColor(6,6,6);
      $this->SetFont('Arial','B',10);
      $this->Cell(120,5,'SOLICITUD DE SERVICIOS',0,0,'L');
      $this->Image('syspic/infini.jpg',160,8,37);
      $this->Ln(6);      
  }
  function Footer()
  {
      $this->SetY(-23);
      $this->SetFont('Times','b',5);
      $this->Cell(190,4,'AVISO DE PRIVACIDAD',0,1,'C');      
      $this->SetFont('Times','',5);
      $this->Rect(10,277,177,8,'D');
      $this->Cell(190,2,utf8_decode('Teléfonos de México, S.AB. DE C.V. (Telmex) ,con domicilio en Av. Parque Vía No. 190, Colonia Cuauhtémoc, código postal 06500, en la Delegación Cuauhtémoc, México, Distrito Federal, utilizara y/o tratara sus datos personales, incluyendo los'),0,1,'L');
      $this->Cell(190,2,utf8_decode('sensibles, con el propósito de cumplir aquellas obligaciones que se derivan de la relación jurídica existente entre usted y Telmex. Para mayor información sobre el tratamiento y/o utilización de sus datos personales y sobre los derechos que usted'),0,1,'L');
      $this->Cell(190,2,utf8_decode('puede hacer valer, agradecemos consulte el aviso de privacidad de Telmex que se encuentra a sui disposición en la página web: www.telmex.com. Consulta términos y condiciones en Información Relevante en telmex.com'),0,1,'L');
      $this->SetFont('Times','b',5);
      $this->Cell(190,5,'ORIGINAL',0,1,'C');
      $this->SetFont('Times','',8);
      $this->SetFont('Arial','I',8);
  }
  function Rotate($angle,$x=-1,$y=-1)
  {
      if($x==-1)
          $x=$this->x;
      if($y==-1)
          $y=$this->y;
      if($this->angle!=0)
          $this->_out('Q');
      $this->angle=$angle;
      if($angle!=0)
      {
          $angle*=M_PI/180;
          $c=cos($angle);
          $s=sin($angle);
          $cx=$x*$this->k;
          $cy=($this->h-$y)*$this->k;
          $this->_out(sprintf('q %.5F %.5F %.5F %.5F %.2F %.2F cm 1 0 0 1 %.2F %.2F cm',$c,$s,-$s,$c,$cx,$cy,-$cx,-$cy));
      }
  }
  function _endpage()
  {
      if($this->angle!=0)
      {
          $this->angle=0;
          $this->_out('Q');
      }
      parent::_endpage();
  }
  function RotatedText($x,$y,$txt,$angle)
  {      
      $this->Rotate($angle,$x,$y);
      $this->Text($x,$y,$txt);
      $this->Rotate(0);
  }
}
$pdf = new PDF();

$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',4.5);

  $pdf->RotatedText(198,288,utf8_decode('Se me informó y explicaron los términos y condiciones del Contrato Marco de Presentación de Servicios de Telecomunicaciones para el Mercado Residencial y COMERCIAL (Masivo) registrado como Contrato de Adhesión ante PROFECO, mismo que está a mi disposición en las siguientes direcciones electrónicas: www.telmex.com y www.profeco.gob.mx TELMEX se obliga a'),90);
  $pdf->RotatedText(200,288,utf8_decode('confirme a través de cualquier medio indubitable, dentro de un plazo de 3 (tres) días hábiles, si cuenta con la disponibilidad para la instalación y prestación del SERVICIO. En caso de contar con disponibilidad, TELMEX llevará a cabo las tareas de instalación del SERVICIO en el domicilio señalado por el CONSUMIDOR por lo que estoy de acuerdo en brindarle las facilidades que'),90);
  $pdf->RotatedText(202,288,utf8_decode('resulten necesarias. EL CONSUMIDOR reconoce y acepta que el uso del SERVICIO se considerará como la confirmación de los términos y condiciones del Contrato de Adhesión previamente suscrito. De no existir disponibilidad, se dejará sin efecto esta solicitud, el Contrato de Adhesión y las Condiciones del Servicio suscritas por el CONSUMIDOR. Manifiesto mi conformidad para que'),90);
  $pdf->RotatedText(204,288,utf8_decode('TELMEX lleve a cabo el tratamiento de mis datos personales en términos de lo dispuesto en el Aviso de Privacidad el cual está publicado en la página www.telmex.com'),90);

  $pdf->SetFont('Arial','B',6);
  $pdf->Cell(5,5,"  ",1,0); 
  $pdf->Cell(25,5,utf8_decode("Línea Residencial"),0,0);
  $pdf->Cell(5,5,"  ",1,0); 
  $pdf->Cell(25,5,utf8_decode("Línea Comercial"),0,0);
  $pdf->Cell(5,5,"  ",1,0); 
  $pdf->Cell(15,5,utf8_decode("Paquete"),0,0);
  $pdf->Cell(5,5,"  ",1,0); 
  $pdf->Cell(20,5,utf8_decode("Portabilidad"),0,0);
  $pdf->Cell(5,5,"  ",1,0); 
  $pdf->Cell(10,5,utf8_decode("FTTH"),0,0);
  $pdf->Cell(5,5,"  ",1,0); 
  $pdf->Cell(10,5,utf8_decode("Claro video"),0,1);

  $pdf->SetFont('Arial','',6);
  $pdf->Cell(125,5,utf8_decode("Fecha:"),0,0);
  $pdf->Cell(10,5,utf8_decode("Número:"),0,1);
  $pdf->Rect(10,25,177,40,'D');
  $pdf->RotatedText(8,49,utf8_decode('Datos Generales'),90);

  $pdf->Cell(40,5,utf8_decode("Teléfono para contratar el servicio:"),0,0);
  $pdf->Cell(5,5,'0',1,0,'C');$pdf->Cell(5,5,'1',1,0,'C');
  $pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');
  $pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');
  $pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');
  $pdf->Cell(20,5,'',0,0,'C');$pdf->Cell(20,5,'Folio Telmex',0,1,'C');
  $pdf->Cell(190,1,' ',0,1,'C');

  $pdf->SetFont('Arial','B',6);
  $pdf->Cell(40,5,utf8_decode("Número a Portar:"),0,0);
  $pdf->Cell(5,5,'0',1,0,'C');$pdf->Cell(5,5,'1',1,0,'C');
  $pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');
  $pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');
  $pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');
  $pdf->Cell(20,5,'',0,0,'C');
  $pdf->Cell(2,5,'',0,0,'C');
  $pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');
  $pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');$pdf->Cell(5,5,' ',1,0,'C');
  $pdf->Cell(190,6,' ',0,1,'C');

  $pdf->SetFont('Arial','',5.5);
  $pdf->Cell(40,5,utf8_decode("Fecha límite pago de factura de proveedor actual:"),0,0);
  $pdf->Cell(190,3,' ',0,1,'C');

  $pdf->SetFont('Arial','',5.5);
  $pdf->Cell(40,5,utf8_decode("Nombre y apellido del cliente o Razón Social (titular de la línea):"),0,0);
  $pdf->Cell(190,3,' ',0,1,'C');

  $pdf->SetFont('Arial','',5.5);
  $pdf->Cell(80,4,utf8_decode("RFC:"),0,0);
  $pdf->Cell(80,4,utf8_decode("Tipo de identificación:"),0,0);
  $pdf->Cell(190,3,' ',0,1,'C');

  $pdf->SetFont('Arial','',5.5);
  $pdf->Cell(80,4,utf8_decode("Folio de identificación:"),0,0);
  $pdf->Cell(80,4,utf8_decode("Correo electrónico (e-mail):"),0,0);
  $pdf->Cell(190,3,' ',0,1,'C');

  $pdf->SetFont('Arial','',5.5);
  $pdf->Cell(80,4,utf8_decode("Teléfono de contacto (10 digitos):"),0,0);
  $pdf->Cell(80,4,utf8_decode("Teléfono Celular:"),0,0);
  $pdf->Cell(190,3,' ',0,1,'C');  

  $pdf->SetFont('Arial','',5.5);
  $pdf->Cell(160,4,utf8_decode("Nombre de quién recibe:"),0,0);
  $pdf->Cell(190,3,' ',0,1,'C'); 

  $pdf->SetFont('Arial','',5.5);
  $pdf->Cell(80,4,utf8_decode("Horario:"),0,0);
  $pdf->Cell(80,4,utf8_decode("Fecha de nacimiento:"),0,0);
  $pdf->Cell(190,3,' ',0,1,'C');   

  $pdf->SetFont('Arial','',5.5);
  $pdf->Cell(160,4,utf8_decode("Observaciones / Indicaciones:"),0,0);
  $pdf->Cell(190,3,' ',0,1,'C');    

  $pdf->Cell(190,10,'',0,1,'C');

  $pdf->SetFont('Arial','',6);
  $pdf->Rect(10,70,177,40,'D');
  $pdf->RotatedText(8,95,utf8_decode('Domicilio de instalación'),90);

  $pdf->Cell(80,5,utf8_decode("Calle:"),0,0);
  $pdf->Cell(40,5,'No. Exterior',0,0,'C');
  $pdf->Cell(30,5,'No. Interior',0,1,'C');
  $pdf->Cell(190,1,' ',0,1,'C');

  $pdf->Cell(80,5,utf8_decode("Colonia:"),0,0);
  $pdf->Cell(80,5,'Ciudad:',0,0,'L');
  $pdf->Cell(190,6,' ',0,1,'C');

  $pdf->SetFont('Arial','',5.5);
  $pdf->Cell(40,5,utf8_decode("Manzana:"),0,0);
  $pdf->Cell(40,5,utf8_decode("Lote:"),0,0);
  $pdf->Cell(40,5,utf8_decode("Edificio:"),0,0);
  $pdf->Cell(40,5,utf8_decode("Subnúmero:"),0,0);
  $pdf->Cell(190,3,' ',0,1,'C');

  $pdf->SetFont('Arial','',5.5);
  $pdf->Cell(40,5,utf8_decode("Estado:"),0,0);
  $pdf->Cell(60,5,utf8_decode("Municipio o Delegación:"),0,0);
  $pdf->Cell(40,5,utf8_decode("Calificador:"),0,0);
  $pdf->Cell(190,3,' ',0,1,'C');

  $pdf->SetFont('Arial','',5.5);
  $pdf->Cell(20,4,utf8_decode("C.P.:"),0,0);
  $pdf->Cell(60,4,utf8_decode("Entre calle 1:"),0,0);
  $pdf->Cell(60,4,utf8_decode("Entre calle 2:"),0,0);
  $pdf->Cell(190,3,' ',0,1,'C');

  $pdf->SetFont('Arial','',5.5);
  $pdf->Cell(80,4,utf8_decode("Teléfono de referencia:"),0,0);
  $pdf->Cell(80,4,utf8_decode("Terminal:"),0,0);
  $pdf->Cell(190,3,' ',0,1,'C');

  $pdf->SetFont('Arial','',5.5);
  $pdf->Cell(160,4,utf8_decode("Alguna referencia:"),0,0);
  $pdf->Cell(190,3,' ',0,1,'C');    

  $pdf->Cell(190,20,'',0,1,'C');

  $pdf->SetFont('Arial','',6);
  $pdf->Rect(10,115,177,40,'D');
  $pdf->RotatedText(8,142,utf8_decode('MAPA DE UBICACIÓN'),90);

  $pdf->Cell(88.5,5,utf8_decode("INDICA LAS CALLES QUE RODEAN EL DOMICILIO"),0,0,'C');
  $pdf->Cell(88.5,5,utf8_decode("OBSERVACIONES"),0,1,'C');
  $pdf->Cell(88.5,31,'',1,0,'C');

  $pdf->Rect(15,125,20,5,'D');
  $pdf->Rect(45,125,20,5,'D');
  $pdf->Rect(75,125,20,5,'D');
  $pdf->RotatedText(40,142,utf8_decode('CALLE 1'),90);

  $pdf->Rect(15,135,20,5,'D');
  $pdf->Rect(45,135,20,5,'D');
  $pdf->Rect(52,135,5,5,'F');
  $pdf->RotatedText(52,142,utf8_decode('CASA'),0);  
  $pdf->Rect(75,135,20,5,'D');
  $pdf->RotatedText(70,142,utf8_decode('CALLE 2'),90);

  $pdf->Rect(15,145,20,5,'D');
  $pdf->Rect(45,145,20,5,'D');
  $pdf->Rect(75,145,20,5,'D');
  $pdf->Cell(88.5,31,'',1,1,'C');

  $pdf->SetFont('Arial','',6);
  $pdf->Rect(10,160,90,60,'D');
  $pdf->RotatedText(8,199,utf8_decode('SERVICIO'),90);

  $pdf->SetFont('Arial','B',7);
  $pdf->RotatedText(12,165,utf8_decode('PLANES DE RENTA MENSUAL'),0);
  $pdf->SetFont('Arial','B',6);
  $pdf->RotatedText(12,168,utf8_decode('Para Líneas Residenciales:'),0);
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(190,14,'',0,1,'C'); 
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(35,2,'',0,0,'C');
  $pdf->RotatedText(18,171,utf8_decode('Paquete Infinitum'),0);
  $pdf->RotatedText(45,171,utf8_decode('$ 399.00'),0);
  /*=========================*/  
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(38,2,'',0,0,'C');
  $pdf->RotatedText(60,171,utf8_decode('Infinitum puro   hasta 10MB'),0);
  $pdf->RotatedText(88,171,utf8_decode('$ 399.00'),0);
/*=========================*/  
  $pdf->Cell(10,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(38,2,'',0,1,'C');
  $pdf->RotatedText(110,171,utf8_decode('Aparato teléfono'),0);
/*=========================*/
  $pdf->Cell(190,1,'',0,1,'C');  
/*=========================*/
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(35,2,'',0,0,'C');
  $pdf->RotatedText(18,174,utf8_decode('Paquete Infinitum'),0);
  $pdf->RotatedText(45,174,utf8_decode('$ 389.00'),0);
/*=========================*/  
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(38,2,'',0,0,'C');
  $pdf->RotatedText(60,174,utf8_decode('Infinitum puro   hasta 20MB'),0);
  $pdf->RotatedText(88,174,utf8_decode('$ 499.00'),0);
/*=========================*/  
  $pdf->Cell(10,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(38,2,'',0,1,'C');
  $pdf->RotatedText(110,174,utf8_decode('Cableado Interior'),0);
/*=========================*/ 
  $pdf->Cell(190,1,' ',0,1,'C');  
/*=========================*/
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(35,2,'',0,0,'C');
  $pdf->RotatedText(18,177,utf8_decode('Paquete Infinitum Frontera'),0);
  $pdf->RotatedText(45,177,utf8_decode('$ 389.00'),0);
/*=========================*/  
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(38,2,'',0,0,'C');
  $pdf->RotatedText(60,177,utf8_decode('Infinitum puro   hasta 50MB'),0);
  $pdf->RotatedText(88,177,utf8_decode('$ 649.00'),0);
  /*=========================*/  
  $pdf->Cell(10,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(38,2,'',0,1,'C');
  $pdf->RotatedText(110,177,utf8_decode('Número privado'),0);
/*=========================*/ 
  $pdf->Cell(190,1,' ',0,1,'C');  
/*=========================*/
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(35,2,'',0,0,'C');
  $pdf->RotatedText(18,180,utf8_decode('Paquete Infinitum'),0);
  $pdf->RotatedText(45,180,utf8_decode('$ 599.00'),0);
/*=========================*/  
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(38,2,'',0,1,'C');
  $pdf->RotatedText(60,180,utf8_decode('Infinitum puro   hasta 100MB'),0);
  $pdf->RotatedText(88,180,utf8_decode('$ 899.00'),0);
/*=========================*/ 
  $pdf->Cell(190,1,' ',0,1,'C');   
/*=========================*/
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(35,2,'',0,0,'C');
  $pdf->RotatedText(18,183,utf8_decode('Paquete Infinitum'),0);
  $pdf->RotatedText(45,183,utf8_decode('$ 999.00'),0);
/*=========================*/  
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(38,2,'',0,1,'C');
/*=========================*/ 
  $pdf->Cell(190,1,' ',0,1,'C');  
/*=========================*/ 
  $pdf->SetFont('Arial','B',6);
  $pdf->RotatedText(12,187,utf8_decode('Para Líneas Comerciales:'),0);
  $pdf->SetFont('Arial','',6);
  /*=========================*/ 
  $pdf->Cell(190,4,' ',0,1,'C');   
/*=========================*/
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(35,2,'',0,0,'C');
  $pdf->RotatedText(18,190,utf8_decode('Paquete Infinitum Negocio'),0);
  $pdf->RotatedText(45,190,utf8_decode('$ 399.00'),0);
/*=========================*/  
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(38,2,'',0,1,'C');
  $pdf->RotatedText(60,190,utf8_decode('Infinitum Negocio'),0);
  $pdf->RotatedText(88,190,utf8_decode('$ 404.84'),0);
/*=========================*/ 
  $pdf->Cell(190,1,' ',0,1,'C');  
/*=========================*/ 
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(35,2,'',0,0,'C');
  $pdf->RotatedText(18,193,utf8_decode('Paquete Infinitum Negocio'),0);
  $pdf->RotatedText(45,193,utf8_decode('$ 549.00'),0);
/*=========================*/  
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(38,2,'',0,1,'C');
  $pdf->RotatedText(60,193,utf8_decode('Infinitum Negocio Red'),0);
  $pdf->RotatedText(88,193,utf8_decode('$ 706.08'),0);
/*=========================*/ 
  $pdf->Cell(190,1,' ',0,1,'C');  
/*=========================*/
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(35,2,'',0,0,'C');
  $pdf->RotatedText(18,196,utf8_decode('Paquete Infinitum Negocio'),0);
  $pdf->RotatedText(45,196,utf8_decode('$ 799.00'),0);
/*=========================*/  
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(38,2,'',0,1,'C');
  $pdf->RotatedText(60,196,utf8_decode('Infinitum Negocio Premium'),0);
  $pdf->RotatedText(88,196,utf8_decode('$ 1,209.42'),0);
/*=========================*/ 
  $pdf->Cell(190,1,' ',0,1,'C');  
/*=========================*/
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(35,2,'',0,0,'C');
  $pdf->RotatedText(18,199,utf8_decode('Paquete Infinitum Negocio'),0);
  $pdf->RotatedText(45,199,utf8_decode('$ 1,499.00'),0);
/*=========================*/  
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',0,0,'C');  
  $pdf->Cell(38,2,'',0,0,'C');
  $pdf->RotatedText(60,199,utf8_decode('Solo Infinitum *Hasta'),0);
  /*=========================*/  
  $pdf->Cell(10,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(38,2,'',0,0,'C');
  $pdf->RotatedText(110,199,utf8_decode('Hasta 20 Mbps $110'),0);
    /*=========================*/  
  $pdf->Cell(2,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(38,2,'',0,1,'C');
  $pdf->RotatedText(155,199,utf8_decode('Hasta 50 Mbps $310'),0);
/*=========================*/ 
  $pdf->Cell(190,1,' ',0,1,'C');  
/*=========================*/
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(35,2,'',0,0,'C');
  $pdf->RotatedText(18,202,utf8_decode('Paquete Infinitum Negocio'),0);
  $pdf->RotatedText(45,202,utf8_decode('$ 1,789.00'),0);
/*=========================*/  
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(10,2,'',0,0,'C');
  $pdf->RotatedText(60,202,utf8_decode('10MB'),0);
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(10,2,'',0,0,'C');
  $pdf->RotatedText(72,202,utf8_decode('20MB'),0);
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(10,2,'',0,0,'C');
  $pdf->RotatedText(85,202,utf8_decode('50MB'),0);
/*=========================*/ 
  $pdf->Cell(40,2,' ',0,0,'C');  
  $pdf->Cell(2,2,'',1,1,'C');
  $pdf->RotatedText(137,202,utf8_decode('Hasta 200 Mbps $1,010'),0);
/*=========================*/    
  $pdf->Cell(190,1,' ',0,1,'C');  
/*=========================*/
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(35,2,'',0,0,'C');
  $pdf->RotatedText(18,205,utf8_decode('Paquete Infinitum Negocio'),0);
  $pdf->RotatedText(45,205,utf8_decode('$ 2,289.00'),0);
/*=========================*/  
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',0,0,'C');  
  $pdf->Cell(38,2,'',0,0,'C');
  $pdf->RotatedText(60,205,utf8_decode('*No aplica IP Estática'),0);
  /*=========================*/  
  $pdf->Cell(10,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(38,2,'',0,1,'C');
  $pdf->RotatedText(110,205,utf8_decode('Otros planes:'),0);
/*=========================*/ 
  $pdf->Cell(190,1,' ',0,1,'C');  
/*=========================*/
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',0,0,'C');  
  $pdf->Cell(35,2,'',0,0,'C');
  $pdf->RotatedText(18,208,utf8_decode(''),0);
  $pdf->RotatedText(45,208,utf8_decode(''),0);
/*=========================*/  
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',1,0,'C');  
  $pdf->Cell(35,2,'',0,0,'C');
  $pdf->RotatedText(60,208,utf8_decode('Paquete Telmex Negocio'),0);
  /*=========================*/  
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',0,0,'C');  
  $pdf->Cell(35,2,'',0,1,'C');
  $pdf->RotatedText(110,208,utf8_decode('*El precio es adicional a los $389. Sujeto a disponibilidad.'),0);
/*=========================*/ 
  $pdf->Cell(190,1,' ',0,1,'C');  
/*=========================*/
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',0,0,'C');  
  $pdf->Cell(35,2,'',0,0,'C');
  $pdf->RotatedText(18,211,utf8_decode(''),0);
  $pdf->RotatedText(45,211,utf8_decode(''),0);
/*=========================*/  
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',0,0,'C');  
  $pdf->Cell(35,2,'',0,1,'C');
  $pdf->RotatedText(70,211,utf8_decode('(sin internet)     $ 899.00)'),0);
/*=========================*/ 
  $pdf->Cell(190,1,' ',0,1,'C');  
/*=========================*/
  $pdf->SetFont('Arial','',5);
  $pdf->Cell(5,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',0,0,'C');  
  $pdf->Cell(35,2,'',0,1,'C');
  $pdf->RotatedText(18,214,utf8_decode('Verificar promoción vigente en: Guía de Infinitum y/o www.telmex.com'),0);
  $pdf->RotatedText(45,214,utf8_decode(''),0);
  /*=========================*/
  $pdf->SetFont('Arial','',6);
  $pdf->Cell(15,2,'',0,0,'C'); 
  $pdf->Cell(2,2,' ',0,0,'C');  
  $pdf->Cell(35,2,'',0,1,'C');
  $pdf->RotatedText(105,214,utf8_decode('Gastos de instalación:'),0);
  $pdf->RotatedText(45,214,utf8_decode(''),0);
/*=========================*/ 
  $pdf->Cell(190,1,' ',0,1,'C');  
/*==============================================*/
  $pdf->SetFont('Arial','B',6);
  $pdf->Rect(102,160,85,20,'D');
  $pdf->RotatedText(105,165,utf8_decode('SERVICIOS COMPLEMENTARIOS'),0);
  $pdf->Rect(102,185,85,24,'D');
  $pdf->RotatedText(105,190,utf8_decode('PLANES ADICIONALES'),0);
  $pdf->SetFont('Arial','',5);
  $pdf->RotatedText(105,194,utf8_decode('*Velocidades Adicionales para paquete $389'),0);
  $pdf->SetFont('Arial','B',6);
  $pdf->Rect(102,210,85,10,'D');
  $pdf->Cell(190,8,' ',0,1,'C');  
  $pdf->Cell(20,5,' ',0,0,'C');
  $pdf->SetFont('Arial','B',7); 
  $pdf->Cell(100,5,utf8_decode('NOTA IMPORTANTE: EL PROMOTOR NO PUEDE RECIBIR DINERO POR NINGÚN CONCEPTO EN EL TRÁMITE DEL SERVICIO.'),0,1,'L'); 
  $pdf->SetFont('Arial','B',6); 
  $pdf->Cell(180,5,utf8_decode('Anexar copia de identificación oficial.'),0,1,'C'); 
  $pdf->Cell(35,10,utf8_decode(''),0,1,'C');
  $pdf->Cell(90,5,utf8_decode('Empresa:'),0,0,'C'); 
  $pdf->Cell(90,5,utf8_decode('Nombre del solicitante'),0,1,'C'); 
  $pdf->Cell(90,5,utf8_decode('Estrategia:'),0,0,'C'); 
  $pdf->Cell(90,5,utf8_decode('Registro en mi Telmex:'),0,1,'C'); 
  $pdf->Cell(90,5,utf8_decode('Clave del promotor:'),0,0,'C'); 
  $pdf->Cell(35,5,utf8_decode(''),0,0,'C');
  $pdf->Cell(2,2,utf8_decode(''),1,0,'C');
  $pdf->Cell(10,2,utf8_decode('SI'),0,0,'L');
  $pdf->Cell(2,2,utf8_decode(''),1,0,'C');
  $pdf->Cell(30,2,utf8_decode('NO'),0,1,'L');
  $pdf->Cell(190,10,utf8_decode(''),0,1,'C');
  $pdf->Cell(100,4,utf8_decode(''),0,0,'C');
  $pdf->Cell(100,2,utf8_decode('______________________________'),0,1,'C');
  $pdf->Cell(100,4,utf8_decode(''),0,0,'C');
  $pdf->Cell(100,4,utf8_decode('Firma'),0,1,'C');
$pdf->Output();
?>