<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$con4 = Conectarse();  
$dato=$_GET['id'];
?>
<?php
        //var_dump($porciones);
        //$sql4="SELECT * FROM ventas where '$dato'=idvendedor AND mes='$mes' ORDER BY mes DESC,year DESC, dia DESC";
        $sql4="SELECT * FROM venta 
        WHERE   idventa='$dato' ";
        $resultado4=$con4->query($sql4);
        while($row4 = $resultado4->fetch_assoc())
        {
            $ventaid=$row4['idventa'];
            $folio_ventas=$row4['folio_ventas'];
            $tipo_cliente=$row4['tipo_cliente'];
            $nombrev=$row4['nombrev'];
            $apaternov=$row4['apaternov'];
            $amaternov=$row4['amaternov'];
            $direccion=$row4['direccion'];
            $telefono_1=$row4['telefono_1'];
            $telefono_2=$row4['telefono_2'];
            $telefono_3=$row4['telefono_3'];
            $dia=$row4['dia'];
            $mes=$row4['mes'];
            $year=$row4['year'];
            $hora=$row4['hora'];
            $correo_cliente=$row4['correo_cliente'];
            $rfc_cliente=$row4['rfc_cliente'];
        }
        ?>
<div align="center">
<img src="../syspic/logo.png">
</div>
<section class="row" style="height:500px;overflow-x:scroll;">
	<table class="table">
		<tr>
			<th>Folio Venta</th>
			<th>Tipo de Cliente</th>
			<th>Cliente</th>
			<th>Dirección</th>
			<th>Tel1</th>
			<th>Tel2</th>
			<th>Tel3</th>
			<th>Fecha de venta</th>
			<th>Correo</th>
			<th>RFC</th>
		</tr>
		<tr>
            <td><?php echo $folio_ventas;?></td>
            <td><?php echo $tipo_cliente;?></td>
            <td><?php echo $nombrev." ".$apaternov." ".$amaternov;?></td>
            <td><?php echo $direccion;?></td>
            <td><?php echo $telefono_1;?></td>
            <td><?php echo $telefono_2;?></td>
            <td><?php echo $telefono_3;?></td>
            <td><?php echo $dia."/".$mes."/".$year." ".$hora;?></td>
            <td><?php echo $correo_cliente;?></td>
            <td><?php echo $rfc_cliente;?></td>
        </tr>
	</table>
</section>
