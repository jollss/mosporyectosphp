<?php
include("../Config/library.php"); 
$self = $_SERVER['PHP_SELF']; //Obtenemos la página en la que nos encontramos
//header("refresh:12; url=$self"); 
date_default_timezone_set('America/Mexico_City');
$con = Conectarse();  
$correo = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo = new Usuario();
$Yo->obtenerUsuarioCorreoBD($correo,$con);
$iduser=$Yo->regresaIdu();
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
    <?php
        cbajantes($user);
    ?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
<div class="panel panel-primary col-md-12">
            <div class="panel-heading">
            <h3>FORMATO SOLICITUD DE VACACIONES</h3><BR>
                <!--Presiona CTRL + F y coloca nombre a buscar.-->
            </div>
</div>
<!--<form action="pdfNomina.php" method="POST" target="_blank">-->
<?php
//var_dump($_POST);
echo "<br>";
$array=$_POST['array_selecion'];
$iduU=$array['0'];
//$inicial=$_POST['inicial'];
//$final=$_POST['final'];
echo "<br>";
?>
        <div style="height:100px;overflow-y:scroll;" class="col-md-12">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>TIPO</th>
                    <TH>SALARIO</TH>
                </tr>
                <?php
                    $sql="SELECT * FROM usuario inner join tipo inner join infuser
                        where usuario_iduu=idu and activo='1' and tipo_idtipo=idtipo and idu='$iduU'";
                    $contar=0;
                    $con1 = Conectarse();
                    $resultado=$con1->query($sql);
                    while($row = $resultado->fetch_assoc())
                    {
                        $salario=$row['salario']; 
                        ?>
                            <tr>
                            <!--<form action="formNomina.php" method="POST">-->
                                <td><?php echo $row['idu'];?></td>
                                <td><?php echo $row['nombre']." ".$row['apaterno']." ".$row['amaterno'];?></td>
                                <td><?php echo $row['tipo'];?></td>
                                <td>$<?php echo $row['salario'];?></td>
                                <!--<td><input type="checkbox" name="array_selecion[]" value="<?php echo $row['idu'];?>"></td>-->
                            <!--</form>-->
                            </tr>   
                        <?php
                    }

                ?>
            </table>
        </div>
        <form action="pdfSolicitud_Vac.php" method="POST" target="_blank">
        <div align="center" class="col-md-12"  style="height:400px;overflow-y:scroll;">
            <input type="hidden" name="array_selecion[]" value="<?php echo $iduU;?>">
            <table class="table">
                <tr>
                    <td>
                        <b>Del:</b>
                        <input type="date" name="inicial" class="form-control" required>
                    </td>
                    <td>
                        <b>Al:</b>
                        <input type="date" name="final" class="form-control" required>
                    </td>
                    <td>
                        <b>Area de ADSCRIPCIÓN:</b>
                        <input type="text" name="area" class="form-control" value="BAJANTES" readonly>
                    </td>
                </tr>
            </table>
            <table class="table">
                <tr>
                    <td>
                        <b>Nombre completo de quien da VISTO BUENO:</b>
                        <input type="text" name="visto_bueno" class="form-control" required>
                    </td>
                    <td>
                        <b>Nombre completo de DIRECTOR DE ÁREA:</b>
                        <input type="text" name="dir_area" class="form-control" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button class="btn btn-success" type="submit"><img src="../syspic/pdf.png" width="50" height="50" class=""></button>    
                    </td>
                    <td></td>
                </tr>
            </table>           
        </div>
        </form>
<!--</form>-->

</div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>