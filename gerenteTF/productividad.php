<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$tos=0;
/*========================================*/
/*========================================*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        
<?php
    ventasS($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <br><br>
</div>
    <div class="col-md-6">
    <div align="center"></div>
        <div class="panel panel-info">
            <?php
            $dia=date('j');
            $mes=date('n');
            $aaaa=date('Y');
            $semana = date("W");
            ?>
            <div class="panel-heading"><?php echo $dia."/".$mes."/".$aaaa;?></div>
            <div class="panel-body" style="background-color:gray;">
            <div align="center" style="font-size:12px !important;">
                <div id="resultadoBusqueda">
                <form action="infoos.php" method="POST">
                        <div class="table-responsive" >
                            <table class="table table-bordered" style="background-color:white;">
                                <tr>
                                  <th>No</th>
                                  <th>Nombre Completo</th>
                                  <th>ID</th>
                                  <th>Correo</th>
                                  <th>Celular</th>
                                </tr>
                                 <?php
                                    $Total=new Usuario();
                                    $totalU=$Total->TotalUBD($con);
                                    $aux=0;
                                    $aux2=0;
                                    for ($i=0; $i < $totalU; $i++) { 
                                        
                                        
                                        $Usuario=new Usuario();
                                        $Usuario->obtenerUsuarioBD($i,$con);
                                        $activo= $Usuario->regresaActivo();
                                        $tipo=$Usuario->regresaTipoIdTipo();
                                        
                                        $idu=$Usuario->regresaIdu();
                                        $correou=$Usuario->regresaCorreo();
                                        $asignado=$Usuario->regresaAsignado();
                                        //echo $i."<br>";
                                        if($tipo==24 or $tipo==27 or $tipo==21 or $tipo==20 or $tipo==34){
                                            if($asignado==$iduser){
                                                //$aux2=$i%2;
                                                $aux=$aux+1;
                                                $Venta=new Usuario();
                                                $Venta->obtenerUsuarioBD($i,$con);
                                                $nombres=$Venta->regresaNombre();
                                                $ap=$Venta->regresaApaterno();
                                                $am=$Venta->regresaAmaterno();
                                                $cel=$Venta->regresaCel();
                                                ?>
                                                <tr>
                                                    <th><?php echo $aux;?></th> 
                                                    <th style="font-size:15px !important;"><?php echo $nombres." ".$ap." ".$am;?></th>
                                                    <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $idu;?>"></th>
                                                    <th><?php echo $correou;?></th>
                                                    <th><?php echo $cel;?></th>
                                                </tr>
                                                <?php
                                                
                                            }else{
                                            }
                                        }else{}
                                    }
                                    $sql1="SELECT * FROM usuario WHERE asignado='$iduser'";
                                    $resultado=$con->query($sql1);
                                    while($row = $resultado->fetch_assoc())
                                    {
                                        $asignado=$row['idu'];        
                                    }
                                    $aux2=$aux;
                                    ?>
                                    <?php
                                    //echo $totalU;
                                    for ($i=0; $i <= $totalU; $i++) { 
                                        $Usuario=new Usuario();
                                        $Usuario->obtenerUsuarioBD($i,$con);
                                        $activo= $Usuario->regresaActivo();
                                        $tipo=$Usuario->regresaTipoIdTipo();
                                        
                                        $idu=$Usuario->regresaIdu();
                                        $correou=$Usuario->regresaCorreo();
                                        $as=$Usuario->regresaAsignado();
                                        //echo $as."-";
                                        if($tipo==27 or $tipo==21 or $tipo==20){
                                            if($as==$asignado){
                                                $aux2=$aux2+1;
                                                $Venta=new Usuario();
                                                $Venta->obtenerUsuarioBD($i,$con);
                                                $nombres=$Venta->regresaNombre();
                                                $ap=$Venta->regresaApaterno();
                                                $am=$Venta->regresaAmaterno();
                                                $cel=$Venta->regresaCel();
                                                ?>
                                                <tr>
                                                    <th><?php echo $aux2;?></th> 
                                                    <th style="font-size:15px !important;"><?php echo $nombres." ".$ap." ".$am;?></th>
                                                    <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $idu;?>"></th>
                                                    <th><?php echo $correou;?></th>
                                                    <th><?php echo $cel;?></th>
                                                </tr>
                                                <?php
                                                
                                            }else{
                                            }
                                        }else{}
                                    }
                                    ?>
                                    
                            </table>
                        </div>
                </form>
                 </div>
            </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div id="container"></div>
    </div>
    <div class="col-md-12"></div>
    <?php footer();?>
</div>
<div class="col-md-1"></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script type="text/javascript" src="../js/exporting.js"></script>
<script type="text/javascript" src="../js/highcharts.js"></script>
<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'PRODUCTIVIDAD TOTAL'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Registros',
        colorByPoint: true,
        data: [
            <?php  
            $Total=new Usuario();
            $totalU=$Total->TotalUBD($con);
            $cantidad=new Ventas();
            $totalV=$cantidad->totalVentasFull($con);
            $aux=0;
            for ($n=0; $n <= $totalU; $n++) {     
                $Usuario=new Usuario();
                $idus=$Usuario->regresaIdu();
                $Usuario->obtenerUsuarioBD($n,$con);
                $tipo=$Usuario->regresaTipoIdTipo();
                $idUsuario=$Usuario->regresaIdu();
                $asignado=$Usuario->regresaAsignado();
                $no=$Usuario->regresaNombre();
                $ap=$Usuario->regresaApaterno();
                $am=$Usuario->regresaAmaterno();
                if($tipo==21 or $tipo==4 or $tipo==23 or $tipo==22 or $tipo==24){
                    if($asignado==$iduser or $iduser==$idus){
                        $aux2=0;
                        for ($i=0; $i <= $totalV ; $i++) {
                            $cantidad->obtenerVentaBD($i,$con);
                            $v=$cantidad->regresaVendedor();
                            if($v==$idUsuario){
                                $aux2=$aux2+1;
                            }
                        }
                        echo "
                        {
                            name: '".$no."',
                            y: ".$aux2."
                        },";
                    }
                }
            }
            $sql1="SELECT * FROM usuario WHERE asignado='$iduser'";
            $resultado=$con->query($sql1);
            while($row = $resultado->fetch_assoc())
            {
                $asignado=$row['idu'];        
            }
            for ($n=0; $n <= $totalU; $n++) {     
                $Usuario=new Usuario();
                $idus=$Usuario->regresaIdu();
                $Usuario->obtenerUsuarioBD($n,$con);
                $tipo=$Usuario->regresaTipoIdTipo();
                $idUsuario=$Usuario->regresaIdu();
                $as=$Usuario->regresaAsignado();
                $no=$Usuario->regresaNombre();
                $ap=$Usuario->regresaApaterno();
                $am=$Usuario->regresaAmaterno();
                if($tipo==21 or $tipo==20 or $tipo==27){
                    if($as==$asignado or $iduser==$idus){
                        $aux2=0;
                        for ($i=0; $i <= $totalV ; $i++) {
                            $cantidad->obtenerVentaBD($i,$con);
                            $v=$cantidad->regresaVendedor();
                            if($v==$idUsuario){
                                $aux2=$aux2+1;
                            }
                        }
                        echo "
                        {
                            name: '".$no."',
                            y: ".$aux2."
                        },";
                    }
                }
            }
            ?>
        ]
    }]
});
</script>
</body>
</html>