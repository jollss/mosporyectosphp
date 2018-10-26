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
                Presiona CTRL + F y coloca nombre a buscar.
            </div>
</div>
        <div style="height:450px;overflow-y:scroll;" class="col-md-12">
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
                    <th>TIPO</th>
                    <TH></TH>
                    <TH></TH>
                </tr>
                <?php
                    $sql="SELECT * FROM usuario inner join tipo
                        where activo=1 and tipo_idtipo=idtipo ORDER BY nombre";
                    $contar=0;
                    $con1 = Conectarse();
                    $resultado=$con1->query($sql);
                    while($row = $resultado->fetch_assoc())
                    {
                        if($row['activo']==1){
                        if($row['idtipo']==1 or $row['idtipo']==3){
                        ?>
                            <tr>
                                <td><?php echo $row['idu'];?></td>
                                <td><?php echo $row['nombre']." ".$row['apaterno']." ".$row['amaterno'];?></td>
                                <td><?php echo $row['tipo'];?></td>
                                <td>
                                <form action="formSolVacaciones.php" method="POST">
                                    <input type="hidden" name="array_selecion[]" value="<?php echo $row['idu'];?>">
                                    <button class="btn btn-success" type="submit">SOLICITUD</button>    
                                </form>
                                </td>
                                <td>
                                
                                <form action="formRecVacaciones.php" method="POST">
                                    <input type="hidden" name="array_selecion[]" value="<?php echo $row['idu'];?>">
                                    <button class="btn btn-success" type="submit">RECIBO PAGO</button>    
                                </form>
                                
                                </td>
                            </tr>   
                        <?php
                        }
                        }
                    }
                ?>
            </table>
        </div>
<!--</form>-->

</div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>