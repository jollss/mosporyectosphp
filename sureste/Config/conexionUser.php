<?php

$manejador="mysql";
//local

	$host="localhost";
	$user="root";
	$psw="";
	$bd="sureste";
		/*
	$host="db725792357.db.1and1.com";
	$user="dbo725792357";
	$psw="QzAfqx2X8yEGJVUd";
	$bd="db725792357";//sureste
	*/
$cadena="$manejador:host=$host;dbname=$bd";
$cnx = new PDO($cadena,$user,$psw);
?>
