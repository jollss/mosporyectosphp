<?php
ob_start(); 
if(!isset($_GET['ky']) or count($_GET)==0){
    header('Location: 404.php');
}
require 'clase_conexion.php';
require 'check.php';
require 'zona.php';
date_default_timezone_set('America/Mexico_City');
function times(){
  date_default_timezone_set('America/Mexico_City');
  $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $hh=date('G');
    $min=date('i');
    ?>
    <script>
        function actual() {
                 fecha=new Date(); 
                 hora=fecha.getHours(); 
                 minuto=fecha.getMinutes(); 
                 segundo=fecha.getSeconds();
                 if (hora<10) { 
                    hora="0"+hora;
                    }
                 if (minuto<10) { 
                    minuto="0"+minuto;
                    }
                 if (segundo<10) {
                    segundo="0"+segundo;
                    }
                 mireloj = hora+" : "+minuto+" : "+segundo; 
                         return mireloj; 
                 }
        function actualizar() { 
           mihora=actual(); 
           mireloj=document.getElementById("reloj"); 
           mireloj.innerHTML=mihora; 
             }
        setInterval(actualizar,1000);
      </script>  
      <script type="text/javascript">
          function show(bloq) {
           obj = document.getElementById(bloq);
           obj.style.display = (obj.style.display=='none') ? 'block' : 'none';
      }
      </script> 
              <div id="reloj" style="width: 100%; height: 20%; border: 2px solid black; 
                     font: bold 2em dotum, 'lucida sans', arial; text-align: center;background-color:#4DEE3D;">
    <?php
    echo $hh." : ".$min." : 00";
}
//and $_GET['key']!='202cb962ac59075b964b07152d234b70')
$urlAltaZona="https://www.mosproyectos.com.mx/Assistance/admin.php?ky=202cb962ac59075b964b07152d234b70&menu=alta_zona";
$urlInicio="https://www.mosproyectos.com.mx/Assistance/admin.php?ky=202cb962ac59075b964b07152d234b70&menu=inicio";
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
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="css/metisMenu.min.css" rel="stylesheet">
    <!-- Timeline CSS -->
    <link href="css/timeline.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/startmin.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="css/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    <!-- MOS STYLE -->
    <link href="css/mostyle.css" rel="stylesheet">
</head>
<body>
<div id="wrapper">
    <!-- Navigation MENU-->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="navbar-header" style="heigh:100px;">
            <a class="navbar-brand" href="#"><img src="../syspic/logo.png" width="100" height="40"></a>
        </div>
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <ul class="nav navbar-right navbar-top-links">
            <li >
                <a href="#">
                    <i class="fa fa-user fa-fw"></i> ADMINISTRADOR
                </a>
            </li>
        </ul>
        <br>
        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <?php echo "V 1.0.0"; ?>
                <ul class="nav" id="side-menu" style="font-size:15px;">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <?php times();?>
                        </div>
                    </li>
                    <li>
                        <a href="<?php echo $urlInicio;?>" class=""><i class="fa fa-home fa-fw"></i> INICIO</a>
                    </li>
                    <li>
                        <a href="<?php echo $urlAltaZona;?>" class=""><i class="fa fa-home fa-fw"></i> CREAR UNA ZONA</a>
                    </li>
                </ul>

            </div>
        </div>
    </nav>
    
    <br><br> 
    <br><br>
    <!-- Page Content -->
    <div id="page-wrapper">
    <div class="col-md-12">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Administrador</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->  
<!--============================================================================================-->
<?php 
//var_dump($_GET); 
date_default_timezone_set('America/Mexico_City');
if (!isset($_GET['dia']) and !isset($_GET['mes']) and !isset($_GET['year'])) {
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
}if (isset($_GET['dia']) and isset($_GET['mes']) and isset($_GET['year'])) {
    $dia=$_GET['dia'];
    $mes=$_GET['mes'];
    $aaaa=$_GET['year'];
}

