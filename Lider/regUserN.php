<?php
include("../Config/library.php");
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$idus=$Yo->regresaIdu();
$sql="SELECT * FROM equipos_fielder where id_fielder='$idus'";
$resultado=$con->query($sql);
while($row = $resultado->fetch_assoc())
{
    $areaLider=$row['id_area'];
}if(!isset($areaLider)){
    $areaLider=0;
}
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
    <?php lider($user);?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Registro Nuevo</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<?php
if(!isset($_GET['name']) AND !isset($_GET['cel']))
{
}if(isset($_GET['name']) AND isset($_GET['cel']) and isset($_GET['tipo'])){
    $sql1="SELECT * FROM usuario ORDER BY idu";
    $resultado=$con->query($sql1);
    while($row = $resultado->fetch_assoc())
    {
      $idu=$row['idu'];
    }
    $idu=$idu+1;
    $name=strtoupper($_GET['name']);
    $apa=strtoupper($_GET['apa']);
    $ama=strtoupper($_GET['ama']);
    $cel=$_GET['cel'];
    $tel=$_GET['tel'];
    $correo=$_GET['correo'];
    $ingreso=$_GET['ingreso'];
    $estado_civil=strtoupper($_GET['estado_civil']);
    $estatura=$_GET['estatura'];
    $dir=strtoupper($_GET['dir']);
    $curp=strtoupper($_GET['curp']);
    $licencia=strtoupper($_GET['licencia']);
    $tel_emergencia=$_GET['tel_emergencia'];
    $tipo=$_GET['tipo'];
    $auxiliar=0;
    $sql1="SELECT * FROM usuario WHERE nombre='$name' and apaterno='$apa' and amaterno='$ama' and correo='$correo'";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
          $nombre=$row['nombre'];
          $auxiliar=1;
        }
    if(!isset($nombre)){
        $auxiliar=1;
    }else{
        $auxiliar=0;
    }
    if($auxiliar==1){
        echo "<div clas='col-md-12' align='center'><span class='label label-success'>Registrado</span></div>";
        $sql="INSERT INTO usuario (
            idu,id_zona,activo,correo,
            nombre,apaterno,amaterno,pssw,
            nocuenta,cel,tel,fecha_ingreso,fecha_seguro,
            direccion,estado_civil,estatura,licencia,
            curp,tel_emerg,checador,tipo_personal,asignado,tipo_idtipo)
            VALUES
            ('".$idu."','1','1','".$correo."',
             '".$name."','".$apa."','".$ama."','202cb962ac59075b964b07152d234b70',
             '0',
             '".$cel."',
             '".$tel."',
             '".$ingreso."',
             '0001-01-01',
             '0',
             '".$estado_civil."',
             '".$estatura."',
             '".$licencia."',
             '".$curp."',
             '".$tel_emergencia."','0',
             '','".$idus."','".$tipo."'
             )";
        if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
/*---------*/
        include ("../Models/asignaciones.php");
        $asigna = new asignaciones();
        $asigna->existencia($idu,$_GET['aquien'],$con);
