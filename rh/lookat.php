<?php
include("../Config/conexion2.php");  
require_once '../Config/conexion.php';
$con = Conectarse();  
$q=$_POST['q'];
$nivel0="OTRO";
$nivel1="TECNICO";
$nivel2="RH";
$nivel3="SUPERVISOR";
$nivel4="VERIFICADOR";
$nivel5="GERENCIAL";
$nivel6="SOPORTE";
//$sql1="SELECT * FROM usuario WHERE idu LIKE '%".$q."%' AND tipo<>5 OR nombre LIKE '%".$q."%' ORDER BY nombre";
$sql1="SELECT * FROM usuario INNER JOIN tipo 
                    WHERE usuario.tipo_idtipo=tipo.idtipo AND activo=1 AND idu LIKE '%".$q."%'  
                    OR nombre LIKE '%".$q."%' and usuario.tipo_idtipo=tipo.idtipo
                    AND idtipo<>5";
					$resultado=$con->query($sql1);
					
/*==================================================================*/
					if(mysqli_num_rows($resultado)==0){
						echo '<font color = "FF0000"><b><H1>No hay sugerencias</H1></b></font>';
					}
					else{
						?>
						<form action=" data.php" method="POST">
		                    <div class="table-responsive">
		                        <table class="table table-bordered" style="background-color:white;">
		                            <tr>
		                              <th>Nombre Completo</th>
		                              <th>Correo</th>
		                              <th>Tipo</th>
		                              <th>Celular</th>
		                              <th>ID</th>
		                              <th>Estado</th>
		                            </tr>
						<?php
						echo '<b>Datos encontrados</b><br />';
						while($row = $resultado->fetch_assoc())
						{
/*=========================================================================*/							
						?> 
		                   	<tr>
		                   		<th><?php echo $row['nombre']." ".$row['apaterno']." ".$row['amaterno'];?></th>
		                        <th><?php echo $row['correo'];?></th>		                        
		                        <th><?php echo $row['tipo'];?></th>		                        
		                        <th><?php echo $row['cel'];?></th>
		                        <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $row['idu'];?>"></th>
		                        <th><?php if($row['activo']==1){echo "ACTIVO";}if($row['activo']==0){echo "INACTIVO";}?></th>
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