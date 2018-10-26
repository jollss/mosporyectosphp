<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$con = Conectarse();  
$cnxe = Conectarse(); 
$con = Conectarse();  
$con2 = Conectarse(); 
$con3 = Conectarse();
$con4 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$cnxe->real_query("SELECT * FROM usuario WHERE correo = '$mail'");
$result = $cnxe->use_result();
while ($line = $result->fetch_assoc()){
    $iduser=$line['idu'];
}
$tos=0;
$idus=$_POST['ident'];
$con2->real_query("SELECT * FROM usuario WHERE idu='$idus'");
    $resultado = $con2->use_result();
    while ($row = $resultado->fetch_assoc()){
        $tos++;
        $idsuper=$row['idu'];
        $nus=$row['nombre'];
        $apus=$row['apaterno'];
        $amus=$row['amaterno'];
    }
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
                <h1 class="page-header">Asignaciones</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
        <!--<div class="container col-md-12" name="toTop" id="topPos">-->
            <div class="col-md-12">
            <!--<div align="center"><h3><?php echo $user;?></h3></div>-->
                <div class="panel panel-info">
                    <?php
                    $dia=date('j');
                    $mes=date('n');
                    $aaaa=date('Y');
                    $semana = date("W");
                    ?>
                    <div class="panel-heading"><?php echo $dia."/".$mes."/".$aaaa;?><h4><!--Semana:<?php echo $semana;?>--></h4></div>
                    <div class="panel-body">
                    <div class="col-md-12">
                        <?php
                        $dia=date('j');
                        $mes=date('n');
                        $aaaa=date('Y');
                        
                        $semana = date("W");
                        echo "<b><br> Asignar a: ".$nus." ".$apus." ".$amus."</b>";
                        ?>
                    </div>
                    <form action="asignar.php" method="POST">
                        <div class="col-md-4">
                        <input type="text" value="<?php echo $idsuper;?>" name="idsuper" style="display:none;">
                            <div class="form-group">
                            <label for="sel1">Personal sin asignacion:</label>
                                <select class="form-control" id="sel1" name="iduser">
                                <?php
                                   $sql1="SELECT * FROM usuario inner join tipo 
                                    WHERE activo=1 and asignado=0 AND  tipo_idtipo=idtipo  ORDER BY tipo";
                                   $resultado=$con2->query($sql1);
                                   while($row = $resultado->fetch_assoc())
                                    {
                                        $name=$row['nombre']." ".$row['apaterno']." ".$row['amaterno'];
                                        $tipo_idtipos=$row['idtipo'];
                                        $ntipo=$row['tipo'];
                                        if($tipo_idtipos==21 or $tipo_idtipos==27 or 
                                            $tipo_idtipos==24 or $tipo_idtipos==34 or 
                                            $tipo_idtipos==33 or $tipo_idtipos==32 or
                                            $tipo_idtipos==31 or $tipo_idtipos==30 or 
                                            $tipo_idtipos==35){
                                            echo "<option value='".$row['idu']."'>".$ntipo." ".$name."</option>";
                                        }else{}
                                    }
                                ?>
                              </select>
                            </div>
                        </div>
                        <div align="center">
                            <input type="submit" class="btn btn-info" value="ASIGNAR">
                        </div>
                    </form>
                    <div align="center" class="col-md-12">
                        <div id="resultadoBusqueda">
                            <?php
                               $sql1="SELECT * FROM usuario 
                                 WHERE activo=1 AND asignado='$idsuper' ORDER BY nombre";
                               $resultado=$con2->query($sql1);
                            ?>
                            <div class="table-responsive" >
                                <table class="table table-bordered" style="background-color:white;">
                                    <tr>
                                      <th>Nombre</th>
                                      <th>ID</th>
                                      <th>Teléfono</th>
                                      <th>Correo</th>
                                      <th>Quitar Asignación</th>
                                    </tr>
                            <?php
                                while($row = $resultado->fetch_assoc())
                                {
                                    $name=$row['nombre']." ".$row['apaterno']." ".$row['amaterno'];
                                    $phone=$row['cel'];
                                    $mail=$row['correo'];
                                    ?> 
                                    <tr>
                                        <th><?php echo $name;?></th> 
                                        <th><?php echo $row['idu'];?></th> 
                                        <th><?php echo $phone;?></th> 
                                        <th><?php echo $mail;?></th> 
                                        <th>
                                            <form action="delAsigna.php" method="POST">
                                                <input type="text" value="<?php echo $idsuper;?>" name="idsuper" style="display:none;">
                                                <input type="text" value="<?php echo $row['idu'];?>" name="ident" style="display:none;">
                                                <input type="submit" class="btn btn-danger" value="-">
                                            </form>
                                        </th>
                                    </tr>
                                    <?php                                              
                                    }
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
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
</body>
</html>