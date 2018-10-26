<?php
function Conectarse()
{
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
