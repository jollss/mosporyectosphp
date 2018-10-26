<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$con = Conectarse();  
$con1 = Conectarse(); 
$con2 = Conectarse(); 
$con3 = Conectarse();
$con4 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
if(!isset($_POST['idu'])){
    $idu=$_GET['idu'];
}if(isset($_POST['idu'])){
    $idu=$_POST['idu'];
}
function BD($sql){
    $con = Conectarse();  
    if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
}
function check_in_range($start_date,$end_date,$evaluar){
    $start_ts=strtotime($start_date);
    $end_ts=strtotime($end_date);
    $user_ts=strtotime($evaluar);
    return (($user_ts>=$start_ts) && ($user_ts<=$end_ts));
}

$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
//echo $dia." ".$mes." ".$aaaa;
$end_date = $aaaa."-".$mes."-".$dia;//'2010-06-30';
//$end_date = "2017-10-6";//'2010-06-30';
$diam=$dia-13;
if($diam<0){
    $mes=$mes-1;
    $diam=25;
}
$start_date = $aaaa."-".$mes."-".$diam;//'2010-06-01';
//$start_date = "2017-9-30";//'2010-06-01';
if(isset($_POST['ddstart']) and isset($_POST['mmstart']) and isset($_POST['ystart']) and isset($_POST['dend']) and isset($_POST['mend']) and isset($_POST['yend'])){
 $start_date=$_POST['ystart']."-".$_POST['mmstart']."-".$_POST['ddstart'];//'2010-06-01';
 $end_date =$_POST['yend']."-".$_POST['mend']."-".$_POST['dend'];//'2010-06-01';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mos Proyectos</title>
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="../css/timeline.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="../css/startmin.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="../css/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>

<div id="wrapper">
    <!-- Navigation MENU-->
    <?php almacen($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Material Usado por:</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<div class="col-md-12">
    <?php
    $sql1="SELECT * FROM usuario WHERE idu='$idu'";
        $resultado=$con1->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
            $nombre=$row['nombre'];
            $apaterno=$row['apaterno'];
            $amaterno=$row['amaterno'];
        }
    ?>
    <h3><?php echo $idu." ".$nombre." ".$apaterno." ".$amaterno;?></h3>
</div>
<div>
<div class="col-md-6">
    
    <div class="panel panel-primary">
        <div class="panel-heading">Comentarios Registrados</div>
        <div class="panel-body" style="overflow:scroll;height: 250px;">
            <table class="table">
            <?php
            $sql1="SELECT * FROM coment_material WHERE id_materiales='$idu' ORDER BY fecha_coment DESC";
            $resultado=$con->query($sql1);
            while($row = $resultado->fetch_assoc())
            {
              ?>
                <tr>
                    <td><?php echo $row['fecha_coment'];?></td>
                    <td><?php echo $row['comentario'];?></td>
                </tr>
              <?php  
            }
            ?>
            </table>
        </div>    
    </div>
</div>
<div class="col-md-6">
<?php
if(isset($_GET['comentarios'])){ 
        
        $comentariosA=strtoupper($_GET['comentarios']);
        $comentarios=$comentariosA;
        $fecha_hora_actual = date('Y-m-d H:i:s'); 
        $idcoment=0;
        $sql12="SELECT * FROM coment_material";
        $resultado2=$con->query($sql12);
        while($row2 = $resultado2->fetch_assoc())
        {
            $idcoment=$row2['idcoment'];
        }
        $idcoment=$idcoment+1;
        $sql3="INSERT INTO coment_material (
        idcoment,id_materiales,comentario,
        fecha_coment)
        VALUES
        ('".$idcoment."','".$idu."','".$comentarios."','".$fecha_hora_actual."')";
        BD($sql3);        
        echo  "
        <script>
            alert('Comentario Registrado');
        </script>"; 
        echo "<form name=form action=asigMaterial.php method=post>";
        echo "<input type=text name=idu value=".$idu.">";
        echo "</form>";
        echo "<script language=javascript>document.form.submit();</script>";
    }
