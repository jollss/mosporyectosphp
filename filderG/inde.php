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
$tos=0;
/*========================================*/
function ejecutar($sql){
    $con = Conectarse();
    if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>"; } }
}
/*========================================*/
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
    <script src="../js/jquery-3.2.0.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</head>
<body>

<div id="wrapper">
    <!-- Navigation MENU-->
    <?php $query = "SELECT * FROM usuario  WHERE  idu='$iduser' and bandera_contrase='no' ";
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
  }else{gventas($user);}?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Venta</h1>
            </div>
        </div>
<!--==============================================================================================================================================-->
        <section class="row" style="height:100px;overflow-x:scroll;">
        <table class="table">
            <tr>
            <?php
                $sql="SELECT * FROM areas_fielder order by nom_area";
                $resultado=$con->query($sql);
                while($row = $resultado->fetch_assoc())
                {
                    if($row['nom_area']<>''){
                    ?>
                    <td>
                    <form action="inde.php" method="GET">
                        <input type="number" value="<?php echo $row['idarea'];?>" name="area" style="display:none;" readonly>
                        <button class="btn btn-success" type="submit">
                            <i class="glyphicon glyphicon-globe">  <?php echo $row['nom_area'];?></i>
                        </button>
                    </form>
                    </td>
                    <?php
                    }
                }
            ?>
            </tr>
        </table>
        </section>
        <section class="row">
            <ol class="breadcrumb">
                <li><a href="inde.php">Inicio</a></li>

                <?php
