<?php
include("../Config/library.php"); 
$cnx = Conectarse(); 
$con = Conectarse();  
$con3 = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$yo=new Usuario();
$yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$yo->regresaIdu();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="../js/browser.js"></script>
<?php
    contabilidad($user);
     date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana = date("W");
    $aux=0;
    $aux1=0;
    if(!isset($_GET['dato'])){ $dato=''; }if(isset($_GET['dato'])){ $dato=$_GET['dato']; }
?>  
</head>
<body>
<br><br><br><br>
<div class="col-md-12">
    <div class="col-md-3"></div>
    <div class="panel panel-default col-md-6">
        <div class="panel-heading">Busqueda</div>
        <div class="panel-body" style="background-color:white;">
            <div align="center">
                <div><strong>Dato buscado: <?php echo $dato;?></strong></div>
                <form action="buscar_factura.php" method="GET">
                    <div class="form-group">
                        <input type="search" class="form-control" placeholder="FACTURA o PAQO" name="factura" style="background-color:;">
                        <input type="submit" value="BUSCAR" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    if (isset($_GET['factura'])) {
        $con3 = Conectarse();
        $factura=$_GET['factura'];
        $cnt=0;
        $sql3="SELECT * FROM validar_os WHERE factura_os LIKE '%$factura%' OR paqo LIKE '%$factura%'";
        $resultado3=$con3->query($sql3);
        ?>
        <div style="background-color:;height:250px;overflow-y:scroll;" class="col-md-12">
        <table>
        <?php
        while($row3 = $resultado3->fetch_assoc())
        {
            $cnt++;
            $pqo=$row3['paqo'];
            $fos=$row3['factura_os'];
            $os=$row3['id_folio_pisa'];
            ?>
            <tr>
                <td><?php echo $os;?></td>
                <td><?php echo $pqo;?></td>
                <td><?php echo $os;?></td>
            </tr>
            <?php
        }
        ?>
        </table>
        </div>
        <?php
    }
    ?>    
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