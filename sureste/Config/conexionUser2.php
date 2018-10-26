<?php
function Conectarse()
{
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
