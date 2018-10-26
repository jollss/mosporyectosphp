<?php
include("../Config/conexion2.php");  
require_once '../Config/conexion.php';
$con = Conectarse();  
$q=$_POST['q'];
$nivel1="TECNICO";
$nivel2="RH";
$nivel3="SUPERVISOR";
$nivel4="VERIFICADOR";
$nivel5="GERENCIAL";
$nivel6="SOPORTE";
$sql1="SELECT * FROM call_center WHERE id_callc LIKE '%".$q."%' 
OR nombre_cli LIKE '%".$q."%' 
OR distrito LIKE '%".$q."%' 
OR cope LIKE '%".$q."%' 
OR expediente LIKE '%".$q."%'
ORDER BY id_callc";
					$resultado=$con->query($sql1);
					if(mysqli_num_rows($resultado)==0){
					echo '<font color = "FF0000"><b><H1>No hay sugerencias</H1></b></font>';
					}
					else{
						?>
						<form action="" method="POST">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tr style="color:green;">
                                      <th>ID</th>
                                      <th>Consecutivo</th>
                                      <th>COPE</th>
                                      <th>EXPEDIENTE</th>
                                      <th>TELÉFONO</th>
                                      <th>CLIENTE</th>
                                      <th>DISTRITO</th>
                                      <th>SUPERVISOR</th>
                                      <th>TECNICO</th>
                                      <th>ESTATUS</th>
                                      <th>LLAMADA</th>
                                    </tr>
                        <?php
                        echo '<b>Datos encontrados</b><br />';
                        while($row = $resultado->fetch_assoc())
                        {
                        ?> 
                            <tr>
                                <th><?php echo $row['id_callc'];?></th>
                                <th><?php echo $row['consecutivo'];?></th>
                                <th><?php echo $row['cope'];?></th>
                                <th><?php echo $row['expediente'];?></th>
                                <th><?php echo $row['telefono'];?></th>                                
                                <th><?php echo $row['nombre_cli'];?></th>
                                <th><?php echo $row['distrito'];?></th>
                                <th><?php echo $row['supervisor'];?></th>
                                <th><?php echo $row['tecnico'];?></th>
                                <th><?php echo $row['estatus'];?></th>
                                <?php 
                                  if($row['estado_call']==3){echo "<th style='color:white;' class='btn btn-danger'>SIN RESPUESTA</th>";}
                                  if($row['estado_call']==2){echo "<th style='color:white;' class='btn btn-warning'>PENDIENTE</th>";}
                                  if($row['estado_call']==1){echo "<th style='color:white;' class='btn btn-success'>FINALIZADO</th>";}?>
                            </tr>
                        <?php
                        }
                        ?>
                        </table>
                            </div>
                        </form>
						<?php
					}
?>