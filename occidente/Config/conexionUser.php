<?php

$manejador="mysql";
//local
	/*
	$host="localhost";
	$user="root";
	$psw="QzAfqx2X8yEGJVUd";
	$bd="mosproyectos";
	*/
	$host="db690630991.db.1and1.com";
	$user="dbo690630991";
	$psw="QzAfqx2X8yEGJVUd";
	$bd="db690630991";
	
$cadena="$manejador:host=$host;dbname=$bd";
$cnx = new PDO($cadena,$user,$psw);
function ConectarseMain()  
{  
//local
	/*
	$host="localhost";
	$user="root";
	$psw="QzAfqx2X8yEGJVUd";
	$bd="mosproyectos";
	*/
	$host="db690630991.db.1and1.com";
	$user="dbo690630991";
	$psw="QzAfqx2X8yEGJVUd";
	$bd="db690630991";
	
   $con = new mysqli($host,$user,$psw,$bd);
	if($con -> connect_errno){
		header("Location: login.html");
	}
	else{
		//echo "Conectado...";
	}
   return $con;  
} 
?>