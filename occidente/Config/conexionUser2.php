<?php
function Conectarse()
{
//local

	$host="localhost";
	$user="root";
	$psw="";
	$bd="occidente";
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
function ConectarseMain()
{
//local
	/*
	$host="localhost";
	$user="root";
	$psw="QzAfqx2X8yEGJVUd";
	$bd="mosproyectos";
	*/
	$host="db723959734.db.1and1.com";
	$user="dbo723959734";
	$psw="QzAfqx2X8yEGJVUd";
	$bd="db723959734";

   $con = new mysqli($host,$user,$psw,$bd);
	if($con -> connect_errno){
		header("Location: login.html");
	}
	else{
		echo "Conectado...";
	}
   return $con;
}
?>
