<?php
function Conectarse()
{
//local
	ini_set('max_execution_time', 300);
	$host="localhost";
	$user="root";
	$psw="";
	$bd="mosproyectos";

	/*
	$host="db690630991.db.1and1.com";
	$user="dbo690630991";
	$psw="QzAfqx2X8yEGJVUd";
	$bd="db690630991";
	*/
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
