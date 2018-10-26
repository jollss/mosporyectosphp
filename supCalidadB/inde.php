<?php
include("../Config/library.php");

$con = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="../js/browserSup.js"></script>
<?php
$self = $_SERVER['PHP_SELF']; //Obtenemos la página en la que nos encontramos
header("refresh:12; url=$self");
$con = Conectarse();
$correo = $_SESSION['mail'];
$user = $_SESSION['username'];
$idus=0;
$tos=0;
$Yo = new Usuario();
$Yo->obtenerUsuarioCorreoBD($correo,$con);
$iduser=$Yo->regresaIdu();
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
    supBajantes($user);}
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana = date("W");
?>
</head>
<body>
<br><br><br><br>
<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">Supervisores</div>
        <div class="panel-body table-responsive" style="font-size:12px;">
            <table class="table">
                <tr>
                    <td></td>
                    <td>ID</td>
                    <td>NOMBRE COMPLETO</td>
                    <td>CORREO</td>
                    <td></td>
                </tr>
                <?php
                $sql1="SELECT * FROM usuario WHERE tipo_idtipo=3 AND activo=1";
                $resultado=$con->query($sql1);
                while($row = $resultado->fetch_assoc())
                {
                    ?>
                            <form action="tecnicosA.php" method="POST">
                            <input type="text" value="<?php echo $row['idu'];?>" style="display:none;" name="super" readonly>
                                <tr>
                                    <th><input type="submit" value="Ver"></th>
                                    <th><?php echo $row['idu'];?></th>
                                    <th><?php echo $row['nombre']." ".$row['apaterno']." ".$row['amaterno'];?></th>
                                    <th><?php echo $row['correo'];?></th>

                            </form>
                            <!--
                            <form action="bolsaCarga.php" method="POST">
                                <input type="text" value="<?php echo $idu;?>" style="display:none;" name="super" readonly>
                                <th><input type="submit" value="BOLSA"></th>
                            </form>
                            -->
                                </tr>
                            <?php
                }
                ?>
            </table>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="col-md-3"></div>
    <div class="panel panel-default col-md-6">
        <div class="panel-heading">Busqueda</div>
        <div class="panel-body" style="background-color:gray;">
            <div align="center">
                <form accept-charset="utf-8" method="POST">
                    <div class="form-group">
                        <input type="search" class="form-control" onkeyup ="loadXMLDoc()" placeholder="FOLIO PISA" id="bus">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-12">
        <div id="resultadoBusqueda"></div>
    </div>
</div>
<div class="col-md-2" ></div>
<div class="col-md-2"></div>
<div class="col-md-12"><?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>
