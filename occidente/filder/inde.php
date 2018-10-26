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
$cantidad_resultados_por_pagina = 8;
if (isset($_GET["pagina"])) {
    if (is_string($_GET["pagina"])) {
         if (is_numeric($_GET["pagina"])) {
             if ($_GET["pagina"] == 1) {
                 header("Location: inde.php");
                 die();
             } else { //Si la petición desde la paginación no es para ir a la pagina 1, va a la que sea
                 $pagina = $_GET["pagina"];
            };
         } else { //Si la string no es numérica, redirige al index (por ejemplo: index.php?pagina=AAA)
             header("Location: inde.php");
            die();
         };
    };

} else { //Si el GET de HTTP no está seteado, lleva a la primera página (puede ser cambiado al index.php o lo que sea)
    $pagina = 1;
};
$total_registros=0;
    $empezar_desde = ($pagina-1) * $cantidad_resultados_por_pagina;
    $tU=new Usuario();
    $totalAux=$tU->TotalUsuariosActivosBD($con);
    $tU->regresaTipoIdTipo();
    for ($i=0; $i <= $totalAux; $i++) { 
        $usuarioU=new Usuario();
        $usuarioU->obtenerUsuarioBD($i,$con);
        $tipo=$usuarioU->regresaTipoIdTipo();
        $activo=$usuarioU->regresaActivo();
        if($activo==1 && $tipo==1){
            $total_registros++;
        }
    }
echo $total_registros;
$total_paginas = ceil($total_registros / $cantidad_resultados_por_pagina); 
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
    nivel1($user);
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
            <nav aria-label="Page navigation">
              <ul class="pagination">
              <!--
                <?php for ($i=1; $i<=$total_paginas; $i++) {?>
                <li><?php echo "<a href='?pagina=".$i."'>".$i."</a>";?></li>
                <?php }; ?>
                -->
                </li>
              </ul>
            </nav>
                <div id="resultadoBusqueda">
                <form action=" infoos.php" method="POST">
                        <div class="table-responsive" >
                            <table class="table table-bordered" style="background-color:white;">
                                <tr>
                                  <th>No</th>
                                  <th>Nombre Completo</th>
                                  <th>ID</th>
                                  <th>Correo</th>
                                  <th>Cobre</th>
                                  <th>Fibra</th>
                                  <th>Tecnica</th>
                                  <th>Hibridos</th>
                                  <th>Voz</th>
                                  <th>PSR</th>
                                  <th>RESTANTES</th>
                                </tr>
                                 <?php
                                 $Total=new Usuario();
                                    $totalU=$Total->TotalUsuariosActivosTBD($con);
                                    $aux=0;
                                    $aux2=0;
                                     $paginas=$cantidad_resultados_por_pagina+$empezar_desde;
                                    for ($i=0; $i < $totalU; $i++) { 
                                        $aux2=$i%2;
                                        
                                        $Usuario=new Usuario();
                                        $Usuario->obtenerUsuarioBD($i,$con);
                                        $activo= $Usuario->regresaActivo();
                                        $tipo=$Usuario->regresaTipoIdTipo();
                                        
                                        $idu=$Usuario->regresaIdu();
                                        $correou=$Usuario->regresaCorreo();
                                        //echo $i."<br>";
                                        if($idu>=$empezar_desde and $idu<=$total_registros and $tipo==1){
                                            $aux=$aux+1;
                                            $CantidadesU=new Cantidades();
                                            $Tecnico=new Usuario();
                                            $Tecnico->obtenerUsuarioBD($i,$con);
                                            $nombres=$Tecnico->regresaNombre();
                                            $ap=$Tecnico->regresaApaterno();
                                            $am=$Tecnico->regresaAmaterno();
                                            $CantidadesU->obtenerCantidadesBD($idu,$con);
                                            $cCO=$CantidadesU->regresaCobre();
                                            $cFO=$CantidadesU->regresaFibra();
                                            $cHI=$CantidadesU->regresaHibrida();
                                            $cVO=$CantidadesU->regresaVoz();
                                            $cTE=$CantidadesU->regresaTecnica();
                                            $cPSR=$CantidadesU->regresaPsr();
                                            $TOTAL=$cCO+$cFO+$cHI+$cVO+$cTE+$cPSR;
                                            if($aux2==0){
                                            ?>
                                            <tr>
                                                <th><?php echo $aux;?></th> 
                                                <th style="font-size:15px !important;"><?php echo $nombres." ".$ap." ".$am;?></th>
                                                <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $idu;?>"></th>
                                                <th><?php echo $correou;?></th>                                
                                                <th><?php echo $cCO;?></th> 
                                                <th><?php echo $cFO;?></th> 
                                                <th><?php echo $cTE;?></th>
                                                <th><?php echo $cHI;?></th> 
                                                <th><?php echo $cVO;?></th> 
                                                <th><?php echo $cPSR;?></th> 
                                                <th style="color:red; font-size:20px !important;"><?php echo $TOTAL;?></th>
                                            </tr>
                                            <?php
                                        }if($aux2==1){
                                            ?>
                                            <tr style="background-color:orange;">
                                                <th><?php echo $aux;?></th> 
                                                <th style="font-size:15px !important;"><?php echo $nombres." ".$ap." ".$am;?></th>
                                                <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $idu;?>"></th>
                                                <th><?php echo $correou;?></th>                                
                                                <th><?php echo $cCO;?></th> 
                                                <th><?php echo $cFO;?></th> 
                                                <th><?php echo $cTE;?></th>
                                                <th><?php echo $cHI;?></th> 
                                                <th><?php echo $cVO;?></th> 
                                                <th><?php echo $cPSR;?></th> 
                                                <th style="color:red; font-size:20px !important;"><?php echo $TOTAL;?></th>
                                            </tr>
                                            <?php
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