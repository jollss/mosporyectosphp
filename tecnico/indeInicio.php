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
$as=$Yo->regresaAsignado();
$tos=0;
/*========================================*/

/*========================================*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <link href="../css/slider.css" rel="stylesheet">
<script type="text/javascript" src="../js/browser5.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

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
    nivel1($user);
  }
?>
</head>
<body  onload="abrir()">
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-1">
    <br><br><br>
    </div>
    <div class="col-md-10">
    <div align="center"></div>
        <div class="panel panel-info">
            <?php
            $dia=date('j');
            $mes=date('n');
            $aaaa=date('Y');
            $semana = date("W");
            ?>
            <div class="panel-heading"><?php echo $dia."/".$mes."/".$aaaa;?></div>
            <div class="panel-body" style="background-color:gray;">
            <div align="center" style="font-size:12px !important;">
                <div id="resultadoBusqueda" style="height:500px;overflow-y:scroll;">
                <form action=" infoos.php" method="POST">
                        <div class="table-responsive" >
                            <table class="table table-bordered" style="background-color:white;font-size:12px;">
                                <tr>
                                  <th>No</th>
                                  <th>Nombre Completo</th>
                                  <th>Correo</th>
                                  <th>RESTANTES</th>
                                </tr>
                                 <?php
                                 $Total=new Usuario();
                                    $totalU=$Total->TotalUBD($con);
                                    $aux=0;
                                    $aux2=0;

                                    for ($i=0; $i <= $totalU; $i++) {
                                        $aux2=$i%2;
                                        $Usuario=new Usuario();
                                        $Usuario->obtenerUsuarioBD($i,$con);
                                        $activo= $Usuario->regresaActivo();
                                        $tipo=$Usuario->regresaTipoIdTipo();
                                        $idu=$Usuario->regresaIdu();
                                        $correou=$Usuario->regresaCorreo();
                                        $asignado=$Usuario->regresaAsignado();
                                        if( $tipo==1 and $as==$asignado){
                                            $aux=$aux+1;
                                            $CantidadesU=new Cantidades();
                                            $Tecnico=new Usuario();
                                            $Tecnico->obtenerUsuarioBD($i,$con);
                                            $nombres=$Tecnico->regresaNombre();
                                            $ap=$Tecnico->regresaApaterno();
                                            $am=$Tecnico->regresaAmaterno();
                                            $conta=0;
                                            $con2 = Conectarse();
                                            $con2->real_query("SELECT * FROM os inner join dataos WHERE idmos=id_orden and estatus=0 and asignado='$idu'");// AND semana='$semana'");
                                            $re = $con2->use_result();
                                            while ($row2 = $re->fetch_assoc()){
                                                $tipos=$row2['tipo_os'];
                                                $conta=$conta+1;
                                            }
                                            $TOTAL=$conta;
                                            if($aux2==0){
                                            ?>
                                            <tr>
                                                <th><?php echo $aux;?></th>
                                                <th style="font-size:15px !important;"><?php echo $nombres." ".$ap." ".$am;?></th>
                                                <th><?php echo $correou;?></th>
                                                <th style="color:red; font-size:20px !important;"><?php echo $TOTAL;?></th>
                                            </tr>
                                            <?php
                                        }if($aux2==1){
                                            ?>
                                            <tr style="background-color:orange;">
                                                <th><?php echo $aux;?></th>
                                                <th style="font-size:15px !important;"><?php echo $nombres." ".$ap." ".$am;?></th>
                                                <th><?php echo $correou;?></th>
                                                <th style="color:red; font-size:20px !important;"><?php echo $TOTAL;?></th>
                                            </tr>
                                            <?php
                                        }
                                        }
                                    }
                                    ?>
                            </table>
                        </div>
                </form>
                 </div>
            </div>
            </div>
        </div>
    </div>
    <?php footer();?>
</div>
<div class="col-md-1"></div>

<script src="../js/menu.js"></script>

</body>
</html>
