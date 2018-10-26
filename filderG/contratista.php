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
<!--==================================================================================================================-->        
        <section class="row" style="height:100px;overflow-x:scroll;">
        <table class="table">
            <tr>
            <?php
                $sql="SELECT * FROM areas_fielder order by nom_area";
                $resultado=$con->query($sql);
                while($row = $resultado->fetch_assoc())
                {
                    if($row['nom_area']<>''){
                    ?>
                    <td>
                    <form action="inde.php" method="GET">
                        <input type="number" value="<?php echo $row['idarea'];?>" name="area" style="display:none;" readonly>
                        <button class="btn btn-success" type="submit">
                            <i class="glyphicon glyphicon-globe">  <?php echo $row['nom_area'];?></i>
                        </button>
                    </form>
                    </td>
                    <?php
                    }
                }
            ?>
            </tr>
        </table>
        </section>
        <section class="row">
           <?php
                $sql="SELECT * FROM usuario where tipo_idtipo=32 and activo=1 order by idu";
                $resultado=$con->query($sql);
                while($row = $resultado->fetch_assoc())
                {
                    
                    ?>
                    <tr>
                        <td>
                            <label><?php echo $row['nombre'];?></label>
                        </td>
                    </tr>
                    <?php
                    
                }
            ?>
        </section>
        <section class="col-md-12 lista" style="height:500px;overflow-y:scroll;">
            
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