?>
    <form action="asigMaterialSup.php" method="GET">
        <!--<textarea name="comentarios" style="resize:none;" cols="45" rows="5" placeholder="COMENTARIO" maxlength="500" required></textarea>-->
        <input type="text" name="comentarios" class="form-control" placeholder="Ingresa un comentario" style="display:;" size="20%" required>
        <input type="number" name="idu" value="<?php echo $idu;?>" style="display:none;" readonly>
        <button type="submit" class="btn btn-primary">
            <span class="glyphicon glyphicon-pencil" aria-hidden="true"> COMENTAR</span>
        </button>
        </form>
        <!--========================-->
        <?php   
        $aux=0;
        $cobrea=0;
        $hibridaa=0;
        $tecnicaa=0;
        $psra=0;
        $voza=0;
        $ttl1=0;
        $sql1="SELECT * FROM os INNER JOIN dataos WHERE idmos=id_orden and estatus=0 and tecnico_asignado_idu='$idu'";
        $resultado=$con3->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
            if($row['tipo_os']=='COBRE'){
                $cobrea=$cobrea+1;
            }if($row['tipo_os']=='FIBRA'){
                $aux=$aux+1;
            }if($row2['tipo_os']=='HIBRIDA'){
                $hibridaa=$hibridaa+1;
            }if($row2['tipo_os']=='VOZ'){
                $voza=$voza+1;
            }if($row2['tipo_os']=='TECNICA'){
                $tecnicaa=$tecnicaa+1;
            }if($row2['tipo_os']=='PSR'){
                $psra=$psra+1;
            }
        }
        $ttl1=$cobrea+$aux;
        $aux1=0;
        $fibras=0;
        $cobres=0;
        $hibridas=0;
        $tecnicas=0;
        $voz=0;
        $psr=0;
        //$sql2="SELECT * FROM os INNER JOIN dataos WHERE idmos=id_orden and estatus=2 and tecnico_asignado_idu='$idu'";
        $sql2="SELECT * FROM os INNER JOIN dataos INNER JOIN material WHERE idmos=id_orden and idmos=idos and estatus=2 and tecnico_asignado_idu='$idu'";
        $resultado2=$con3->query($sql2);
        while($row2 = $resultado2->fetch_assoc())
        {
            $daux=$row2['ddos'];
            $maux=$row2['mmos'];
            $yaux=$row2['yearos'];
            $fecha_a_evaluar = $yaux."-".$maux."-".$daux;//'2010-06-15';
            if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
                //$aux1=$aux1+1;
                //echo $aux1."=".$daux."-".$maux."-".$yaux."<br>";
                if($row2['tipo_os']=='FIBRA'){
                    $fibras=$fibras+1;
                }if($row2['tipo_os']=='COBRE'){
                    $cobres=$cobres+1;
                }if($row2['tipo_os']=='HIBRIDA'){
                    $hibridas=$hibridas+1;
                }if($row2['tipo_os']=='VOZ'){
                    $voz=$voz+1;
                }if($row2['tipo_os']=='TECNICA'){
                    $tecnicas=$tecnicas+1;
                }if($row2['tipo_os']=='PSR'){
                    $psr=$psr+1;
                }
            }   
        }
    ?>
        <form action="asigMaterialSup.php" method="POST">
        <table border="0" width="100%">
            <tr>
                <td  style="color:red;">Fecha de referencia: </td>
                <td>
                    <input type="text" name="idu" value="<?php echo $idu?>" style="display:none;" readonly>
                    <input type="number" name="ddstart" size="2" min="0" max="31" placeholder="dia" style="width: 50px;">/
                    <input type="number" name="mmstart" size="2" min="0" max="12" placeholder="mes" style="width: 50px;">/
                    <input type="number" name="ystart" size="4" min="0" max=<?php echo $aaaa;?> placeholder="año" style="width: 50px;">
                </td>
                <td>
                    AL 
                </td>
                <td>
                    <input type="text" name="idu" value="<?php echo $idu?>" style="display:none;" readonly>
                    <input type="number" name="dend" size="2" min="0" max="31" placeholder="dia" style="width: 50px;">/
                    <input type="number" name="mend" size="2" min="0" max="12" placeholder="mes" style="width: 50px;">/
                    <input type="number" name="yend" size="4" min="0" max=<?php echo $aaaa;?> placeholder="año" style="width: 50px;">
                </td>
                <td><?php echo $start_date." al ".$end_date;?></td>
                <td>
                    <button type="submit" class="btn btn-primary">
                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"> VER</span>
                    </button>
                </td> 
            </tr>
        </table>
        <!--
        <table border="0" width="100%">
            
            <tr style=" border-bottom:1pt solid black;">
                <td>Ordenes Pendientes por Trabajar: </td>
                <td><label><?php echo "COBRE: ".$cobrea."<br>FIBRA: ".$aux1."<br>HIBRIDAS: ".$hibridaa;?></label></td>
                <td><label><?php echo " TECNICAS: ".$tecnicaa."<br>VOZ: ".$voza."<br>PSR: ".$psra; ?></label></td>
            </tr>
            
            <tr style=" border-bottom:1pt solid black;">    
                <td style="border-bottom:1pt solid black;">Ordenes Liquidadas: </td>
                <td style="border-bottom:1pt solid black;"><label><?php echo "COBRE: ".$cobres."<br>FIBRA: ".$fibras."<br>HIBRIDAS: ".$hibridas;?></label></td>
                <td style="border-bottom:1pt solid black;"><label><?php echo "TECNICAS: ".$tecnicas."<br>VOZ: ".$voz."<br>PSR: ".$psr; ?></label></td>
            </tr>
        </table>
        -->
        </form> 
        <!--==============================-->
