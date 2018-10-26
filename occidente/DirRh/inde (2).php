<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$con = Conectarse();  
$con2 = Conectarse(); 
$con3 = Conectarse();
$con4 = Conectarse();
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
        <link href="../css/slider.css" rel="stylesheet">
<script type="text/javascript" src="../js/browser5.js"></script>
        
<?php
    recluta($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-1">
    <br><br><br>
    </div>
    <div class="col-md-10">
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
                        <div class="table-responsive" >
                            <table class="table table-bordered" style="background-color:white;">
                                <tr>
                                  <th>No</th>
                                  <th>Nombre Completo</th>
                                  <th>ID</th>
                                  <th>Correo</th>
                                  <th>Celular</th>
                                  <th></th>
                                  <th>Cantidades</th>
                                </tr>
                                 <?php
                                    $Total=new Usuario();
                                    $totalU=$Total->TotalUsuariosActivosBD($con);
                                    $aux=0;
                                    $aux2=0;
                                    for ($i=0; $i < $totalU; $i++) { 
                                        $aux2=$i%2;
                                        
                                        $Usuario=new Usuario();
                                        $Usuario->obtenerUsuarioBD($i,$con);
                                        $activo= $Usuario->regresaActivo();
                                        $tipo=$Usuario->regresaTipoIdTipo();
                                        
                                        $idu=$Usuario->regresaIdu();
                                        $correou=$Usuario->regresaCorreo();
                                        //echo $i."<br>";
                                        if($tipo==21 or $tipo==4 or $tipo==23){
                                            $aux=$aux+1;
                                            $Venta=new Usuario();
                                            $Venta->obtenerUsuarioBD($i,$con);
                                            $nombres=$Venta->regresaNombre();
                                            $ap=$Venta->regresaApaterno();
                                            $am=$Venta->regresaAmaterno();
                                            $cel=$Venta->regresaCel();
                                            //if($aux2==0){
                                            ?>
                                            <form action="regCantidad.php" method="POST">
                                            <tr>
                                                <th><?php echo $aux;?></th> 
                                                <th style="font-size:15px !important;"><?php echo $nombres." ".$ap." ".$am;?></th>
                                                <th><input name="ident" type="text" value="<?php echo $idu;?>" size="4" style="border:none; background:none;" readonly></th>
                                                <th><?php echo $correou;?></th>
                                                <th><?php echo $cel;?></th>
                                                <th><input class="btn btn-success" name="" type="submit" value="+"></th>
                                                <?php 
                                                $rCantidad=new Reclutadorcantidad();
                                                $rCantidad->obtenerReclutaBD($idu,$con);
                                                $canti=$rCantidad->regresaCantidad();
                                                if($canti==0 or $canti==''){$canti=0;}
                                                ?>
                                                <th><label><?php echo $canti;?></label></th>
                                            </tr>
                                            </form>
                                            <?php
                                        }
                                    }
                                    ?>
                            </table>
                        </div>
                 </div>
            </div>
            </div>
        </div>
    </div>
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
Highcharts.chart('graph1', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'PRIMEROS 15 DÍAS'
    },
    subtitle: {
        text: 'Por: MOSPROYECTOS.COM.MX'
    },
    xAxis: {
        categories: [
            <?php
            $con->real_query("SELECT * FROM usuario ORDER BY idu");
            $result = $con->use_result();
            while ($line = $result->fetch_assoc()){
                $data=$line['nombre'];
                $idusuario=$line['idu'];
                $contador=0;
                $con3->real_query("SELECT * FROM osend WHERE usuario_idu='$idusuario' AND edd < $pago ORDER BY usuario_idu");
                $rs = $con3->use_result();
                while ($ls = $rs->fetch_assoc()){
                    //echo "data: [".$ls['usuario_idu'].",]";
                    $contador=$contador+1;
                    if($contador>0){
                    echo "'".$data."',";
                    }
                }
               
            }  
            ?>
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'OS'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.1,
            borderWidth: 0
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    series: [
    
            <?php
           $con->real_query("SELECT * FROM usuario ORDER BY idu");
            $result = $con->use_result();
            while ($line = $result->fetch_assoc()){
                $data=$line['nombre'];
                $idusuario=$line['idu'];
                //echo "data: [".$data.",]";
                $contador=0;
                $con3->real_query("SELECT * FROM osend WHERE usuario_idu='$idusuario' AND edd < $pago ORDER BY usuario_idu");
                $rs = $con3->use_result();
                while ($ls = $rs->fetch_assoc()){
                    //echo "data: [".$ls['usuario_idu'].",]";
                    $contador=$contador+1;
                }
                if($contador>0){
                echo "{";
                echo "name: '".$line['nombre']."',";
                echo "data: [".$contador.",]";
                echo "}, ";
                }
            }  
            ?>
    ]
});
</script>
<script type="text/javascript">
Highcharts.chart('graph2', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'SEGUNDOS 15 DÍAS'
    },
    subtitle: {
        text: 'Por: MOSPROYECTOS.COM.MX'
    },
    xAxis: {
        categories: [
            <?php
            $con->real_query("SELECT * FROM usuario ORDER BY idu");
            $result = $con->use_result();
            while ($line = $result->fetch_assoc()){
                $data=$line['nombre'];
                $idusuario=$line['idu'];
                $contador=0;
                $con3->real_query("SELECT * FROM osend WHERE usuario_idu='$idusuario' AND edd > $pago ORDER BY usuario_idu");
                $rs = $con3->use_result();
                while ($ls = $rs->fetch_assoc()){
                    //echo "data: [".$ls['usuario_idu'].",]";
                    $contador=$contador+1;
                    if($contador>0){
                    echo "'".$data."',";
                    }
                }
               
            }  
            ?>
        ],
        crosshair: true
    },
    yAxis: {
        min: 0,
        title: {
            text: 'OS'
        }
    },
    tooltip: {
        headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
        pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
            '<td style="padding:0"><b>{point.y:.1f} </b></td></tr>',
        footerFormat: '</table>',
        shared: true,
        useHTML: true
    },
    plotOptions: {
        column: {
            pointPadding: 0.1,
            borderWidth: 0
        }
    },
    legend: {
        layout: 'vertical',
        align: 'right',
        verticalAlign: 'top',
        x: -40,
        y: 80,
        floating: true,
        borderWidth: 1,
        backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
        shadow: true
    },
    series: [
    
            <?php
           $con->real_query("SELECT * FROM usuario ORDER BY idu");
            $result = $con->use_result();
            while ($line = $result->fetch_assoc()){
                $data=$line['nombre'];
                $idusuario=$line['idu'];
                //echo "data: [".$data.",]";
                $contador=0;
                $con3->real_query("SELECT * FROM osend WHERE usuario_idu='$idusuario' AND edd > $pago ORDER BY usuario_idu");
                $rs = $con3->use_result();
                while ($ls = $rs->fetch_assoc()){
                    $contador=$contador+1;
                }
                if($contador>0){
                echo "{";
                echo "name: '".$line['nombre']."',";
                echo "data: [".$contador.",]";
                echo "}, ";
                }
            }  
            ?>
    ]
});
</script>
</body>
</html>