<?php
include("../Config/library.php"); 
date_default_timezone_set('America/Mexico_City');
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$semana = date("W");
$cnxe = Conectarse(); 
$con = Conectarse();  
$con2 = Conectarse(); 
$con3 = Conectarse();
$con4 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$cnxe->real_query("SELECT * FROM usuario WHERE correo = '$mail'");
$result = $cnxe->use_result();
while ($line = $result->fetch_assoc()){
    $iduser=$line['idu'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
<script type="text/javascript" src="../js/browser5.js"></script>       
<?php
    Grh($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">    
    <div class="col-md-6">
        <div id="container"><?php $tipoGet=20;?></div>
    </div>
    <div class="col-md-6">
        <div align="center"><h3><?php //echo $user;?></h3></div>
        <div class="panel panel-info" style="height:500px;overflow-y:scroll;">
            <div class="panel-heading">RECLUTADORES</div>
            <div class="panel-body" style="background-color:gray;">
            <div align="center" style="font-size:12px !important;">
                <div id="resultadoBusqueda">
                <?php
                   $sql1="SELECT * FROM usuario WHERE tipo_idtipo=20 AND activo=1 ORDER BY nombre";
                   $resultado=$con2->query($sql1);
                ?>
                <div class="table-responsive" >
                    <table class="table table-bordered" style="background-color:white;">
                        <tr>
                          <th>RECLUTA</th>
                          <th>Teléfono</th>
                          <th>ID</th>
                          <th></th>
                        </tr>
                      <?php
                      $aux=0;
                      $aux2=0;
                      while($row = $resultado->fetch_assoc())
                      {
                        $name=$row['nombre']." ".$row['apaterno']." ".$row['amaterno'];
                        $phone=$row['cel'];
                        $idu=$row['idu'];
                        ?> 
                            <tr> 
                                <th><?php echo $name;?></th> 
                                <th><?php echo $phone;?></th> 
                                <th><?php echo $idu;?></th> 
                                <th>
                                    <form action="" method="POST">
                                      <input type="submit" class="btn btn-primary" value="VER">
                                    </form>
                                </th>
                            </tr>
                        <?php                                              
                      }
                      ?>
                      </table>
                </div>                        
                        <?php
                    ?>
                 </div>
            </div>
            </div>
        </div>
    </div>
    <?php footer();?>
</div>
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
        text: 'PROSPECTOS'
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
            $sql1="SELECT * FROM usuario WHERE activo=1 AND tipo_idtipo=20";
            $resultado=$con2->query($sql1);
            while($row = $resultado->fetch_assoc())
            {
              $idu=$row['idu'];
              $name=$row['nombre'];
              $sq="SELECT * FROM  reclutamiento WHERE id_reclutar='$idu'";
              $res=$con2->query($sq);
              while($ro = $res->fetch_assoc())
              {
                $aux=$aux+1;
              }
              echo "
              {
                  name: '".$name."',
                  y: ".$aux."
              },";
            }
            ?>
        ]
    }]
});
</script>
</body>
</html>