</div>
<div class="col-md-12" style="background-color:;">
    <div style="overflow:scroll;height: 300px;">
        <table class="table">
                <tr>
                    <th></th>
                    <th>Folio</th>
                    <th>TIPO</th>
                    <th>Fecha</th>
                    <th>MODEM</th>
                    <th>ROSETAS</th>
                    <th>METRAJE</th>
                </tr>
        <?php
        $mT=0;
        $rT=0;
        $meT=0;
        $a1=0;
        /*METRAJE*/
        $mcobre=0;
        $mfibra=0;
        $mhibrida=0;
        $mtecnica=0;
        $mvoz=0;
        $mpsr=0;
        /*Modem*/
        $mocobre=0;
        $mofibra=0;
        $mohibrida=0;
        $motecnica=0;
        $movoz=0;
        $mopsr=0;
        /*Rocetas*/
        $rocobre=0;
        $rofibra=0;
        $rohibrida=0;
        $rotecnica=0;
        $rovoz=0;
        $ropsr=0;
        $sql2="SELECT * FROM os INNER JOIN dataos INNER JOIN material WHERE idmos=id_orden and idmos=idos and estatus=2 and usuario_idu='$idu'";
            $resultado2=$con3->query($sql2);
            while($row2 = $resultado2->fetch_assoc())
            {
                $daux=$row2['ddos'];
                $maux=$row2['mmos'];
                $yaux=$row2['yearos'];
                $haux=$row2['horaos'];
                $tipoorden=$row2['tipo_os'];
                $fecha_a_evaluar = $yaux."-".$maux."-".$daux;//'2010-06-15';
                if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
                    $a1=$a1+1;
                    $mT=$mT+$row2['modem'];
                    $rT=$rT+$row2['rosetas'];
                    
                    if($tipoorden=='COBRE'){
                        $mcobre=$mcobre+$row2['metraje'];
                        $mocobre=$mocobre+$row2['modem'];
                        $rocobre=$rocobre+$row2['rosetas'];
                    }if($tipoorden=='FIBRA'){
                        $mfibra=$mfibra+$row2['metraje'];
                        $mofibra=$mofibra+$row2['modem'];
                        $rofibra=$rofibra+$row2['rosetas'];
                    }if($tipoorden=='HIBRIDA'){
                        $mhibrida=$mhibrida+$row2['metraje'];
                        $mohibrida=$mohibrida+$row2['modem'];
                        $rohibrida=$rohibrida+$row2['rosetas'];
                    }if($tipoorden=='VOZ'){
                        $mvoz=$mvoz+$row2['metraje'];
                        $movoz=$movoz+$row2['modem'];
                        $rovoz=$rovoz+$row2['rosetas'];
                    }if($tipoorden=='TECNICA'){
                        $mtecnica=$mtecnica+$row2['metraje'];
                        $motecnica=$motecnica+$row2['modem'];
                        $rotecnica=$rotecnica+$row2['rosetas'];
                    }if($tipoorden=='PSR'){
                        $mpsr=$mpsr+$row2['metraje'];
                        $mopsr=$mopsr+$row2['modem'];
                        $ropsr=$ropsr+$row2['rosetas'];
                    }
                    $meT=$meT+$row2['metraje'];
                    ?>
                    <tr>
                        <td><?php echo $a1;?></td>
                        <td><?php echo $row2['folio_pisa'];?></td>
                        <td><?php echo $tipoorden;?></td>
                        <td><?php echo $daux."/".$maux."/".$yaux;?></td>
                        <td><?php echo $row2['modem'];?></td>
                        <td><?php echo $row2['rosetas'];?></td>
                        <td><?php echo $row2['metraje'];?></td>
                    </tr>
                    <?php
                }   
            }
        ?>
        </table>
    </div>
    <div class="col-md-12" style="background-color:;height:25px;">
    </div>
    <div class="col-md-12">
        <div class="col-md-12" style="background-color:;"><h3>TOTALES</h3></div>
        <div class="col-md-12" style="font-size:15px;font-weight: bold;">
        <div class="col-md-12">
