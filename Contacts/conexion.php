<?php 
/*
    $host = "localhost";
    $basededatos = "electronic_wallet";
    $usuario="root";
    $contrasenia = "QzAfqx2X8yEGJVUd";
    */
    $puerto="3306";
    $host="db690630991.db.1and1.com";
    $usuario="dbo690630991";
    $contrasenia="QzAfqx2X8yEGJVUd";
    $basededatos="db690630991";

try{
    
    $bd = new PDO( "mysql:host=".$host.";dbname=".$basededatos.";port=".$puerto . ";charset=UTF8", $usuario, $contrasenia);
    
    //atributo para arrojar errores
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //echo "CONEXION LISTA";

}catch(PDOException $e){
    
    echo "<br>Ocurrio un error: -> ".$e->getMessage()."<br>";
    
}//catch
?>