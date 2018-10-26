<?php
include("../Config/library.php"); 
date_default_timezone_set('America/Mexico_City');
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$yo=new Usuario();
$yo->obtenerUsuarioCorreoBD($mail,$con);
$idyo=$yo->regresaIdu();
if(!isset($_POST['iduser'])){
    $id=$_GET['iduser'];
    $ls=$_GET['ls'];
}if(!isset($_GET['iduser'])){
    $id=$_POST['iduser'];
}
function dia_semana_real($dia,$mes,$aaaa){
    $semana1 = date('W',  mktime(0,0,0,$mes,$dia,$aaaa)); 
    return $semana1;
}
$estandar=1.5;
$estandarobj=0.2;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--<meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">-->
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="../js/browserDigital.js"></script>
        <script src="../js/jquery-3.2.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<?php
    digital($user);
?>  
</head>
<body>
<br><br><br><br>
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">
        <a href="inde.php"><img src="../syspic/back.png" width="60" height="60"></a>
        <?php
        //echo $id." ";
        $semanas = date("W");
            $con = Conectarse();
            $sql="SELECT * FROM usuario WHERE idu='$id'";
            $resultado=$con->query($sql);
            while($row = $resultado->fetch_assoc())
            {
                $name=$row['nombre'];
                $ap=$row['apaterno'];
                $am=$row['amaterno'];
            }
            echo $name." ".$ap." ".$am;
            echo "<br>(Semana actual ".$semanas.")";
        ?>
        </div>
        <?php
        if(!isset($_GET['semana'])){
            $dia=date('j');
            $mes1=date('n');
            $aaaa=date('Y');
            $semana=dia_semana_real($dia,$mes1,$aaaa);
            ?>
            <div class="panel-body table-responsive" style="font-size:12px;">
                <div class="col-md-3"></div>
                <div class="panel panel-primary col-md-6" align="center">
                    <form>
                        <input type="number" class="form-control" name="semana" min=1 max=52 placeholder="Numero de SEMANA (1-52)" required>
                        <input type="number" step="0.1" class="form-control" name="ls" min=0 placeholder="LITROS X OS LIQUIDADA" required>
                        <input type="number" step="0.1" class="form-control" name="lso" min=0 placeholder="LITROS X OS OBJETADA" required>
                        <input type="hidden" value="<?php echo $id;?>" name="iduser">
                        <button class="btn btn-primary" type="submit">BUSCAR</button>
                    </form>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-6">
                <?php
                    //echo $semana;
                    $liqu=0;
                    $obj=0;
                    $auxl=0;
                    $auxo=0;
                    $con2 = Conectarse();
                    $sql2="SELECT * FROM os inner join dataos 
                    WHERE idmos=id_orden and asignado ='$id' 
                    and tecnico_asignado_idu='$id'";
                    $resultado2=$con2->query($sql2);
                ?>
                    <div style="height:350px;overflow-y:scroll;">
                        <table class="table">
                            <tr>
                                <th></th>
                                <th>SEMANA</th>
                                <th>FECHA</th>
                                <th>FOLIO</th>
                                <th>TIPO DE ORDEN</th>
                                <th>TECNICO</th>
                                <th>MODO</th>
                            </tr>
                            <?php
                            while($row2 = $resultado2->fetch_assoc())
                            {
                                $estatus=$row2['estatus'];
                                $ddos=$row2['ddos'];
                                $mmos=$row2['mmos'];
                                $yearos=$row2['yearos'];
                                $evaluar=$yearos."-".$mmos."-".$ddos;
                                $folio_ps=$row2['folio_pisa'];
                                $tipo=$row2['tipo_os'];
                                //$estatus=$row2['estatus'];
                                $ver=dia_semana_real($ddos,$mmos,$yearos);
                                if($semana<>$ver){}if($semana==$ver){
                                    
                                    if($estatus==1){
                                        $auxo=$auxo+1;
                                        ?>
                                        <tr>
                                            <td><?php echo $aux;?></td>
                                            <td><?php echo $ver;?></td>
                                            <td><?php echo $evaluar;?></td>
                                            <td><?php echo $folio_ps;?></td>
                                            <td><?php echo $tipo;?></td>
                                            <td><?php echo $name." ".$ap." ".$am;?></td>
                                            <td style="color:red;font-weight: bold;"> OBJETADA</td>
                                        </tr>
                                        <?php
                                    }if($estatus==2){
                                        $auxl=$auxl+1;
                                        ?>
                                        <tr>
                                            <td><?php echo $aux;?></td>
                                            <td><?php echo $ver;?></td>
                                            <td><?php echo $evaluar;?></td>
                                            <td><?php echo $folio_ps;?></td>
                                            <td><?php echo $tipo;?></td>
                                            <td><?php echo $name." ".$ap." ".$am;?></td>
                                            <td style="color:green; font-weight: bold;"> LIQUIDADA</td>
                                        </tr>
                                        <?php
                                    }
                                }
                            }
                            //echo $aux;
                            ?>
                        </table>
                    </div>
                    <div style="background-color:#ADFF2F" class="col-md-12">
                    <table>
                        <tr>
                            <th>Total de OS: <h3><?php echo $auxl+$auxo;?></h3></th>
                        </tr>
                        <tr>
                            <th>
                                Total de LITROS UTILIZADOS LIQUIDACION(<?php echo $estandar;?> Lts x OS): 
                                <h3>
                                <?php 
                                    $uso=$estandar*$auxl;
                                    echo $uso." litros";
                                ?>
                                </h3>
                            </th>
                        </tr>
                        <tr>
                            <th>
                                Total de LITROS UTILIZADOS OBJECION(<?php echo $estandarobj;?> Lts x OS): 
                                <h3>
                                <?php 
                                    $uso2=$estandarobj*$auxo;
                                    echo $uso2." litros";
                                ?>
                                </h3>
                            </th>
                        </tr>
                        <tr>
                        	<th>
                        		TOTALES = <?php echo $uso+$uso2;?>
                        	</th>
                        </tr>
                    </table>
                    </div>
                </div>
                <div class="col-md-6" align="center" style="border:solid;">
                    <form action="getContent.php" method="GET">
                        <input type="number" step="0.1" name="ls_asig" min=1 placeholder="GASOLINA ASIGNADA" class="form-control" required>
                        <input type="text" name="coment" placeholder="COMENTARIO" class="form-control" required>
                        <input type="hidden" step="0.1" class="form-control" name="ls" min=0  value="<?php echo $estandar;?>" placeholder="LITROS X OS"  required>
                        <input type="hidden" value="<?php echo $id;?>" name="iduser"><!--tecnico-->
                        <input type="hidden" value="<?php echo $semana;?>" name="semana"><!--tecnico-->
                        <input type="hidden" value="<?php echo $estandar;?>" name="lsxos"><!--litros por os liquidada-->
                        <input type="hidden" value="<?php echo $estandarobj;?>" name="lsxosobj"><!--litros por os obj-->
                        <input type="hidden" value="<?php echo $auxl;?>" name="noos"><!--numero de os-->
                        <input type="hidden" value="<?php echo $auxo;?>" name="nooso"><!--numero de os-->
                        <!--<input type="hidden" value="<?php echo $aux;?>" name="noos">-->
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </button>
                    </form>
                    <div style="height:350px;overflow-y:scroll;">
                        <table class="table">
                            <tr>
                                <th>No de Ordenes</th>
                                <th>Fecha</th>
                                <th>COMENTARIO</th>
                                <th>GASOLINA ASIGNADA</th>
                                <th>Semana</th>
                                <th></th>
                            </tr>
                        <?php
                        $con3 = Conectarse();
                        $sql3="SELECT * FROM gasolina_os WHERE tecnico_gas='$id'";
                        $resultado3=$con3->query($sql3);
                        while($row3 = $resultado3->fetch_assoc())
                        {
                            ?>
                            <tr>
                                <td><?php echo $row3['no_os_gas'];?></td>
                                <td><?php echo $row3['dd_gas']."/".$row3['mm_gas']."/".$row3['year_gas']." ".$row3['hora_gas'];?></td>
                                <td><?php echo $row3['comentario_gas'];?></td>
                                <td><?php echo $row3['lts_calculados_gas']." Lts";?></td>
                                <td><?php echo $row3['semana'];?></td>
                                <?php
                                $asino=$row3['asigna_gas'];
                                $con4 = Conectarse();
                                $sql4="SELECT * FROM usuario where idu='$asino'";
                                $resultado4=$con4->query($sql4);
                                while($row4 = $resultado4->fetch_assoc())
                                {
                                    ?>
                                    <td><?php echo $row4['nombre']." ".$row4['apaterno'];?></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <?php
                        }
                        ?>
                        </table>
                    </div>
                </div>

            </div>
            <?php
        }if(isset($_GET['semana']) and isset($_GET['ls']) and isset($_GET['lso'])){
            $semana=$_GET['semana'];
            $estandar=$_GET['ls'];
            $estandarobj=$_GET['lso'];
            ?>
            <div class="panel-body table-responsive" style="font-size:12px;">
                <div class="col-md-3"></div>
                <div class="panel panel-primary col-md-6" align="center">
                    <form>
                        <input type="number" class="form-control" name="semana" min=1 max=52 placeholder="Numero de SEMANA (1-52)" required>
                        <input type="number" step="0.1" class="form-control" name="ls" min=0 placeholder="LITROS X OS LIQUIDADA"  required>
                        <input type="number" step="0.1" class="form-control" name="lso" min=0 placeholder="LITROS X OS OBJETADA"  required>
                        <input type="hidden" value="<?php echo $id;?>" name="iduser">
                        <button class="btn btn-primary" type="submit">BUSCAR</button>
                    </form>
                </div>
                <div class="col-md-3"></div>
                <div class="col-md-6" align="center">
                <?php
                    //echo $semana;
                    
                    $con2 = Conectarse();
/*                    
                    $sql2="SELECT * FROM os inner join dataos 
                    WHERE idmos=id_orden and asignado ='$id' 
                    and tecnico_asignado_idu='$id' ORDER BY mmos DESC, yearos DESC, ddos DESC";
*/
                    $sql2="SELECT * FROM os inner join dataos 
                    WHERE idmos=id_orden and asignado ='$id' 
                    and tecnico_asignado_idu='$id'";

                    $resultado2=$con2->query($sql2);
                ?>
                    <div style="height:350px;overflow-y:scroll;">
                        <table class="table">
                            <tr>
                                <th></th>
                                <th>SEMANA</th>
                                <th>FECHA</th>
                                <th>FOLIO</th>
                                <th>TIPO DE ORDEN</th>
                                <th>TECNICO</th>
                                <th>MODO</th>
                            </tr>
                            <?php
                            $auxl=0;
                            $auxo=0;
                            while($row2 = $resultado2->fetch_assoc())
                            {
                                $ddos=$row2['ddos'];
                                $mmos=$row2['mmos'];
                                $yearos=$row2['yearos'];
                                $evaluar=$yearos."-".$mmos."-".$ddos;
                                $folio_ps=$row2['folio_pisa'];
                                $tipo=$row2['tipo_os'];
                                $estatus=$row2['estatus'];
                                $ver=dia_semana_real($ddos,$mmos,$yearos);
                                
                                if($semana<>$ver){}if($semana==$ver){
                                    //echo $estatus."<br>";
                                    if($estatus==1){
                                        $auxo=$auxo+1;
                                        ?>
                                        <tr>
                                            <td><?php echo $aux;?></td>
                                            <td><?php echo $ver;?></td>
                                            <td><?php echo $evaluar;?></td>
                                            <td><?php echo $folio_ps;?></td>
                                            <td><?php echo $tipo;?></td>
                                            <td><?php echo $name." ".$ap." ".$am;?></td>
                                            <td style="color:red;font-weight: bold;"> OBJETADA</td>
                                        </tr>
                                        <?php
                                    }if($estatus==2){
                                        $auxl=$auxl+1;
                                        ?>
                                        <tr>
                                            <td><?php echo $aux;?></td>
                                            <td><?php echo $ver;?></td>
                                            <td><?php echo $evaluar;?></td>
                                            <td><?php echo $folio_ps;?></td>
                                            <td><?php echo $tipo;?></td>
                                            <td><?php echo $name." ".$ap." ".$am;?></td>
                                            <td style="color:green; font-weight: bold;"> LIQUIDADA</td>
                                        </tr>
                                        <?php
                                    }
                                }
                            }
                            //echo $aux;
                            ?>
                        </table>
                    </div>
                    <div style="background-color:#ADFF2F" class="col-md-12">
                    <table>
                        <tr>
                            <th>Total de OS: <h3><?php echo $auxl+$auxo;?></h3></th>
                        </tr>
                        <tr>
                            <th>
                                Total de LITROS UTILIZADOS LIQUIDACION(<?php echo $estandar;?> Lts x OS): 
                                <h3>
                                <?php 
                                    $uso=$estandar*$auxl;
                                    echo $uso." litros";
                                ?>
                                </h3>
                            </th> 
                        </tr>
                        <tr>
                        	<th>
                                Total de LITROS UTILIZADOS OBJECION(<?php echo $estandarobj;?> Lts x OS): 
                                <h3>
                                <?php 
                                    $uso2=$estandarobj*$auxo;
                                    echo $uso2." litros";
                                ?>
                                </h3>
                            </th> 
                        </tr>
                        <tr>
                        	<th>
                        		TOTALES = <?php echo $uso+$uso2;?>
                        	</th>
                        </tr>
                    </table>
                    </div>
                </div>
                <div class="col-md-6" align="center" style="border:solid;">
                    <form action="getContent.php" method="GET">
                        <input type="number" step="0.1" name="ls_asig" min=1 placeholder="GASOLINA ASIGNADA" class="form-control" required>
                        <input type="text" name="coment" placeholder="COMENTARIO" class="form-control" required>
                        <input type="hidden" step="0.1" class="form-control" name="ls" min=0  value="<?php echo $estandar;?>" placeholder="LITROS X OS"  required>
                        <input type="hidden" value="<?php echo $id;?>" name="iduser"><!--tecnico-->
                        <input type="hidden" value="<?php echo $semana;?>" name="semana"><!--tecnico-->
                        <input type="hidden" value="<?php echo $estandar;?>" name="lsxos"><!--litros por os-->
                        <input type="hidden" value="<?php echo $aux;?>" name="noos"><!--numero de os-->
                        <!--<input type="hidden" value="<?php echo $aux;?>" name="noos">-->
                        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                        </button>
                    </form>
                    <div style="height:350px;overflow-y:scroll;">
                        <table class="table">
                            <tr>
                                <th>No de Ordenes</th>
                                <th>Fecha</th>
                                <th>COMENTARIO</th>
                                <th>GASOLINA ASIGNADA</th>
                                <th>Semana</th>
                                <th>MODO</th>
                            </tr>
                        <?php
                        $con3 = Conectarse();
                        $sql3="SELECT * FROM gasolina_os WHERE tecnico_gas='$id'";
                        $resultado3=$con3->query($sql3);
                        while($row3 = $resultado3->fetch_assoc())
                        {
                            ?>
                            <tr>
                                <td><?php echo $row3['no_os_gas'];?></td>
                                <td><?php echo $row3['dd_gas']."/".$row3['mm_gas']."/".$row3['year_gas']." ".$row3['hora_gas'];?></td>
                                <td><?php echo $row3['comentario_gas'];?></td>
                                <td><?php echo $row3['lts_calculados_gas']." Lts";?></td>
                                <td><?php echo $row3['semana'];?></td>
                                <?php
                                $asino=$row3['asigna_gas'];
                                $con4 = Conectarse();
                                $sql4="SELECT * FROM usuario where idu='$asino'";
                                $resultado4=$con4->query($sql4);
                                while($row4 = $resultado4->fetch_assoc())
                                {
                                    ?>
                                    <td><?php echo $row4['nombre']." ".$row4['apaterno'];?></td>
                                    <?php
                                }
                                ?>
                            </tr>
                            <?php
                        }
                        ?>
                        </table>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>
<div class="col-md-12">
<?php
if(isset($_GET['ls_asig']) and  isset($_GET['coment']) and isset($_GET['iduser'])){
    $dia=date('j');
    $mes1=date('n');
    $aaaa=date('Y'); 
    $hora=date('G');
    $min=date('i');
    $time=$hora.":".$min;

    $ls_asig=$_GET['ls_asig'];
    $coment=$_GET['coment'];
    $iduser=$_GET['iduser'];
    $lsxos=$_GET['lsxos'];
    $noos=$_GET['noos'];

    //echo $ls_asig."-".$coment."-".$iduser."-".$lsxos."-".$noos;
    $calculados=
    $con3 = Conectarse();

    $sql3="INSERT INTO gasolina_os (
    no_os_gas,tecnico_gas,dd_gas,
    mm_gas,year_gas,hora_gas,comentario_gas,
    lts_calculados_gas,asigna_gas,semana)
    VALUES
    ('".$aux."','".$id."','".$dia."',
     '".$mes1."','".$aaaa."','".$time."','".$coment."',
     '".$ls_asig."','".$idyo."','".$semana."')";
   if ($con3->query($sql3) === TRUE) { echo ""; } else { if (!mysqli_query($con3, $sql3)) { printf("Errormessage: %s\n", mysqli_error($con3)); echo "<br>";} }
   echo "
    <script>
        alert('REGISTRO EXITOSO!');
    </script>"; 
    echo "<form name=form action=getContent.php method=GET>";
    echo "<input type=hidden name=iduser value=".$id.">";
    echo "</form>";
    echo "<script language=javascript>document.form.submit();</script>";  
    
}
?>
<!--
    <div class="panel panel-primary">
        <div class="panel-body table-responsive" style="font-size:12px;">
        </div>
    </div>
-->
</div>
<!--
verificar errores de un archivo de envio por emtodo de post
-->
<!-- Modal -->
<!--
<div class="modal fade myModal" id="" role="dialog" style="width:100% !important;">
    <div class="modal-dialog modal-lg">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Datos de la Orden</h4>
        </div>
        <div class="modal-body">
          <p>No hay datos por buscar</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
</div>-->

<div class="col-md-2" ></div>
<div class="col-md-2"></div>
<div class="col-md-12"><?php footer();?></div>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
/*
$(document).ready(function(){
    $('.bntmodal').click (function(){
        var id=$(this).data("id");
        var ido=$(this).data("ido");
        console.log(ido);
        
        $('.modal-body').load('getContent.php?id='+id,function(){
            $('.myModal').modal({show:true});
        });
    });
});
*/
</script>
<script src="../js/menu.js"></script>
</body>
</html>