<!--MODEM------------------------------------------------------------------------------------------------------------------>        
            <?PHP 
            if($mT>0){?>
            <div class="col-md-12" style="color:white;font-weight:bold;background-color:black;border: solid; font-size:12px;">
                TOTAL MODEM: 
                <!--<h4><?php echo $mT;?> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4>-->
                <table class="table">
                    <tr>
                        <th>COBRE</th>
                        <th>FIBRA</th>
                        <th>HIBRIDA</th>
                        <th>TECNICA</th>
                        <th>VOZ</th>
                        <th>PSR</th>
                    </tr>
                    <tr>
                        <td><?php echo $mocobre;?></td>
                        <td><?php echo $mofibra;?></td>
                        <td><?php echo $mohibrida;?></td>
                        <td><?php echo $motecnica;?></td>
                        <td><?php echo $movoz;?></td>
                        <td><?php echo $mopsr;?></td>
                    </tr>
                    
                </table>
                <!--<label><?php echo " COBRE->".$mocobre." FIBRA->".$mofibra." HIBRIDA->".$mohibrida." TECNICA->".$motecnica." VOZ->".$movoz." PSR->".$mopsr;?></label>-->
            </div>
            <?php 
            }
            if($mT<=0){?>
            <div class="col-md-12"  style="color:white;font-weight: bold;background-color:red; border: solid;font-size:12px;">
                TOTAL MODEM: 
                <!--<h4><?php echo $mT;?> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></h4>-->
                <table class="table">
                    <tr>
                        <th>COBRE</th>
                        <th>FIBRA</th>
                        <th>HIBRIDA</th>
                        <th>TECNICA</th>
                        <th>VOZ</th>
                        <th>PSR</th>
                    </tr>
                    <tr>
                        <td><?php echo $mocobre;?></td>
                        <td><?php echo $mofibra;?></td>
                        <td><?php echo $mohibrida;?></td>
                        <td><?php echo $motecnica;?></td>
                        <td><?php echo $movoz;?></td>
                        <td><?php echo $mopsr;?></td>
                    </tr>
                    
                </table>
                <!--<label><?php echo " COBRE->".$mocobre." FIBRA->".$mofibra." HIBRIDA->".$mohibrida." TECNICA->".$motecnica." VOZ->".$movoz." FIBRA->".$mopsr;?></label>-->
            </div>
            <?php }
            ?>