if($iduser==79){
  echo"  <li><a href='departamento.php'>Rendimiento Director</a></li>";
}else{
  echo"  <li><a href='departamentoco.php'>Rendimiento Coordinador</a></li>";
}


                 ?>

                <?php
                if(isset($_GET['area'])){
                    $area=$_GET['area'];
                    $sql="SELECT * FROM areas_fielder WHERE idarea='$area'";
                    $resultado=$con->query($sql);
                    while($row = $resultado->fetch_assoc())
                    {
                        $nombredearea=$row['nom_area'];
                    }
                    ?>
                    <li>
                        <a href="inde.php?area=<?php echo $area;?>"><?php echo $nombredearea;?></a>
                    </li>
                    <?php
                    if(isset($_GET['user'])){
                        $user=$_GET['user'];
                        $sql="SELECT * FROM usuario WHERE idu='$user'";
                        $resultado=$con->query($sql);
                        while($row2 = $resultado->fetch_assoc())
                        {
                            $nomuser=$row2['nombre'];
                        }
                        ?>
                        <li>
                            <a href="inde.php?area=<?php echo $area;?>&user=<?php echo $user;?>"><?php echo $nomuser;?></a>
                        </li>
                        <?php
                    }
                    if(isset($_GET['user2'])){
                        $user=$_GET['user'];
                        $user2=$_GET['user2'];
                        $sql2="SELECT * FROM usuario WHERE idu='$user2'";
                        $resultado2=$con->query($sql2);
                        while($row3 = $resultado2->fetch_assoc())
                        {
                            $nomuser3=$row3['nombre'];
                        }
                        ?>
                        <li>
                            <a href="inde.php?area=<?php echo $area;?>&user=<?php echo $user;?>&user2=<?php echo $user2;?>"><?php echo $nomuser3;?></a>
                        </li>
                        <?php
                    }
                    if(isset($_GET['user3'])){
                        $user=$_GET['user'];
                        $user2=$_GET['user2'];
                        $user3=$_GET['user3'];
                        $sql2="SELECT * FROM usuario WHERE idu='$user3'";
                        $resultado2=$con->query($sql2);
                        while($row4 = $resultado2->fetch_assoc())
                        {
                            $nomuser4=$row4['nombre'];
                        }
                        ?>
                        <li>
                            <a href="inde.php?area=<?php echo $area;?>&user=<?php echo $user;?>&user2=<?php echo $user2;?>&user3=<?php echo $user3;?>"><?php echo $nomuser4;?></a>
                        </li>
                        <?php
                    }
                }
                ?>
            </ol>
        </section>
        <section class="col-md-12 lista" style="height:500px;overflow-y:scroll;">
            <div style="background-color:black;color:white;">
                <h3>PERSONAL</h3>
            </div>
            <table class="table">
                <tr>
                    <th></th>
                    <th>Personal Asignado</th>
                    <th>Ver ventas</th>
                    <th>Tipo de Empleado</th>
                    <th>Nombre</th>
                    <th>Celular</th>
                    <th>Numero de Ventas totales</th>
                </tr>
            <?php
                if(isset($_GET['area']) and !isset($_GET['user'])  and !isset($_GET['user2'])){
                    $area=$_GET['area'];
                    $sql="SELECT * FROM equipos_fielder inner join usuario inner join tipo
                    WHERE id_area='$area' and idu=id_fielder and idtipo=tipo_idtipo ORDER BY tipo_idtipo DESC";
                    $resultado=$con->query($sql);
                    while($row = $resultado->fetch_assoc())
                    {
                        $id=$row['idu'];
                        ?>
                        <tr>
                            <td>
                                <a class="btn btn-warning" href="pago_form.php?user=<?php echo $row['idu'];?>">PAGO</a>
                            </td>
                            <td>
                            <a href="inde.php?area=<?php echo $area;?>&user=<?php echo $row['idu'];?>">
                                <?php echo $row['idu'];?>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-md bntmodal myBtn" name="user" data-id="<?php echo $row['idu'];?>" value="<?php echo $row['idu'];?>">VER</button>
                                <!--<form action="ventaslist.php" method="POST" target="_blank">
                                    <input type="number" value="<?php echo $row['idu'];?>" style="display:none;" name="idu" readonly>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    </button>
                                </form>-->
                            </td>
                            <td>
                                <?php echo $row['tipo'];?>
                            </td>
                            <td>
                                <?php echo $row['nombre']." ".$row['apaterno']." ".$row['amaterno'];?>
                            </td>
                            <td>
                                <?php echo $row['cel'];?>
                            </td>
                            <td align="center">
                            <?php
                            $contador=0;
                                $sql2="SELECT * FROM venta WHERE idvendedor='$id'";
                                $r=$con->query($sql2);
                                while($r1 = $r->fetch_assoc()){
                                    $contador=$contador+1;
                                }
                                echo $contador;
                            ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                if(isset($_GET['area']) and isset($_GET['user']) and !isset($_GET['user2'])){
                    $area=$_GET['area'];
                    $userArea=$_GET['user'];
                    $sql="SELECT * FROM equipos_fielder inner join usuario inner join tipo
                    WHERE id_area='$area' and idu=id_fielder and idtipo=tipo_idtipo and asignado='$userArea' ORDER BY tipo_idtipo DESC";
                    $resultado=$con->query($sql);
                    while($row = $resultado->fetch_assoc())
                    {
                        $id=$row['idu'];
                        ?>
                        <tr>
                            <td>
                            <a href="inde.php?area=<?php echo $area;?>&user=<?php echo $_GET['user'];?>&user2=<?php echo $row['idu'];?>">
                                <?php echo $row['idu'];?>
                            </td>
                            <td>
                            <button type="button" class="btn btn-info btn-md bntmodal myBtn" name="user" data-id="<?php echo $row['idu'];?>" value="<?php echo $row['idu'];?>">VER</button>
                            <!--    <form action="ventaslist.php" method="POST" target="_blank">
                                    <input type="number" value="<?php echo $row['idu'];?>" style="display:none;" name="idu" readonly>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    </button>
                                </form>-->
                            </td>
                            <td>
                                <?php echo $row['tipo'];?>
                            </td>
                            <td>
                                <?php echo $row['nombre']." ".$row['apaterno']." ".$row['amaterno'];?>
                            </td>
                            <td>
                                <?php echo $row['cel'];?>
                            </td>
                            <td align="center">
                            <?php
                            $contador=0;
                                $sql2="SELECT * FROM venta WHERE idvendedor='$id'";
                                $r=$con->query($sql2);
                                while($r1 = $r->fetch_assoc()){
                                    $contador=$contador+1;
                                }
                                echo $contador;
                            ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                if(isset($_GET['area']) and isset($_GET['user']) and isset($_GET['user2']) and !isset($_GET['user3'])){
                    $area=$_GET['area'];
                    $userArea=$_GET['user'];
                    $userArea2=$_GET['user2'];

                    $sql="SELECT * FROM equipos_fielder inner join usuario inner join tipo
                    WHERE id_area='$area' and idu=id_fielder and idtipo=tipo_idtipo and asignado='$userArea2' ORDER BY tipo_idtipo DESC";
                    $resultado=$con->query($sql);
                    while($row3 = $resultado->fetch_assoc())
                    {
                        $id=$row3['idu'];
                        ?>
                        <tr>
                            <td>
                            <a href="inde.php?area=<?php echo $area;?>&user=<?php echo $_GET['user'];?>&user2=<?php echo $_GET['user2'];?>&user3=<?php echo $row3['idu'];?>">
                                <?php echo $row3['idu'];?>
                            </td>
                            <td>
                            <!--
                                <form action="ventaslist.php" method="POST" target="_blank">
                                    <input type="number" value="<?php echo $row['idu'];?>" style="display:none;" name="idu" readonly>
                                    <button type="submit" class="btn btn-primary">
                                        <span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>
                                    </button>
                                </form>
                            -->
                            <button type="button" class="btn btn-info btn-md bntmodal myBtn" name="user" data-id="<?php echo $row['idu'];?>" value="<?php echo $row['idu'];?>">VER</button>
                            </td>
                            <td>
                                <?php echo $row3['tipo'];?>
                            </td>
                            <td>
                                <?php echo $row3['nombre']." ".$row3['apaterno']." ".$row3['amaterno'];?>
                            </td>
                            <td>
                                <?php echo $row3['cel'];?>
                            </td>
                            <td align="center">
                            <?php
                            $contador=0;
                                $sql2="SELECT * FROM venta WHERE idvendedor='$id'";
                                $r=$con->query($sql2);
                                while($r1 = $r->fetch_assoc()){
                                    $contador=$contador+1;
                                }
                                echo $contador;
                            ?>
                            </td>
                        </tr>
                        <?php
                    }
                }
                if(isset($_GET['area']) and isset($_GET['user']) and isset($_GET['user2']) and isset($_GET['user3'])){
                    $area=$_GET['area'];
                    $userArea=$_GET['user'];
                    $userArea2=$_GET['user2'];
                    $userArea3=$_GET['user3'];

                    $sql="SELECT * FROM equipos_fielder inner join usuario inner join tipo
                    WHERE id_area='$area' and idu=id_fielder and idtipo=tipo_idtipo and asignado='$userArea3' ORDER BY tipo_idtipo DESC";
                    $resultado=$con->query($sql);
                    while($row4 = $resultado->fetch_assoc())
                    {
                        ?>
                        <tr>
                            <td>
                            <a href="inde.php?area=<?php echo $area;?>&user=<?php echo $_GET['user'];?>&user2=<?php echo $_GET['user2'];?>&user3=<?php echo $_GET['user3'];?>&user4=<?php echo $row4['idu'];?>">
                                <?php echo $row4['idu'];?>
                            </td>
                            <td>
                                <?php echo $row4['tipo'];?>
                            </td>
                            <td>
                                <?php echo $row4['nombre']." ".$row4['apaterno']." ".$row4['amaterno'];?>
                            </td>
                            <td>
                                <?php echo "".$row4['cel'];?>
                            </td>
                        </tr>
                        <?php
                    }
                }
            ?>
            </table>
        </section>
<!--=============================================================================-->
    </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade myModal" id="" role="dialog" style="width:100% !important;">
<div class="modal-dialog modal-lg">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h2 class="modal-title">VENTAS</h2>
    </div>
    <div class="modal-body">
      <p>No hay datos por buscar</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>

</div>
</div>
<script>
$(document).ready(function(){
    $('.bntmodal').click (function(){
        var iduser=$(this).data("id");
        console.log(iduser);
        $('.modal-body').load('getVentas.php?iduser='+iduser,function(){
            $('.myModal').modal({show:true});
        });
    });
});
</script>
<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="../js/startmin.js"></script>
<script>
    $(".ocultar").click(function (){
        $(".lista").hide(2000,function(){
            $(".lventa").show();
        });
    });
     $(".mostrar").click(function (){
        $(".lista").show(2000,function(){
            $(".lventa").hide();
        });
    });
</script>

</body>
</html>
