<?php
/*
    $host = "localhost";
    $basededatos = "assistance_control";
    $usuario="root";
    $contrasenia = "QzAfqx2X8yEGJVUd";
    $puerto="3306";
    */
    $host="db710921271.db.1and1.com";
    $usuario="dbo710921271";
    $contrasenia="QzAfqx2X8yEGJVUd";
    $basededatos="db710921271";
    $puerto="3306";
try{
    
    $bd = new PDO( "mysql:host=".$host.";dbname=".$basededatos.";port=".$puerto . ";charset=UTF8", $usuario, $contrasenia);
    
    //atributo para arrojar errores
    $bd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //echo "CONEXION LISTA bd registros";

}catch(PDOException $e){
    
    echo "<br>Ocurrio un error: -> ".$e->getMessage()."<br>";
    
}//catch
?>
<?php
    /*
    $host2 = "localhost";
    $basededatos2 = "v2";
    $usuario2="root";
    $contrasenia2 = "QzAfqx2X8yEGJVUd";
    $puerto2="3306";
    */
    $host2="db690630991.db.1and1.com";
    $usuario2="dbo690630991";
    $contrasenia2="QzAfqx2X8yEGJVUd";
    $basededatos2="db690630991";
    $puerto2="3306";
try{
    
    $bd2 = new PDO( "mysql:host=".$host2.";dbname=".$basededatos2.";port=".$puerto2 . ";charset=UTF8", $usuario2, $contrasenia2);
    
    //atributo para arrojar errores
    $bd2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    //echo "CONEXION LISTA";
    //echo "CONEXION LISTA bd usuarios";

}catch(PDOException $e){
    
    echo "<br>Ocurrio un error: -> ".$e->getMessage()."<br>";
    
}//catch
?>


