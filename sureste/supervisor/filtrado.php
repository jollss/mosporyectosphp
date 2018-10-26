<?php
include("../Config/library.php"); 
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$totalUser=new Usuario();
$totalUser->obtenerIdu($con);
$id=$totalUser->regresaIdu();

$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$idYo=$Yo->regresaIdu();
$nsup=$Yo->regresaNombre();
$apsu=$Yo->regresaApaterno();
$amsu=$Yo->regresaAmaterno();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="../js/browserG.js"></script>
<?php
    nivel3($user);
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana = date("W");
    function check_in_range($start_date, $end_date, $evaluame) {
        $start_ts = strtotime($start_date);
        $end_ts = strtotime($end_date);
        $user_ts = strtotime($evaluame);
        return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
    }
?>	
</head>
<body>
<br><br><br><br>
<div class="col-md-12">
    <div class="col-md-1"></div>
    <div class="col-md-10">
        <div class="panel panel-default">
            <div class="panel-heading"><b>Filtrado -- Fecha Actual <?php echo $dia."/".$mes."/".$aaaa;?></b></div>
            <div class="panel-body" style="background-color:gray;">
            <div align="center">
                <label>Filtrado por mes y año.</label>
            </div>
            <!--
                <div align="center">
                    <form accept-charset="utf-8" method="POST">
                        <div class="form-group">
                            <input type="search" class="form-control" onkeyup ="loadXMLDoc()" placeholder="Número de Orden o id MOS" id="bus">
                        </div>
                    </form>
                </div>
            -->
                <form action="filtrado.php" method="GET">
                    <div class="col-md-4">
                        <div class="well">
                            <label>Fecha de inicio</label>
                            <div class="form-group col-xl-2">
                                <input type="number" class="form-control"  min=1 max=31 placeholder="DD" value="1" name="iddcarga" style="display:;" required>
                            </div>
                            <div class="form-group col-xl-2">
                                <input type="number" class="form-control"  min=1 max=12 placeholder="MM" name="immcarga" required>
                            </div>
                            <div class="form-group col-xl-2">
                                <input type="number" class="form-control"  min=1990 max=<?php echo $aaaa;?> placeholder="YYYY" name="iyyyycarga"  required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="well">
                            <label>Fecha de fin</label>
                            <div class="form-group col-xl-2">
                                <input type="number" class="form-control" min=1 max=31 placeholder="DD" name="fddcarga" value="31"  style="display:;"  required>
                            </div>
                            <div class="form-group col-xl-2">
                                <input type="number" class="form-control" min=1 max=12 placeholder="MM" name="fmmcarga" value="<?php echo $mes;?>" required>
                            </div>
                            <div class="form-group col-xl-2">
                                <input type="number" class="form-control" min=1990 max=<?php echo $aaaa;?> placeholder="YYYY" name="fyyyycarga" value="<?php echo $aaaa;?>" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="well">
                            <div class="form-group col-xl-2">
                                <select class="form-control" name="tipo">
                                    <option value="1">Fecha de carga</option>
                                    <option value="2">Fecha de asignacion</option>
                                    <option value="3">Fecha de objecion</option>
                                    <option value="4">Fecha de liquidacion</option>
                                </select>
                            </div>
                            <div class="form-group col-xl-2">
                                <input type="submit" class="btn btn-primary" value="BUSCAR">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-12">
            <div id="resultadoBusqueda"></div>
            <?php
                if(!isset($_GET['iddcarga'],$_GET['immcarga'],$_GET['iyyyycarga'],$_GET['fddcarga'],
                    $_GET['fddcarga'],$_GET['fddcarga'],$_GET['tipo']))
                {
                    ?>
                    <div class="panel panel-info" align="center">
                        <label>Sin datos por filtrar aún.</label>
                    </div>
                    <?php
                }else{
                    $di=$_GET['iddcarga'];
                    $mi=$_GET['immcarga'];
                    $yi=$_GET['iyyyycarga'];
                    
                    $df=$_GET['fddcarga'];
                    $mf=$_GET['fmmcarga'];
                    $yf=$_GET['fyyyycarga'];
                    $tipo=$_GET['tipo'];
                    ?>
                    <table border="1" class="table">
                        <tr>
                            <th><?php echo "Filtrado de: ".$di."/".$mi."/".$yi." a ".$df."/".$mf."/".$yf;
                            if($tipo==1){ echo " Carga";}
                            if($tipo==2){ echo " Asignacion";}
                            if($tipo==3){ echo " Objecion";}
                            if($tipo==4){ echo " Liquidacion";}
                            ?></th>
                        </tr>
                    </table>
                    <table border="1" class="table">
                                    <tr>
                                        <th>IDMOS</th>
                                        <th>Folio Pisaplex</th>
                                        <th>Folio Pisa</th>
                                        <th>Teléfono</th>
                                        <th>Cliente</th>
                                        <th>Fecha</th>
                                        <th>Tecnico</th>
                                    </tr>
                    <?php
                    if($tipo==1){
                        ?>
                        <form action="downloadExcel.php" method="POST" target="_blank">
                            <input type="submit" value="DESCARGAR" class="btn btn-primary">
                            <input type="number" value="<?php echo $tipo;?>" name="tipo" style="display:none;">
                            <input type="number" value="<?php echo $di;?>" name="di" style="display:none;">
                            <input type="number" value="<?php echo $mi;?>" name="mi" style="display:none;">
                            <input type="number" value="<?php echo $yi;?>" name="yi" style="display:none;">

                            <input type="number" value="<?php echo $df;?>" name="df" style="display:none;">
                            <input type="number" value="<?php echo $mf;?>" name="mf" style="display:none;">
                            <input type="number" value="<?php echo $yf;?>" name="yf" style="display:none;">
                            <!--<a href="downloadExcel.php" target="_blank"><label>Descargar Excel</label></a>-->
                        </form>
                        <?php
                        /*======================*/
                        $TotalOs=new Os();
                        $Totales=$TotalOs->totalesOs($con);
                        for ($i=1; $i <= $Totales; $i++) { 
                            $Os=new Os();
                            $Os->obtenerOsFolioBD($i,$con);
                            $idmos=$Os->regresaIdmos();
                            $quienAsigna=$Os->regresaUsuarioIdu();
                            $folio_pisaplex=$Os->regresaFolioPisaplex();
                            $folio_pis=$Os->regresaFolioPisa();
                            $tel=$Os->regresaTelefono();
                            $cliente=$Os->regresaCliente();                            
                            /*===============================*/
                            $daux=$Os->regresaDDOS();
                            $maux=$Os->regresaMMOS();
                            $yaux=$Os->regresaYEAROS();
                            /*===============================*/
                            //if($yi<=$yaux && $yaux>=$yf && $mi<=$maux && $mf>=$maux && $di<=$daux && $df>=$daux){ 
                            $start_date = $yi."-".$mi."-".$di;//'2010-06-01';
                            $end_date = $yf."-".$mf."-".$df;//'2010-06-30';
                            $fecha_a_evaluar = $yaux."-".$maux."-".$daux;//'2010-06-15';
                            if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
                            //if($yi<=$yaux && $yaux>=$yf && $mi<=$maux && $mf>=$maux ){ 
                                if($quienAsigna==$idYo){
                                ?>
                                    <tr>
                                        <th><?php echo $idmos;?></th>
                                        <td><?php echo $folio_pisaplex;?></td>
                                        <td><?php echo $folio_pis;?></td>
                                        <td><?php echo $tel;?></td>
                                        <td><?php echo $cliente;?></td>
                                        <td><?php echo $daux."/".$maux."/".$yaux;?></td>
                                    </tr>                               
                                <?php
                                }
                            //}else{
                            }
                        }
                    }
                    if($tipo==2){
                        ?>
                        <form action="downloadExcel.php" method="POST" target="_blank">
                            <input type="submit" value="DESCARGAR" class="btn btn-primary">
                            <input type="number" value="<?php echo $tipo;?>" name="tipo" style="display:none;">
                            <input type="number" value="<?php echo $di;?>" name="di" style="display:none;">
                            <input type="number" value="<?php echo $mi;?>" name="mi" style="display:none;">
                            <input type="number" value="<?php echo $yi;?>" name="yi" style="display:none;">

                            <input type="number" value="<?php echo $df;?>" name="df" style="display:none;">
                            <input type="number" value="<?php echo $mf;?>" name="mf" style="display:none;">
                            <input type="number" value="<?php echo $yf;?>" name="yf" style="display:none;">
                            <!--<a href="downloadExcel.php" target="_blank"><label>Descargar Excel</label></a>-->
                        </form>
                        <?php
                        $Dataos=new Dataos();
                        $TotalOs=new Os();
                        $Totales=$TotalOs->totalesOs($con);
                        $total=$Dataos->TotalDataosBD($con);
                        for ($i=0; $i <= $Totales; $i++) {
                            $Os=new Os();
                            $Os->obtenerOsBD($i,$con);
                            $quienAsigna=$Os->regresaUsuarioIdu();
                            $folio_pisaplex=$Os->regresaFolioPisaplex();
                            $folio_pis=$Os->regresaFolioPisa();
                            $tel=$Os->regresaTelefono();
                            $cliente=$Os->regresaCliente();  
                            $asignado=$Os->regresaAsignado();
                            $idmos=$Os->regresaIdmos();
                            /*===============================*/
                            $daux=$Os->regresaDDOS();
                            $maux=$Os->regresaMMOS();
                            $yaux=$Os->regresaYEAROS();
                            /*===============================*/
                            $tecnico=new Usuario();
                            $tecnico->obtenerUsuarioBD($asignado,$con);
                            $nmt=$tecnico->regresaNombre();
                            $apmt=$tecnico->regresaApaterno();
                            $ammt=$tecnico->regresaAmaterno();
                            $tecnicoa=$nmt." ".$apmt." ".$ammt;
                            if($asignado==0){
                            }else{
                            $Datos=new Dataos();
                            $Datos->obtenerDataosOsBD($idmos,$con);
                            $ordens=$Datos->regresaIdOrden();
                            $dd=$Datos->regresaDDASIG();
                            $mm=$Datos->regresaMMASIG();
                            $yy=$Datos->regresaYEARASIG();
                            //echo "if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm && $di<=$dd && $df>=$dd){<br>";
                                //if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm && $di<=$dd && $df>=$dd){
                            $start_date = $yi."-".$mi."-".$di;//'2010-06-01';
                            $end_date = $yf."-".$mf."-".$df;//'2010-06-30';
                            $fecha_a_evaluar = $yaux."-".$maux."-".$daux;//'2010-06-15';
                            if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
                                //if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm){
                                    if($quienAsigna==$idYo){
                                    ?>
                                        <tr>
                                            <th><?php echo $idmos;?></th>
                                            <td><?php echo $folio_pisaplex;?></td>
                                            <td><?php echo $folio_pis;?></td>
                                            <td><?php echo $tel;?></td>
                                            <td><?php echo $cliente;?></td>
                                            <td><?php echo $daux."/".$maux."/".$yaux;?></td>
                                            <td><?php echo $tecnicoa;?></td>
                                        </tr>                               
                                    <?php
                                    }
                                }
                            }
                        }
                    }if($tipo==3){
                        ?>
                        <form action="downloadExcel.php" method="POST" target="_blank">
                            <input type="submit" value="DESCARGAR" class="btn btn-primary">
                            <input type="number" value="<?php echo $tipo;?>" name="tipo" style="display:none;">
                            <input type="number" value="<?php echo $di;?>" name="di" style="display:none;">
                            <input type="number" value="<?php echo $mi;?>" name="mi" style="display:none;">
                            <input type="number" value="<?php echo $yi;?>" name="yi" style="display:none;">

                            <input type="number" value="<?php echo $df;?>" name="df" style="display:none;">
                            <input type="number" value="<?php echo $mf;?>" name="mf" style="display:none;">
                            <input type="number" value="<?php echo $yf;?>" name="yf" style="display:none;">
                            <!--<a href="downloadExcel.php" target="_blank"><label>Descargar Excel</label></a>-->
                        </form>
                        <?php
                        $Dataos=new Dataos();
                        $TotalOs=new Os();
                        $Totales=$TotalOs->totalOs($idYo,$con);
                        //echo $Totales;
                        $total=$Dataos->TotalDataosBD($con);
                        //echo $total;
                        for ($i=0; $i <= $total; $i++) { 
                            $Datos=new Dataos();
                            $Datos->obtenerDataosBD($i,$con);
                            $estatus=$Datos->regresaEstatus();

                            $dd=$Datos->regresaDDASIG();
                            $mm=$Datos->regresaMMASIG();
                            $yy=$Datos->regresaYEARASIG();
                            $ordens=$Datos->regresaIdOrden(); 
                            $Os=new Os();
                            $Os->obtenerOsBD($ordens,$con);
                            $quienAsigna=$Os->regresaUsuarioIdu();
                            $folio_pisaplex=$Os->regresaFolioPisaplex();
                            $folio_pis=$Os->regresaFolioPisa();
                            $tel=$Os->regresaTelefono();
                            $cliente=$Os->regresaCliente();
                            $idmos=$Os->regresaIdmos();
                            $asignado=$Os->regresaAsignado();
                            /*===============================*/
                            $daux=$Os->regresaDDOS();
                            $maux=$Os->regresaMMOS();
                            $yaux=$Os->regresaYEAROS();   
                            $ddos=$Datos->regresaDDOS();
                            $mmos=$Datos->regresaMMOS();
                            $yearos=$Datos->regresaYEAROS();                        
                            /*===============================*/
                            $tecnico=new Usuario();
                            $tecnico->obtenerUsuarioBD($asignado,$con);
                            $nmt=$tecnico->regresaNombre();
                            $apmt=$tecnico->regresaApaterno();
                            $ammt=$tecnico->regresaAmaterno();
                            $tecnicoa=$nmt." ".$apmt." ".$ammt;
                            //if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm && $di<=$dd && $df>=$dd && $estatus==1){ 
                            //if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm &&  $estatus==1){ 
                            $start_date = $yi."-".$mi."-".$di;//'2010-06-01';
                            $end_date = $yf."-".$mf."-".$df;//'2010-06-30';
                            $fecha_a_evaluar = $yearos."-".$mmos."-".$ddos;//'2010-06-15';
                            if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
                                //if($quienAsigna==$idYo){
                                if($estatus==1 && $asignado<>0 && $quienAsigna==$idYo){
                                ?>
                                    <tr>
                                        <th><?php echo $idmos;?></th>
                                        <td><?php echo $folio_pisaplex;?></td>
                                        <td><?php echo $folio_pis;?></td>
                                        <td><?php echo $tel;?></td>
                                        <td><?php echo $cliente;?></td>
                                        <td><?php echo $daux."/".$maux."/".$yaux;?></td>
                                        <td><?php echo $tecnicoa;?></td>
                                    </tr>                               
                                <?php
                                }
                            }
                        }
                    }if($tipo==4){
                        ?>
                        <form action="downloadExcel.php" method="POST" target="_blank">
                            <input type="submit" value="DESCARGAR" class="btn btn-primary">
                            <input type="number" value="<?php echo $tipo;?>" name="tipo" style="display:none;">
                            <input type="number" value="<?php echo $di;?>" name="di" style="display:none;">
                            <input type="number" value="<?php echo $mi;?>" name="mi" style="display:none;">
                            <input type="number" value="<?php echo $yi;?>" name="yi" style="display:none;">

                            <input type="number" value="<?php echo $df;?>" name="df" style="display:none;">
                            <input type="number" value="<?php echo $mf;?>" name="mf" style="display:none;">
                            <input type="number" value="<?php echo $yf;?>" name="yf" style="display:none;">
                            <!--<a href="downloadExcel.php" target="_blank"><label>Descargar Excel</label></a>-->
                        </form>
                        <?php
                        $Dataos=new Dataos();
                        $TotalOs=new Os();
                        $Totales=$TotalOs->totalOs($idYo,$con);
                        //echo $Totales;
                        $total=$Dataos->TotalDataosBD($con);
                        //echo $total;
                        for ($i=0; $i <= $total; $i++) { 
                            $Datos=new Dataos();
                            $Datos->obtenerDataosBD($i,$con);
                            $estatus=$Datos->regresaEstatus();

                            $dd=$Datos->regresaDDASIG();
                            $mm=$Datos->regresaMMASIG();
                            $yy=$Datos->regresaYEARASIG();
                            $ordens=$Datos->regresaIdOrden();
                            $Os=new Os();
                            $Os->obtenerOsBD($ordens,$con);
                            $quienAsigna=$Os->regresaUsuarioIdu();
                            $folio_pisaplex=$Os->regresaFolioPisaplex();
                            $folio_pis=$Os->regresaFolioPisa();
                            $tel=$Os->regresaTelefono();
                            $cliente=$Os->regresaCliente();
                            $asignado=$Os->regresaAsignado();
                            /*===============================*/
                            $daux=$Os->regresaDDOS();
                            $maux=$Os->regresaMMOS();
                            $yaux=$Os->regresaYEAROS();
                            $ddos=$Datos->regresaDDOS();
                            $mmos=$Datos->regresaMMOS();
                            $yearos=$Datos->regresaYEAROS();                           
                            /*===============================*/
                            $tecnico=new Usuario();
                            $tecnico->obtenerUsuarioBD($asignado,$con);
                            $nmt=$tecnico->regresaNombre();
                            $apmt=$tecnico->regresaApaterno();
                            $ammt=$tecnico->regresaAmaterno();
                            $tecnicoa=$nmt." ".$apmt." ".$ammt;
                            //if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm && $di<=$dd && $df>=$dd && $estatus==2){ 
                            //if($yi<=$yy && $yy>=$yf && $mi<=$mm && $mf>=$mm &&  $estatus==2){ 
                                $idmos=$Os->regresaIdmos();
                            //     if($quienAsigna==$idYo){
                            $start_date = $yi."-".$mi."-".$di;//'2010-06-01';
                            $end_date = $yf."-".$mf."-".$df;//'2010-06-30';
                            $fecha_a_evaluar = $yearos."-".$mmos."-".$ddos;//'2010-06-15';
                            if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
                                if($estatus==2 && $asignado<>0 && $quienAsigna==$idYo){
                                ?>
                                    <tr>
                                        <th><?php echo $idmos;?></th>
                                        <td><?php echo $folio_pisaplex;?></td>
                                        <td><?php echo $folio_pis;?></td>
                                        <td><?php echo $tel;?></td>
                                        <td><?php echo $cliente;?></td>
                                        <td><?php echo $daux."/".$maux."/".$yaux;?></td>
                                        <td><?php echo $tecnicoa;?></td>
                                    </tr>                               
                                <?php
                                }
                            }
                        }
                    }
                }
            ?>                
        </div>
    </div>
    <div class="col-md-1" ></div>
</div>
<div class="col-md-2" ></div>
<div class="col-md-2"></div>

<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>