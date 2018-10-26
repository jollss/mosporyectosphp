<?php
ob_start();
if(!isset($_POST['ky'])){
    header('Location: 404.php');
}
require 'clase_conexion.php';
require 'check.php';
require 'zona.php';
require 'usuario.php';
$di=$_POST['dia'];
$mi=$_POST['mes'];
$yi=$_POST['year'];
$location=$_POST['location'];
$dateIn=$yi."-".$mi."-".$di;
$registro = new Check();
$usuario = new Usuario();
$total=$registro->obtenerTotaldeRegsitros($bd);
$nombre_archivo="report.csv";

//$id.",".$full_name.",".$date.",".$inout;

if(file_exists($nombre_archivo)){ 
    unlink($nombre_archivo);
    $archivo = fopen($nombre_archivo, "a");
    $mensaje = "FOLIO CHECADOR,EMPLEADO,FECHA,ENTRADA/SALIDA";
    fwrite($archivo,$mensaje. "\n");
}else{
    $archivo = fopen($nombre_archivo, "a");
    $mensaje = "FOLIO CHECADOR,EMPLEADO,FECHA,ENTRADA/SALIDA";
    fwrite($archivo,$mensaje. "\n");
}
for ($i=0; $i < $total; $i++) { 
    $dato=$registro->obtenerUnRegistro($bd,$i);
    $dateRow=$dato[0]['fecha_reg'];
    if($dateRow==$dateIn){
        $date=$dato[0]['fecha'];
        $inout=$dato[0]['tipo'];
        $location=$dato[0]['location'];
        $user=$dato[0]['usuario'];
        $id=$dato[0]['idreg'];
        $datosU=$usuario->obtenerUnRegistro($bd2,$user);
        $full_name=$datosU[0]['nombre']." ".$datosU[0]['apaterno']." ".$datosU[0]['amaterno'];
        //var_dump($full_name);

        if($full_name<>"SIN ASIGNACION DE USUARIO"){
            $mensaje = $id.",".$full_name.",".$date.",".$inout;
            $archivo = fopen($nombre_archivo, "a");
            fwrite($archivo,$mensaje. "\n");
        }
    }
}
    fclose($archivo);

header("Location: ".$nombre_archivo);
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";
ob_end_flush();
?>