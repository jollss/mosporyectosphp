<?php
$nombre=strtoupper($_POST['nombre']);
$edad=$_POST['edad'];
$cel=$_POST['cel'];
$estudio=strtoupper($_POST['estudio']);
$trabajo=strtoupper($_POST['trabajo']);
$puesto=strtoupper($_POST['puesto']);
$zona=strtoupper($_POST['zona']);
$mail=$_POST['mail'];


$mymail="claudia.echeverri@mosproyectos.com.mx";
$mensaje = "
<h3>Los datos de reclutamiento MOS son:</h3><br>
<table border='2'>
	<tr>
		<th><h4>NOMBRE</h4></th>
		<th><h4>EDAD</h4></th>
		<th><h4>CELULAR</h4></th>
		<th><h4>CORREO</h4></th>
	</tr>
	<tr>
		<td>".$nombre."</td>
		<td>".$edad." años</td>
		<td>".$cel."</td>
		<td>".$mail."</td>
	</tr>
</table>
<br><br>
<table border='2'>
	<tr>
		<th><h4>Ultimo grado de estudio</h4></th>
		<th><h4>Ultimo trabajo realizado</h4></th>
	</tr>
	<tr>
		<td>".$estudio."</td>
		<td>".$trabajo."</td>
	</tr>
</table>
<br><br>
<table border='2'>
	<tr>
		<th><h4>Puesto Solicitado</h4></th>
		<th><h4>Zona de trabajo</h4></th>
	</tr>
	<tr>
		<td>".$puesto."</td>
		<td>".$zona."</td>
	</tr>
</table>
<p>Esta información es enviada desde el formulario web.</p>
";
//Titulo
$titulo = "RECLUTAMIENTO DESDE WEB";
//cabecera
$headers = "MIME-Version: 1.0\r\n"; 
$headers .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
//dirección del remitente 
$headers .= "From: MOS PROYECTOS < ".$mail." >\r\n";
//Enviamos el mensaje a tu_dirección_email 
$bool = mail($mymail,$titulo,$mensaje,$headers);
if($bool){
    echo "<script type='text/javascript'>alert('Registro Enviado.');location.href='contactanos.php';</script>";  
}else{
    echo "<script type='text/javascript'>alert('Registro NO Enviado.');location.href='contactanos.php';</script>";  
}
?>