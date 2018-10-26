<?php  
function Conectarse()  
{  
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