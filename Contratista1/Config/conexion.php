<?php

$manejador="mysql";
//local
	/*
	$host="localhost";
	$user="root";
	$psw="QzAfqx2X8yEGJVUd";
	$bd="mosproyectos";
	*/
	$host="db724603062.db.1and1.com";
	$user="dbo724603062";
	$psw="QzAfqx2X8yEGJVUd";
	$bd="db724603062";
	
$cadena="$manejador:host=$host;dbname=$bd";
$cnx = new PDO($cadena,$user,$psw);
?>