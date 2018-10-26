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
        <script type="text/javascript" src="../js/browserDigital.js"></script>
<?php
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
    cobranza($user);
  }
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana = date("W");
?>
</head>
<body>
<br><br><br><br>
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">Supervisores</div>
        <div class="panel-body table-responsive" style="font-size:12px;">
            <div style="height:500px;overflow-y:scroll;">
                <table class="table">
                    <tr>
                        <td></td>
                        <td>ID</td>
                        <td>NOMBRE COMPLETO</td>
                        <td>CORREO</td>
                        <td></td>
                    </tr>
                    <?php
                        $totales=new Usuario();
                        $total=$totales->TotalUBD($con);
                        for ($i=0; $i <= $total; $i++) {
                            $supervisor=new Usuario();
                            $supervisor->obtenerUsuarioBD($i,$con);
                            $tipo=$supervisor->regresaTipoIdTipo();
                            $activo=$supervisor->regresaActivo();
                            if($tipo==3 && $activo==1){
                                $idu=$supervisor->regresaIdu();
                                $correo=$supervisor->regresaCorreo();
                                $nom=$supervisor->regresaNombre();
                                $apepa=$supervisor->regresaApaterno();
                                $apma=$supervisor->regresaAmaterno();
                                $nomcompleto=$nom." ".$apepa." ".$apma;
                                ?>
                                <form action="tecnicosA.php" method="POST">
                                <input type="text" value="<?php echo $idu;?>" style="display:none;" name="super" readonly>
                                    <tr>
                                        <th><input type="submit" value="Ver" class="btn btn-primary"></th>
                                        <th><?php echo $idu;?></th>
                                        <th><?php echo $nomcompleto;?></th>
                                        <th><?php echo $correo;?></th>

                                </form>
                                    </tr>
                                <?php
                            }
                        }
                    ?>
                </table>
            </div>
        </div>
    </div>
</div>
<!--
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
</div>-->
<div class="col-md-2" ></div>
<div class="col-md-2"></div>
<div class="col-md-12"><?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>
