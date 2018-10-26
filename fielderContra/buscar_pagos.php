<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$con = Conectarse();  
$con2 = Conectarse(); 

$con4 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$tos=0;
/*========================================*/
function ejecutar($sql){
    $con = Conectarse();  
    if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>"; } }
}
function check_in_range($start_date, $end_date, $evaluame) {
    $start_ts = strtotime($start_date);
    $end_ts = strtotime($end_date);
    $user_ts = strtotime($evaluame);
    return (($user_ts >= $start_ts) && ($user_ts <= $end_ts));
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
                <h1 class="page-header">NOMINA</h1> 
            </div>
        </div>
<!--==============================================================================================================================================-->        
        <!--<section class="row" style="height:100px;overflow-x:scroll;">-->
        <section class="row">
        <form action="buscar_pagos.php" method="GET">
        <div align="center"><h3>BUSQUEDA ENTRE FECHAS</h3></div>
        <table class="table">
            <tr>
                <th>FECHA INICIAL</th>
                <th>FECHA FINAL</th>
                <th>AREA</th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <input type="number" min=1 max=31 name="di" placeholdeR="DIA" required>
                
                    <select name="mi" required>
                        <option value="1">ENERO</option>
                        <option value="2">FEBRERO</option>
                        <option value="3">MARZO</option>
                        <option value="4">ABRIL</option>
                        <option value="5">MAYO</option>
                        <option value="6">JUNIO</option>
                        <option value="7">JULIO</option>
                        <option value="8">AGOSTO</option>
                        <option value="9">SEPTIEMBRE</option>
                        <option value="10">OCTUBRE</option>
                        <option value="11">NOVIEMBRE</option>
                        <option value="12">DICIEMBRE</option>
                    </select>
                    <input type="number" min=2017 name="yi" placeholder="AÑO" required>
                </td>
                <td>
                    <input type="number" min=1 max=31 name="df" placeholdeR="DIA" required>
                
                    <select name="mf" required>
                        <option value="1">ENERO</option>
                        <option value="2">FEBRERO</option>
                        <option value="3">MARZO</option>
                        <option value="4">ABRIL</option>
                        <option value="5">MAYO</option>
                        <option value="6">JUNIO</option>
                        <option value="7">JULIO</option>
                        <option value="8">AGOSTO</option>
                        <option value="9">SEPTIEMBRE</option>
                        <option value="10">OCTUBRE</option>
                        <option value="11">NOVIEMBRE</option>
                        <option value="12">DICIEMBRE</option>
                    </select>
                    <input type="number" min=2017 name="yf" placeholder="AÑO" required>
                </td>
                <td>
                <select name="area">
                    <?php
                        $sql="SELECT * FROM areas_fielder order by nom_area";
                        $resultado=$con->query($sql);
                        while($row = $resultado->fetch_assoc())
                        {
                            if($row['nom_area']<>''){
                            ?>
                            <option value="<?php echo $row['idarea'];?>"><?php echo $row['nom_area'];?></option>
                            <?php
                            }
                        }
                    ?>
                </select>
                </td>
                <td>
                    <button class="btn btn-success" type="submit">
                        <i class="glyphicon glyphicon-globe">VER</i>
                    </button>
                </td>
            </tr>
        </table>
        </form>
        </section>
        <?php
        if(isset($_GET['di']) and isset($_GET['mi']) and isset($_GET['yi']) 
            and isset($_GET['df']) and isset($_GET['mf']) and isset($_GET['yf'])){
        ?>
        <section class="row">
        <div align="center">
            <?php echo $_GET['di']."/".$_GET['mi']."/".$_GET['yi']."  al  ".$_GET['df']."/".$_GET['yf']."/".$_GET['yf'];?>
        </div>
        </section>
        <section class="col-md-12" style="height:500px;overflow-y:scroll;">
        <table class="table">
            <tr>
                <th></th>
                <th>AREA</th>
                <th>ETAPA</th>
                <th>Folio SIAC</th>
                <th>Folio OS</th>
                <th>PAGADO</th>
                <th>Fecha Pago</th>
                <th>Pagó</th>
                <th>Folio Venta</th>
                <th>Cliente</th>
                <th>Paquete Venta</th>
                <th>Registro de Venta</th>
            </tr>
            <?php
            $cont=0;
            $start_date = $_GET['yi']."-".$_GET['mi']."-".$_GET['di'];//'2010-06-01';
            $end_date = $_GET['yf']."-".$_GET['mf']."-".$_GET['df'];//'2010-06-01';
            $sql="SELECT * FROM venta ORDER BY dia ASC,mes ASC, year ASC";
            $resultado=$con->query($sql);
            while($row = $resultado->fetch_assoc())
            {
                $pago_idu=$row['idvendedor'];
                $area=$_GET['area'];
                $con3 = Conectarse();
                //$sql3="SELECT * FROM usuario where idu='$pago_idu'";
                $sql3="SELECT * FROM equipos_fielder inner join usuario inner join tipo inner join areas_fielder
                WHERE id_area=idarea and id_area='$area' and idu=id_fielder and idtipo=tipo_idtipo and idu='$pago_idu' ORDER BY tipo_idtipo DESC";
                $resultado3=$con3->query($sql3);
                while($row3 = $resultado3->fetch_assoc())
                {
                    $n=$row3['nombre'];
                    $ap=$row3['apaterno'];
                    $nom_area=$row3['nom_area'];
                }
                if(isset($n) and isset($ap)){
                    //echo "string<br>";
                    
                    $fecha_a_evaluar = $row['year']."-".$row['mes']."-".$row['dia'];//'2010-06-15';
                    if (check_in_range($start_date, $end_date, $fecha_a_evaluar)) {
                        $cont++;
                        //echo $fecha_a_evaluar."<br>";
                        
                        
                        //if(($row['etapa']=='P' OR $row['etapa']=='PS')){
                        ?>
                        <tr>
                            <th><?php echo $cont;?></th>
                            <th><?php echo $nom_area;?></th>
                            <th><?php echo $row['etapa'];?></th>
                            <th><?php echo $row['folio_siac'];?></th>
                            <th><?php echo $row['folio_os'];?></th>
                            <th>
                            <?php 
                            if($row['venta_pagada']==0){
                                echo "<label style='color:RED;'>SIN PAGO</label>";
                            }if($row['venta_pagada']==1){
                                echo "<label style='color:green;'>PAGADO</label>";
                            }
                            ?>
                            </th>
                            <th><?php echo $row['fecha_pago'];?></th>
                            <th><?php echo $n." ".$ap;?></th>
                            <th><?php echo $row['folio_ventas'];?></th>
                            <th><?php echo $row['nombrev']." ".$row['apaternov']." ".$row['amaternov'];?></th>
                            <th><?php echo $row['paquete_venta'];?></th>
                            <th><?php echo $row['dia']."/".$row['mes']."/".$row['year']." ".$row['hora'];?></th>
                        </tr>
                        <?php
                        //}
                    }
                    
                }
            }
            ?>
        </table>
        </section>
        <?php
        }
        ?>
        
<!--=============================================================================-->        
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
      <h2 class="modal-title">VENTAS</h2>
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
        var iduser=$(this).data("id");
        console.log(iduser);
        $('.modal-body').load('getVentas.php?iduser='+iduser,function(){
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
<script>
    $(".ocultar").click(function (){
        $(".lista").hide(2000,function(){
            $(".lventa").show();
        });
    });
     $(".mostrar").click(function (){
        $(".lista").show(2000,function(){
            $(".lventa").hide();
        });
    });
</script>

</body>
</html>