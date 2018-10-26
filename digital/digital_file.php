<?php
include("../Config/library.php"); 

$con = Conectarse();  
$con2 = Conectarse();  
$con3 = Conectarse();  
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
    digital($user);
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
    <div class="panel panel-primary col-md-12">
        <div class="panel-heading">Supervisores</div>
<!--        
        <div class="col-md-12 " style="background-color:red;">
            <button class="ocultar_orden">OCULTAR PANEL SUPERVISORES</button>
            <button class="ver_orden">VER PANEL SUPERVISORES</button>
        </div>
-->
        <div class="panel-body table-responsive panel_supervisor col-md-6" style="font-size:12px;">
            <table class="table" id="">
                <tr>
                    <td></td>
                    <td></td>
                    <td>NOMBRE COMPLETO</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <?php
                    $sql="SELECT * FROM usuario WHERE tipo_idtipo=3 and activo=1";
                    $resultado=$con->query($sql);
                    while($row = $resultado->fetch_assoc())
                    {
                        ?>
                        <tr>
                            <td class="">
                            <div >
                                <form action="digital_file.php" method="GET" class=" ">
                                    <input type="text" value="<?php echo $row['idu'];?>" name="idu" style="display:none;" readonly>
                                    <button action="submit" class="btn btn-primary">
                                        VER ORDENES
                                    </button>
                                </form>
                            </div>
                            </td>
                            <td><?php echo $row['idu'];?></td>
                            <th><?php echo $row['nombre'];?></th>
                            <th><?php echo $row['apaterno'];?></th>
                            <th><?php echo $row['amaterno'];?></th>
                        </tr>
                        <?php
                    }
                ?>
            </table>
        </div>
        <div class="panel-body table-responsive panel_ordenes col-md-6" style="height:500px;ovrflow-y:scroll;">
                <!--<tr>
                    <td><br><br></td>
                </tr>-->
                <?php
                //if()
                if(isset($_GET['idu'])){
                    $super=$_GET['idu'];
                    $sql="SELECT * FROM usuario WHERE idu='$super'";
                    $resultado=$con->query($sql);
                    while($row = $resultado->fetch_assoc())
                    {
                        echo "<h2>".$row['nombre']." ".$row['apaterno']." ".$row['amaterno']."</h2>";
                    }
                    ?>
                    <?php
            echo "<table border='10' class='table'>";
                    $sql="SELECT * FROM os inner join dataos where idmos=id_orden and supervisor_idu=usuario_idu and supervisor_idu='$super' and estatus=2 order by mmos DESC, yearos  DESC,  ddos DESC";
                    $resultado=$con->query($sql);
                    while($row = $resultado->fetch_assoc())
                    {
                        $idos=$row['idmos'];
                        echo 
                        "<tr>
                            <td>".$row['folio_pisa']."</td>
                            <td style='color:red;'>".$row['ddos']."/".$row['mmos']."/".$row['yearos']." ".$row['horaos']."</td>
                            <td>";
                            $asig=$row['asignado'];
                        //echo "<td>".$asig."</td>";
                            echo "<td>";
                        $sql3="SELECT * FROM usuario WHERE idu='$asig'";
                        $resultado3=$con3->query($sql3);
                        while($row3 = $resultado3->fetch_assoc())
                        {
                            echo "".$row3['nombre']." ".$row3['apaterno']." ".$row3['amaterno']."";
                        }
                        echo "</td>
                        <td>";
                        $sql2="SELECT * FROM adjunto_os where os_idos='$idos'";
                        $resultado2=$con2->query($sql2);
                        while($row2 = $resultado2->fetch_assoc())
                        {
                            echo "<a href='../os/".$row2['nombreimg']."' target='_blank'><img src='../os/".$row2['nombreimg']."' width='30' height='30'></a>";
                        }
                        echo "
                        </td>
                        </tr>";
                    }
            echo "</table>";
                }
                ?>
        </div>
    </div>
</div>


<div class="col-md-2" ></div>
<div class="col-md-2"></div>
<div class="col-md-12"><?php footer();?></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script>
    $(".ocultar_orden").click(function (){
        $(".panel_supervisor").hide(1000,function(){
            $(".panel_ordenes").show(1000);
        });
    });
    $(".ver_orden").click(function (){
        $(".panel_ordenes").hide(1000,function(){
            $(".panel_supervisor").show(1000);
        });
    });
</script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
</body>
</html>