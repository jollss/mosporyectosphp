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
        <script src="../js/jquery-3.2.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>

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
<div class="col-md-6">
    <div class="panel panel-primary">
        <div class="panel-heading">Supervisores</div>
        <div class="panel-body table-responsive" style="font-size:12px;">
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
                                    <th><input type="submit" value="Ver"></th>
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

<div class="col-md-6">
    <div class="col-md-3"></div>
    <div class="panel panel-default col-md-6">
        <div class="panel-heading">Busqueda</div>
        <div class="panel-body" style="background-color:gray;">
            <div align="center">
                <form accept-charset="utf-8"  action="inde.php" method="GET">
                    <div class="form-group">
                        <input type="search" class="form-control" placeholder="NOMBRE DE TECNICO" name="tecnico">
                        <button class="btn btn-primary">
                            <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-3"></div>
    <div class="col-md-12">
        <?php
            if(!isset($_GET['tecnico'])){
            }if(isset($_GET['tecnico'])){
                $tecnico=$_GET['tecnico'];
                ?>
                <div style="height:400px;overflow-y:scroll;">
                <table class="table">
                <?php
                $sql1="SELECT * FROM usuario WHERE tipo_idtipo=1 and activo=1 and nombre LIKE '%$tecnico%'";
                $resultado=$con->query($sql1);
                while($row = $resultado->fetch_assoc())
                {
                    $id=$row['idu'];
                    $nombre=$row['nombre'];
                    $amaterno=$row['amaterno'];
                    $apaterno=$row['apaterno'];
                    ?>
                    <tr>
                    <form action="getContent.php" method="POST">
                        <!--<td><button type="button" class="btn btn-info btn-md bntmodal myBtn" name="valor" data-id="<?php echo $id;?>" value="<?php echo $id;?>">VER</button></td>-->
                        <td><button type="submit" class="btn btn-primary"> VER</button></td>
                        <td><input type="hidden" value="<?php echo $id;?>" name="iduser" readonly></td>
                        <td><?php echo $nombre;?></td>
                        <td><?php echo $apaterno;?></td>
                        <td><?php echo $amaterno;?></td>
                    </form>
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
</div>
<div class="col-md-2" ></div>
<div class="col-md-2"></div>
<div class="col-md-12"><?php footer();?></div>
<!-- Modal -->
<!--
<div class="modal fade myModal" id="" role="dialog" style="width:100% !important;">
    <div class="modal-dialog modal-lg">

      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Datos de la Orden</h4>
        </div>
        <div class="modal-body">
          <p>No hay datos por buscar</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      
    </div>
</div>-->

<script src="../js/bootstrap.min.js"></script>
<script>
/*
$(document).ready(function(){
    $('.bntmodal').click (function(){
        var id=$(this).data("id");
        var ido=$(this).data("ido");
        console.log(ido);
        
        $('.modal-body').load('getContent.php?id='+id,function(){
            $('.myModal').modal({show:true});
        });
    });
});
*/
</script>
<script src="../js/menu.js"></script>
</body>
</html>