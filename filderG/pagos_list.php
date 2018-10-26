<table class="table">
    <tr>
        <th></th>
        <th></th>
        <th>AREA</th>
        <th>ETAPA</th>
        <th>Folio SIAC</th>
        <th>Folio OS</th>
        <th>PAGADO</th>
        <th>Fecha Pago</th>
        <th></th>
        <th>Folio Venta</th>
        <th>Cliente</th>
        <th>Paquete Venta</th>
        <th>Registro de Venta</th>
    </tr>
    <?php
    $cont=0;
    $asignadov=0;
    $propio=0;
    $p389=0;
    $neto=0;
    include("funcion_pago.php");
    $start_date = $_GET['yi']."-".$_GET['mi']."-".$_GET['di'];//'2010-06-01';
    $end_date = $_GET['yf']."-".$_GET['mf']."-".$_GET['df'];//'2010-06-01';
    $sql="SELECT * FROM venta WHERE venta_pagada<>1 ORDER BY dia ASC,mes ASC, year ASC";
    $resultado=$con->query($sql);
    while($row = $resultado->fetch_assoc())
    {
        $pago_idu=$row['idvendedor'];
        $personal=$_GET['personal'];//vendedor
        $con3 = Conectarse();
        /*PROPIAS------------------------------------------------*/
        $sql3="SELECT * FROM equipos_fielder inner join usuario inner join tipo inner join areas_fielder inner join venta
        WHERE id_area=idarea and idvendedor='$personal' AND idvendedor=idu
        and idu=id_fielder and idtipo=tipo_idtipo ORDER BY tipo_idtipo DESC";
        $resultado3=$con3->query($sql3);
        while($row3 = $resultado3->fetch_assoc())
        {
            $n=$row3['nombre'];
            $ap=$row3['apaterno'];
            $nom_area=$row3['nom_area'];
            $tipo=$row3['tipo_idtipo'];
            $asignado=$row3['asignado'];
        }
        if(isset($n) and isset($ap)){
            $fecha_a_evaluar = $row['year']."-".$row['mes']."-".$row['dia'];//'2010-06-15';
            if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
                $cont++;
                $propio++;
                ?>
                <tr>
                    <th><?php echo $cont;?></th>
                    <th><?php echo "$200";?></th>
                    <th><?php echo $nom_area;?></th>
                    <th><?php echo $row['etapa'];?></th>
                    <th><?php echo $row['folio_siac'];?></th>
                    <th><?php echo $row['folio_os'];?></th>
                    <th>
                    <?php 
                        if($row['venta_pagada']==0){
                            echo "<label style='color:RED;'>SIN PAGO</label>";
                        }if($row['venta_pagada']==1){
                            echo "<label style='color:green;'>PAGADO</label>";
                        }
                    ?>
                    </th>
                    <th><?php echo $row['fecha_pago'];?></th>
                    <th><?php echo $n." ".$ap;?></th>
                    <th><?php echo $row['folio_ventas'];?></th>
                    <th><?php echo $row['nombrev']." ".$row['apaternov']." ".$row['amaternov'];?></th>
                    <th><?php echo $row['paquete_venta'];?></th>
                    <th><?php echo $row['dia']."/".$row['mes']."/".$row['year']." ".$row['hora'];?></th>
                </tr>
                <?php
                //}
                $neto=tipo_pago($row['paquete_venta'],$tipo,$neto,$asignado);
                $p389=contador_paquete($row['paquete_venta'],$p389);
            }
            
        }
        /*------------------------------------------------*/
        echo "<h2>TIPO:".$tipo."</h2>";
        /*ASIGNADO------------------------------------------------*/
        $sql3="SELECT * FROM equipos_fielder inner join usuario inner join tipo inner join areas_fielder inner join venta
        WHERE id_area=idarea  AND idvendedor=idu and asignado='$personal'
        and idu=id_fielder and idtipo=tipo_idtipo ORDER BY tipo_idtipo DESC";
        $resultado3=$con3->query($sql3);
        while($row3 = $resultado3->fetch_assoc())
        {
            $n=$row3['nombre'];
            $ap=$row3['apaterno'];
            $nom_area=$row3['nom_area'];
            //$tipo=$row3['tipo_idtipo'];
            $asignado=$row3['asignado'];
        }
        if(isset($n) and isset($ap)){
            $fecha_a_evaluar = $row['year']."-".$row['mes']."-".$row['dia'];//'2010-06-15';
            if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
                $cont++;
                $asignadov++;
                
                ?>
                <tr style="background-color:green;">
                    <th><?php echo $cont;?></th>
                    <th><?php echo "$50";?></th>
                    <th><?php echo $nom_area;?></th>
                    <th><?php echo $row['etapa'];?></th>
                    <th><?php echo $row['folio_siac'];?></th>
                    <th><?php echo $row['folio_os'];?></th>
                    <th>
                    <?php 
                        if($row['venta_pagada']==0){
                            echo "<label style='color:RED;'>SIN PAGO</label>";
                        }if($row['venta_pagada']==1){
                            echo "<label style='color:green;'>PAGADO</label>";
                        }
                    ?>
                    </th>
                    <th><?php echo $row['fecha_pago'];?></th>
                    <th><?php echo $n." ".$ap;?></th>
                    <th><?php echo $row['folio_ventas'];?></th>
                    <th><?php echo $row['nombrev']." ".$row['apaternov']." ".$row['amaternov'];?></th>
                    <th><?php echo $row['paquete_venta'];?></th>
                    <th><?php echo $row['dia']."/".$row['mes']."/".$row['year']." ".$row['hora'];?></th>
                </tr>
                <?php
                $neto=tipo_pago($row['paquete_venta'],$tipo,$neto,$asignado);
                $p389=contador_paquete($row['paquete_venta'],$p389);
                //}
            }
            
        }
        /*------------------------------------------------*/
    }
    ?>
</table>