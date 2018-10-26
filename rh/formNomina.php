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
        nivel2($user);
    ?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
<div class="panel panel-primary col-md-12">
            <div class="panel-heading">Presiona CTRL + F y coloca nombre a buscar.</div>
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
        <form action="pdfNomina.php" method="POST" target="_blank">
        <div align="center" class="col-md-12"  style="height:400px;overflow-y:scroll;">
            <input type="hidden" name="array_selecion[]" value="<?php echo $iduU;?>">
            <table class="table">
                <tr>
                    <TH>RANGO UNO</TH>
                    <td>
                        <b>Del:</b>
                        <input type="date" name="inicial" class="form-control" required>
                    </td>
                    <td>
                        <b>Al:</b>
                        <input type="date" name="final" class="form-control" required>
                    </td>
                    <td>
                        <b>Dìas Trabajados:</b>
                        <input type="number" name="dias_t" class="form-control">
                    </td>
                    <td>
                        <b>No. de Nomina:</b>
                        <input type="number" name="nonomina" class="form-control">
                    </td>
                    <td>
                        <b>Pago:</b>
                        <input type="number" name="pago" class="form-control" value="<?php echo $salario;?>">
                    </td>
                </tr>
                <tr>
                    <TH>RANGO DOS</TH>
                    <td>
                        <b>Del:</b>
                        <input type="date" name="inicial2" class="form-control" required>
                    </td>
                    <td>
                        <b>Al:</b>
                        <input type="date" name="final2" class="form-control" required>
                    </td>
                    <td>
                        <b>Dìas Trabajados:</b>
                        <input type="number" name="dias_t2" class="form-control">
                    </td>
                    <td>
                        <b>No. de Nomina:</b>
                        <input type="number" name="nonomina2" class="form-control">
                    </td>
                    <td>
                        <b>Pago:</b>
                        <input type="number" name="pago2" class="form-control" value="<?php echo $salario;?>">
                    </td>
                </tr>
                <!--
                <tr>
                    <td></td>
                    <td><b>PERCEPCION</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    <input type="text" name="com1" placeholder="Persepciòn de Ingresos 1" class="form-control">
                    <input type="number" name="cant1" placeholder="$" value="0">
                    </td>
                    <td>
                    <input type="text" name="com2" placeholder="Persepciòn de Ingresos 2" class="form-control">
                    <input type="number" name="cant2" placeholder="$" value="0">
                    </td>
                    <td>
                    <input type="text" name="com3" placeholder="Persepciòn de Ingresos 3" class="form-control">
                    <input type="number" name="cant3" placeholder="$" value="0">
                    </td>
                    <td>
                    <input type="text" name="com4" placeholder="Persepciòn de Ingresos 4" class="form-control">
                    <input type="number" name="cant4" placeholder="$" value="0">
                    </td>
                    <td>
                    <input type="text" name="com5" placeholder="Persepciòn de Ingresos 5" class="form-control">
                    <input type="number" name="cant5" placeholder="$" value="0">
                    </td>
                    <td>
                    <input type="text" name="com6" placeholder="Persepciòn de Ingresos 6" class="form-control">
                    <input type="number" name="cant6" placeholder="$" value="0">
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td><b>DEDUCIONES</b></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td>
                    <input type="text" name="com7" placeholder="Adeudo 1" class="form-control">
                    <input type="number" name="cant7" placeholder="$" value="0">
                    </td>
                    <td>
                    <input type="text" name="com8" placeholder="Adeudo 2" class="form-control">
                    <input type="number" name="cant8" placeholder="$" value="0">
                    </td>
                    <td>
                    <input type="text" name="com9" placeholder="Adeudo 3" class="form-control">
                    <input type="number" name="cant9" placeholder="$" value="0">
                    </td>
                    <td>
                    <input type="text" name="com10" placeholder="Adeudo 4" class="form-control">
                    <input type="number" name="cant10" placeholder="$" value="0">
                    </td>
                    <td>
                    <input type="text" name="com11" placeholder="Adeudo 5" class="form-control">
                    <input type="number" name="cant11" placeholder="$" value="0">
                    </td>
                    <td>
                    <input type="text" name="com12" placeholder="Adeudo 6" class="form-control">
                    <input type="number" name="cant12" placeholder="$" value="0">
                    </td>
                </tr>
                -->
                <tr>
                    <td>
                        <button class="btn btn-success" type="submit"><img src="../syspic/pdf.png" width="50" height="50" class=""></button>    
                    </td>
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