<?php

$manejador="mysql";
//local

	$host="localhost";
	$user="root";
	$psw="";
	$bd="occidente";


	/*
	$host="db723959734.db.1and1.com";
	$user="dbo723959734";
	$psw="QzAfqx2X8yEGJVUd";
	$bd="db723959734";//puerto vallarta
	*/
$cadena="$manejador:host=$host;dbname=$bd";
$cnx = new PDO($cadena,$user,$psw);
?>
