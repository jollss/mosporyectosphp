<?php
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
    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>
    <!-- MOS STYLE -->
    <link href="../css/mostyle.css" rel="stylesheet">

    <script type="text/javascript" src="webcam.js"></script>
    <script language="JavaScript">
			webcam.set_api_url( 'test.php' );//PHP adonde va a recibir la imagen y la va a guardar en el servidor
			webcam.set_quality( 90 ); // calidad de la imagen
			webcam.set_shutter_sound( true ); // Sonido de flash
	</script>
	<script language="JavaScript">
		webcam.set_hook( 'onComplete', 'my_completion_handler' );
		
		function do_upload() {
			// subir al servidor
			document.getElementById('upload_results').innerHTML = '<h1>Cargando al servidor...</h1>';
			webcam.upload();
		}
		
		function my_completion_handler(msg) {
			
			if (msg.match(/(http\:\/\/\S+)/)) {
				var image_url = RegExp.$1;//respuesta de text.php que contiene la direccion url de la imagen
				console.log(image_url);
				// Muestra la imagen en la pantalla
				/*
				document.getElementById('upload_results').innerHTML = 
					'<img src="' + image_url + '">'+
					'<form action="gestion_foto.php" method="post">'+
					'<input type="hidden" name="id_foto" id="id_foto" value="' + image_url + '"  /><br>'+
					'<label>Nombre </label><input type="text" name="nombre_foto" id="nombre_foto"/>'+
					'<label>Descripcion </label><input type="text" name="des" id="des"/>'+
				    '<input type="submit" name="button" id="button" value="Enviar" /></form>'
					;
					*/
				document.getElementById('upload_results').innerHTML = '<img src="' + image_url + '">';

				// reset camera for another shot
				webcam.reset();
			}
			else alert("PHP Error: " + msg);
		}
	</script>

	<!--<script type="text/javascript" src="jquery-1.6.2.min.js"></script>-->
	<script type="text/javascript" src="jquery.lightbox-0.5.js"></script>
	<link rel="stylesheet" type="text/css" href="jquery.lightbox-0.5.css" media="screen" />
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
	
</head>
<body>

<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="#"><img src="../syspic/logo.png" width="100" height="80"></a></li>
  <li role="presentation"><a href="https://www.mosproyectos.com.mx/" target="_blank">WEB</a></li>
  <!--<li role="presentation"><a href="#">Messages</a></li>-->
</ul>

<div class="col-md-12" style="">
	<?php
	times();
	?>
</div>	
<div></div>
<div align="left" id="cuadro_camara" class="col-md-12"> 
	<div class="col-md-6">
		<div class="col-md-1"></div>
		<div class="col-md-10" align="center" style="border:solid;background-color:grey;">
			<!--<span class="glyphicon glyphicon-user btn-lg" aria-hidden="true"></span>-->
			<img src="galeria/usuario.png" width="200" height="200">
			<form action="index.php" method="GET">
				<input type="number" class="form-control" min=0 placeholder="INGRESA TU ID DE USUARIO" onchange="webcam.freeze();" name="id" required>
				<div class="input-group btn btn-success">
			      <span class="input-group-addon ">
			        <input type="radio" class="target zombie " style="width:50px;height:50px">
			      </span>
			      <input type="text" class="form-control" value="VERIFICA QUE NO ERES UN ZOMBIE"  required readonly>
			    </div><!-- /input-group -->
				<input type="submit" class="btn btn-primary envio" value="REGISTRAR ENTRADA" onclick="do_upload();"  id="botones_cam">
			</form>
		</div>
		<div class="col-md-1"></div>
	</div>
	<div class="col-md-6">
		<script language="JavaScript">
			document.write( webcam.get_html(320, 240) );//dimensiones de la camara
		</script>
	</div>
	
	
</div>
<!--<div style="background-color:RED;">-->
<?php
	if(!isset($_GET['id'])){

	}if(isset($_GET['id'])){
		?>
		<div class="col-md-12" style="color:white;background-color:black;">
			<h2><?php echo "ENTRADA DE : ".$_GET['id'];?></h2>
		</div>
		<div class="col-md-12" style="background-color:red;height:400px;">
	    	<div id="upload_results" class="formulario" > </div>
	    	<?php
	    	?>
		</div>
		<?php
	}
?>
<!--</div>-->
<script type="text/javascript">
    $(function() {
        $('#gallery a').lightBox();//Galeria jquery
    });
</script>
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
		$(".envio").hide();
		var check=$(".target").val();
		$( ".target" ).change(function() {	
			console.log(check);	
			$(".envio").show();  
		});
	});
</script>  
