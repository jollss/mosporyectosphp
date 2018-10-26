<?php
include("../Config/library.php");
$idos=$_POST['ident'];
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
if(!isset($_GET['year']) and !isset($_GET['month'])){
	date_default_timezone_set('America/Mexico_City');
	$dia=date('j');
	$mes=date('n');
	$aaaa=date('Y');
	$hora = date("g");
	$min = date("i");
}if(isset($_GET['year']) and isset($_GET['month'])){
	$dia=date('j');
	$mes=$_GET['month'];
	$aaaa=$_GET['year'];
	$aaaa2=date('Y');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/slider.css" rel="stylesheet">
    <script src="../js/jquery.min.js"></script>

<?php
    nivel1($user);
?>	
</head>
<body>
<br><br><br><br>
<div class="col-md-12">
    <div class="panel panel-primary">
      <div class="panel-heading">Ordenes Pagadas (POR ACTUALIZAR)</div>
      <div class="panel-body">
        <div class="panel panel-default">
          <div class="panel-body">
            Los pagos registrados que aparecen en esta sección pueden no estar actualizados ya que es una nueva sección donde podras verificar tus ordenes pagadas o enviadas a pago.
          </div>
        </div>
        <!-------------------------------------->
        <div align="center">
        <form action="a_pago.php" method="GET">
        <h3>Ordenes Pagadas por mes</h3>
        <table>
	        <tr>
	        	<td>
		        	<select name="month" class="form-control">
		        		<option value="1">ENERO</option>
		        		<option value="2">FEBRERO</option>
		        		<option value="3">MARZO</option>
		        		<option value="4">ABRIL</option>
		        		<option value="5">MAYO</option>
		        		<option value="6">JUNIO</option>
		        		<option value="7">JULIO</option>
		        		<option value="8">AGOSTO</option>
		        		<option value="9">SEPTIEMBRE</option>
		        		<option value="10">OCTUBRE</option>
		        		<option value="11">NOVIEMBRE</option>
		        		<option value="12">DICIEMBRE</option>
		        	</select> 
	        	</td>
	        	<td>
	        		<input type="number" min="1990" max="<?php echo $aaaa2;?>" name="year" value="<?php echo $aaaa;?>" class="form-control">
	        	</td>
	        	<td>
	        		<button type="submit" class="btn btn-primary">VER</button>
	        	</td>
	        </tr>
        </table>
        </form>
        </div>
        <div  style="height:500px;overflow-y:scroll;">
            <table class="table">
            <tr>
                <th>Contador</th>
                <th>Folio Pisa</th>
                <th>Teléfono</th>
                <th>Cliente</th>
                <th>Tipo de tarea</th>
                <th>Tipo de OS</th>
                <th>Fecha de liquidación</th>
                <th>Fecha de Pago</th>
            </tr>
            <?php 
            $conta=0;
            $date=$mes."/".$aaaa;
            $sql1="SELECT * from os inner join validar_os inner join dataos
            where folio_pisa=id_folio_pisa and idmos=id_orden and a_cobro=1 and asignado='$iduser' and fecha_cobranza like '%".$date."%' ORDER BY fecha_cobranza";//and mmos='$mes' and yearos='$aaaa' ORDER BY fecha_cobranza";//mmos DESC, yearos desc, ddos DESC";
            $resultado=$con->query($sql1);
            while($row = $resultado->fetch_assoc())
            {
                $conta=$conta+1;
                echo "<tr>";
                echo "<td>".$conta."</td>";
                echo "<td>".$row['folio_pisa']."</td>";
                echo "<td>".$row['telefono']."</td>";
                echo "<td>".$row['cliente']."</td>";
                echo "<td>".$row['tipo_tarea']."</td>";
                echo "<td>".$row['tipo_os']."</td>";
                echo "<td>".$row['ddos']."/".$row['mmos']."/".$row['yearos']." ".$row['horaos']."</td>";
                echo "<td>".$row['fecha_cobranza']."</td>";
                echo "</tr>";
            }
            ?>
            </table>
        </div>
      </div>
    </div>
</div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>