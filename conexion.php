<?php

	$mysqli = new mysqli("localhost","root","","mosproyectos"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos
	//$mysqli = new mysqli("db690630991.db.1and1.com","dbo690630991","QzAfqx2X8yEGJVUd","db690630991"); //servidor, usuario de base de datos, contraseña del usuario, nombre de base de datos

	if(mysqli_connect_errno()){
		echo 'Conexion Fallida : ', mysqli_connect_error();
		exit();
	}

?>
