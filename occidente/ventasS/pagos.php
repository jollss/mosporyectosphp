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
$dato=$iduser;
/*========================================*/
$sql="SELECT * FROM equipos_fielder where id_fielder='$iduser'";
$resultado=$con->query($sql);
while($row = $resultado->fetch_assoc())
{
    $areaLider=$row['id_area'];
}
if(!isset($areaLider)){
    $areaLider=0;
}
if(!isset($_GET['mesactual'])){
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mesactual=date('n');
    $aaaa=date('Y');
    $semana = date("W");
}if(isset($_GET['mesactual'])){
    $mesactual=$_GET['mesactual'];
}
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
    <script src="../js/jquery-3.2.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>

<div id="wrapper">
    <!-- Navigation MENU-->
    <?php ventas($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div align="center" class="col-md-6">
            <h3 class="page-header">POR PAGAR</h3>
        </div>  
        <div align="center" class="col-md-6">
            <h3 class="page-header">PAGADO</h3>
        </div>  
        <!-------------------------------------->
        <section class="col-md-6" style="height:600px;overflow-x:scroll;background-color:black;color:white;">
            <table class="table" border="1">
                <tr>
                    
                    <th>Folio Venta</th>
                    <th>Tipo de Cliente</th>
                    <th>Cliente</th>
                    <th>Dirección</th>
                    <th>Fecha de venta</th>
                    <th>Correo</th>
                    <th>ETAPA</th>
                </tr>
                
                <?php
                //var_dump($porciones);
                //$sql4="SELECT * FROM ventas where '$dato'=idvendedor AND mes='$mes' ORDER BY mes DESC,year DESC, dia DESC";
                $sql4="SELECT * FROM venta 
                WHERE   idvendedor='$dato' AND venta_pagada=0
                ORDER BY mes DESC,year DESC, dia DESC";
                $resultado4=$con4->query($sql4);
                while($row4 = $resultado4->fetch_assoc())
                {
                    $ventaid=$row4['idventa'];
                    ?>
                    <tr>
                        
                        <td><?php echo $row4['folio_ventas'];?></td>
                        <td><?php echo $row4['tipo_cliente'];?></td>
                        <td><?php echo $row4['nombrev']." ".$row4['apaternov']." ".$row4['amaternov'];?></td>
                        <td><?php echo $row4['direccion'];?></td>
                        <td><?php echo $row4['dia']."/".$row4['mes']."/".$row4['year']." ".$row4['hora'];?></td>
                        <td><?php echo $row4['correo_cliente'];?></td>
                        <td><?php echo $row4['etapa'];?></td>
                    </tr>
                    <?php
                }
                ?>
                
            </table>
        </section>
        <section class="col-md-6" style="height:600px;overflow-x:scroll;">
            <table class="table" border="1">
                <tr>
                    
                    <th>Folio Venta</th>
                    <th>Tipo de Cliente</th>
                    <th>Cliente</th>
                    <th>Dirección</th>
                    <th>Fecha de venta</th>
                    <th>Correo</th>
                    <th>ETAPA</th>
                </tr>
                
                <?php
                //var_dump($porciones);
                //$sql4="SELECT * FROM ventas where '$dato'=idvendedor AND mes='$mes' ORDER BY mes DESC,year DESC, dia DESC";
                $sql4="SELECT * FROM venta 
                WHERE   idvendedor='$dato' AND venta_pagada=1
                ORDER BY mes DESC,year DESC, dia DESC";
                $resultado4=$con4->query($sql4);
                while($row4 = $resultado4->fetch_assoc())
                {
                    $ventaid=$row4['idventa'];
                    ?>
                    <tr>
                        
                        <td><?php echo $row4['folio_ventas'];?></td>
                        <td><?php echo $row4['tipo_cliente'];?></td>
                        <td><?php echo $row4['nombrev']." ".$row4['apaternov']." ".$row4['amaternov'];?></td>
                        <td><?php echo $row4['direccion'];?></td>
                        <td><?php echo $row4['dia']."/".$row4['mes']."/".$row4['year']." ".$row4['hora'];?></td>
                        <td><?php echo $row4['correo_cliente'];?></td>
                        <td><?php echo $row4['etapa'];?></td>
                    </tr>
                    <?php
                }
                ?>
                
            </table>
        </section>
        <!-------------------------------------->
    </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade myModal" id="" role="dialog" style="width:100% !important;">
<div class="modal-dialog modal-lg">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">VENTAS DEL MES</h4>
    </div>
    <div class="modal-body">
      <p>No hay datos por buscar</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
  
</div>
</div>  
<script>
$(document).ready(function(){
    $('.bntmodal').click (function(){
        var idmos=$(this).data("id");
        $('.modal-body').load('pagos.php?id='+idmos,function(){
            $('.myModal').modal({show:true});
        });
    });
});
</script>
<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="../js/startmin.js"></script>

</body>
</html>