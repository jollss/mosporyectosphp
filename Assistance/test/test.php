<!DOCTYPE html>
<?php
require '../clase_conexion.php';
require '../check.php';
require '../usuario.php';
$registro = new Check();
$usuario=new Usuario();
?>
<html>
<head>
	<title></title>
</head>
<body>
<?php
$iduser=6;
$id=$registro->obtenerTotaldeRegsitros($bd);
$usuarios=$usuario->obtenerUnRegistro($bd2,$iduser);
$iduserc=count($usuarios[0][0]);
echo "Usuarios iguales= ".$iduserc;
$registros=$registro->obtenerTotaldeRegsitros($bd);
echo "<br>Total de registros.. ".$registros;
?>
<!--
<script>
	$(function() {
	  var sayCheese = new SayCheese('#container-element', { audio: true });
	  sayCheese.on('start', function() {
	    this.takeSnapshot();
	  });

	  sayCheese.on('snapshot', function(snapshot) {
	    // a snapshot has been taken, do something with it :)
	  });

	  sayCheese.start();
	});
</script>
-->
</body>
</html>
<?php
//echo "test";
?>