$hoy=$aaaa."-".$mes."-".$dia;
$registro = new Check();
$cnt=$registro->obtenerTotaldeRegsitros($bd);
$zona = new Zona();
$cntz=$zona->obtenerTotaldeZona($bd);
if($_GET['menu']=='inicio'){
?>
<div class="col-md-12" style="background-color:;">
    <div class="col-md-12" style="background-color:;">
        <div class="col-md-12">
            <form>
                <input type="hidden" value="202cb962ac59075b964b07152d234b70" name="ky">
                <input type="hidden" value="inicio" name="menu">
                <table class="col-md-6">
                <tr>
                  <td>
                    DIA
                  </td>
                  <TD>
                    MES
                  </TD>
                  <TD>
                    AÑO
                  </TD>
                  <TD>
                    ZONA
                  </TD>
                </tr>
                  <tr>
                    <td>
                      <input class="form-control" type="number" placeholder="dia" name="dia" min=1 max=31 value="<?php echo $dia;?>">
                    </td>
                    <td>
                      <input class="form-control" type="number" placeholder="mes" name="mes" min=1 max=12 value="<?php echo $mes;?>">
                    </td>
                    <td>
                      <input class="form-control" type="number" placeholder="año" name="year" min=1900 max="<?php echo $aaaa;?>" value="<?php echo $aaaa;?>">
                    </td>
                    <td>
                      <select class="form-control" name="location"> 
                        <?php
                        for ($i=1; $i < $cntz; $i++) { 
                          $nzona=$zona->obtenerZonaxID($bd,$i);
                          ?>
                          <option value="<?php echo $nzona[0]['nombre_zona'];?>"><?php echo $nzona[0]['nombre_zona'];?></option>
                          <?php
                        }
                        ?>
                      </select>
                    </td>
                  </tr>
                </table>
                <!--
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    
                </div>
                -->
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary">VER</button>
                </div>
            </form>
                <div class="col-md-2">
                  <form action="report_assistance.php" method="POST" target="_blank">
                      <input type="hidden" value="202cb962ac59075b964b07152d234b70" name="ky">
                      <input type="hidden" value="inicio" name="menu">
                      <input class="form-control" type="hidden" placeholder="dia" name="dia" min=1 max=31 value="<?php echo $dia;?>">
                      <input class="form-control" type="hidden" placeholder="mes" name="mes" min=1 max=12 value="<?php echo $mes;?>">
                      <input class="form-control" type="hidden" placeholder="año" name="year" min=1900 max="<?php echo $aaaa;?>" value="<?php echo $aaaa;?>">
                      <input class="form-control" type="hidden" placeholder="zona" name="location" value="<?php echo $_GET['location'];?>">
                      <button type="submit" class="btn btn-success">DESCARGAR</button>
                  </form>
                </div>
        </div>
    </div>
    <div class="col-md-12" align="center">
        <h3><?php echo $dia."/".$mes."/".$aaaa;?></h3>
    </div>
    <div class="col-md-12" style="height:500px;overflow-y:scroll;">
      <table class="table">
          <tr>
            <th>Id Empelado</th> 
            <th>Fecha</th>
            <th>Foto</th>
            <th></th>
          </tr>
      <?php
      require 'usuario.php';
      $usuario=new Usuario();
      if(!isset($_GET['location'])){$location='';}if(isset($_GET['location'])){$location=strtoupper($_GET['location']);}
      for ($i=1; $i < $cnt; $i++) { 
        $dato=$registro->obtenerUnRegistro($bd,$i);
        $loc=$dato[0]['location']; 
        $compara=$dato[0]['fecha_reg']; 
        if($hoy==$compara and $loc==$location)
        {
          $usuarios=$usuario->obtenerUnRegistro($bd2,$dato[0]['usuario']);
          //var_dump($usuarios);
          $registrado=$usuarios[0]['nombre']." ".$usuarios[0]['apaterno']." ".$usuarios[0]['amaterno'];
          if($registrado<>"SIN ASIGNACION DE USUARIO"){
          ?>
              <tr>
                  <td><?php echo $registrado;?></td>
                  <td><?php echo $dato[0]['fecha'];?></td>
                  <td><a href="fotos/<?php echo $dato[0]['imagen'];?>" target="_blank"><img src="fotos/<?php echo $dato[0]['imagen'];?>" width=50 height=50></a></td>
                  <?php
                  if($dato[0]['tipo']=='ENTRADA'){
                  ?>
                  <td style="color:green;"><?php echo $dato[0]['tipo'];?></td>
                  <?php
                  }if($dato[0]['tipo']=='SALIDA'){
                  ?>
                  <td style="color:RED;"><?php echo $dato[0]['tipo'];?></td>
                  <?php
                  }
                  ?>
              </tr>
          <?php
          }
        }
      }
      ?>
      </table>
    </div>
</div>   
<?php
}if($_GET['menu']=='alta_zona'){
  if(isset($_GET['nombre_zona'])){
    $id=$zona->obtenerTotaldeZona($bd);
    $name=strtoupper($_GET['nombre_zona']);
    $data = array('idzona' => $id,'nombre_zona' => $name );
    $zona->registrarZona($bd,$data);
    header('Location: '.$urlAltaZona.'');
  }
  ?>
  <div class="col-md-12" style="background-color:orange;">
    <div class="col-md-12" align="center">ZONAS</div>
    <form action="admin.php" method="GET">
        <input type="hidden" value="202cb962ac59075b964b07152d234b70" name="ky">
        <input type="hidden" value="alta_zona" name="menu">
        <input type="text" class="form-control" name="nombre_zona" placeholder="NOMBRE DE LA NUEVA ZONA A CREAR">
        <button type="submit" class="btn btn-primary">
            REGISTRAR
        </button>
    </form>
    <table class="table">
        <tr>
          <th></th>
          <th></th>
          <th></th>
        </tr>
        
        <?php
        for ($i=1; $i < $cntz; $i++) { 
          $nzona=$zona->obtenerZonaxID($bd,$i);
          echo "<tr>";
          echo "<td>".$i."</td>";
          echo "<td>".$nzona[0]['nombre_zona']."</td>";
          echo "</tr>";
        }
        ?>
        
    </table>
  </div>
  <?php
}
?> 
<!--============================================================================================-->
    </div>
</div>
<!-- Bootstrap Core JavaScript -->
<script src="../js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="../js/metisMenu.min.js"></script>
<!-- Custom Theme JavaScript -->
<script src="../js/startmin.js"></script>
</div>
</body>
</html>
<?php
ob_end_flush();
?>