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
        <script type="text/javascript" src="../js/browserBajantes.js"></script>
<?php
    digital($user);
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana = date("W");
    $aux=0;
    $aux1=0;
    $con1 = Conectarse();
    $con2 = Conectarse();
    $con3 = Conectarse();
    if(!isset($_GET['dato']) or !isset($idmos)){ $dato='';}
    if(isset($_GET['dato'])){
        $dato=$_GET['dato'];
        $sql="SELECT * FROM os inner join dataos
        WHERE idmos=id_orden and folio_pisa<>0 AND folio_pisa='$dato' OR telefono='$dato' OR idmos='$dato'";
        $resultado=$con1->query($sql);
        while($row = $resultado->fetch_assoc())
        {
            /*OS*/
            $idmos=$row['idmos'];
            $cope=$row['cope'];
            $expediente=$row['expediente'];
            $ddcarga=$row['ddcarga'];
            $mmcarga=$row['mmcarga'];
            $yearcarga=$row['yearcarga'];
            $folio_pisaplex=$row['folio_pisaplex'];
            $folio_pisa=$row['folio_pisa'];
            $telefono=$row['telefono'];
            $cliente=$row['cliente'];
            $tipo_tarea=$row['tipo_tarea'];
            $tecnologia=$row['tecnologia'];
            $distrito=$row['distrito'];
            $zona=$row['zona'];
            $dilacion_etapa=$row['dilacion_etapa'];
            $dilacion=$row['dilacion'];
            $usuario_idu=$row['usuario_idu'];
            $asignado=$row['asignado'];
            $aux1=1;
            $supervisor_idu=$row['supervisor_idu'];
            $tecnico_asignado_idu=$row['tecnico_asignado_idu'];
            $estatus=$row['estatus'];
            $observaciones=$row['observaciones'];
            $ddos=$row['ddos'];
            $mmos=$row['mmos'];
            $yearos=$row['yearos'];
            $horaos=$row['horaos'];
            $principal=$row['principal'];
            $secundario=$row['secundario'];
            $claro_video=$row['claro_video'];
            $tipo_os=$row['tipo_os'];
            $alfanumerico=$row['alfanumerico'];
            $serie=$row['serie'];
        }
        /*
        $sql1="SELECT * FROM dataos
        WHERE id_orden='$idmos'";
        $RES=$con2->query($sql1);
        while($r = $RES->fetch_assoc())
        {
            
            $supervisor_idu=$r['supervisor_idu'];
            $tecnico_asignado_idu=$r['tecnico_asignado_idu'];
            $estatus=$r['estatus'];
            $observaciones=$r['observaciones'];
            $ddos=$r['ddos'];
            $mmos=$r['mmos'];
            $yearos=$r['yearos'];
            $horaos=$r['horaos'];
            $principal=$r['principal'];
            $secundario=$r['secundario'];
            $claro_video=$r['claro_video'];
            $tipo_os=$r['tipo_os'];
            $alfanumerico=$r['alfanumerico'];
            $serie=$r['serie'];
            $aux=1;
        }*/
        if($idmos==''){
            /*OS*/
            $idmos='';
            $cope='';
            $expediente='';
            $ddcarga='';
            $mmcarga='';
            $yearcarga='';
            $folio_pisaplex='';
            $folio_pisa='';
            $telefono='';
            $cliente='';
            $tipo_tarea='';
            $tecnologia='';
            $distrito='';
            $zona='';
            $dilacion_etapa='';
            $dilacion='';
            $usuario_idu='';
            $asignado='';
            /*dataos*/
                $estatus=5;
                $observaciones='';
                $ddos='';
                $mmos='';
                $yearos='';
                $horaos='';
                $principal='';
                $secundario='';
                $claro_video='';
                $tipo_os='';
                $alfanumerico='';
                $serie=''; 
        }
        if($idmos<>''){
        
        }
        //echo "<h2>".$aux."</h2>";
        if($idmos=='')
        {
            $estatus=5;
            $observaciones='';
            $ddos='';
            $mmos='';
            $yearos='';
            $horaos='';
            $principal='';
            $secundario='';
            $claro_video='';
            $tipo_os='';
            $alfanumerico='';
            $serie='';  
        }
    }
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
                <form action="buscar.php" method="GET">
                    <div class="form-group">
                        <input type="search" class="form-control" placeholder="FOLIO PISA, TELÉFONO, FOLIO PISAPLEX o IDMOS" name="dato" style="background-color:;">
                        <input type="submit" value="BUSCAR" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4" style="background-color:;border:none;">
        <div class="col-md-12" style="background-color:;border:solid;">
            <!--OPCIONES-->
            <?php
            if($aux==0  or !isset($idmos))
            {
                ?>
                <label style="color:red;">SIN INFORMACION</label>
                <?php
            }if($aux==1 or isset($idmos)){
            ?>
            <!--
                <form action="modOs.php" method="POST">
                    <input type="text" value="<?php echo $idmos;?>" name="idmos" style="display:none;" readonly="readonly">
                    <input type="text" value="1" name="tipo" style="display:none;" readonly="readonly">
                    <input type="image" class="btn btn-default" src="../syspic/editar.png" width="70">
                    <label>EDITAR</label>
                </form>
                <form action="modOs.php" method="POST">
                    <input type="text" value="<?php echo $idmos;?>" name="idmos" style="display:none;" readonly="readonly">
                    <input type="text" value="2" name="tipo" style="display:none;" readonly="readonly">
                    <input type="image" class="btn btn-default" src="../syspic/user-edit.png" width="70">
                    <label>QUITAR TECNICO</label>
                </form>
                <form action="modOs.php" method="POST">
                    <input type="text" value="<?php echo $idmos;?>" name="idmos" style="display:none;" readonly="readonly">
                    <input type="text" value="3" name="tipo" style="display:none;" readonly="readonly">
                    <input type="image" class="btn btn-default" src="../syspic/config.png" width="70">
                    <label>LIBERAR PARA TRABAJAR</label>
                </form>-->
                <table>
                    <tr>
                        <td>
                            <form action="osPDF.php" method="POST" target="_blank">
                                <input type="text" value="<?php echo $idmos;?>" name="idmos" style="display:none;" readonly="readonly">
                                <!--<input type="submit" class="btn btn-success" value="LIBERAR PARA TRABAJAR">-->
                                <input type="image" class="btn btn-default" src="../syspic/pdf_icon.png" width="70">
                                <label>GENERAR PDF</label>
                            </form>    
                        </td>
                        <td>
                            <form action="carsoForm.php" method="POST" target="_blank">
                                <input type="text" value="<?php echo $idmos;?>" name="idmos" style="display:none;" readonly="readonly">
                                <!--<input type="submit" class="btn btn-success" value="LIBERAR PARA TRABAJAR">-->
                                <input type="image" class="btn btn-default" src="../syspic/carso.JPG" width="70">
                                <label>CARSO</label>
                            </form>
                        </td>
                    </tr>
                </table>
                <!--
                <form action="" method="POST">
                    <input type="text" value="<?php echo $idmos;?>" style="display:none;" readonly="readonly">
                    <input type="submit" class="btn btn-warning" value="QUITAR ASIGNACION">
                </form>
                -->
                <!--
                <form action="modOs.php" method="POST">
                    <input type="text" value="<?php echo $idmos;?>" name="idmos" style="display:none;" readonly="readonly">
                    <input type="text" value="4" name="tipo" style="display:none;" readonly="readonly">
                    
                    <input type="image" class="btn btn-danger" src="../syspic/eliminar_dato.png" width="70" onclick="return confirm('DESEAS ELIMINAR POR COMPLETO?')">
                    <label>ELIMINAR</label>
                </form>
                -->
            <?php
            }
            ?>
        </div>
        <div class="col-md-12 table-responsive" style="background-color:gray;border:solid;">
            <!--IMAGENES-->
            <?php
            if(!isset($idmos)){
                /*OS*/
                $idmos='';
                $cope='';
                $expediente='';
                $ddcarga='';
                $mmcarga='';
                $yearcarga='';
                $folio_pisaplex='';
                $folio_pisa='';
                $telefono='';
                $cliente='';
                $tipo_tarea='';
                $tecnologia='';
                $distrito='';
                $zona='';
                $dilacion_etapa='';
                $dilacion='';
                $usuario_idu='';
                $asignado='';
                /*dataos*/
                $estatus=5;
                $observaciones=''; 
                $ddos='';
                $mmos='';
                $yearos='';
                $horaos='';
                $principal='';
                $secundario='';
                $claro_video='';
                $tipo_os='';
                $alfanumerico='';
                $serie=''; 
            }
            if($idmos<>''){
                $sql3="SELECT * FROM adjunto_os 
                WHERE os_idos='$idmos'";
                $resultado=$con3->query($sql3);
                while($row = $resultado->fetch_assoc())
                {
                    /*OS*/
                    $idadjunto=$row['idadjunto'];
                    $nombreimg=$row['nombreimg'];
                    $os_idos=$row['os_idos'];
                    ?>
                    <a href="<?php echo "../os/".$nombreimg;?>" target="_blank">
                        <img src="../os/<?php echo $nombreimg;?>" width="50" height="50">
                    </a>
                    <?php
                }
            }
            ?>
        </div>
        <div class="col-md-12 table-responsive" style="background-color:white;border:solid;">
            <!--SUPERVISOR Y TECNICO-->
            <?php
            //echo $usuario_idu."-----".$asignado."<br>";
            if(!isset($usuario_idu) or !isset($asignado)){
            }if(isset($usuario_idu) or isset($asignado)){
                ?>
                <label style="color:green;">SUPERVISOR</label><br>
                <?php
                $sql3="SELECT * FROM usuario WHERE idu='$usuario_idu'";
                $resultado=$con3->query($sql3);
                while($row = $resultado->fetch_assoc())
                {
                    /*SUPERVISOR*/
                    $nombre=$row['nombre'];
                    $apaterno=$row['apaterno'];
                    $amaterno=$row['amaterno'];
                    ?>
                     <label><?php echo $nombre." ".$apaterno." ".$amaterno;?></label>
                    <?php
                }
                ?>
                <br><br>
                <label style="color:green;">TECNICO ASIGNADO</label><br>
                <?php
                $sql3="SELECT * FROM usuario WHERE idu='$asignado'";
                $resultado=$con3->query($sql3);
                while($row = $resultado->fetch_assoc())
                {
                    /*TECNICO*/
                    $nombre=$row['nombre'];
                    $apaterno=$row['apaterno'];
                    $amaterno=$row['amaterno'];
                    ?>
                     <label><?php echo $nombre." ".$apaterno." ".$amaterno;?></label>
                    <?php
                }

            }
            ?>
            <?php
                    $con1 = Conectarse(); 
                    $sql="SELECT * FROM objecion_os INNER JOIN os WHERE id_orden=idmos AND folio_pisa='$folio_pisa' ORDER BY fecha DESC";
                    $resultado=$con1->query($sql);
                    ?>
                <div style="background-color:;height:200px;overflow-y:scroll;">
                    <?php //echo $folio_pisa;?>
                    <table class="table">
                    <?php
                        while($row = $resultado->fetch_assoc())
                        {
                            if($row['id_orden']<>0 or $row['id_orden']<>''){
                            ?>
                                 <tr>
                                    <td><?php echo $row['fecha'];?></td>
                                    <td><?php echo $row['observaciones'];?></td>
                                    <td><?php echo $row['personal_telmex'];?></td>
                                    <td><?php echo $row['distintivo'];?></td>
                                  </tr>
                            <?php 
                            }
                        } 
                        if ($con->query($sql) === TRUE) { echo "New record created successfully<br>"; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
                    ?>
                    </table>
                </div>
        </div>
    </div>
    <div class="col-md-8">
        <div style="background-color:gray;border:solid;" class="table-responsive">
            <table class="table" style="background-color:white;">
                <tr>
                    <th>IDMOS:</th>                    
                    <th>COPE:</th>
                    <th>EXPEDIENTE:</th>
                    <th>FECHA DE CARGA:</th>
                    <th>FOLIO PISAPLEX</th>
                    <th>FOLIO PISA</th>
                    <TH>TELEFONO</TH>
                    
                </tr>
                <tr>
                    <td><?php echo $idmos;?></td>
                    <td><?php echo $cope;?></td>
                    <td><?php echo $expediente;?></td>
                    <td style="color:red;"><b><?php echo $ddcarga."/".$mmcarga."/".$yearcarga;?></b></td>
                    <td style="color:red;"><b><?php echo $folio_pisaplex;?></b></td>
                    <td style="color:red;"><b><?php echo $folio_pisa;?></b></td>
                    <td><?php echo $telefono;?></td>
                </tr>
                <tr>
                    <th>CLIENTE</th>
                    <th>TIPO DE TAREA</th>
                    <!--<TH>TECNOLOGIA</TH>-->
                    <TH>DISTRITO</TH>
                    <TH>ZONA</TH>
                    <TH>DILACION ETAPA</TH>
                    <TH>DILACION</TH>
                    <th></th>
                </tr>
                <tr>
                    <td><?php echo $cliente;?></td>
                    <td><?php echo $tipo_tarea;?></td>
                    <!--<td><?php echo $tecnologia;?></td>-->
                    <td><?php echo $distrito;?></td>
                    <td><?php echo $zona;?></td>
                    <td><?php echo $dilacion_etapa;?></td>
                    <td><?php echo $dilacion;?></td>
                    <th></th>
                </tr>
            </table>
        </div>
        <div style="background-color:gray;border:solid;" class="table-responsive">
            <table class="table" style="background-color:white;">
                <tr>
                    <th>ESTATUS</th>                    
                    <th>OBSERVACIONES</th>
                    <th>FECHA DE CIERRE</th>
                    <th>PRINCIPAL</th>
                    <th>SECUNDARIO</th>
                </tr>
                <tr>
                    <td><?php 
                        if($estatus==0){
                            echo "ABIERTA";
                        }if($estatus==1){
                            echo "OBJETADA";
                        }if($estatus==2){
                            echo "LIQUIDADA";
                        }if($estatus==5){
                            echo "";
                        }
                        ?>
                    </td>
                    <td><?php echo $observaciones;?></td>
                    <td style="color:red;"><b><?php echo $ddos."/".$mmos."/".$yearos." ".$horaos;?></b></td>
                    <td><?php echo $principal;?></td>
                    <td><?php echo $secundario;?></td>
                </tr>
                <tr>
                    <th>CLARO VIDEO</th>                    
                    <th>TIPO DE OS</th>
                    <th>ALFANUMERICO</th>
                    <th>SERIE</th>
                    <th></th>
                </tr>
                <tr>
                    <td><?php 
                        echo $claro_video;
                        ?>
                    </td>
                    <td><?php echo $tipo_os;?></td>
                    <td><?php echo $alfanumerico;?></td>
                    <td><?php echo $serie;?></td>
                    <td></td>
                </tr>
            </table>
        </div>
        <div style="background-color:gray;border:solid;" class="table-responsive">
            <?php
            if(!isset($idmos) OR $idmos==''){

            }if(isset($idmos)){
                $sql="SELECT * FROM material WHERE idos='$idmos'";
                $resultado=$con1->query($sql);
                while($re = $resultado->fetch_assoc())
                {
                    /*MATERIAL*/
                    $modem=$re['modem'];
                    $rosetas=$re['rosetas'];
                    $metraje=$re['metraje'];
                    $tipo_instalacion=$re['tipo_instalacion'];
                }
                ?>
                <table class="table" style="background-color:white;">
                    <tr>
                        <th>MODEM</th>                    
                        <th>ROSETAS</th>
                        <th>METRAJE</th>
                        <th>TIPO DE INSTALACION</th>
                    </tr>
                    <tr>
                    <?php
                    if(!isset($modem)){

                    }else{
                        ?>
                        <td><?php echo $modem;?></td>
                        <td><?php echo $rosetas;?></td>
                        <td><?php echo $metraje;?></td>
                        <td><?php echo $tipo_instalacion;?></td>
                    <?php
                    }
                    ?>
                    </tr>
                </table>
                <?php
            }
            ?>
        </div>
    </div>
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