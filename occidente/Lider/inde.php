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
    <?php lider($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="page-header">VENTAS DEL MES: <?php echo $mesactual;?></h3>
            </div>
        </div>
        <div align="center">
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
        </div>
        <!-------------------------------------->
        <?php
        
        if($areaLider<>0){
            $sql2="SELECT * FROM equipos_fielder inner join usuario 
            where '$areaLider'=id_area and id_fielder=idu and
            asignado='$iduser' and activo=1";
            $resultado2=$con2->query($sql2);
            ?>
            <table class="table">
            <?php
            while($row2 = $resultado2->fetch_assoc())
            {
                $cuenta=0;
                ?>
                <tr>
                <?php
                $iduserEquipo=$row2['id_fielder'];
                //echo "-".$iduserEquipo."-";
                //$sql3="SELECT * FROM usuario where '$iduserEquipo'=idu and activo=1";
                //$resultado3=$con3->query($sql3);
                //while($row3 = $resultado3->fetch_assoc())
                //{
                    $idusuarioV=$row2['idu'];
                    ?>
                    <th><?php echo $row2['nombre']." ".$row2['apaterno']." ".$row2['amaterno'];?></th>
                    <?php
                //}
                $sql4="SELECT * FROM venta where '$iduserEquipo'=idvendedor and mes='$mesactual'";
                $resultado4=$con4->query($sql4);
                while($row4 = $resultado4->fetch_assoc())
                {
                    $cuenta=$cuenta+1;
                }
                ?>
                    <th><?php echo $cuenta;?></th>
                    <th>
                     <button type="button" class="btn btn-info btn-md bntmodal myBtn" name="valor" data-id="<?php echo $mesactual."-".$idusuarioV;?>" value="<?php echo $mesactual."-".$idusuarioV;?>">VER</button>
                    </th>
                </tr>
                <?php
            }
            ?>
            </table>
            <?php
        }else{
            ?>
            <h2>Solicita te agregen a un equipo de trabajo para ver tu ÁREA</h2>
            <?php
        }
        ?>
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
        $('.modal-body').load('listVentasModal.php?id='+idmos,function(){
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