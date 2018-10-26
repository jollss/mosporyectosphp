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
/*========================================*/
function ejecutar($sql){
    $con = Conectarse();  
    if ($con->query($sql) === TRUE) { echo "Nuevo registro correcto<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>"; } }
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
                <h1 class="page-header">Generar Equipos</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<?php
if(isset($_GET['Narea'])){
    ?>
    <section>
        <form action="equiposF.php" method="GET">
            <input type="text" placeholder="Nombre de la nueva Area" name="Nomarea" class="form-control">
            <button type="submit" title="Click para agregar empleado a un Área" class="btn btn-warning">
                <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
            </button>
        </form>
    </section>
    <?php
}if(isset($_GET['Nomarea'])){
    $idarea=0;
    $con->real_query("SELECT * FROM areas_fielder");
    $resultado = $con->use_result();
    while ($row = $resultado->fetch_assoc()){
        $idarea=$row['idarea'];
    }
    $idarea=$idarea+1;
    $nombreArea=strtoupper($_GET['Nomarea']);
    $sql="INSERT INTO areas_fielder (
    idarea,nom_area)
    VALUES
    ('".$idarea."','".$nombreArea."')";
    ejecutar($sql);
}if(isset($_GET['area']) and isset($_GET['usuario'])){
    $idarea=0;
    $usuario=$_GET['usuario'];
    $area=$_GET['area'];

    $con->real_query("SELECT * FROM equipos_fielder where id_fielder='$usuario'");
    $resultado = $con->use_result();
    while ($row = $resultado->fetch_assoc()){
        $idequipo=$row['idequipo'];
        $fielder=$row['id_fielder'];
        $area_id=$row['id_area'];
    }
    if(isset($idequipo)){
        $sql="UPDATE equipos_fielder SET 
        id_area='$area'
        WHERE id_fielder='".$usuario."'";
        ejecutar($sql);
    }if(!isset($idequipo)){
        $idarea=0;
        $con->real_query("SELECT * FROM equipos_fielder");
        $resultado = $con->use_result();
        while ($row = $resultado->fetch_assoc()){
            $idarea=$row['idequipo'];
        }
        $idarea=$idarea+1;
        echo $usuario." ".$area;
        $sql="INSERT INTO equipos_fielder (
        idequipo,id_fielder,id_area)
        VALUES
        ('".$idarea."','".$usuario."','".$area."')";
        ejecutar($sql);  
    }
}
?>
<section class="row">
    <table>
        <tr>
    <form action="equiposF.php" method="GET">
            <td>
                <select name="usuario" class="form-control">
                <?php
                $con->real_query("SELECT * FROM usuario where tipo_idtipo=23 or tipo_idtipo=22 or tipo_idtipo=32 or tipo_idtipo=34 or
                tipo_idtipo=24 or tipo_idtipo=27 or tipo_idtipo=21 or tipo_idtipo=4");
                $resultado = $con->use_result();
                while ($row = $resultado->fetch_assoc()){
                    if($row['activo']==1){
                    ?>
                        <option value="<?php echo $row['idu'];?>"><?php echo $row['nombre']." ".$row['apaterno']." ".$row['amaterno'];?></option>
                    <?php
                    }
                }
                ?>
                </select>
            </td>
            <td>
                <select name="area" class="form-control">
                <?php
                $con->real_query("SELECT * FROM areas_fielder");
                $resultado = $con->use_result();
                while ($row = $resultado->fetch_assoc()){
                ?>
                    <option value="<?php echo $row['idarea'];?>"><?php echo $row['nom_area'];?></option>
                <?php
                }
                ?>
                </select>
            </td>
            <td>
                 <button type="submit" title="Click para agregar empleado a un Área" class="btn btn-primary">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                </button>
            </td>
            <td>
                
            </td>
     </form>
            <td>
                <form action="equiposF.php" method="GET">
                    <input type="number" value="1" name="Narea" style="display:none;" readonly>
                    <button type="submit" title="Click para agregar una nueva Area" style="border:none;background:none;">
                        <span class="glyphicon glyphicon-question-sign" aria-hidden="true"></span>
                    </button>
                </form>
            </td>
        </tr>
    </table>
</section>
<section>
    <div class="col-md-12" style="height:500px;overflow-y:scroll;">
        <table class="table">
                <tr>
                    <th>EQUIPO ACTUAL</th>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Celular</th>
                    <th>Télefono</th>
                </tr>
    
        <?php
            $sql="SELECT * FROM usuario inner join equipos_fielder inner join areas_fielder where id_fielder=idu and idarea=id_area order by id_area";
                        $resultado=$con->query($sql);
                        while($row = $resultado->fetch_assoc())
                        {
                            //$tipo=0;
                            $nombres=$row['nombre'];
                            $ap=$row['apaterno'];
                            $am=$row['amaterno'];
                            $tipo=$row['tipo_idtipo'];
                            $cel=$row['cel'];
                            $tel=$row['tel'];
                            $idu=$row['idu'];
                            $activo=$row['activo'];
                            $area=$row['nom_area'];
                            if($tipo==23 OR $tipo==22 OR $tipo==32 OR $tipo==34 OR $tipo==24 OR $tipo==27 OR $tipo==21 OR $tipo==4){
                            ?>
                                <tr>
                                    <td style="color:red;font: oblique bold 120% cursive;"><?php echo $area;?></td>
                                    <td><?php echo $idu;?></td>
                                    <td><?php echo $nombres;?></td>
                                    <td><?php echo $ap;?></td>
                                    <td><?php echo $am;?></td>
                                    <td><?php echo $cel;?></td>
                                    <td><?php echo $tel;?></td>
                                </tr>
                            <?php
                            }/*else{
                            }*/
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
