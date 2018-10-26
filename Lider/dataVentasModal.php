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

            $servicio=$row4['servicio'];
            $paquete=$row4['paquete'];
            $gastos_instalacion=$row4['gastos_instalacion'];
            $tiempo_instalacion=$row4['tiempo_instalacion'];
            $observaciones=$row4['observaciones'];

            $folio_siac=$row4['folio_siac'];
            $fecha_siac=$row4['fecha_siac'];
            $tienda_comercial=$row4['tienda_comercial'];
            $telefono_asignado=$row4['tel_asignado'];
            $folio_os=$row4['folio_os'];
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
    <table class="table">
        <tr>
            <th>Servicio</th>
            <th>Paquete</th>
            <th>Gastos de Instalación</th>
            <th>Tiempo Instalación</th>
            <th>Observaciones</th>
        </tr>
        <tr>
            <td><?php echo $servicio;?></td>
            <td><?php echo $paquete;?></td>
            <td><?php echo $gastos_instalacion;?></td>
            <td><?php echo $tiempo_instalacion;?></td>
            <td><?php echo $observaciones;?></td>
        </tr>
    </table>
    <table class="table">
        <tr>
            <th>Folio SIAC</th>
            <th>Fecha de Registro SIAC</th>
            <th>Tienda Comercial</th>
            <th>Teléfono Asignado</th>
            <th>Folio OS</th>
            <th></th>
        </tr>
        <tr>
            <td><?php echo $folio_siac;?></td>
            <td><?php echo $fecha_siac;?></td>
            <td><?php echo $tienda_comercial;?></td>
            <td><?php echo $telefono_asignado;?></td>
            <td><?php echo $folio_os;?></td>
        </tr>
    </table>
</section>
