<?php
include("library2.php"); 
$con = Conectarse(); 
?>
<!DOCTYPE html>
<html>
<head>
	<title>CONSULTA SQL</title>
</head>
<body>
<?php
if(!isset($_GET['consultar'])){
	$_GET['consultar']="";
}
if($_GET['consultar']==""){ 
	//echo "Consulta: ".$sql."<br>";
}
else{
	$sql=$_GET['consultar'];
/*-------------------------------------------------------------------------*/
	$mysqli = $con;
	$mysqli->real_query($_GET['consultar']);
		if ($mysqli->field_count) {
		    /* this was a select/show or describe query */
		    $result = $mysqli->store_result();
		    /* process resultset */
		    $rows = $result->fetch_row();
		    /* free resultset */
		    $result->close();
		}
/*-------------------------------------------------------------------------*/
	/* ejecutar multi consulta */
	if (mysqli_multi_query($con, $_GET['consultar'])) {
	    do {
	        /* almacenar primer juego de resultados */
	        if ($result = mysqli_store_result($con)) {
	        	
	            while ($row = mysqli_fetch_row($result)) {
	                //printf("%s\n", $row[0]." ".$row[1]." ".$row[2]." ".$row[3]." ".$row[4]." ".$row[5]."<br>");
	                echo('<pre>');
	                var_dump($row);
	                echo('</pre>');
	            }
	            mysqli_free_result($result);
	        }
	        /* mostrar divisor */
	        if (mysqli_more_results($con)) {
	            printf("-----------------\n");
	        }
	    } while (mysqli_next_result($con));
	}
}
echo "Consulta: ".$_GET['consultar']."<br>";
?>
	<form action="consulta.php" method="GET">
		<textarea name="consultar" style="resize:none;" cols="50" rows="5"></textarea>
		<input type="submit" value="CONSULTAR">
	</form>
</body>
</html>