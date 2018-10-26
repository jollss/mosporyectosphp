<?php
include("../Config/library.php");
include("../Models/pago_fielder.php");
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
                <h1 class="page-header">PAGO</h1>
            </div>
        </div>
<!--==============================================================================================================================================-->        
        <!--<section class="row" style="height:100px;overflow-x:scroll;">
        <table class="table">
            <tr>
            <?php
                $sql="SELECT * FROM areas_fielder order by nom_area";
                $resultado=$con->query($sql);
                while($row = $resultado->fetch_assoc())
                {
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
            ?>
            </tr>
        </table>
        </section>-->
        <section class="row">
            <ol class="breadcrumb">
                <li><a href="inde.php">Inicio</a></li>
            </ol>
        </section>
        <?php
        $user=$_GET['user'];
        $sql4="SELECT * FROM usuario where idu='$user'";
        $resultado4=$con4->query($sql4);
        while($row4 = $resultado4->fetch_assoc())
        {
            $name=$row4['nombre'];
            $apaterno=$row4['apaterno'];
        }
        ?>
        <section class="col-md-12 lista" style="">
            <div style="background-color:black;color:white;">
                <h3>PAGO DE <?php echo $name." ".$apaterno;?></h3>
            </div>
            <form action="pago_form.php" method="GET">
            <input type="hidden" name="user" value="<?php echo $user;?>">
            <div class="col-md-4">
                <input type="date" name="inicio" class="form-control">
            </div>
            <div class="col-md-4">
                <input type="date" name="fin" class="form-control">
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">
                    CALCULAR
                </button>
            </div>
            </form>
        </section>
        
        <?php
        $PAGO = new pago_fielder();
        if(isset($_GET['inicio']) and isset($_GET['fin'])){
                $PAGO->datos($_GET['inicio'],$_GET['fin'],$user,$con);
        }
        /*
        if(isset($_GET['inicio']) and isset($_GET['fin'])){
            $dia1 = date("d", strtotime($_GET['inicio']));
            $mes1 = date("m", strtotime($_GET['inicio']));
            $year1 = date("Y", strtotime($_GET['inicio']));
 
            $dia2 = date("d", strtotime($_GET['fin']));
            $mes2 = date("m", strtotime($_GET['fin']));
            $year2 = date("Y", strtotime($_GET['fin']));

            //echo $dia1."/".$mes1."/".$year1."----".$fin;

        }
        */
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