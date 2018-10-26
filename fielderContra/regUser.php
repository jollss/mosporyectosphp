<?php
include("../Config/library.php");
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$idus=$Yo->regresaIdu();
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
</head>
<body>

<div id="wrapper">
    <!-- Navigation MENU-->
    <?php gventas($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Personal</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
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
<div class="col-md-3"></div>
<div class="table-responsive col-md-12" style="height:500px;overflow-y:scroll;">
    <?php
    if(!isset($_GET['dato'])){
        $nombres='';
        $ap='';
        $am='';
        $tipo='';
        $idu='';
    }
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
                    $sql="SELECT * FROM usuario WHERE  
                    nombre like '$dato%' OR apaterno like '$dato%' OR idu like '$dato%'";
                    $resultado=$con->query($sql);
                    while($row = $resultado->fetch_assoc())
                    {
                        $tipo=0;
                        $nombres=$row['nombre'];
                        $ap=$row['apaterno'];
                        $am=$row['amaterno'];
                        $tipo=$row['tipo_idtipo'];
                        $cel=$row['cel'];
                        $tel=$row['tel'];
                        $tel_emer=$row['tel_emerg'];
                        $idu=$row['idu'];
                        $activo=$row['activo'];
                        if($tipo==23 OR $tipo==22 OR $tipo==32 OR $tipo==34 OR $tipo==24 OR $tipo==27 OR $tipo==21 OR $tipo==4){
                        ?>
                            <tr>
                                <td><?php echo $idu;?></td>
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
                        }else{
                        }
                    }
                }if(!isset($_GET['dato'])){
                    $sql="SELECT * FROM usuario where activo=1 order by activo desc";
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
                        if($tipo==23 OR $tipo==22 OR $tipo==32 OR $tipo==34 OR $tipo==24 OR $tipo==27 OR $tipo==21 OR $tipo==4){
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
                        }
                        /*else{
                        }*/
                    }
                }
                ?>
            </table>
</div>        
<!--============================================================================================-->      
    </div>
</div>

<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="../js/startmin.js"></script>
</div>
</body>
</html>