/*--------*/    
    
        $sql1="SELECT * FROM equipos_fielder ORDER BY idequipo";
            $resultado=$con->query($sql1);
            while($row = $resultado->fetch_assoc())
            {
              $ideq=$row['idequipo'];
            }
            $ideq=$ideq+1;
        $sql="INSERT INTO equipos_fielder (
            idequipo,id_fielder,id_area)
            VALUES
            ('".$ideq."','".$idu."','".$areaLider."')";
        if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
        $sql1="SELECT * FROM infuser ORDER BY idinfo";
            $resultado=$con->query($sql1);
            while($row = $resultado->fetch_assoc())
            {
              $ida=$row['idinfo'];
            }
            $ida=$ida+1;
        $sql="INSERT INTO infuser (
            idinfo,departamento,hora_entrada,
            hora_salida,tipo_contrato,fecha_nacimiento,nacionalidad,
            sexo,peso,correo_alterno,nss,ife,
            rfc,vig_licencia,salario,usuario_iduu)
            VALUES
            ('".$ida."','','',
             '','','','',
             '','','','','','',
             '','','".$idu."'
             )";
        if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
        $sql1="SELECT * FROM archivosuser ORDER BY idarchiuser";
            $resultado=$con->query($sql1);
            while($row = $resultado->fetch_assoc())
            {
              $idarchivo=$row['idarchiuser'];
            }
            $idarchivo=$idarchivo+1;
        $sql="INSERT INTO archivosuser (
            idarchiuser,acta_na,comp_dom,
            comp_estudios,arch_curp,arch_licencia,fotos,
            est_socioeco,usuario_idus)
            VALUES
            ('".$idarchivo."','','',
             '','','','',
             '','".$idu."'
             )";
        if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
        $sql="INSERT INTO cantidades (
            cobre,fibra,hibrida,
            tecnica,voz,psr,usuario_idu)
            VALUES
            ('0','0','0',
             '0','0','0',
             '".$idu."'
             )";
        if ($con->query($sql) === TRUE) { echo ""; } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }

    }if($auxiliar==0){
        echo "<div clas='col-md-12' align='center'><span class='label label-danger'>ERROR EN DATOS</span></div>";
    }
}
?>
        <div class="col-md-12"><a href="regUser.php"><img src="../syspic/back.png" width="40" height="40"></a></div>
        <div class="col-md-12 table-responsive">
            <form action="regUserN.php" method="GET">
                <div style="height:500px;ovrflow-y:scroll;">
                <table class="table">
                    <tr>
                        <th>Nombre</th>
                        <th>Apellido Paterno</th>
                        <th>Apelido Materno</th>
                        <th>Celular</th>
                        <th>Telefono</th>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="text" name="name" value="" required></td>
                        <td><input class="form-control" type="text" name="apa" value="" required></td>
                        <td><input class="form-control" type="text" name="ama" value="" required></td>
                        <td><input class="form-control" type="text" name="cel" value="" required></td>
                        <td><input class="form-control" type="text" name="tel" value="" required></td>
                        <input class="form-control" type="hidden" name="tipo" value="21">
                        <!--
                        <td>
                        <select class="form-control" name="tipo">
                            <?php
                            $sql1="SELECT * FROM tipo ORDER BY tipo";
                            $resultado=$con->query($sql1);
                            while($row = $resultado->fetch_assoc())
                            {
                              $idtipo=$row['idtipo'];
                              $ntipo=$row['tipo'];
                              if($idtipo==24 or $idtipo==27 or $idtipo==21){
                              ?>
                                <option value="<?php echo $idtipo;?>"><?php echo $ntipo;?></option>
                              <?php
                              }
                            }
                            ?>
                        </select>
                        </td>
                        -->
                    </tr>
                    <tr></tr>
                    <tr>
                        <th>Usuario</th>
                        <th>Fecha de Ingreso</th>
                        <th></th>
                        <th>Estado Civil</th>
                        <th>Estatura</th>
                    </tr>
                    <tr>
                        <td>
                              <input type="text" class="form-control" placeholder="Correo"  value="@mosproyectos.com.mx" name="correo" aria-describedby="sizing-addon2" required>
                        </td>
                        <td><input class="form-control" type="date" name="ingreso" value="" required></td>
                        <td></td>
                        <td><input class="form-control" type="text" name="estado_civil" value="" required></td>
                        <td><input class="form-control" type="text" name="estatura" value="" required></td>
                    </tr>
                    <tr>
                        <th>Direccion</th>
                        <th>CURP</th>
                        <th>Licencia</th>
                        <th>Telefono de Emergencia</th>
                    </tr>
                    <tr>
                        <td><input class="form-control" type="text" name="dir" value="" required></td>
                        <td><input class="form-control" type="text" name="curp" value="" required></td>
                        <td><input class="form-control" type="text" name="licencia" value="" required></td>
                        <td><input class="form-control" type="number" name="tel_emergencia" value="" required></td>
                    </tr>
                    <tr>
                         <td>
                            <select class="form-control" name="aquien">
                                <?php
                                $sql1="SELECT * FROM usuario WHERE asignado='".$idus."' AND activo=1";
                                $resultado=$con->query($sql1);
                                while($row = $resultado->fetch_assoc())
                                {
                                  $idusr=$row['idu'];
                                  $nombre=$row['nombre'];
                                  $apaterno=$row['apaterno'];
                                  $amaterno=$row['amaterno'];
                                  //if($idtipo==24 or $idtipo==27 or $idtipo==21){
                                  ?>
                                    <option value="<?php echo $idusr;?>"><?php echo $nombre." ".$apaterno." ".$amaterno;?></option>
                                  <?php
                                  //}
                                }
                                ?>
                            </select>
                        </td>
                        <td><input class="btn btn-success" type="submit"  value="REGISTRAR"></td>
                        <td></td>
                    </tr>
                </table>
                </div>
            </form>
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
