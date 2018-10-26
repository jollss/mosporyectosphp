<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
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
        <link href="../css/slider.css" rel="stylesheet">
<script type="text/javascript" src="../js/browser5.js"></script>
        
<?php
    nivel5($user);
?>
</head>
<body>
<br><br><br>
<div class="container col-md-8" name="toTop" id="topPos">
</div>
<div class="col-md-4" align="center">
    <a href="../log/log.csv"><img src="../syspic/registros.png" width="50" height="50"></a>
</div>
    <div class="col-md-12">
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
                 <div class="col-md-6">
                    <a href="fielderPersonal.php"><div id="container"></div></a>
                </div>
                <div class="col-md-6" style="background-color:white;">
                    <div id="container2">
                        <table class="table">
                            <tr><h2>Supervisores</h2><label>Área Bajantes</label></tr>
                        <?php
                        $sql="SELECT * FROM usuario where activo=1 and tipo_idtipo=3 ORDER BY nombre";
                        $resultado=$con->query($sql);
                        while($row = $resultado->fetch_assoc())
                        {
                            ?>
                            <form action="bajanteSupervisor.php" method="POST">
                            <input type="text" name="iduser" value="<?php echo $row['idu'];?>" style="display:none;">
                            <tr>
                                <th><?php echo $row['nombre']." ".$row['apaterno']." ".$row['amaterno'];?></th>
                                <th><input type="submit" value="TECNICOS A CARGO"></th>
                            </tr>
                            </form>
                            <?php
                        }
                        ?>
                        </table>
                    </div>
                </div>
            </div>
            </div>
        </div>
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
        text: 'PRODUCTIVIDAD TOTAL FIELDERS'
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
                $Usuario->obtenerUsuarioBD($n,$con);
                $tipo=$Usuario->regresaTipoIdTipo();
                $idUsuario=$Usuario->regresaIdu();
                $no=$Usuario->regresaNombre();
                $ap=$Usuario->regresaApaterno();
                $am=$Usuario->regresaAmaterno();
                $activo=$Usuario->regresaActivo();
                if( $activo==1){
                    if($tipo==21 or $tipo==4 or $tipo==23 or $tipo==22 or $tipo==24 or $tipo==27){
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