<?php
include("../Config/library.php"); 
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
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
<?php
    nivel2($user);
?>	
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-12">
        <div class="panel panel-info" >
            <div class="panel-heading" style="height:150px;overflow-y:scroll;">
            Usuarios<br>
            <table class="table">
            <tr>
            <?php
            $cone = Conectarse();
            $sqle="SELECT * FROM areas_fielder";
            $rae=$cone->query($sqle);
            while($lae = $rae->fetch_assoc())
            {
                $area=$lae['nom_area'];
                $idarea=$lae['idarea'];
                ?>
                <td>
                <form>
                    <input type="hidden" value="<?php echo $idarea;?>" name="id">
                   <button type="submit"><?php echo $area;?></button> 
                </form>
                </td>
                <?php
            }
            ?>
            <td>
                <form>
                    <input type="hidden" value="all" name="id">
                   <button type="submit">TODOS</button> 
                </form>
                </td>
            </tr>
            </table>
            </div>
            <div class="panel-body"  >
            
                    <div class="table-responsive" style="height:450px;overflow-y:scroll;">
                        <table class="table table-bordered">
                            <tr>
                              <th>AREA</th>
                              <th>Nombre Completo</th>
                              <th>Correo</th>
                              <th>Tipo</th>
                              <th>Celular</th>
                              <th>Telefono</th>
                              <th>Direccion</th>
                              <th>ID</th>
                              <th>Estado</th>
                              <th>TIPO DE PERSONAL</th>
                              
                            </tr>
                <?php
                //$Usuario_infuser=new Usuario_infuser();
                //$tusuarios=$Usuario_infuser->TotalUsuarioRh($con);
                //for ($i=0; $i < $tusuarios; $i++) { 
                $count=0;
                if(!isset($_GET['id']) or $_GET['id']=='all'){
                    $con->real_query("SELECT * FROM usuario inner join infuser inner join tipo 
                    where usuario_iduu=idu and tipo_idtipo=idtipo ");
                }if(isset($_GET['id'])){
                    $areas=$_GET['id'];
                    $con->real_query("SELECT * FROM usuario inner join infuser 
                        inner join tipo inner join equipos_fielder inner join areas_fielder
                        WHERE usuario_iduu=idu and idarea='$areas' and id_area=idarea
                        and tipo_idtipo=idtipo and id_fielder=idu ");
                }
                    $r = $con->use_result();
                    while ($l = $r->fetch_assoc()){ 
                    $name=$l['nombre'];
                    $ap=$l['apaterno'];
                    $am=$l['amaterno'];
                    $correos=$l['correo'];
                    
                    $tipo_pe=$l['tipo_idtipo'];
                    $celu=$l['cel'];
                    $tel=$l['tel'];
                    $idus=$l['idu'];
                    $direccion=$l['direccion'];
                    $activos=$l['activo'];
                    $tipo_personal=$l['tipo_personal'];
                    $ntipo=$l['tipo'];
                    
                    
                    $sql="SELECT * FROM equipos_fielder inner join areas_fielder
                    WHERE id_fielder='$idus' and id_area=idarea ";
                    $ra=$cnx->query($sql);
                    while($la = $ra->fetch_assoc())
                    {
                        $area=$la['nom_area'];
                    }
                    if(!isset($area)){
                        $area="SIN AREA";
                    }
                ?>
                <form action="data.php" method="POST">
                    <?php 
                    if($activos==1){
                    if($tipo_pe==4 or $tipo_pe==21 or $tipo_pe==24 or $tipo_pe==32 or $tipo_pe==40){
                        $count++;
                            ?>  
                            <tr>
                                <th><?php echo $area;?></th>
                                <th style="font-size:12px;"><?php echo $name." ".$ap." ".$am;?></th>
                                <th><?php echo $correos;?></th>
                                <th style="font-size:10px;"><?php echo $ntipo;?></th>
                                <th><?php echo $celu;?></th>
                                <th><?php echo $tel;?></th>
                                <th><?php echo $direccion;?></th>
                                <th><input class="btn btn-success" name="ident" type="submit" value="<?php echo $idus;?>"></th>
                                <th><?php if($activos==1){echo "ACTIVO";}if($activos==0){echo "INACTIVO";}?></th>
                                <th style="font-size:10px;"><?php echo $tipo_personal;?></th>
                            </tr>
                            <?php
                        
                    }
                    }
                    ?>                        
                </form>
                <?php
                }
                ?>
                </table>
                    </div>
            </div>
            <div class="panel-heading"><b>Total de usuarios activos: <?php echo $count;?></b></div>
        </div>
        <?php footer();?>
    </div>
    
</div>
<div class="col-md-2"></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>