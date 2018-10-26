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
$sql="SELECT * FROM equipos_fielder where id_fielder='$iduser'";
$resultado=$con->query($sql);
while($row = $resultado->fetch_assoc())
{
    $areaLider=$row['id_area'];
}
if(!isset($areaLider)){
    $areaLider=0;
}
if(!isset($_GET['mesactual'])){
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mesactual=date('n');
    $aaaa=date('Y');
    $semana = date("W");
}if(isset($_GET['mesactual'])){
    $mesactual=$_GET['mesactual'];
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
    <?php lider($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="col-md-3">
            <a href="regUserN.php">
                <button class="btn btn-success" type="submit">
                    + <i class="glyphicon glyphicon-user"></i>
                </button>
            </a>
        </div>
        <form action="regUser.php" method="GET">
            <div class="input-group col-md-6">
                <input type="text" name="dato" class="form-control" placeholder="Buscar por NOMBRE o APELLIDO PATERNO">
                <div class="input-group-btn">
                <button class="btn btn-default" type="submit">
                    <i class="glyphicon glyphicon-search"></i>
                </button>
                </div>
            </div>
        </form>
        <div class="col-md-3"><?php //echo $areaLider."-".$iduser; ?></div>
        <!-------------------------------------->
        <?php
        
        if($areaLider<>0){
            ?>
            <table class="table">
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Celular</th>
                    <th>Télefono</th>
                    <th>Télefono de Emergencia</th>
                    <th>Editar</th>
                    <th>Eliminar/Activar</th>
                </tr>
            <?php
            if(isset($_GET['dato'])){
                $dato=$_GET['dato'];
                    /*
                    $sql2="SELECT * FROM equipos_fielder inner join usuario 
                    where '$areaLider'=id_area and id_fielder=idu and
                    asignado='$iduser' and activo=1 and 
                    nombre like '%$dato%' or apaterno like '%$dato%'";
                    */
                    $sql2="SELECT * FROM equipos_fielder inner join usuario
                     inner join areas_fielder where '$areaLider'=id_area and idarea=id_area 
                     and id_fielder=idu and asignado='$iduser' and id_fielder=idu and (nombre like '%$dato%' OR apaterno like '%$dato%')
                    ";
                    //echo $sql2;
                    $resultado2=$con2->query($sql2);
                    ?>
                    <table class="table">
                    <?php
                    while($row = $resultado2->fetch_assoc())
                    {
                        $tipo=0;
                        $nombres=$row['nombre'];
                        $ap=$row['apaterno'];
                        $am=$row['amaterno'];
                        $tipo=$row['tipo_idtipo'];
                        $cel=$row['cel'];
                        $tel=$row['tel'];
                        $iduser=$row['idu'];
                        //echo $iduser;
                        $activo=$row['activo'];
                        $cuenta=0;
                        ?>
                        <tr>
                        <td><?php echo $iduser;?></td>
                        <td><?php echo $nombres;?></td>
                        <td><?php echo $ap;?></td>
                        <td><?php echo $am;?></td>
                        <td><?php echo $cel;?></td>
                        <td><?php echo $tel;?></td>
                        <td>
                            <form action="modPersonal.php" method="POST">
                                <input type="text" value="<?php echo $iduser;?>" name="idu" style="display:none;">
                                <button class="btn btn-warning" type="submit">
                                    <i class="glyphicon glyphicon-pencil"></i>
                                </button>
                            </form>
                        </td>
                        <td>
                        <?php
                        if($activo==1){
                        ?>
                            <form action="delUser.php" method="POST">
                                <input type="text" value="<?php echo $iduser;?>" name="idu" style="display:none;">
                                <input type="text" value="1" name="activo" style="display:none;">
                                <button class="btn btn-danger" type="submit">
                                    <i class="glyphicon glyphicon-trash"></i>
                                </button>
                            </form>
                        <?php
                        }if($activo==0){
                             ?>
                            <form action="delUser.php" method="POST">
                                <input type="text" value="<?php echo $iduser;?>" name="idu" style="display:none;">
                                <input type="text" value="0" name="activo" style="display:none;">
                                <button class="btn btn-success" type="submit">
                                    <i class="glyphicon glyphicon-thumbs-up"></i>
                                </button>
                            </form>
                        <?php
                        }
                        ?>
                        </td>
                        <td></td>
                    </tr>
                        <?php
                    }
                    ?>
                    </table>
                <?php
            }if(!isset($_GET['dato'])){
                    $sql="SELECT * FROM usuario where activo=1 and asignado='$iduser' order by activo desc";
                    $resultado=$con->query($sql);
                    while($row = $resultado->fetch_assoc())
                    {
                        //$tipo=0;
                        $nombres=$row['nombre'];
                        $ap=$row['apaterno'];
                        $am=$row['amaterno'];
                        $tipo=$row['tipo_idtipo'];
                        $cel=$row['cel'];
                        $tel=$row['tel'];
                        $tel_emer=$row['tel_emerg'];
                        $idu=$row['idu'];
                        $activo=$row['activo'];
                        //if($tipo==23 OR $tipo==22 OR $tipo==32 OR $tipo==34 OR $tipo==24 OR $tipo==27 OR $tipo==21 OR $tipo==4){
                        //tipo_idtipo=23 or tipo_idtipo=22 or tipo_idtipo=32 or tipo_idtipo=34 or tipo_idtipo=24 or tipo_idtipo=27 or tipo_idtipo=21 or tipo_idtipo=4 
                        ?>
                            <tr>
                                <td><?php echo $idu;?></td>
                                <!--<td><?php echo $tipo;?></td>-->
                                <td><?php echo $nombres;?></td>
                                <td><?php echo $ap;?></td>
                                <td><?php echo $am;?></td>
                                <td><?php echo $cel;?></td>
                                <td><?php echo $tel;?></td>
                                <td><?php echo $tel_emer;?></td>
                                <td>
                                    <form action="modPersonal.php" method="POST">
                                        <input type="text" value="<?php echo $idu;?>" name="idu" style="display:none;">
                                        <button class="btn btn-warning" type="submit">
                                            <i class="glyphicon glyphicon-pencil"></i>
                                        </button>
                                    </form>
                                </td>
                                <td>
                                <?php
                                if($activo==1){
                                ?>
                                    <form action="delUser.php" method="POST">
                                        <input type="text" value="<?php echo $idu;?>" name="idu" style="display:none;">
                                        <input type="text" value="1" name="activo" style="display:none;">
                                        <button class="btn btn-danger" type="submit">
                                            <i class="glyphicon glyphicon-trash"></i>
                                        </button>
                                    </form>
                                <?php
                                }if($activo==0){
                                     ?>
                                    <form action="delUser.php" method="POST">
                                        <input type="text" value="<?php echo $idu;?>" name="idu" style="display:none;">
                                        <input type="text" value="0" name="activo" style="display:none;">
                                        <button class="btn btn-success" type="submit">
                                            <i class="glyphicon glyphicon-thumbs-up"></i>
                                        </button>
                                    </form>
                                <?php
                                }
                                ?>
                                </td>
                                <td></td>
                            </tr>
                        <?php
                        //}
                        /*else{
                        }*/
                    }
            }
            ?>
            </table>
            <?php
        }else{
            ?>
            <h2>Solicita te agregen a un equipo de trabajo para ver tu ÁREA</h2>
            <?php
        }
        ?>
        <!-------------------------------------->
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
      <h4 class="modal-title">VENTAS DEL MES</h4>
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
        var idmos=$(this).data("id");
        $('.modal-body').load('listVentasModal.php?id='+idmos,function(){
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

</body>
</html>