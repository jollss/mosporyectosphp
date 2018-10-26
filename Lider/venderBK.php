<?php
include("../Config/library.php");
date_default_timezone_set('America/Mexico_City');
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$hora=date('G');
$min=date('i');
$cnx = Conectarse(); 
$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$nombreyo=$Yo->regresaNombre();
$apyo=$Yo->regresaApaterno();
$amyo=$Yo->regresaAmaterno();
$minI=6;
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
    <?php
     if (!isset($_GET['latitud']) && !isset($_GET['longitud'])) {
                echo "
                      <script type='text/javascript'>
                       if (navigator.geolocation) {
                            navigator.geolocation.getCurrentPosition(obtenerUbicacion);
                          } else {alert('¡Error! Este navegador no soporta la Geolocalización.');}
                          function obtenerUbicacion(position) {
                            var times = position.timestamp;
                            var latitud = position.coords.latitude;
                            var longitud = position.coords.longitude;
                            var altitud = position.coords.altitude; 
                            var exactitud = position.coords.accuracy; 
                            location.href='vender.php?latitud='+ latitud + '&longitud='+longitud;
                          }
                      </script>
                  ";
              }else{
                $id=0;
                    $idventa='0';
                    $lon=$_GET['longitud'];
                    $lat=$_GET['latitud'];
              }
      ?>
      <script>
      $( function() {
        $( "#datepicker" ).datepicker();
      } );
      </script>
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
                <h1 class="page-header">VENDER</h1>
            </div>
        </div>
        <!-- ... Your content goes here ... -->   
