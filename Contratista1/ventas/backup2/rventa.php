<?php
include("../Config/library.php");
$con = Conectarse();  
function execute($query){
      $con = Conectarse();  
      return mysqli_query($con,$query);
}
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$estatus=0;
$name=strtoupper($_POST['name']);
$ap =strtoupper($_POST['ap']);
$am =strtoupper($_POST['am']);
$terminal =strtoupper($_POST['terminal']);
$documentacion =strtoupper($_POST['documentacion']);
//$name=$name." ".$ap." ".$am;
$tel1 =$_POST['tel1'];
$tel2 =$_POST['tel2'];
$tel3 =$_POST['tel3'];
$folio =strtoupper($_POST['folio']);
$dir=strtoupper($_POST['dir']);
$datos=strtoupper($_POST['detalles']);
$area=strtoupper($_POST['area']);
$distrito=strtoupper($_POST['distrito']);
if(isset($name) && isset($ap)&& isset($am)&& isset($tel1)&& isset($dir)
  && isset($tel2)&& isset($folio)&& isset($tel3))
{
  $venta=new Ventas();
  $ultimo=$venta->obtenerUltimo($con);
  //$ultimo=$ultimo+1;
  $venta->ingresaVentas($ultimo,$folio,$iduser,$name,$ap,$am,$dir,$datos,
        $terminal,$tel1,$tel2,$tel3,$estatus,$documentacion);
  //$venta->verVentas();
  date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $hora=date('G');
    $min=date('i');
    $time=$hora.":".$min;
    
    $sql="INSERT INTO ventas (
      idventa,folio_ventas,idvendedor,
      nombre,apaternov,amaternov,direccion,
      datos,terminal,telefono_1,telefono_2,telefono_3,
      dia,mes,year,hora,
      estatus,vendedor,documentacion,area,distrito)
      VALUES
      ('".$ultimo."','".$folio."','".$iduser."',
       '".$name."','".$ap."','".$am."','".$dir."',
       '".$datos."','".$terminal."','".$tel1."','".$tel2."',
       '".$tel3."','".$dia."','".$mes."','".$aaaa."',
       '".$time."','".$estatus."','0','".$documentacion."','".$area."','".$distrito."'
       )";
//echo "string";
if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
      //execute($sql) or die (mysqli_error($con)); 
/*-----------------------*/
  //$venta->registrarVentaBD($con);

  //$venta->cambiarArea($ultimo,$area,$con);
  //$venta->cambiarDistrito($ultimo,$distrito,$con);

         echo "
            <script>
                alert('REGISTRO EXITOSO!');
              document.location=('inde.php');   
            </script>";

}else{
  echo "
  <script>
      alert('ERROR EN DATOS!');
      document.location=('inde.php'); 
  </script>"; 
}
?>