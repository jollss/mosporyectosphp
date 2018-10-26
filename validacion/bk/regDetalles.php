<?php
include("../Config/library.php");
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$idventas=$_POST['idventa'];

$contesto=$_POST['contesto'];
$nomcliente=$_POST['nomcliente'];
$nomatiende=$_POST['nomatiende'];
$servicio=$_POST['servicio'];
$paquete=$_POST['paquete'];
$direccion=$_POST['calle_num'];
$colonia=$_POST['colonia'];
$municipio=$_POST['municipio'];
$cp=$_POST['CP'];
$paquete=$_POST['paquete'];
$aprox=$_POST['aprox'];
$detalles=$_POST['detalles'];
$gastos_instalacion=$_POST['gastos_inst'];
$tiempo_instalacion=$_POST['aprox'];
//$direccion=$calle_num." ".$colonia." ".$municipio;
//$colonia=$_POST['colonia'];
/*
$id=0;
$detalles=new Dataos();
$detalles->obtenerDataosBD($orden,$con);

$adjunto=new Adjunto_os();
$aux=$adjunto->ExisteAdjuntoBD($orden,$con);*/

  /*===============================================*/
  
  if(isset($contesto) && isset($nomcliente)&& isset($servicio))
  {
    /*$filder=new Filder();
    $id=$filder->obtenerId($con);
    $filder->ingresaFilder($id,$contesto,$iduser,$nomcliente,$nomatiende,$servicio,$paquete,
      $direccion,$colonia,$municipio,$cp,$gastos_instalacion,$tiempo_instalacion,$detalles,$idventas);
    $filder->registrarFilderBD($con);*/
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $hora = date("g");
    $min = date("i");
    $fecha=$dia."/".$mes."/".$aaaa." ".$hora.":".$min;
    $sql="UPDATE venta SET 
    contesto='$contesto',id_user='$iduser',fecha_fielder='$fecha',
    cliente='$nomcliente',atiende='$nomatiende',
    servicio='$servicio',paquete='$paquete',
    direccion_v='$direccion',colonia='$colonia',
    municipio='$municipio',cp='$cp',
    gastos_instalacion='$gastos_instalacion',tiempo_instalacion='$tiempo_instalacion',
    observaciones='$detalles'
    WHERE idventa='".$idventas."'";
    if ($con->query($sql) === TRUE) { echo "Modificacion exitosa<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }

    if($contesto=='SI'){
      //$venta=new Ventas();
      //$venta->cambiarEstatus($idventas,$con);
      $sql="UPDATE venta SET 
      estatus='1'
      WHERE idventa='".$idventas."'";
      if ($con->query($sql) === TRUE) { echo "Modificacion de estatus exitosa<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }

    }
    
    echo "
      <script>
          alert('REGISTRADO!');
          document.location=(' inde.php');
      </script>"; 

    }else{
    echo "
      <script>
          alert('ERROR EN DATOS!');
          document.location=(' inde.php');
      </script>"; 
    } 
?>
