<?php
include("../Config/library.php"); 
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$super=$_POST['super'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="../js/browser.js"></script>
<?php
    cbajantes($user);
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana = date("W");
?>  
</head>
<body>
<br><br><br><br>
<!--<div class="col-md-12" style="background-color:black;">-->
<div class="col-md-2"></div>
<div class="col-md-8 panel panel-primary">
    <div class="panel-heading">
        Tecnicos 
        <a href="inde.php"><img src="../syspic/back.png" width="40" height="40"></a>
    </div>
    <div class="table-responsive panel-body">
        <table class="table">
            <tr>
                <td></td>
                <td><b>ID</b></td>
                <td><b>NOMBRE</b></td>
                <td><b>USUARIO</b></td>
                <td><b>CELULAR</b></td>
                <td><b>ASIGNADAS POR TRABAJAR</b></td>
                <!--<td>TELEFONO EMERGENCIA</td>-->
            </tr>
            <?php
            $tecnicos=new Usuario();
            $totales=$tecnicos->TotalUBD($con);
            
            for ($i=0; $i <=$totales ; $i++) { 
                $tecnico=new Usuario();
                $tecnico->obtenerUsuarioBD($i,$con);
                $asignado=$tecnico->regresaAsignado();
                if($asignado==$super){
                    $idu=$tecnico->regresaIdu();
                    $nom=$tecnico->regresaNombre();
                    $app=$tecnico->regresaApaterno();
                    $apm=$tecnico->regresaAmaterno();
                    $correo=$tecnico->regresaCorreo();
                    $tel=$tecnico->regresaTel();
                    $cel=$tecnico->regresaCel();
                    $ntecnico=$nom." ".$app." ".$apm;
                    $CantidadesU=new Cantidades();
                    $CantidadesU->obtenerCantidadesBD($idu,$con);
                    $cCO=$CantidadesU->regresaCobre();
                    $cFO=$CantidadesU->regresaFibra();
                    $cHI=$CantidadesU->regresaHibrida();
                    $cVO=$CantidadesU->regresaVoz();
                    $cTE=$CantidadesU->regresaTecnica();
                    $cPSR=$CantidadesU->regresaPsr();
                    //$TOTAL=$cCO+$cFO+$cHI+$cVO+$cTE+$cPSR;
                    $TOTAL=0;
                    $aux=0;

                    /*
                    $con1 = Conectarse(); 
                    $sql1="SELECT * FROM cantidades WHERE usuario_idu='$idu'";
                    $resultado=$con1->query($sql1);
                    while($row = $resultado->fetch_assoc())
                    {
                        $c=$row['cobre'];
                        $f=$row['fibra'];
                        $h=$row['hibrida'];
                        $v=$row['voz'];
                        $p=$row['psr'];
                        $t=$row['tecnica'];
                        $aux=1;         
                    }*/
                    $conta=0;
                    $con2 = Conectarse(); 
                    $con2->real_query("SELECT * FROM os inner join dataos WHERE idmos=id_orden and estatus=0 and asignado='$idu'");// AND semana='$semana'");
                    $re = $con2->use_result();
                    while ($row2 = $re->fetch_assoc()){
                        $tipos=$row2['tipo_os'];
                        $conta=$conta+1;
                        /*
                        if($tipos=='COBRE'){
                            $c=$c+1;
                        }if($tipos=='FIBRA'){
                            $f=$f+1;
                        }if($tipos=='HIBRIDA'){
                            $h=$h+1;
                        }if($tipos=='VOZ'){
                            $v=$v+1;
                        }if($tipos=='TECNICA'){
                            $t=$t+1;
                        }if($tipos=='PSR'){
                            $p=$p+1;
                        }*/
                    }
                    $TOTAL=$conta;
                    //echo $idu."=".$c."-".$f."-".$h."-".$v."-".$p."-".$t;
                    //if(isset($c) and isset($f) and isset($f)){
                        //$TOTAL=$c+$f+$h+$v+$p+$t;
                    //}if(!isset($c) and !isset($f)){
                      //  $TOTAL=0;
                    //}
                    ?>
                    <form action="ordenesTec.php" method="POST">
                    <input type="text" value="<?php echo $super;?>" style="display:none;" name="supervisor" readonly>
                    <input type="text" value="<?php echo $idu;?>" style="display:none;" name="tecnico" readonly>
                    <tr>
                        <th><input type="submit" value="Ver"></th>
                        <td><?php echo $idu;?></td>
                        <td><?php echo $ntecnico;?></td>
                        <td><?php echo $correo;?></td>
                        <td><?php echo $cel;?></td>
                        <td align="center" style="font-size:14px;color:red;"><label><?php echo $TOTAL;?></label></td>
                        <!--<td><?php echo $tel;?></td>-->
                    </tr>
                    </form>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</div>
<div class="col-md-2"></div>
<div class="col-md-12"><?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>