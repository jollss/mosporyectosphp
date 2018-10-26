<?php
ob_start(); 
if(!isset($_GET['location'])  or $_GET['location']=='' or $_GET['ky']==''){
    header('Location: 404.php');
}
if(!isset($_GET['ky']) or count($_GET)==0){
    header('Location: 404.php');
}
require 'clase_conexion.php';
require 'check.php';
function times(){
  date_default_timezone_set('America/Mexico_City');
  $dia=date('j');
    $mes=date('n');
    ob_start(); 
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
                     font: bold 4em dotum, 'lucida sans', arial; text-align: center;background-color:#4DEE3D;">
    <?php
    echo $hh." : ".$min." : 00";
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
    <!-- jQuery -->
    <script src="jquery-1.6.2.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js "></script>
    <!-- MOS STYLE -->
    <link href="css/mostyle.css" rel="stylesheet">
  <style type="text/css">
    /* jQuery lightBox plugin - Gallery style */
    #cuadro_camara {
      /*background-color: #444;*/
      border-color: red;
      padding-left: 30px;
      padding-top:20px;
      border: solid;
    }
    #titulo_camara {
      /*background-color: #666;*/
      border: solid;
      color:#FFF;
      padding-left: 30px;
      font-size: 14px;
      text-align:center;
    }
    .nav {
      color: blue;
      padding-left: 30px;
      font-size: 18px;
      text-align:center;
    }
    .formulario {
      color: #FFF;
    }
  </style>
<!----> 
<script>
  $(window).load(function() {
    $(".loader").fadeOut("slow");
  });
</script>
<!---->
</head>
<body>

<ul class="nav nav-tabs">
  <!--<li role="presentation" class="active"><a href="#"><img src="syspic/logo.png" width="100" height="80"></a></li>-->
  <li role="presentation"><a href="https://www.mosproyectos.com.mx/" target="_blank">WEB</a></li>
</ul>

<div class="col-md-12" style="">
  <?php
  times();
  ?>
</div>  
<div></div>
<div align="left" id="cuadro_camara" class="col-md-12" style="background-color:yellow"> 
  <div class="col-md-12" style="background-color:blue">
    <div class="col-md-3" align="center" style="border:solid;background-color:grey;">
      <img src="galeria/usuario.png" width="200" height="200">
      <canvas id="canvas" style="display:none;"></canvas>
    </div>
    <div class="col-md-3">
      <form method="post" accept-charset="utf-8" name="form1">
          <input name="ky" id='ky' type="hidden" value="123" />
          <input name="hidden_data" id='hidden_data' type="hidden"/>
          <input type="number" id="user" class="form-control" min=0 placeholder="INGRESA TU ID DE USUARIO" name="user">
          <input type="hidden" value="<?php echo $_GET['location'];?>" name="location" id="location">
          <select id="tipo" class="target form-control" name="tipo" required>
              <option value="ERROR">SELECCIONA UNA OPCIÓN</option>
              <option value="ENTRADA">ENTRADA</option>
              <option value="SALIDA">SALIDA</option>
          </select>
      </form>
          <button id="take" class="btn btn-primary envio">REGISTRAR</button><br />
    </div>
        <div class="col-md-3">
            <video id="v" width="400"></video>
        </div>
      <div class="col-md-3">
      
        <img src="http://placehold.it/300&text=Your%20image%20here%20..." id="photo" alt="photo" width="200" height="200">
      </div>

  </div>
  <?php

  require 'usuario.php';
  $usuario=new Usuario();
  $usuarios=$usuario->obtenerUnRegistro($bd2,10);

  ?>

</div>
<div class="col-md-12" style="background-color:white; border:solid;">
    <div class="col-md-12">
      <div class="content" align="center"><img src="galeria/cargando.gif"></div>
    <div class="col-md-12" id="reg" style="height:400px;overflow-y:scroll;">
    </div>
</div>
<style type="text/css">
  /* jQuery lightBox plugin - Gallery style */
  #gallery {
    background-color: #444;
    width: 100%;
  }
  #gallery ul { list-style: none; }
  #gallery ul li { display: inline; }
  #gallery ul img {
    border: 5px solid #3e3e3e;
    border-width: 5px 5px 5px;
  }
  #gallery ul a:hover img {
    border: 5px solid #fff;
    border-width: 5px 5px 5px;
    color: #fff;
  }
  #gallery ul a:hover { color: #fff; }
</style>
<script>
  $(document).ready(function(){

    setTimeout(function() {
        $(".content").fadeOut(1500);
    },5000);

    $("#take").hide();
    var refreshId =  setInterval(function(){
      $("#reg").empty().load("data_reg.php?location=<?php echo $_GET['location'];?>");
      var check=$(".target").val();
      $( ".target" ).click(function() {  
        $(".envio").show();  
      });
    },5000);
  });
</script>  
    <script>
      function refresh() {
          
      }
    </script>
    <script>
        ;(function(){
            function userMedia(){
                return navigator.getUserMedia = navigator.getUserMedia ||
                navigator.webkitGetUserMedia ||
                navigator.mozGetUserMedia ||
                navigator.msGetUserMedia || null;

            }
            // Now we can use it
            if( userMedia() ){
                var videoPlaying = false;
                var constraints = {
                    video: true,
                    audio:false
                };
                var video = document.getElementById('v');

                var media = navigator.getUserMedia(constraints, function(stream){

                    // URL Object is different in WebKit
                    var url = window.URL || window.webkitURL;

                    // create the url and set the source of the video element
                    video.src = url ? url.createObjectURL(stream) : stream;

                    // Start the video
                    video.play();
                    videoPlaying  = true;
                }, function(error){
                    console.log("ERROR");
                    console.log(error);
                });
                document.getElementById('take').addEventListener('click', function(){
                    if (videoPlaying){
                        var canvas = document.getElementById('canvas');
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        canvas.getContext('2d').drawImage(video, 0, 0);
                        var data = canvas.toDataURL('image/webp');
                        document.getElementById('photo').setAttribute('src', data);
                        var dataURL = canvas.toDataURL("image/png");

                        document.getElementById('hidden_data').value = dataURL;
                        document.getElementById('user').value;
                        console.log(document.getElementById('user').value);
                        var fd = new FormData(document.forms["form1"]);

                        var xhr = new XMLHttpRequest();
                        //xhr.open('POST', 'upload_data.php', true);
                        xhr.open('POST', 'process.php', true);

                        xhr.upload.onprogress = function(e) {
                            if (e.lengthComputable) {
                                var percentComplete = (e.loaded / e.total) * 100;
                                //console.log(percentComplete + '% uploaded');
                                //alert('Succesfully uploaded');
                            }
                        };
                        xhr.onload = function() {
                        };
                        xhr.send(fd);
                        //sendToServerAJAX();
                    }
                }, false);
            //
            } else {
                console.log("KO");
            }
            //
        })();
    </script>
</body>
</html>
<?php
ob_end_flush();
?>