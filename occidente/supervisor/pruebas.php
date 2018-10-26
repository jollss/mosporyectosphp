<?php
include("../Config/library.php"); 
$con = Conectarse(); 
$con->real_query("SELECT * FROM os");
$resultado = $con->use_result();
while ($row = $resultado->fetch_assoc()){
    $aux=$row['idmos'];
    if ($row['idmos']==($aux+1)) {
    	echo $row['idmos'];
    }
}
echo "string";
?>