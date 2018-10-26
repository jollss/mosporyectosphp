<?php
ob_start();
include("../Config/library.php"); 
$con = Conectarse();
date_default_timezone_set('America/Mexico_City');
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$hoy = $dia." ".$mes." ".$aaaa;
$nombre_archivo="../filtro/DIRECTORIO ".$hoy.".csv";
if(file_exists($nombre_archivo)){
    unlink($nombre_archivo);
    $archivo = fopen($nombre_archivo, "a");
    $mensaje = "IDU,ACTIVO,USUARIO,NOMBRE COMPLETO,NUMERO DE CUENTA,CELULAR,TELEFONO,FECHA DE INGRESO,FECHA DE ALTA SEGURO,DIRECCION,ESTADO CIVIL, ESTATURA,LICENCIA,CURP, TELEFONO DE EMERGENCIA,CHECADOR,TIPO DE PERSONAL, TIPO,TIPO DE PAGO, RFC, ENTRADA,SALIDA,CONTRATO,FECHA NACIMIENTO, NACIONALIDAD,SEXO,PESO,NSS,IFE,RFC,VIGENCIA LICENCIA,SALARIO";
    fwrite($archivo,$mensaje. "\n");
}else{
    $archivo = fopen($nombre_archivo, "a");
    $mensaje = "IDU,ACTIVO,USUARIO,NOMBRE COMPLETO,NUMERO DE CUENTA,CELULAR,TELEFONO,FECHA DE INGRESO,FECHA DE ALTA SEGURO,DIRECCION,ESTADO CIVIL, ESTATURA,LICENCIA,CURP, TELEFONO DE EMERGENCIA,CHECADOR,TIPO DE PERSONAL, TIPO,TIPO DE PAGO, RFC, ENTRADA,SALIDA,CONTRATO,FECHA NACIMIENTO, NACIONALIDAD,SEXO,PESO,NSS,IFE,RFC,VIGENCIA LICENCIA,SALARIO";
    fwrite($archivo,$mensaje. "\n");
}

$sqlo="SELECT * from usuario inner join infuser INNER JOIN tipo where idu=usuario_iduu and tipo_idtipo=idtipo ORDER BY activo DESC";
$resultadoo=$con->query($sqlo);
while($row = $resultadoo->fetch_assoc())
{
	if($row['activo']==1){
		$activo="ACTIVO";
	}if($row['activo']==0){
		$activo="NO ACTIVO";
	}
	$direccion=str_replace ( ',' , '' , $row['direccion'] ) ;
    $buscar=array(chr(13).chr(10), "\r\n", "\n", "\r",",");
    $reemplazar=array("", "", "", "","");
    $direccion=str_ireplace($buscar,$reemplazar,$direccion); 
    $direccion = preg_replace("[\n|\r|\n\r]", "", $direccion);
    $direccion = trim($direccion);
    $mensaje = $row['idu'].",".$activo.",".$row['correo'].",".$row['nombre']." ".$row['apaterno']." ".$row['amaterno'].",".$row['nocuenta'].",".$row['cel'].",".$row['tel'].",".$row['fecha_ingreso'].",".$row['fecha_seguro'].",".$direccion.",".$row['estado_civil'].",".$row['estatura'].",".$row['licencia'].",".$row['curp'].",".$row['tel_emerg'].",".$row['checador'].",".$row['tipo_personal'].",".$row['tipo'].",".$row['tipo_pago'].",".$row['rfc'].",".$row['hora_entrada'].",".$row['hora_salida'].",".$row['tipo_contrato'].",".$row['fecha_nacimiento'].",".$row['nacionalidad'].",".$row['sexo'].",".$row['peso'].",".$row['nss'].",".$row['ife'].",".$row['rfc'].",".$row['vig_licencia'].",".$row['salario'];

	$archivo = fopen($nombre_archivo, "a");
	fwrite($archivo,$mensaje. "\n");
	fclose($archivo);
} 
header("Location: ../filtro/".$nombre_archivo);
echo "<script languaje='javascript' type='text/javascript'>window.close();</script>";

ob_end_flush();
?>