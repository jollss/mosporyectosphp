<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
//$idus=$_POST['ident'];
$Yo = new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
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
    <script type="text/javascript" src="../js/browserVentas.js"></script>
    <script src="../js/jquery-3.2.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>

<div id="wrapper">
    <!-- Navigation MENU-->
    <?php nivel4($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Busqueda</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-12">
        <div class="panel panel-info">
        <?php
                $dia=date('j');
                $mes=date('n');
                $aaaa=date('Y');
                $semana = date("W");
            ?>
            
            <div align="center">
                <form accept-charset="utf-8" action="buscarVenta.php" method="GET">
                <div class="form-group">
                    <input type="search" class="form-control"  placeholder="Ingresa dato a buscar" name="data">
                </div>
                <button type="submit" class="btn btn-primary">
                    buscar
                </button>
                </form>
                 <div id="resultadoBusqueda"></div>
                </div>
            <div class="panel-heading">
                <?php 
                    echo $dia."/".$mes."/".$aaaa;
                    echo "<br><b>BUSCAR</b>";
                ?>
            </div>
            <div class="panel-body" style="height:500px;overflow-x:scroll;">
                <?php
                if(isset($_GET['data'])){
                $data=$_GET['data'];
                    $con1 = Conectarse();
                    $sql="SELECT * FROM venta WHERE folio_ventas LIKE '%$data%' or nombrev LIKE '%$data%' or rfc_cliente LIKE '%$data%'";
                    $resultado=$con1->query($sql);
                    ?>
                    <table class="table">
                    <tr>
                        <th>VER</th>
                        <th>EDITAR</th>
                        <th>FOLIO VENTA</th>
                        <th>CLIENTE</th>
                        <th>DIRECCIÓN</th>
                        <th>TEL1</th>
                        <th>TEL2</th>
                        <th>TEL3</th>
                        <th>FECHA DE REGISTRO</th>
                        <th>RFC</th>
                        <th>CORREO</th>
                    </tr>
                    <?php
                    while($row = $resultado->fetch_assoc())
                    {
                        $idv=$row['idventa'];
                        $estatus=$row['estatus'];
                    ?>
                    <tr>
                        <td><button type="button" class="btn btn-info btn-md bntmodal myBtn" name="valor" data-id="<?php echo $idv;?>" value="<?php echo $idv;?>">VER</button></td>
                        <td>
                        <?php
                        if($estatus==0){
                            ?>
                            <form action="infoos.php" method="POST">
                                <input type="hidden" value="<?php echo $idv;?>" name="ident">
                                <button class="btn btn-warning">
                                    EDITAR
                                </button>
                            </form>
                            <?php
                        }if($estatus==1){
                            ?>
                            <form action="step3.php" method="POST">
                                <input type="hidden" value="<?php echo $idv;?>" name="ident">
                                <button class="btn btn-warning">
                                    EDITAR
                                </button>
                            </form>
                            <?php
                        }
                        ?>
                        </td>
                        <td><?php echo $row['folio_ventas'];?></td>
                        <td><?php echo $row['nombrev']." ".$row['apaternov']." ".$row['amaternov'];?></td>
                        <td><?php echo $row['direccion'];?></td>
                        <td><?php echo $row['telefono_1'];?></td>
                        <td><?php echo $row['telefono_2'];?></td>
                        <td><?php echo $row['telefono_3'];?></td>
                        <td><?php echo $row['dia']."/".$row['mes']."/".$row['year']." ".$row['hora'];?></td>
                        <td><?php echo $row['rfc_cliente'];?></td>
                        <td><?php echo $row['correo_cliente'];?></td>
                    </tr>
                    <?php
                    }
                    ?>
                    </table>
                    <?php
                }if(!isset($_GET['data'])){
                    ?>
                    <div align="center">
                        <h3>Ingresa NOMBRE DE CLIENTE, FOLIO SIAC, OS Y TELÉFONO ASIGNADO a buscar</h3>
                    </div>
                    <?php
                }
                ?>
            </div>
    </div>    
</div>                                                                                                                                              
</div>
<!--============================================================================================-->      
    </div>
</div>
<!-- Modal -->
<div class="modal fade myModal" id="" role="dialog" style="width:100% !important;">
<div class="modal-dialog modal-lg">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Datos de la Orden</h4>
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
        console.log(idmos);
        $('.modal-body').load('ventaData.php?id='+idmos,function(){
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
</div>
</body>
</html>
