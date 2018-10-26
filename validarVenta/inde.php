<?php
function  selectEtapa($etapa){
            if($etapa=='COMERCIAL' or $etapa=='C'){
                ?>
                <label class="btn btn-default"><?php echo $etapa;?></label>
                <?php
            }if($etapa=='SOLICITUD DUPLICADA'){
                ?>
                <label class="btn btn-warning"><?php echo $etapa;?></label>
                <?php
            }if($etapa=='CANCELADA' OR $etapa=='X'){
                ?>
                <label class="btn btn-danger"><?php echo $etapa;?></label>
                <?php
            }if($etapa=='P' OR $etapa=='POSTEADO'){
                ?>
                <label class="btn btn-success" style="background-color: blue !important;"><?php echo $etapa;?></label>
                <?php
            }
            if($etapa=='DEMANDA/INFRAESTRUCTURA' or $etapa=='ID'){
                ?>
                <label class="btn btn-primary"><?php echo $etapa;?></label>
                <?php
            }if($etapa=='ABIERTA' OR $etapa=='I'){
                ?>
                <label class="btn btn-success" style="background-color: DarkCyan  !important;"><?php echo $etapa;?></label>
                <?php
            }if($etapa=='ADEUDO' or $etapa=='CC'){
                ?>
                <label class="btn btn-success" style="background-color: DarkSlateBlue  !important;"><?php echo $etapa;?></label>
                <?php
            }if($etapa=='1'){
                ?>
                <label style="background-color: DarkSlateBlue  !important;color:white !important;">SIN VALIDAR</label>
                <?php
            } 
            

            /*if($etapa<>'ADEUDO' OR $etapa<>'ABIERTA' OR $etapa<>'DEMANDA/INFRAESTRUCTURA' OR $etapa<>'P' OR $etapa<>'CANCELADA' OR $etapa<>'SOLICITUD DUPLICADA' OR $etapa<>'COMERCIAL'){
                ?>
                <label class="btn" style="background-color: DarkSlateBlue  !important;"><?php echo $etapa;?></label>
                <?php
            }*/
        }
        if(isset($_GET['etapaget'])){
        	selectEtapa($_GET['etapaget']);
        }
?>
<!--
<style type="text/css">
    thead, tbody { display: block; }
tbody {
    height: 200px;
    overflow-y: auto;
    overflow-x: hidden;
}
-->
</style>
<form method="GET" action="<?php echo $main;?>">
    <select name="etapaget" class="form-control">
        <option value="1"><label class="btn btn-success" >SIN VALIDAR</label></option>
        <option value="ABIERTA"><label class="btn btn-success" style="background-color: DarkCyan  !important;">ABIERTA</label></option>
        <option value="COMERCIAL"><label class="btn btn-default">COMERCIAL</label></option>
        <option value="SOLICITUD DUPLICADA"><label class="btn btn-warning">SOLICITUD DUPLICADA</label></option>
        <option value="CANCELADO"><label class="btn btn-danger">CANCELADO</label></option>
        <option value="P"><label class="btn btn-success" style="background-color: blue !important;">POSTEADO</label></option>
        <option value="DEMANDA/INFRAESTRUCTURA"><label class="btn btn-primary">DEMANDA/INFRAESTRUCTURA</label></option>
    </select>
    <button class="btn">VER</button>
</form>

<div class="col-md-12">
    <section class="row" style="height:500px;overflow-x:scroll;">
                <table class="table" border="2">
                <thead style="">
                <tr id="m-header">
                    <th></th>
                    <th>FOLIO VENTA</th>
                    <th>ETAPA</th>
                    <th>AREA</th>
                    <th>SIAC</th>
                    <th>NOMBRE CLIENTE</th>
                    <th>DIRECCION</th>
                    <th>TELEFONO 1</th>
                    <th>TELEFONO 2</th>
                    <th>TELEFONO 3</th>
                    <th>CORREO</th>
                    <th>TIPO DE CLIENTE</th>
                    <th>FECHA DE REGISTRO</th>
                    <th>¿QUIEN VENDIO?</th>
                </tr>
                </thead>
                <tbody>
        <?php 
        

        if(!isset($_GET['area'])){
                if(isset($_GET['etapaget'])){
                    $etapaget=$_GET['etapaget'];
                    if($etapaget=='' or $etapaget===''){
                        $sql2="SELECT * FROM venta WHERE estatus=1 and contesto='SI' AND idvendedor<>0 AND etapa= '' order by area desc";        
                    }if(!is_numeric($etapaget)){
                        $sql2="SELECT * FROM venta WHERE  etapa = '".$etapaget."' order by area desc";    
                    }if(is_numeric($etapaget)){
                    	if($etapaget==1){
	                        $sql2="SELECT * FROM venta WHERE contesto='' and etapa=''";    
	                    }
                    }
                    
                }if(!isset($_GET['etapaget'])){
                    $sql2="SELECT * FROM venta WHERE contesto='' and etapa=''";    
                }
                //echo $_GET['etapaget'];
                //echo $sql2;
                $cnt=0;
                $resultado2=$con2->query($sql2);
                while($row2 = $resultado2->fetch_assoc())
                {
                    
                    //if($row2['etapa']<>'P' AND $row2['etapa']<>'POSTEADO'){
                        $n='';$ap='';$am='';
                    $fielderid=$row2['idvendedor'];
                    //echo $fielderid;
                    $folio_os=$row2['folio_os'];
                    $sql3="SELECT * FROM usuario WHERE idu='$fielderid'";
                    $resultado3=$con3->query($sql3);
                    while($row3 = $resultado3->fetch_assoc())
                    {
                        $n=$row3['nombre'];
                        $ap=$row3['apaterno'];
                        $am=$row3['amaterno'];
                    }

                    ?>
                    <tr>
                        <td><?php echo $cnt;?></td>
                        <td>
                        <?php
                        if($folio_os<>''){
                        ?>
                        <form action="../validacion/inde.php" method="POST">
                        <input type="hidden" value="<?php echo $row2['idventa'];?>" name="ident">
                            <button class="btn btn-success" type="submit" >
                               <?php echo $row2['folio_ventas'];?> 
                            </button>
                        </form>
                        <?php
                        }if($folio_os==''){
                        ?>
                        <form action="../validacion/inde.php" method="POST">
                        <input type="hidden" value="<?php echo $row2['idventa'];?>" name="ident">
                            <button class="btn btn-danger" type="submit" >
                               <?php echo $row2['folio_ventas'];?> 
                            </button>
                        </form>
                        <?php
                        }
                        ?>
                        </td>
                        <td><?php selectEtapa($row2['etapa']);?></td>
                        <td><?php echo $row2['area'];?></td>
                        <td><?php echo $row2['folio_siac'];?></td>
                        <td><?php echo $row2['dia']."/".$row2['mes']."/".$row2['year']." ".$row2['hora'];?></td>
                        <td><?php echo $fielderid."-".$n." ".$ap." ".$am;?></td>
                        <td><?php echo $row2['nombrev']." ".$row2['apaternov']." ".$row2['amaternov'];?></td>
                        <td><?php echo $row2['direccion'];?></td>
                        <td><?php echo $row2['telefono_1'];?></td>
                        <td><?php echo $row2['telefono_2'];?></td>
                        <td><?php echo $row2['telefono_3'];?></td>
                        <td><?php echo $row2['correo_cliente'];?></td>
                        <td><?php echo $row2['tipo_cliente'];?></td>
                        
                    </tr>
                    <?php
                    //}
                    $cnt=$cnt+1;
                }
            
        }
        ?>
                </tbody>
        </table>
    </section>
</div>