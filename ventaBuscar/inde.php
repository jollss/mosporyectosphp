<div align="center">
    <form accept-charset="utf-8" action="buscarVenta.php" method="GET">
	    <div class="form-group">
	        <input type="search" class="form-control"  placeholder="Ingresa dato a buscar" name="data">
	    </div>
	    <button type="submit" class="btn btn-primary">
	        buscar
	    </button>
    </form>
     <div id="resultadoBusqueda"></div>
</div>
<div class="panel-body" style="height:500px;overflow-x:scroll;">
    <?php
    if(isset($_GET['data'])){
    	$data=$_GET['data'];
        $con1 = Conectarse();
        $sql="SELECT * FROM venta WHERE folio_siac LIKE '%$data%' OR folio_ventas LIKE '%$data'";
        //echo $sql;
        $resultado=$con1->query($sql);
        ?>
        <table class="table">
        <tr>
            <th>VER</th>
            <th>EDITAR</th>
            <th>SIAC</th>
            <th>FOLIO VENTA</th>
            <th>CLIENTE</th>
            <th>DIRECCIÓN</th>
            <th>TEL1</th>
            <th>TEL2</th>
            <th>TEL3</th>
            <th>FECHA DE REGISTRO</th>
            <th>RFC</th>
            <th>CORREO</th>
        </tr>
        <?php
        while($row = $resultado->fetch_assoc())
        {
            $idv=$row['idventa'];
            $estatus=$row['estatus'];
        ?>
        <tr>
            <td><button type="button" class="btn btn-info btn-md bntmodal myBtn" name="valor" data-id="<?php echo $idv;?>" value="<?php echo $idv;?>">VER</button></td>
            <td>
            <?php
            if($estatus==0){
                ?>
                <form action="../validacion/inde.php" method="POST">
                    <input type="hidden" value="<?php echo $idv;?>" name="ident">
                    <button class="btn btn-warning">
                        EDITAR
                    </button>
                </form>
                <?php
            }if($estatus==1){
                ?>
                <form action="../validacion/inde.php" method="POST">
                    <input type="hidden" value="<?php echo $idv;?>" name="ident">
                    <button class="btn btn-warning">
                        EDITAR
                    </button>
                </form>
                <?php
            }
            ?>
            </td>
            <td><?php echo $row['folio_siac'];?></td>
            <td><?php echo $row['folio_ventas'];?></td>
            <td><?php echo $row['nombrev']." ".$row['apaternov']." ".$row['amaternov'];?></td>
            <td><?php echo $row['direccion'];?></td>
            <td><?php echo $row['telefono_1'];?></td>
            <td><?php echo $row['telefono_2'];?></td>
            <td><?php echo $row['telefono_3'];?></td>
            <td><?php echo $row['dia']."/".$row['mes']."/".$row['year']." ".$row['hora'];?></td>
            <td><?php echo $row['rfc_cliente'];?></td>
            <td><?php echo $row['correo_cliente'];?></td>
        </tr>
        <?php
        }
        ?>
        </table>
        <?php
    }if(!isset($_GET['data'])){
        ?>
        <div align="center">
            <h3>Ingresa FOLIO SIAC a buscar</h3>
        </div>
        <?php
    }
    ?>
</div>