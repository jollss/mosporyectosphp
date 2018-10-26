<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$con = Conectarse();  
$con2 = Conectarse(); 
$con3 = Conectarse();
$con4 = Conectarse();
$con42 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$tos=0;
$dato=$_GET['id'];
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
    <?php gventas($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper"> 
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
            <?php
            $sql41="SELECT * FROM usuario 
                WHERE   idu='$dato'";
                $resultado41=$con4->query($sql41);
                while($row41 = $resultado41->fetch_assoc())
                {
                    $nu=$row41['nombre'];
                    $apa=$row41['apaterno'];
                    $ama=$row41['amaterno'];
                }
                $areaID=$_GET['area'];
            
            $sql412="SELECT * FROM areas_fielder 
                WHERE  idarea='$areaID'";
                //echo $sql412;
                
                $resultado412=$con42->query($sql412);
                while($row412 = $resultado412->fetch_assoc())
                {
                    $areaNow=$row412['nom_area'];
                }
                //$areaNow=$areaID;
                ?>
                <h3 class="page-header">
                <a href="pagar.php?area=<?php echo $_GET['area'];?>"><img src="../syspic/back.png" width="30" height="30"></a>
                Por pagar a <?php echo $nu." ".$apa." ".$ama."  de  ".$areaNow;?>
                </h3>
            </div>
        </div>
        <div align="center">

        <!--
            <form method="GET" action="inde.php">
                <select name="mesactual"  class="form-control">
                    <option value="1">ENERO</option><option value="2">FEBRERO</option>
                    <option value="3">MARZO</option><option value="4">ABRIL</option>
                    <option value="5">MAYO</option><option value="6">JUNIO</option>
                    <option value="7">JULIO</option><option value="8">AGOSTO</option>
                    <option value="9">SEPTIEMBRE</option><option value="10">OCTUBRE</option>
                    <option value="11">NOVIEMBRE</option><option value="12">DICIEMBRE</option>
                </select>
                <button class="btn btn-primary" type="submit">
                    VER
                </button>
            </form>
            -->
        </div>  
        <!-------------------------------------->
        <form action="pagar_venta.php" method="POST">
        <div align="center">
            <button type="submit" class="btn btn-primary">
                MARCAR PAGADAS
            </button>
        </div>
        <section class="row" style="height:750px;overflow-x:scroll;">
            <table class="table">
                <tr>
                    <th></th>
                    <th>Folio Venta</th>
                    <th>SIAC</th>
                    <th>Folio OS</th>
                    <th>Tipo de Cliente</th>
                    <th>Cliente</th>
                    <th>Tipo cliente</th>
                    <th>Paquete</th>
                    <th>Fecha de venta</th>
                    <th>Correo</th>
                    <th>ETAPA</th>
                    <th>PS</th>
                </tr>
                
                <?php
                //var_dump($porciones);
                //$sql4="SELECT * FROM ventas where '$dato'=idvendedor AND mes='$mes' ORDER BY mes DESC,year DESC, dia DESC";
                $sql4="SELECT * FROM venta 
                WHERE   idvendedor='$dato' AND venta_pagada=0 and (etapa='P' OR etapa='PS')
                ORDER BY mes DESC,year DESC, dia DESC";
                $resultado4=$con4->query($sql4);
                while($row4 = $resultado4->fetch_assoc())
                {
                    $ventaid=$row4['idventa'];
                    ?>
                    <tr>
                        <td><input type="checkbox" name="pagos[]" value="<?php echo $ventaid;?>"></td>
                        <td><?php echo $row4['folio_ventas'];?></td>
                        <td><b><?php echo $row4['folio_siac'];?></b></td>
                        <td><?php echo $row4['folio_os'];?></td>
                        <td><?php echo $row4['tipo_cliente'];?></td>
                        <td><?php echo $row4['nombrev']." ".$row4['apaternov']." ".$row4['amaternov'];?></td>
                        <td><?php echo $row4['tipo_cliente'];?></td>
                        <td><?php echo $row4['paquete_venta'];?></td>
                        <td><?php echo $row4['dia']."/".$row4['mes']."/".$row4['year']." ".$row4['hora'];?></td>
                        <td><?php echo $row4['correo_cliente'];?></td>
                        <td><?php echo $row4['etapa'];?></td>
                        <td><?php echo $row4['listo_ps'];?></td>
                    </tr>
                    <?php
                }
                ?>
                
            </table>
        </section>
        <input type="hidden" name="area" value="<?php echo $_GET['area'];?>">
        </form>
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