<!--============================================================================================-->
<div class="container col-md-12" name="toTop" id="topPos">
  <?php
  if(!isset($_GET['return'])){
    $longitud=$_GET['longitud'];
    $latitud=$_GET['latitud'];
  ?>
  <form action="uploadFile.php" method="POST" enctype="multipart/form-data">
  <input type="hidden" value="<?php echo $longitud;?>" name="longitud">
  <input type="hidden" value="<?php echo $latitud;?>" name="latitud">
    <div class="input-group">
      <span class="input-group-addon" id="sizing-addon2">*No. de Solicitud:</span>
      <input type="text" class="form-control" name="solicitud" value="" aria-describedby="sizing-addon2" required>
    </div>
    <span class="input-group-addon" id="sizing-addon2">
    <label>Archivo de solicitud</label>
    <input type="file" name="userfile[]" required>
    <label>Comprobante de domicilio</label>
    <input type="file" name="userfile[]" required>
    <label>Identificación Personal FRENTE</label>
    <input type="file" name="userfile[]" required>
    <label>Identificación Personal TRAS</label>
    <input type="file" name="userfile[]" required>
    <label>Aviso de Privacidad FRENTE</label>
    <input type="file" name="userfile[]">
    <label>Captura de MAPA</label>
    <input type="file" name="userfile[]">
    <input type="submit" value="CARGAR IMAGEN" class="btn btn-success">
    </span>
  </form>
  <?php
  }if(isset($_GET['return'])){
    //var_dump($_GET);
    $folio=$_GET['return']; 
    $latitud=$_GET['latitud'];
    $longitud=$_GET['longitud'];
    $con->real_query("SELECT * FROM adjunto_venta WHERE folio_venta='$folio'");
    $r = $con->use_result();
    ?>
    <div align="center">
    <table>
    <tr>
    <?php
    $count=0;
    while ($l = $r->fetch_assoc()){
        $count++;
        $totalAdjuntos=$l['idaventa'];
        $nameImg=$l['imagen_n'];
        ?>
          <td>
            <form method="POST" action="delImage.php">
              <input type="hidden" name="return" value="<?php echo $folio;?>">
              <input type="hidden" name="longitud" value="<?php echo $longitud;?>">
              <input type="hidden" name="latitud" value="<?php echo $latitud;?>">
              <input type="hidden" name="idImagen" value="<?php echo $totalAdjuntos;?>">
              <button type="submit">X</button>
            </form>
          </td>
          <td><img src="../adjVentas/<?php echo $nameImg;?>" width="100px" height="100px" title="<?php echo $totalAdjuntos;?>"></td>
        <?php
    }
    ?>
    </tr>
    </table>
    <table>
      <tr>
      <td>Imagenes minimas </td>
      <td><?php echo " <b>".$count.":".$minI."<b>";?></td>
    </tr>
    <tr>
      <td>FOLIO VENTA:</td>
      <td><?php echo $_GET['return'];?></td>
    </tr>
    </table>
    <table border="1">
      <tr>
          <form action="uploadFile.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $longitud;?>" name="longitud">
            <input type="hidden" value="<?php echo $latitud;?>" name="latitud">
            <input type="hidden" value="<?php echo $folio;?>" name="solicitud">
            <input type="hidden" value="1" name="reload">
            <td><label>Adjuntar más evidencia</label></td>
            <td><input type="file" name="userfile[]"></td>
            <td><input type="submit" value="CARGAR IMAGEN"></td>
            </span>
          </form>
        
      </tr>
    </table>
    </div>
    <form action="rventa.php" method="POST">
      <input type="hidden" name="folio" value="<?php echo $folio;?>">
      <input type="hidden" name="iduser" value="<?php echo $iduser;?>">
      <input type="hidden" name="longitud" value="<?php echo $longitud;?>">
      <input type="hidden" name="latitud" value="<?php echo $latitud;?>">
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">Tipo de cliente:</span>
        <!--<input type="text" name="tipo_cliente" class="form-control" value="" aria-describedby="sizing-addon2" required>-->
        <select name="tipo_cliente" class="form-control" required>
        <option>--SELECCIONA UNA OPCION--</option>
          <option value="CLIENTE NUEVO">CLIENTE NUEVO</option>
          <option value="PORTABILIDAD">PORTABILIDAD</option>
          <option value="CLIENTE EXISTENTE">CLIENTE EXISTENTE</option>
        </select>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">*Nombre(s):</span>
        <input type="text" name="name" class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">*Apellido Paterno:</span>
        <input type="text"name="ap"  class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">*Apellido Materno:</span>
        <input type="text" name="am" class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">RFC:</span>
        <input type="text" name="rfc" class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">*Teléfono 1:</span>
        <input type="tel" name="tel1" class="form-control" value="" name="tel1" aria-describedby="sizing-addon2" title="Recuerda, se te solicita un teléfono." required>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">Teléfono 2:</span>
        <input type="tel" name="tel2" class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">Teléfono 3:</span>
        <input type="tel" name="tel3" class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group">
        <span class="input-group-addon" id="sizing-addon2">Correo:</span>
        <input type="mail" name="mail" class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group" style="display:;">
          <span class="input-group-addon" id="sizing-addon2">Área:</span>
          <input type="text" name="area" class="form-control" value=""aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group" style="display:">
          <span class="input-group-addon" id="sizing-addon2">Distrito:</span>
          <input type="text" name="distrito" class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      
      <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Terminal:</span>
          <input type="text" name="terminal" minlength="9" maxlength="10"  class="form-control" value="" aria-describedby="sizing-addon2" required>
      </div>
      <div class="input-group">
          <span class="input-group-addon" id="sizing-addon2">Paquete:</span>
          <!--input type="text" name="terminal" minlength="9" maxlength="10" class="form-control" value="" aria-describedby="sizing-addon2" required>-->
          <select class="form-control" name="paquete_venta">
              <option value="RESIDENCIAL $333">RESIDENCIAL $333</option>
              <option value="RESIDENCIAL $389">RESIDENCIAL $389</option>
              <option value="RESIDENCIAL FRONTERA $389">RESIDENCIAL FRONTERA $389</option>
              <option value="RESIDENCIAL $599">RESIDENCIAL $599</option>
              <option value="RESIDENCIAL $999">RESIDENCIAL $999</option>
              <option value="RESIDENCIAL PURO 10MB $349">RESIDENCIAL PURO 10MB $349</option>
              <option value="RESIDENCIAL PURO 20MB $499">RESIDENCIAL PURO 20MB $499</option>
              <option value="RESIDENCIAL PURO 50MB $649">RESIDENCIAL PURO 50MB $649</option>
              <option value="RESIDENCIAL PURO 100MB $899">RESIDENCIAL PURO 100MB $899</option>
              <option value="COMERCIAL $399">COMERCIAL $399</option>
              <option value="COMERCIAL $549">COMERCIAL $549</option>
              <option value="COMERCIAL $799">COMERCIAL $799</option>
              <option value="COMERCIAL $1499">COMERCIAL $1499</option>
              <option value="COMERCIAL $1789">COMERCIAL $1789</option>
              <option value="COMERCIAL $2289">COMERCIAL $2289</option>
              <option value="COMERCIAL $404.84">COMERCIAL $404.84</option>
              <option value="COMERCIAL RED $706.08">COMERCIAL RED $706.08</option>
              <option value="COMERCIAL PREMIUM $1209.42">COMERCIAL PREMIUM $1209.42</option>
              <option value="COMERCIAL (Sin Internet) $899">COMERCIAL (Sin Internet) $899</option>
          </select>

      </div>
      <div class="form-group">
              <span class="input-group-addon" id="sizing-addon2">*Dirección: </span>
              <textarea class="form-control"name="dir"  minlength="15" maxlength="500" rows="3" name="dir" placeholder="Dirección" style="resize:none;" required></textarea>
          </div>
      <div class="well well-sm"></div>
        <div class="form-group">
              <span class="input-group-addon" id="sizing-addon2">Detalles: </span>
              <textarea class="form-control" name="detalles" rows="3" name="detalles" maxlength="500" placeholder="Detalles" style="resize:none;" required></textarea>
          </div>
          <?php
          if($count==$minI){
            ?>
            <button type="submit" class="btn btn-primary"> REGISTRAR</button>
            <?php
          }
          ?>
    </form>
    <?php
  }
  ?>
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

