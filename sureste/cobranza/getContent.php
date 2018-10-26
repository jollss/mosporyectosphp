<?php
include("../Config/library.php"); 
$idmos=$_GET['idmos'];
$con4 = Conectarse();
$sql4="SELECT * FROM os inner join dataos where idmos=id_orden and idmos = '$idmos'";
$resultado4=$con4->query($sql4);
while($row4 = $resultado4->fetch_assoc())
{
    ?>
    <div class="panel panel-primary">
      <div class="panel-heading">DATOS GENERALES DE LA ORDEN <?php echo $idmos;?></div>
      <div class="panel-body">
            <div style="height:600px;overflow-y:scroll;">
            <table class="table">
                <tr>
                    <th style="color:red;">FOLIO PISA: <?php echo $row4['folio_pisa'];?></th>
                    <th>COPE: <?php echo $row4['cope'];?></th>
                    <th>EXPEDIENTE: <?php echo $row4['expediente'];?></th>
                    <th>FECHA DE CARGA: <?php echo $row4['ddcarga']."/".$row4['mmcarga']."/".$row4['yearcarga'];?></th>
                    <th>FOLIO PISAPLEX: <?php echo $row4['folio_pisaplex'];?></th>
                </tr>
            </table>
            <table style="border:1px;" class="table">
                <tr>
                    <td>Telefono: <?php echo $row4['telefono'];?></td>
                    <td>Cliente: <?php echo $row4['cliente'];?></td>
                    <td>Tipo de Tarea: <?php echo $row4['tipo_tarea'];?></td>
                    <td>Distrito: <?php echo $row4['distrito'];?></td>
                    <td>Zona: <?php echo $row4['zona'];?></td>
                    <td>Dilacion Etapa: <?php echo $row4['dilacion_etapa'];?></td>
                    <td>Dilacion: <?php echo $row4['dilacion'];?></td>
                </tr>
            <?php
            $supervisor=$row4['usuario_idu'];
            $tecnico=$row4['tecnico_asignado_idu'];
            $con3 = Conectarse();
            $sql3="SELECT * FROM usuario where idu = '$supervisor'";
            $resultado3=$con3->query($sql3);
            while($row3 = $resultado3->fetch_assoc())
            {
                $ns=$row3['nombre'];
                $aps=$row3['apaterno'];
                $ams=$row3['amaterno'];
            }
            $con2 = Conectarse();
            $sql2="SELECT * FROM usuario where idu = '$tecnico'";
            $resultado2=$con2->query($sql2);
            while($row2 = $resultado2->fetch_assoc())
            {
                $nt=$row2['nombre'];
                $apt=$row2['apaterno'];
                $amt=$row2['amaterno'];
            }
            ?>
            <table class="table" style="border:solid; width='100%' ">
                <tr>
                    <th>Supervisor</th>
                    <td><?php echo $ns." ".$aps." ".$ams;?></td>
                    <th>Tecnico</th>
                    <td><?php echo $nt." ".$apt." ".$amt;?></td>
                </tr>
            </table>
            <table class="table" style="border:solid; width='100%' ">
                <tr>
                    <th>Estatus: <?php if ($row4['estatus']==0){echo "ABIERTA";} if($row4['estatus']==1){ echo "OBJETADA";}if($row4['estatus']==2){ echo "LIQUIDADA";}?></th>
                    <td>Observaciones: <?php echo $row4['observaciones'];?></td>
                    <th>Fecha de Cierre: <?php echo $row4['ddos']."/".$row4['mmos']."/".$row4['yearos']." ".$row4['horaos'];?></th>
                    <th style="color:red;">Tipo de orden: <?php echo $row4['tipo_os'];?></th>
                </tr>
            </table>
            <div style="height:200px;overflow-y:scroll;">
            <table>
                <tr>
            <?php
            $con1 = Conectarse();
            $sql1="SELECT * FROM adjunto_os where os_idos = '$idmos'";
            $resultado1=$con1->query($sql1);
            while($row1 = $resultado1->fetch_assoc())
            {
                //$idadjunto=$row1[''];
                $nombreimg=$row1['nombreimg'];
                ?>
                    <td>
                        <a href="../os/<?php echo $nombreimg;?>" target="_blank"><img src="../os/<?php echo $nombreimg;?>" height=100 width=100 ></a>
                    </td>
                <?php
            }
            ?>
                </tr>
            </table>
            </div>
            <table align="center">
                <tr>
                    <td>
                        <form action="osPDF.php" method="POST" target="_blank">
                            <input type="text" value="<?php echo $idmos;?>" name="idmos" style="display:none;" readonly="readonly">
                            <!--<input type="submit" class="btn btn-success" value="LIBERAR PARA TRABAJAR">-->
                            <input type="image" class="btn btn-default" src="../syspic/pdf_icon.png" width="70">
                            <label>GENERAR PDF</label>
                        </form>    
                    </td>
                    <td>
                        <form action="osPDFCARSO.php" method="POST" target="_blank">
                            <input type="text" value="<?php echo $idmos;?>" name="idmos" style="display:none;" readonly="readonly">
                            <!--<input type="submit" class="btn btn-success" value="LIBERAR PARA TRABAJAR">-->
                            <input type="image" class="btn btn-default" src="../syspic/carso.JPG" width="70">
                            <label>CARSO</label>
                        </form>
                    </td>
                </tr>
            </table>
        </div>
      </div>
    </div>
    <?php
}
//echo "Esta es la info externa ".$idmos;
?>