<!--ROSETA------------------------------------------------------------------------------------------------------------------>
            <?PHP 
            if($rT>0){?>
            <div class="col-md-12" style="color:white;font-weight: bold;background-color:black; border: solid;font-size:12px;">
            TOTAL ROSETA: 
                <!--<h4><?php echo $rT;?> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4>-->
                <table class="table">
                    <tr>
                        <th>COBRE</th>
                        <th>FIBRA</th>
                        <th>HIBRIDA</th>
                        <th>TECNICA</th>
                        <th>VOZ</th>
                        <th>PSR</th>
                    </tr>
                    <tr>
                        <td><?php echo $rocobre;?></td>
                        <td><?php echo $rofibra;?></td>
                        <td><?php echo $rohibrida;?></td>
                        <td><?php echo $rotecnica;?></td>
                        <td><?php echo $rovoz;?></td>
                        <td><?php echo $ropsr;?></td>
                    </tr>
                    
                </table>
                <!--<label><?php echo " COBRE:".$rocobre." FIBRA:".$rofibra;?></label>-->
            </div>
            <?php 
            }
            if($mT<=0){?>
            <div class="col-md-12" style="color:white;font-weight: bold;background-color:red; border: solid;font-size:12px;">
                TOTAL ROSETA: 
                <!--<h4><?php echo $rT;?> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></h4>-->
                <table class="table">
                    <tr>
                        <th>COBRE</th>
                        <th>FIBRA</th>
                        <th>HIBRIDA</th>
                        <th>TECNICA</th>
                        <th>VOZ</th>
                        <th>PSR</th>
                    </tr>
                    <tr>
                        <td><?php echo $rocobre;?></td>
                        <td><?php echo $rofibra;?></td>
                        <td><?php echo $rohibrida;?></td>
                        <td><?php echo $rotecnica;?></td>
                        <td><?php echo $rovoz;?></td>
                        <td><?php echo $ropsr;?></td>
                    </tr>
                    
                </table>
                <!--<label><?php echo " COBRE:".$rocobre." FIBRA:".$rofibra;?></label>-->
            </div>
            <?php }
            ?>
<!--METRAJE------------------------------------------------------------------------------------------------------------------>            
            <?PHP 
            if($meT>0){?>
            <div class="col-md-12" style="color:white;font-weight: bold;background-color:black; border: solid;font-size:12px;">
            TOTAL METRAJE: 
                <!--<h4><?php echo $meT;?> <span class="glyphicon glyphicon-ok" aria-hidden="true"></span></h4>-->
                <table class="table">
                    <tr>
                        <th>COBRE</th>
                        <th>FIBRA</th>
                        <th>HIBRIDA</th>
                        <th>TECNICA</th>
                        <th>VOZ</th>
                        <th>PSR</th>
                    </tr>
                    <tr>
                        <td><?php echo $mcobre;?></td>
                        <td><?php echo $mfibra;?></td>
                        <td><?php echo $mhibrida;?></td>
                        <td><?php echo $mtecnica;?></td>
                        <td><?php echo $mvoz;?></td>
                        <td><?php echo $mpsr;?></td>
                    </tr>
                    
                </table>
                <!--<label><?php echo " COBRE:".$mcobre." FIBRA:".$mfibra;?></label>-->
            </div>
            <?php 
            }
            if($meT<=0){?>
            <div class="col-md-12" style="color:white;font-weight: bold;background-color:red; border: solid;font-size:12px;">
            TOTAL METRAJE: 
                <!--<h4><?php echo $meT;?> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></h4>-->
                <table class="table">
                    <tr>
                        <th>COBRE</th>
                        <th>FIBRA</th>
                        <th>HIBRIDA</th>
                        <th>TECNICA</th>
                        <th>VOZ</th> 
                        <th>PSR</th>
                    </tr>
                    <tr>
                        <td><?php echo $mcobre;?></td>
                        <td><?php echo $mfibra;?></td>
                        <td><?php echo $mhibrida;?></td>
                        <td><?php echo $mtecnica;?></td>
                        <td><?php echo $mvoz;?></td>
                        <td><?php echo $mpsr;?></td>
                    </tr>
                    
                </table>
                <!--<label><?php echo " COBRE:".$mcobre." FIBRA:".$mfibra;?></label>-->
            </div>
            <?php }
            ?>
<!------------------------------------------------------------------------------------------------------------------------>            
        </div>
        <div class="col-md-6">
        <?php
            //if(isset($_GET['']))
        ?>
    <!--
        <form action="asigMaterial.phps" method="GET">
            <div class="col-md-12" style="color:;font-weight:bold;border: solid;">
                MODEM ASIGNAR: 
                <input type="number" value="0" min=0 name="asmodem" align="center" required>
            </div>
            <div class="col-md-12" style="color:;font-weight:bold;border: solid;">
                ROSETAS ASIGNAR: 
                <input type="number" value="0" min=0 name="asroseta" align="center" required>
            </div>
            <div class="col-md-12" style="color:;font-weight:bold;border: solid;">
                METRAJE ASIGNAR: 
                <input type="number" value="0" min=0 name="asmetraje" align="center" required>
            </div>
        </form>
        -->
        </div>
        </div>
    </div>
</div>
<!--============================================================================================-->      
    </div>
</div>

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="../js/startmin.js"></script>
</div>
</body>
</html>
