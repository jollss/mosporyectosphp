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
function ejecutar($sql){
    $con = Conectarse();  
    if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>"; } }
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
                <h1 class="page-header">Venta</h1>
            </div>
        </div>
<!--==============================================================================================================================================-->        
        <section class="row" style="height:120px;overflow-x:scroll;">
        <table class="table">
            <tr>
                <td>
                <form action="migration.php" method="GET">
                    <input type="text" placeholder="Folio Pisa" name="folio" class="form-control" required>
                    <button class="btn btn-success" type="submit">
                        <i class="glyphicon glyphicon-globe"> Buscar</i>
                    </button>
                </form>
                </td>
                <td>
                    <p>
                        Busqueda rapida presiona CTRL + F y coloca el folio o dato a buscar.
                    </p>
                </td>
            </tr>
        </table>
        </section>
        <section class="col-md-12 lista" style="height:500px;overflow-y:scroll;">
            <table class="table">
                <tr>
                    <th>Folio Pisa</th>
                    <th>Télefono</th>
                    <th>Cliente</th>
                    <th>COPE</th>
                    <th>Tipo Tarea</th>
                    <th>Distrito</th>
                    <th>Zona</th>
                    <th>VER</th>
                </tr>
                <?php
                $con3 = Conectarse();
                $sql3="SELECT * from os inner join dataos inner join validar_os where idmos=id_orden and estatus=2 and folio_pisa=id_folio_pisa and tipo_tarea like '%TS%'";
                $resultado3=$con3->query($sql3);
                while($row3 = $resultado3->fetch_assoc())
                {
                    ?>
                    <tr>
                        <td><?php echo $row3['folio_pisa'];?></td>
                        <td><?php echo $row3['telefono'];?></td>
                        <td><?php echo $row3['cliente'];?></td>
                        <td><?php echo $row3['cope'];?></td>
                        <td><?php echo $row3['tipo_tarea'];?></td>
                        <td><?php echo $row3['distrito'];?></td>
                        <td><?php echo $row3['zona'];?></td>
                        <td>
                            <!--<button type="button" class="btn btn-info bntmodal" data-toggle="modal" data-target="#myModal">VER</button>-->
                            <!--<button type="button" class="btn btn-info btn-md bntmodal myBtn" name="id" data-id="<?php echo $row['idmos'];?>" value="<?php echo $row['idmos'];?>">VER</button>-->
                            <!--<button type="button" class="btn btn-info btn-md bntmodal myBtn" name="user" data-id="<?php echo $row['idmos'];?>" value="<?php echo $row['idmos'];?>">VER</button>-->
                            <button type="button" class="btn btn-info btn-md bntmodal myBtn" name="user" data-id="<?php echo $row['idmos'];?>" value="<?php echo $row['idmos'];?>">VER</button>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </table>
        </section>
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
/*
$(document).ready(function(){
    $('.bntmodal').click (function(){
        var idmos=$(this).data("id");
        console.log(idmos);
        $('.modal-body').load('getOs.php?idmos='+idmos,function(){
            $('.myModal').modal({show:true});
        });
    });
});*/
/*
$(document).ready(function(){
    $('.bntmodal').click (function(){
        var iduser=$(this).data("id");
        console.log(iduser);
        $('.modal-body').load('getOs.php?idmos='+iduser,function(){
            $('.myModal').modal({show:true});
        });
    });
});*/
$(document).ready(function(){
    $('.bntmodal').click (function(){
        var iduser=$(this).data("id");
        console.log(iduser);
        $('.modal-body').load('getOs.php?iduser='+iduser,function(){
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