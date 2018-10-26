<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$con = Conectarse();  

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
            <div class="col-lg-12" align="center">
                <h3 class="page-header">Mover mis ventas</h3>
            </div>
        </div>
        <div align="center">
        <p>NOTA: Las ventas que muevas no podran ser regresadas a ti, en caso de tener un error mandar un correo a soporte.</p>
        <form action="moventaschange.php" method="POST">
            <div class="table-responsive col-md-12" style="height:500px;ovrflow-y:scroll;">
                <table class="table">
                <tr>
                    <th></th>
                    <th></th>
                    <th>Folio Venta</th>
                    <th>Cliente</th>
                    <th>Terminal</th>
                    <th>Telefonos</th>
                    <th></th>
                    <th></th>
                    <th>Fecha de registro</th>
                    <th>Area</th>
                </tr>
                <?php
                $indice=0;
                $con2 = Conectarse(); 
                $sql2="SELECT * FROM venta where idvendedor='".$iduser."'";
                $resultado2=$con2->query($sql2);
                while($row2 = $resultado2->fetch_assoc())
                {
                    $indice++;
                    ?>
                    <tr>
                        <td><?php echo $indice;?></td>
                        <td><input type="checkbox" name="select[]" value="<?php echo $row2['idventa'];?>"></td>
                        <td><?php echo $row2['folio_ventas'];?></td>
                        <td><?php echo $row2['nombrev']." ".$row2['apaternov']." ".$row2['amaternov'];?></td>
                        <td><?php echo $row2['terminal'];?></td>
                        <td><?php echo $row2['telefono_1'];?></td>
                        <td><?php echo $row2['telefono_2'];?></td>
                        <td><?php echo $row2['telefono_3'];?></td>
                        <td><?php echo $row2['dia']."/".$row2['mes']."/".$row2['year'];?></td>
                        <td><?php echo $row2['area'];?></td>
                        <td></td>
                    </tr>
                    <?php
                }
                ?>
                </table>
            </div>
            <div class="col-md-6">
                <select name="cambio" class="form-control">
                <?php
                $sql2="SELECT * FROM equipos_fielder inner join usuario 
                    where '".$areaLider."'=id_area and id_fielder=idu and
                    asignado='".$iduser."' and activo=1";
                    $resultado2=$con3->query($sql2);
                     while($row2 = $resultado2->fetch_assoc())
                    {
                        ?>
                            <option value="<?php echo $row2['idu'];?>"><?php echo $row2['nombre']." ".$row2['apaterno']." ".$row2['amaterno'];?></option>
                        <?php
                    }
                ?>
                </select>
            </div>
            <div class="col-md-6">
                <button type="submit" class="btn btn-default">CAMBIAR</button>
            </div>
        </form>
        </div>
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