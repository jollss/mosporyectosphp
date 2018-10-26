<!DOCTYPE html>
<?php
require 'conexion.php';
require 'vacantes.php';
$tel="7225623246";
$correo="";
$mensajeTitle="Forma parte de nuestro equipo..!!!";
$mensajeSub="Llenando el siguiente formulario nos permites agilizar el proceso para que adquieras tu mejor empleo.";
$vacantes=new Vacantes();
$cntArreglo=$vacantes->TotalVacantes($bd);
$cntArreglo=count($cntArreglo);
?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
	    body{
	    	background-image: url("../syspic/madera.jpg");
	    }
	    a{
	    	text-decoration: none;
	    	color:black;
	    	font-weight: bold; 
	    	font-size: 1.3em;
	    }
	    .fondo-rgba{
	    	background-color: rgba(215, 44, 44, 0.7);
	    	color:white;
	    }
	    .part1{
	    	background-color: rgba(215, 44, 44, 0.7);
	    	color:white;
	    	height: 550px;
	    }
	    .part2{
	    	background-color: rgba(215, 44, 44, 0.7);
	    	color:black;
	    	height: 550px;
	    }
	    .partcentro{
	    	background-color: rgba(127, 140, 225, 0.7);
	    	color:white;
	    	height: 550px;
	    }
	    .part{
	    	background-color: rgba(215, 44, 44, 0.7);
	    	color:white;
	    }
    </style>
</head>
<body>
<div class="col-md-12" align="center">
	<img src="../syspic/logo.png" class="img-responsive">
</div>
<div class="col-md-12"><br><br><br></div>
<div class="col-md-12 fondo-rgba">
	<h3><?php echo $mensajeTitle;?></h3>
</div>
<div class="col-md-12"><br><br><br></div>
<div class="col-md-12 part"><h4><?php echo $mensajeSub;?></h4></div>
<div class="col-md-12">
	<div class="col-md-5 part1">
		<form action="envio.php" method="POST">
			<label>Nombre Completo:</label>
			<input type="text" class="form-control" name="nombre" placeholder="Ingresa tu nombre completo" required>
			<label>Edad:</label>
			<input type="number" class="form-control" name="edad" placeholder="Ingresa tu edad" required>
			<label>Celular:</label>
			<input type="text" class="form-control" name="cel" placeholder="Ingresa tu celular" required>
			<label>Correo:</label>
			<input type="mail" class="form-control" name="mail" placeholder="Ingresa tu correo de contacto" required>
			<label>Ultimo grado de estudio:</label>
			<!--<input type="text" class="form-control" name="nombre" placeholder="Ingresa tu nombre completo" required>-->
			<select name="estudio" class="form-control">
				<option value="Primaria">Primaria</option>
				<option value="Secundaria">Secundaria</option>
				<option value="Preparatoria">Preparatoria</option>
				<option value="Universitario">Universitario</option>
			</select>
			<label>Ultimo Trabajo:</label>
			<input type="text" class="form-control" name="trabajo" placeholder="Ingresa tu ultimo cargo laboral" required>
			<label>Puesto solicitado:</label>
			<input type="text" class="form-control" name="puesto" placeholder="Ingresa el puesto" required>
			<label>ZONA:</label>
			<input type="text" class="form-control" name="zona" placeholder="Ingresa la zona de tu interes" required>
			<button class="btn btn-primary" type="submit">
				REGISTRARME
			</button>
		</form>
		<div class="panel panel-default" style="color:black;">
		  <div class="panel-body">
		    Recuerda colocar un correo electronico valido pues es posible que se te confirme tu registro en el.
		  </div>
		</div>
	</div>
	<div class="col-md-2 partcentro">
		<table class="table" >
			<tr>
				<td align="center">
					Llamar: <a href='tel:<?php echo $tel;?>'><img src="../syspic/phone.png" class="img-responsive" width="70" height="70"></a>
				</td>
			</tr>
			<tr>
				<td align="center">
					Correo: <a href='mailto:<?php echo $correo;?>'><img src="../syspic/mail.png" class="img-responsive" width="70" height="70"></a>
				</td>
			</tr>
			<tr>
				<td align="center">
					Ubicación:
					<!--<a href="http://maps.google.com/maps?q=loc:36.26577,-92.54324">-->
					<a href="https://www.google.com.mx/maps/@19.2852551,-99.6609089,3a,75y,175.73h,82.46t/data=!3m7!1e1!3m5!1s6Ij2lhzpe_a9dW1Tn42_zQ!2e0!6s%2F%2Fgeo3.ggpht.com%2Fcbk%3Fpanoid%3D6Ij2lhzpe_a9dW1Tn42_zQ%26output%3Dthumbnail%26cb_client%3Dmaps_sv.tactile.gps%26thumb%3D2%26w%3D203%26h%3D100%26yaw%3D102.91536%26pitch%3D0%26thumbfov%3D100!7i13312!8i6656" target="_blank">
						<img src="../syspic/mapicone.png" class="img-responsive" width="70" height="70">
					</a>
				</td>
			</tr>
			<tr>
				<td align="center">
					Web:
					<a href="https://www.mosproyectos.com.mx/" target="_blank">
						<img src="../syspic/web-hosting.png" class="img-responsive" width="70" height="70">
					</a>
				</td>
			</tr>
		</table>
	</div>
	<div class="col-md-5 part2">
		<MARQUEE DIRECTION=up scrolldelay="400" height=400px>
			<table class="table">
				<tr>
					<th>ZONA</th>
					<th>PUESTO</th>
					<th>NUM. DE VACANTES</th>
				</tr>
				<?php
				for ($i=1; $i <= $cntArreglo; $i++) { 
					$data=$vacantes->ObtenerVacante($bd,$i);
					/*
					echo "<pre>";
					var_dump($data);
					echo "</pre>";
					*/
					?>
					<tr>
						<td><?php echo $data[0]['zona'];?></td>
						<td><?php echo $data[0]['puesto'];?></td>
						<td align="center"><?php echo $data[0]['num_vacantes'];?></td>
					</tr>
					<?php
					
				}
				?>
			</table>
		</MARQUEE>
	</div>
</div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>