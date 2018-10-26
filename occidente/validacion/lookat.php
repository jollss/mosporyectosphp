<?php
include("../Config/library.php");
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];  
$q=$_POST['q'];

//$sql1="SELECT * FROM usuario WHERE idu LIKE '%".$q."%' AND tipo<>5 OR nombre LIKE '%".$q."%' ORDER BY nombre";
$sql1="SELECT * FROM ventas 
                    WHERE folio_ventas LIKE '".$q."%'  
                    ";
					$resultado=$con->query($sql1);
					
/*==================================================================*/
					if(mysqli_num_rows($resultado)==0){
						echo '<font color = "FF0000"><b><H1>No hay sugerencias</H1></b></font>';
					}
					else{
						?>
						<form action="dataVenta.php" method="POST">
		                    <div class="table-responsive">
		                        <table class="table table-bordered" style="background-color:white;">
		                            <tr>
		                              <th>NO. DE SOLICITUD</th>
		                              <th>CLIENTE</th>
		                              <th>TELEFONO</th>
		                              <th>VER MÁS</th>
		                            </tr>
						<?php
						echo '<b>Datos encontrados</b><br />';
						while($row = $resultado->fetch_assoc())
						{
/*=========================================================================*/							
						?> 
		                   	<tr>
		                        <th><?php echo $row['folio_ventas'];?></th>		                        
		                        <th><?php echo $row['nombre']." ".$row['apaternov']." ".$row['amaternov'];?></th>		                        
		                        <th><?php echo $row['telefono_1'];?></th>
		                        <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $row['idventa'];?>"></th>
		                    </tr>
		                        
						<?php
/*=========================================================================*/							 					
						}
						?>
						</table>
		                    </div>
		                </form>
						<?php
					}
?>