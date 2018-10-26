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
    <?php ventasS($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Mi Equipo</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<div class="container col-md-12" name="toTop" id="topPos">
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
                                    $totalU=$Total->TotalUsuariosActivosBD($con);
                                    $aux=0;
                                    $aux2=0;
                                    
                                    //echo $totalU."<br>";
                                    for ($i=0; $i < $totalU; $i++) { 
                                        $aux2=$i%2;
                                        
                                        $Usuario=new Usuario();
                                        $Usuario->obtenerUsuarioBD($i,$con);
                                        $activo= $Usuario->regresaActivo();
                                        $tipo=$Usuario->regresaTipoIdTipo();
                                        
                                        $idu=$Usuario->regresaIdu();
                                        $correou=$Usuario->regresaCorreo();
                                        $asignado=$Usuario->regresaAsignado();
                                        //echo $i."<br>";
                                        if($tipo==27 or $tipo==21 or $tipo==20 or $tipo==24){
                                        if($asignado==$iduser){
                                            $aux=$aux+1;
                                            $Venta=new Usuario();
                                            $Venta->obtenerUsuarioBD($i,$con);
                                            $nombres=$Venta->regresaNombre();
                                            $ap=$Venta->regresaApaterno();
                                            $am=$Venta->regresaAmaterno();
                                            $cel=$Venta->regresaCel();
                                            if($aux2==0){
                                            ?>
                                            <tr>
                                                <th><?php echo $aux;?></th> 
                                                <th style="font-size:15px !important;"><?php echo $nombres." ".$ap." ".$am;?></th>
                                                <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $idu;?>"></th>
                                                <th><?php echo $correou;?></th>
                                                <th><?php echo $cel;?></th>
                                            </tr>
                                            <?php
                                            }if($aux2==1){
                                            ?>
                                            <tr style="background-color:orange;">
                                                <th><?php echo $aux;?></th> 
                                                <th style="font-size:15px !important;"><?php echo $nombres." ".$ap." ".$am;?></th>
                                                <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $idu;?>"></th>
                                                <th><?php echo $correou;?></th>
                                                <th><?php echo $cel;?></th>
                                            </tr>
                                            <?php
                                            }
                                        }
                                        }
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
            $totalU=$Total->TotalUsuariosActivosBD($con);
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
            ?>
        ]
    }]
});
</script>
</div>
</body>
</html>
