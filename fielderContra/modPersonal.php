<?php
include("../Config/library.php");
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$idus=$Yo->regresaIdu();
$id=$_POST['idu'];
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
    <?php gventas($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Modificacion</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<?php
        $sql="SELECT * FROM usuario WHERE idu='$id'";
        $resultado=$con->query($sql);
        while($row = $resultado->fetch_assoc())
        {
            $nombre=$row['nombre'];
            $apaterno=$row['apaterno'];
            $amaterno=$row['amaterno'];
            $cel=$row['cel'];
            $tel=$row['tel'];
            $correo=$row['correo'];
        }
?>
        <div class="col-md-12"><a href="regUser.php"><img src="../syspic/back.png" width="40" height="40"></a></div>
        <div class="col-md-12">
            <form action="modPersonalR.php" method="POST">
            <input  type="text" name="id" value="<?php echo $id;?>" style="display:none;">
                <table class="table">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apelido Materno</th>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="text" name="name" value="<?php echo $nombre;?>"></td>
                        <td><input class="form-control" type="text" name="apa" value="<?php echo $apaterno;?>"></td>
                        <td><input class="form-control" type="text" name="ama" value="<?php echo $amaterno;?>"></td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <th>Celular</th>
                        <th>Telefono</th>
                        <th>Usuario</th>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="text" name="cel" value="<?php echo $cel;?>"></td>
                        <td><input class="form-control" type="text" name="tel" value="<?php echo $tel;?>"></td>
                        <td><input class="form-control" type="text" name="mail" value="<?php echo $correo;?>" required></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input class="btn btn-primary" type="submit"  value="MODIFICAR"></td>
                        <td></td>
                    </tr>
                </table>
            </form>
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
