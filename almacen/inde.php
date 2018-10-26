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
    <?php
    $query = "SELECT * FROM usuario  WHERE  idu='$iduser' and bandera_contrase='no' ";
  $result = $con->query($query);
  while($filas = $result->fetch_assoc()) {
    //print_r($filas);
   $modificarcontrase=$filas['bandera_contrase'];
    $modificarcontrasenombre=$filas['nombre'];
    $modificarcontraseidu=$filas['idu'];
   }
  if($modificarcontrase=='no'){
  echo"<h2><p style='color:#FF0000';>$modificarcontrasenombre</p> tienes que cambiar contraseña por motivos de seguridad  favor de llenar el siguiente formulario</h2> ";
  echo"<form action='../modi.php' method='POST'>
  <input type='hidden'  placeholder='nueva contraseña'  name='idu' value='$modificarcontraseidu'>
    <input type='password'  placeholder='nueva contraseña'  name='pass' aria-describedby='sizing-addon2' maxlength='10' required>
      <input type='submit' class='btn btn-primary' value='Enviar'>


  </form>

  ";
  }else{

    almacen($user);
}


    ?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">BUSCAR PERSONAL</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->
<!--============================================================================================-->
    <form action="inde.php" method="GET">
        <div class="input-group">
          <input type="text" class="form-control" placeholder="Buscar " name="dato">
          <span class="input-group-btn">
            <button class="btn btn-primary" type="button">BUSCAR</button>
          </span>
        </div><!-- /input-group -->
    </form>
    <div style="overflow:scroll;height: 500px;">
        <table class="table">
            <?php
            if(!isset($_GET['dato'])){
                $sql1="SELECT * FROM usuario WHERE tipo_idtipo=1 and activo=1";
                $resultado=$con->query($sql1);
                while($row = $resultado->fetch_assoc())
                {
                    $idu=$row['idu'];
                    $nombre=$row['nombre'];
                    $apaterno=$row['apaterno'];
                    $amaterno=$row['amaterno'];
                    ?>
                    <tr>
                        <th><input type="text" name="idu" style="border:none;" value="<?php echo $idu;?>"></th>
                        <th><?php echo $nombre." ".$apaterno." ".$amaterno;?></th>
                        <th>
                            <form action="asigMaterial.php" method="POST">
                                <input type="text" name="idu" value="<?php echo $idu;?>" style="display:none;">
                                <input type="submit" value="VER" class=" btn btn-success">
                            </form>
                        </th>
                        <th>

                        </th>
                    </tr>
                    <?php
                }
            }else{
                $dato=$_GET['dato'];
                $sql1="SELECT * FROM usuario WHERE tipo_idtipo=1 and activo=1 and nombre like '%$dato'";
                $resultado=$con->query($sql1);
                while($row = $resultado->fetch_assoc())
                {
                    $idu=$row['idu'];
                    $nombre=$row['nombre'];
                    $apaterno=$row['apaterno'];
                    $amaterno=$row['amaterno'];
                    ?>
                    <tr>
                        <th><input type="text" name="idu" style="border:none;" value="<?php echo $idu;?>"></th>
                        <th><?php echo $nombre." ".$apaterno." ".$amaterno;?></th>
                        <th>
                            <form action="asigMaterial.php" method="POST">
                                <input type="text" name="idu" value="<?php echo $idu;?>" style="display:none;">
                                <input type="submit" value="VER" class=" btn btn-success">
                            </form>
                        </th>
                        <th>

                        </th>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
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
</div>
</body>
</html>
