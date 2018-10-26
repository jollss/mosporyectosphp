<?php

require 'clase_conexion.php';
require 'check.php';
require 'usuario.php';
$registro = new Check();
$usuario=new Usuario();
date_default_timezone_set('America/Mexico_City');
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$hora=date('G');
$min=date('i');
$seg=date('s');
$name=$dia.$mes.$aaaa.$hora.$min.$seg;
$time=$hora.":".$min.":".$seg;
$img = $_POST['hidden_data'];
$iduser=$_POST['user'];
$tipo=$_POST['tipo'];
$location=strtoupper($_POST['location']);
$file = $upload_dir . $iduser."-".$name . ".png";
$imagen = $iduser."-".$name . ".png";

$id=$registro->obtenerTotaldeRegsitros($bd);
$usuarios=$usuario->obtenerUnRegistro($bd2,$iduser);
$iduserc=count($usuarios[0][0]);

$fecha=$dia."/".$mes."/".$aaaa." ".$time;
$fecha_reg=$aaaa."-".$mes."-".$dia;

$datos = array('id'=>$id,'usuario' =>$iduser ,'fecha' => $fecha,'fecha_reg'=>$fecha_reg,'imagen'=>$imagen,'tipo'=>$tipo,'location'=>$location);
if($iduserc==0){

}if($iduserc>0){
$name=$file;
$upload_dir = "fotos/";
$user=$iduser;
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);


$file = $upload_dir . $imagen . "";
$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';
$registro->registrarRegistros($bd,$datos);
}
?>
