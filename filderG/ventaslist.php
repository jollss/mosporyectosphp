<!DOCTYPE html>
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
$idu=$_POST['idu'];
/*========================================*/
function ejecutar($sql){
    $con = Conectarse();  
    if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>"; } }
}
/*========================================*/
?>
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
    <link href="../css/menu.css" rel="stylesheet">
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
                <h1 class="page-header">Listado de Ventas</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<section class="row">
    <?php
    $sql2="SELECT * FROM usuario where idu='$idu'";
    $resultado2=$con2->query($sql2);
    while($row2 = $resultado2->fetch_assoc())
    {
        $nombre=$row2['nombre'];
        $apaterno=$row2['apaterno'];
        $amaterno=$row2['amaterno'];
    }
    echo "<h3>".$nombre." ".$apaterno." ".$amaterno."</h3>";
    ?>
</section>
<section class="row">
    <div class="col-md-12" style="height:500px;overflow-x:scroll;">
        <table class="table datagrid">
            <tr>
                <th>ID VENTA</th>
                <th>FOLIO VENTA</th>
                <th>NOMBRE</th>
                <th>APELLIDO PATERNO</th>
                <th>APELLIDO MATERNO</th>
                <th>DIRECCION</th>
                <th>DATOS</th>
                <th>TERMINAL</th>
                <th>TELEFONO 1</th>
                <th>TELEFONO 2</th>
                <th>TELEFONO 3</th>
                <th>FECHA</th>
                <th>ESTATUS</th>
                <th>VENDEDOR</th>
                <th>DOCUMENTACION</th>
                <th>AREA</th>
                <th>DISTRITO</th>
            </tr>
            <?php
            $sql="SELECT * FROM ventas where idvendedor='$idu' ORDER BY mes  DESC, year DESC, dia DESC";
            $resultado=$con->query($sql);
            while($row = $resultado->fetch_assoc())
            {
            ?>
            <tr>
                <td><?php echo $row['idventa'];?></td>
                <td style="font-weight: bold;color:red;"><?php echo $row['folio_ventas'];?></td>
                <td><?php echo $row['nombre'];?></td>
                <td><?php echo $row['apaternov'];?></td>
                <td><?php echo $row['amaternov'];?></td>
                <td><?php echo $row['direccion'];?></td>
                <td><?php echo $row['datos'];?></td>
                <td><?php echo $row['terminal'];?></td>
                <td><?php echo $row['telefono_1'];?></td>
                <td><?php echo $row['telefono_2'];?></td>
                <td><?php echo $row['telefono_3'];?></td>
                <td style="font-weight: bold;color:red;"><?php echo $row['dia']."/".$row['mes']."/".$row['year']." ".$row['hora'];?></td>
                <td><?php echo $row['estatus'];?></td>
                <td><?php echo $row['vendedor'];?></td>
                <td><?php echo $row['documentacion'];?></td>
                <td><?php echo $row['area'];?></td>
                <td><?php echo $row['distrito'];?></td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</section>
<!--============================================================================================-->      
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
</div>
</body>
</html>
