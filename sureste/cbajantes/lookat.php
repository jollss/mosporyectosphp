<?php
include("../Config/library.php");
$con = Conectarse();  
$q=$_POST['q'];
$sql1="SELECT * FROM ventas 
WHERE folio_ventas LIKE '%".$q."%'  
OR nombre LIKE '".$q."%'";
$resultado=$con->query($sql1);
if(mysqli_num_rows($resultado)==0){
	echo '<font color = "FF0000"><b><H1>No hay sugerencias</H1></b></font>';
}
else{
	?>
	<form action="dataVenta.php" method="POST">
        <div class="table-responsive">
            <table class="table table-bordered" style="background-color:white;">
                <tr>
                	<th></th>
                	<th>Folio Venta</th>
                  	<th>CLIENTE</th>
                  	<th>DIRECCIÓN</th>
                  	<th>DETALLES</th>
                  	<th>TELÉFONO</th>
                  	<th>FECHA DE REGISTRO</th>
                </tr>
				<?php
				echo '<b>Datos encontrados</b><br />';
				while($row = $resultado->fetch_assoc())
				{
					$estatus=$row['estatus'];
					$idventa=$row['idventa'];
					if($estatus==1){
						$filder=new Filder();
                        $filder->obtenerFilderVBD($idventa,$con);
                        $idfilder=$filder->regresaIdFilder();
                        $contesto=$filder->regresaContesto();
                        
                        $siac=new Foliosiac();
                        $siac->obtenerSiacBD($idfilder,$con);
                        $fsiac=$siac->regresaIdFilder();
                        	if($contesto=='SI' && $fsiac==$idfilder)
                        	{
                        		$tienda= new TiendaComercial();
                                $tienda->obtenerTiendaBD($idfilder,$con);
                                //$tienda->verTienda();
                                $idtienda=$tienda->regresaIdVenta();
                        		if($idtienda!=''){
								?> 
				                   	<tr style="font-size:10px;">
				                   		<th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $row['idventa'];?>"></th>
				                   		<th><?php echo $row['folio_ventas'];?></th>
				                   		<th><?php echo $row['nombre']." ".$row['apaternov'];?></th>
				                   		<th><?php echo $row['direccion'];?></th>
				                   		<th><?php echo $row['datos'];?></th>
				                   		<th><a href="tel:<?php echo $row['telefono_1'];?>"><?php echo $row['telefono_1'];?></a></th>
				                   		<th><?php echo $row['dia']."/".$row['mes']."/".$row['year']." ".$row['hora'];?></th>
				                    </tr>  
								<?php
								}
							}
					}else{
					}
				}
				?>
			</table>
        </div>
    </form>
	<?php
}
?>