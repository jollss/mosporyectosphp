<?php
function validaSesion(){
  /*
 if(isset($_SESSION['tiempo']) ) {

    //Tiempo en segundos para dar vida a la sesión.
    $inactivo = 10;//20min en este caso.

    //Calculamos tiempo de vida inactivo.
    $vida_session = time() - $_SESSION['tiempo'];

        //Compraración para redirigir página, si la vida de sesión sea mayor a el tiempo insertado en inactivo.
        if($vida_session > $inactivo)
        {
            //Removemos sesión.
            session_unset();
            //Destruimos sesión.
            session_destroy();
            //Redirigimos pagina.
            header("Location: tupagina");

            exit();
        } else {  // si no ha caducado la sesion, actualizamos
            $_SESSION['tiempo'] = time();
        }


} else {
    //Activamos sesion tiempo.
    $_SESSION['tiempo'] = time();
}
*/
}
function valida(){
  ?>
  <script type="text/javascript">
  function redireccion() {
      window.location = "../logout.php";
  }
  // se llamará a la función que redirecciona después de 10 minutos (600.000 segundos)
  var temp = setTimeout(redireccion, 600000);
  // cuando se pulse en cualquier parte del documento
  document.addEventListener("click", function() {
      // borrar el temporizador que redireccionaba
      clearTimeout(temp);
      // y volver a iniciarlo
      temp = setTimeout(redireccion, 600000);
  })
  </script>
  <?php
}
?>
<?php
function times($user){
  date_default_timezone_set('America/Mexico_City');
  $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $hh=date('G');
    $min=date('i');
    if($user<>''){
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
              <div id="reloj" style="width: 120px; height: 10px; padding: 2px 5px; border: 0px solid black;
                     font: bold 1em dotum, 'lucida sans', arial; text-align: center;
                     float: right; margin: 1em 1em 1em 1em;">
    <?php
    echo $hh." : ".$min." : 00";
    }if($user==''){
    ?>
     <script type="text/javascript">
      window.location = "../logout.php"
    </script>
    <?php
    }
}
?>

<?php
function nivel1($user){
  //validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">
      <script type="text/javascript">
           function doC() {
          alert("En construcción...")
        }
        </script>
    <nav class='navbar navbar-default navbar-fixed-top nav-pills'>
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="  inde.php"><img src="../syspic/logo.png" width="150px" height="50px"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          <li><?php times($user);?></li>

              <li><a><b><?php echo $user;?></b></a></li>
              <li><a href="dataosuall.php">MIS OS </a></li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MIS PAGOS <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="a_pago.php">PAGADOS</a></li>
                <li><a href="pendientes_pago.php">PENDIENTES</a></li>
              </ul>
            </li>
              <li><a href="inde.php">INICIO</a></li>
                  <li><a href="avance.php">Tu Avance</a></li>
              <li ><a href="config.php">MI PERFIL</a></li>
              <li role="separator" class="divider"></li>
              <li style="font-size:12px;">
                <a href="../logout.php"><!--Cerrar sesión--><img src="../syspic/close.ico" width="30px" height="30px"></a>
              </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>
<?php
function nivel2($user){
  validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">

    <nav class='navbar navbar-default navbar-fixed-top nav-pills' style="bacground:#F2F2F2;">
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inde.php"><img src="../syspic/logo.png" width="150px" height="50px"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          <li><label><?php times($user);?></label></li>
          <?php
                        if(isset($_SESSION['AltaGerencia'])){
                          ?>
                          <li><a href="../AltaGerencia/inde.php">
                          <button type="button" class="btn btn-primary ">
                            <span class="glyphicon glyphicon-king" aria-hidden="true"></span>
                          </button>
                          </a></li>
                          <?php
                        }
                        ?>
                <li><a href="inde.php"><b><?php echo $user;?></b></a></li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ARCHIVOS <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="firma_asistencia.php">FIRMAS</a></li>
                <li><a href="recibo_nomina.php">RECIBO DE NOMINA</a></li>
                <li><a href="formato_vacaciones.php">FORMATO VACACIONES</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">USUARIOS <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="ruserF.php">REGISTRO DE USUARIOS</a></li>
                <li><a href="in.php">BUSCAR USUARIO</a></li>
                <li><a href="list.php">DIRECTORIO</a></li>
                <li><a href="reclutar.php">RECLUTAMIENTO</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MENU <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li ><a href="config.php">MI PERFIL</a></li>
                <li style="font-size:12px;">
                  <a href="../logout.php"><!--Cerrar sesión--><img src="../syspic/close.ico" width="30px" height="30px"></a>
                </li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>
<?php
function rhFielder($user){
  validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">

    <nav class='navbar navbar-default navbar-fixed-top nav-pills' style="bacground:#F2F2F2;">
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inde.php"><img src="../syspic/logo.png" width="150px" height="50px"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          <li><label><?php times($user);?></label></li>
          <?php
                        if(isset($_SESSION['AltaGerencia'])){
                          ?>
                          <li><a href="../AltaGerencia/inde.php">
                          <button type="button" class="btn btn-primary ">
                            <span class="glyphicon glyphicon-king" aria-hidden="true"></span>
                          </button>
                          </a></li>
                          <?php
                        }
                        ?>
                <li><a href="inde.php"><b><?php echo $user;?></b></a></li>

            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">OTROS <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="firma_asistencia.php">FIRMAS</a></li>
                <li><a href="recibo_nomina.php">RECIBO DE NOMINA</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">USUARIOS <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="ruserF.php">REGISTRO DE USUARIOS</a></li>
                <li><a href="in.php">BUSCAR USUARIO</a></li>
                <li><a href="list.php">LISTA DE USUARIOS</a></li>
                <li><a href="reclutar.php">RECLUTAMIENTO</a></li>
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MENU <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li ><a href="config.php">MI PERFIL</a></li>
                <li style="font-size:12px;">
                  <a href="../logout.php"><!--Cerrar sesión--><img src="../syspic/close.ico" width="30px" height="30px"></a>
                </li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>
<?php
function nivel3($user){
  validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">
    <nav class='navbar navbar-default navbar-fixed-top nav-pills'>
      <div class="container-fluid" >
        <div class="navbar-header" style="height='50px'">
          <a class="navbar-brand" href="inde.php"><img class="responsive" src="../syspic/logo.png" width="150px" height="50px"></a>

        </div>
        <div>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          <li><label><?php times($user);?></label></li>
            <li><a href="inde.php">INICIO</a></li>
            <!--<li><a href="listVentas.php">VENTAS</a></li>-->

              <li class="dropdown" >
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BUSQUEDA<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="search.php">BUSQUEDA</a></li>
                  <li><a href="filtrado.php">FILTRADO</a></li>
                </ul>
              </li>
              <li class="dropdown" >
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ORDENES DE SERVICIO<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="addOs.php">AGREGAR TRABAJO</a></li>
                  <li><a href="addROs.php">NUEVA OS</a></li>
                  <li><a href="reAdd.php">REASIGNACION</a></li>
                  <li><a href="regOsObj.php">AGREGAR TRABAJO OBJETADO</a></li>
                </ul>
              </li>

              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MENU<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a><b><?php echo $user;?></b></a></li>
                  <li ><a href="config.php">MI PERFIL</a></li>
                  <li role="separator" class="divider"></li>
                  <li style="font-size:10px;">
                    <a href="../logout.php"><img src="../syspic/close.ico" width="30px" height="30px"></a>
                  </li>
                </ul>
              </li>

          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>

<?php
function nivel5($user){
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">
    <nav class='navbar navbar-default navbar-fixed-top nav-pills'>
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inde.php"><img src="../syspic/logo.png" width="150px" height="50px"></a>
          <label><?php times($user);?></label>
        </div>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">

          <li><a href="inde.php">INICIO</a></li>
          <!--
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PAGOS<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="pago.php">PAGO</a></li>
                <li><a href="lookatpago.php">BUSCAR PAGO</a></li>
              </ul>
            </li>
            <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">ORDENES DE SERVICIO<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="listosli.php">LISTA DE USUARIOS</a></li>
                <li><a href="end.php">AGREGAR TRABAJO</a></li>
                <li><a href="listosdown.php">REDUCIR TRABAJO</a></li>
              </ul>
            </li>
            <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">USUARIOS<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="in.php">BUSCAR USUARIO</a></li>
                <li><a href="list.php">LISTA DE USUARIOS</a></li>
                <li><a href="ruserF.php">REGISTRO DE USUARIOS</a></li>
                <li role="separator" class="divider"></li>
              </ul>
            </li>
            -->
            <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MENU<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a><b><?php echo $user;?></b></a></li>
                <li ><a href="config.php">MI PERFIL</a></li>
                <li role="separator" class="divider"></li>
                <li style="font-size:10px;">
                  <a href="../logout.php"><img src="../syspic/close.ico" width="30px" height="30px"></a>
                </li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>
<?php
function support(){
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">
    <nav class='navbar navbar-default navbar-fixed-top nav-pills'>
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="level3.ini.php"><img src="../syspic/logo.png" width="150px" height="50px">V0.5</a>
          <label><?php times($user);?></label>
        </div>
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>
<?php
function supportU($user){
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">
      <script type="text/javascript">
           function doC() {
          alert("En construcción...")
        }
        </script>
    <nav class='navbar navbar-default navbar-fixed-top nav-pills'>
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inde.php"><img src="../syspic/logo.png" width="150px" height="50px"></a>
          <label><?php times($user);?></label>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          <li><a href="inde.php">INICIO</a></li>
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">LOG<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="logIn.php"><b>Ingresos</b></a></li>
                <li><a href="logOut.php"><b>Salidas</b></a></li>
                <li ><a href="logE.php"><b>Errores de Ingreso</b></a></li>
                <li role="separator" class="divider"></li>
                <li style="font-size:10px;">
                  <a href="../logout.php"><img src="../syspic/close.ico" width="30px" height="30px"></a>
                </li>
              </ul>
            </li>
            <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MENU<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a><b><?php echo $user;?></b></a></li>
                <li ><a href="config.php">MI PERFIL</a></li>
                <li role="separator" class="divider"></li>
                <li style="font-size:10px;">
                  <a href="../logout.php"><img src="../syspic/close.ico" width="30px" height="30px"></a>
                </li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>
<?php
function nivel5adm($user){
  //validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">
      <script type="text/javascript">
           function doC() {
          alert("En construcción...")
        }
        </script>
    <nav class='navbar navbar-default navbar-fixed-top nav-pills' style="bacground:#F2F2F2;">
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inde.php"><img src="../syspic/logo.png" width="150px" height="50px"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          <li><label><?php times($user);?></label></li>
                <li><a href="inde.php"><b><?php echo $user;?></b></a></li>
                <li><a href="ruserF.php">REGISTRO DE USUARIOS</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">USUARIOS <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="in.php">BUSCAR USUARIO</a></li>
                <li><a href="list.php">LISTA DE USUARIOS</a></li>
                <!--<li><a href="reclutar.php">RECLUTAMIENTO</a></li>-->
              </ul>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MENU <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li ><a href="config.php">MI PERFIL</a></li>
                <li style="font-size:12px;">
                  <a href="../logout.php"><!--Cerrar sesión--><img src="../syspic/close.ico" width="30px" height="30px"></a>
                </li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>
<?php
function call_center($user){
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">
    <nav class='navbar navbar-default navbar-fixed-top nav-pills'>
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inde.php"><img src="../syspic/logo.png" width="150px" height="50px"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          <li><label><?php times($user);?></label></li>
          <li><a href="inde.php">INICIO</a></li>

          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">OPCIONES<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="browser.php">BUSCAR</a></li>
                <li><a href="pFull.php">PENDIENTES</a></li>
                <li><a href="fullF.php">COMPLETAS</a></li>
                <li><a href="regCallF.php">REGISTRAR</a></li>
              </ul>
          </li>

            <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MENU<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a><b><?php echo $user;?></b></a></li>
                <li ><a href="config.php">MI PERFIL</a></li>
                <li role="separator" class="divider"></li>
                <li style="font-size:10px;">
                  <a href="../logout.php"><img src="../syspic/close.ico" width="30px" height="30px"></a>
                </li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>
<?php
function division($user){
  //validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">
      <script type="text/javascript">
           function doC() {
          alert("En construcción...")
        }
        </script>
    <nav class='navbar navbar-default navbar-fixed-top nav-pills'>
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inde.php"><img src="../syspic/logo.png" width="150px" height="50px"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><?php times($user);?></li>
              <li><a href="inde.php">INICIO</a></li>
              <li class="dropdown" >
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">OS<span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li><a href="terminadas.php">Terminadas</a></li>
                    <li><a href="pendientes.php">Pendientes</a></li>
                    <li><a href="objetadas.php">Objetadas</a></li>
                  </ul>
              </li>
              <li ><a href="config.php">MI PERFIL</a></li>
              <li role="separator" class="divider"></li>
              <li style="font-size:12px;">
                <a href="../logout.php"><!--Cerrar sesión--><img src="../syspic/close.ico" width="30px" height="30px"></a>
              </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>
<?php
function asignar($user){
  //validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">
      <script type="text/javascript">
           function doC() {
          alert("En construcción...")
        }
        </script>
    <nav class='navbar navbar-default navbar-fixed-top nav-pills'>
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inde.php"><img src="../syspic/logo.png" width="150px" height="50px"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><?php times($user);?></li>
              <li><a href="inde.php">INICIO</a></li>
              <li ><a href="reclutador.php">RECLUTAR</a></li>
              <li ><a href="config.php">MI PERFIL</a></li>
              <li role="separator" class="divider"></li>
              <li style="font-size:12px;">
                <a href="../logout.php"><!--Cerrar sesión--><img src="../syspic/close.ico" width="30px" height="30px"></a>
              </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>
<?php
function recluta($user){
  //validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">
      <script type="text/javascript">
           function doC() {
          alert("En construcción...")
        }
        </script>
    <nav class='navbar navbar-default navbar-fixed-top nav-pills'>
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inde.php"><img src="../syspic/logo.png" width="150px" height="50px"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><?php times($user);?></li>
              <li><a href="inde.php">INICIO</a></li>
              <!--
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">VENTAS <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li ><a href="venta.php">VENDER</a></li>
                  <li ><a href="ventas.php">MIS VENTAS</a></li>
                </ul>
              </li>
              -->
              <li ><a href="addRecluta.php">Agregar BP</a></li>
              <!--<li ><a href="addUsuario.php">Agregar A Sistema</a></li>-->
              <li ><a href="reclutador.php">MIS R.</a></li>
              <li ><a href="config.php">MI PERFIL</a></li>
              <li role="separator" class="divider"></li>
              <li style="font-size:12px;">
                <a href="../logout.php"><!--Cerrar sesión--><img src="../syspic/close.ico" width="30px" height="30px"></a>
              </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>

<?php
function cbajantes($user){
  //validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">

    <nav class='navbar navbar-default navbar-fixed-top nav-pills'>
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inde.php"><img src="../syspic/logo.png" width="150px" height="50px"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          <li><label><?php times($user);?></label></li>
          <?php
            if(isset($_SESSION['AltaGerencia'])){
              ?>
              <li><a href="../AltaGerencia/bajantes.php">
              <button type="button" class="btn btn-primary ">
                <span class="glyphicon glyphicon-king" aria-hidden="true"></span>
              </button>
              </a></li>
              <?php
            }
            if(isset($_SESSION['bajantesGerencia'])){
              ?>
              <li><a href="../bajantesG/bajantes.php">
              <button type="button" class="btn btn-primary ">
                <span class="glyphicon glyphicon-king" aria-hidden="true"></span>
              </button>
              </a></li>
              <?php
            }
            ?>
          <li><a href="inde.php">INICIO</a></li>
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BAJANTES<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="filtrado.php">FILTRADO</a></li>
                <li><a href="buscar.php">BUSCAR</a></li>
                <li><a href="asigna.php">ASIGNAR TECNICO</a></li>
                <li><a href="addROs.php">NUEVA OS</a></li>
              </ul>
          </li>
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">REGISTROS<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="ruserF.php">Nuevo Usuario</a></li>
                <li><a href="formato_vacaciones.php">Formatos Vacaciones</a></li>
              </ul>
          </li>
          <!--
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PROYECTO FIELDER<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="proFielder.php">LISTADO</a></li>
                <li><a href="listVentas.php">BUSCAR</a></li>
              </ul>
          </li>
          -->
          <!--<li><a href="listadoVentas.php">LISTA DE VENTAS</a></li>-->
          <!--<li><a href="call_center.php">CALL CENTER</a></li>-->
           <!--<li><a href="seeos.php">BUSCAR OS</a></li>-->
            <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MENU<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a><b><?php echo $user;?></b></a></li>
                <li ><a href="config.php">MI PERFIL</a></li>
                <li role="separator" class="divider"></li>
                <li style="font-size:10px;">
                  <a href="../logout.php"><img src="../syspic/close.ico" width="30px" height="30px"></a>
                </li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>

<?php
/*
function bajantesG($user){
  //validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">
    <nav class='navbar navbar-default navbar-fixed-top nav-pills'>
      <div class="container-fluid" >
        <div class="navbar-header" style="height='50px'">
          <a class="navbar-brand" href="inde.php"><img class="responsive" src="../syspic/logo.png" width="150px" height="50px"></a>

        </div>
        <div>
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          <li><label><?php times($user);?></label></li>
            <li><a href="inde.php">INICIO</a></li>
            <!--<li><a href="listVentas.php">VENTAS</a></li>-->

              <li class="dropdown" >
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BUSQUEDA<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a href="search.php">BUSQUEDA</a></li>
                  <li><a href="filtrado.php">FILTRADO</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MENU<span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li><a><b><?php echo $user;?></b></a></li>
                  <li ><a href="config.php">MI PERFIL</a></li>
                  <li role="separator" class="divider"></li>
                  <li style="font-size:10px;">
                    <a href="../logout.php"><img src="../syspic/close.ico" width="30px" height="30px"></a>
                  </li>
                </ul>
              </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
*/
?>
<?php
function bajantesG($user){
  //validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">
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

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $user;?> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!--<li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                        </li>-->
                        <li><a href="config.php"><i class="fa fa-gear fa-fw"></i> Configuracion</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> SALIR</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <br>
            <!-- Sidebar -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <?php echo "V 1.0.0"; ?>
                    <ul class="nav" id="side-menu" style="font-size:19px;">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <?php times($user);?>
                            </div>
                        </li>
        <!--================================================================================================-->
                            <li>
                                <a href="inde.php" class=""><i class="fa fa-home fa-fw"></i> INICIO</a>
                            </li>
                            <!--
                            <li>
                                <a href="../cobranza/inde.php"><i class="fa fa-money"></i>COBRANZA<span class="fa arrow"></span></a>
                            </li>
                            -->
                            <li>
                                <a href="bajantes.php"><i class="fa fa-plug fa-fw"></i> Proyecto Bajantes<span class="fa arrow"></span></a>
                            </li>

                            <li class="divider"></li>
                            <li style="color:red;"><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> SALIR</a>
                            </li>
                            <!--
                            <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Almacen<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                  <li><a href="#"><i class="fa fa-sitemap fa-fw"></i> CREAR</a></li>
                                  <li><a href="#"><i class="fa fa-sitemap fa-fw"></i> BUSCAR</a></li>
                                </ul>
                            </li>
                            -->
                            <!--<li ><a href=""><i class="fa fa-line-chart fa-fw"></i> Agregar Material</a></li>-->
        <!--================================================================================================-->
                    </ul>

                </div>
            </div>
      </nav>
  <?php
}
?>
<?php
function supBajantes($user){
  //validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">

    <nav class='navbar navbar-default navbar-fixed-top nav-pills'>
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inde.php"><img src="../syspic/logo.png" width="150px" height="50px"></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          <li><label><?php times($user);?></label></li>
                    <?php
            if(isset($_SESSION['AltaGerencia'])){
              ?>
              <li><a href="../AltaGerencia/bajantes.php">
              <button type="button" class="btn btn-primary ">
                <span class="glyphicon glyphicon-king" aria-hidden="true"></span>
              </button>
              </a></li>
              <?php
            }
            if(isset($_SESSION['bajantesGerencia'])){
              ?>
              <li><a href="../bajantesG/bajantes.php">
              <button type="button" class="btn btn-primary ">
                <span class="glyphicon glyphicon-king" aria-hidden="true"></span>
              </button>
              </a></li>
              <?php
            }
            ?>
          <li><a href="inde.php">INICIO</a></li>
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BAJANTES<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="filtrado.php">FILTRADO</a></li>
                <li><a href="search.php">BUSCAR</a></li>
                <!--<li><a href="asigna.php">ASIGNAR TECNICO</a></li>-->
              </ul>
          </li>
            <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MENU<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a><b><?php echo $user;?></b></a></li>
                <li ><a href="config.php">MI PERFIL</a></li>
                <li role="separator" class="divider"></li>
                <li style="font-size:10px;">
                  <a href="../logout.php"><img src="../syspic/close.ico" width="30px" height="30px"></a>
                </li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>
<?php
function digital($user){
  //validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">

    <nav class='navbar navbar-default navbar-fixed-top nav-pills'>
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inde.php"><img src="../syspic/logo.png" width="150px" height="50px"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          <li><label><?php times($user);?></label></li>
          <li><a href="inde.php">INICIO</a></li>
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BAJANTES<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="filtrado.php">FILTRADO</a></li>
                <li><a href="buscar.php">BUSCAR</a></li>
                <li><a href="digital_file.php"> ARCHIVO DIGITAL</a></li>
              </ul>
          </li>
            <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MENU<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a><b><?php echo $user;?></b></a></li>
                <li ><a href="config.php">MI PERFIL</a></li>
                <li role="separator" class="divider"></li>
                <li style="font-size:10px;">
                  <a href="../logout.php"><img src="../syspic/close.ico" width="30px" height="30px"></a>
                </li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>
<?php
function cobranza($user){
  validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">

    <nav class='navbar navbar-default navbar-fixed-top nav-pills'>
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inde.php"><img src="../syspic/logo.png" width="150px" height="50px"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          <li><label><?php times($user);?></label></li>
          <?php
          if(isset($_SESSION['AltaGerencia'])){
            ?>
            <li><a href="../AltaGerencia/inde.php">
            <button type="button" class="btn btn-primary ">
              <span class="glyphicon glyphicon-king" aria-hidden="true"></span>
            </button>
            </a></li>
            <?php
          }
          if(isset($_SESSION['bajantesGerencia'])){
            ?>
            <li><a href="../bajantesG/bajantes.php">
            <button type="button" class="btn btn-primary ">
              <span class="glyphicon glyphicon-king" aria-hidden="true"></span>
            </button>
            </a></li>
            <?php
          }
          ?>
          <li><a href="inde.php">INICIO</a></li>
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BUSQUEDA<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="filtrado.php">FILTRADO</a></li>
                <li><a href="buscar.php">BUSCAR</a></li>
                <li><a href="digital_file.php"> ARCHIVO DIGITAL</a></li>
                <li><a href="validar.php"> VALIDAR</a></li>
              </ul>
          </li>
          <!--NOMINA-->
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">NOMINA<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="pagos.php">POR PAGAR</a></li>
                <li><a href="pagados.php">PAGADOS</a></li>
                <!--<li><a href="con_pqo.php">AGREGAR PQO</a></li>-->
              </ul>
          </li>
          <!--PAQO-->
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PAQO<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="os_spaqo.php">ORDENES SIN PAQO</a></li>
                <li><a href="os_cpaqo.php">ORDENES CON PAQO</a></li>
<li><a href="paqocarga.php">CARGA DE PAQO</a></li>
              </ul>
          </li>
          <!--FACTURA-->
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">FACTURA<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="con_factura.php">FACTURAS</a></li>
                <!--<li><a href="#">AGREGAR FACTURA</a></li>-->
              </ul>
          </li>
            <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MENU<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a><b><?php echo $user;?></b></a></li>
                <li ><a href="config.php">MI PERFIL</a></li>
                <li role="separator" class="divider"></li>
                <li style="font-size:10px;">
                  <a href="../logout.php"><img src="../syspic/close.ico" width="30px" height="30px"></a>
                </li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>
<?php
function contabilidad($user){
  validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">
    <nav class='navbar navbar-default navbar-fixed-top nav-pills'>
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inde.php"><img src="../syspic/logo.png" width="150px" height="50px"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
          <li><label><?php times($user);?></label></li>
          <?php
          if(isset($_SESSION['AltaGerencia'])){
            ?>
            <li><a href="../AltaGerencia/inde.php">
            <button type="button" class="btn btn-primary ">
              <span class="glyphicon glyphicon-king" aria-hidden="true"></span>
            </button>
            </a></li>
            <?php
          }
          if(isset($_SESSION['bajantesGerencia'])){
            ?>
            <li><a href="../bajantesG/bajantes.php">
            <button type="button" class="btn btn-primary ">
              <span class="glyphicon glyphicon-king" aria-hidden="true"></span>
            </button>
            </a></li>
            <?php
          }
          ?>
          <li><a href="inde.php">INICIO</a></li>
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BUSQUEDA<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="filtrado.php">FILTRADO</a></li>
                <li><a href="buscar.php">BUSCAR</a></li>
                <li><a href="digital_file.php"> ARCHIVO DIGITAL</a></li>
                <li><a href="validar.php"> VALIDAR</a></li>
              </ul>
          </li>
          <!--NOMINA-->
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">NOMINA FIELDER<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="pagoFielder.php?option=1">POR PAGAR</a></li>
                <li><a href="pagoFielder.php?option=3">PAGADOS</a></li>
                <!--<li><a href="con_pqo.php">AGREGAR PQO</a></li>-->
              </ul>
          </li>
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">NOMINA<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="pagos.php">POR PAGAR</a></li>
                <li><a href="pagados.php">PAGADOS</a></li>
                <!--<li><a href="con_pqo.php">AGREGAR PQO</a></li>-->
              </ul>
          </li>

          <!--PAQO-->
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PAQO<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="os_spaqo.php">ORDENES SIN PAQO</a></li>
                <li><a href="os_cpaqo.php">ORDENES CON PAQO</a></li>

              </ul>
          </li>
          <!--FACTURA-->
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">FACTURA<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="con_factura.php">FACTURAS</a></li>
                <li><a href="buscar_factura.php">BUSCAR FACTURA</a></li>
              </ul>
          </li>
            <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MENU<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a><b><?php echo $user;?></b></a></li>
                <li ><a href="config.php">MI PERFIL</a></li>
                <li role="separator" class="divider"></li>
                <li style="font-size:10px;">
                  <a href="../logout.php"><img src="../syspic/close.ico" width="30px" height="30px"></a>
                </li>
              </ul>
            </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>
<?php
function Grh($user){
  //validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">
      <script type="text/javascript">
           function doC() {
          alert("En construcción...")
        }
        </script>
    <nav class='navbar navbar-default navbar-fixed-top nav-pills'>
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inde.php"><img src="../syspic/logo.png" width="150px" height="50px"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><?php times($user);?></li>
              <li><a href="inde.php">INICIO</a></li>
              <!--
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">VENTAS <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li ><a href="venta.php">VENDER</a></li>
                  <li ><a href="ventas.php">MIS VENTAS</a></li>
                </ul>
              </li>-->
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">RH <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li ><a href="ruserF.php">REGISTRO DE EMPLEADO</a></li>
                  <li ><a href="in.php">BUSCAR EMPLEADO</a></li>
                </ul>
              </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">PROMOTOR <span class="caret"></span></a>
                <ul class="dropdown-menu">
                  <li ><a href="reclutador.php">MIS PROSPECTOS</a></li>
                  <li ><a href="reclutadorS.php">POR RECLUTAS</a></li>
                </ul>
              </li>
              <li ><a href="addRecluta.php">Agregar BP</a></li>
              <!--<li ><a href="addUsuario.php">Agregar A Sistema</a></li>-->
              <li ><a href="config.php">MI PERFIL</a></li>
              <li role="separator" class="divider"></li>
              <li style="font-size:12px;">
                <a href="../logout.php"><!--Cerrar sesión--><img src="../syspic/close.ico" width="30px" height="30px"></a>
              </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>
<?php
function cobCobre($user){
  //validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">
    <nav class='navbar navbar-default navbar-fixed-top nav-pills'>
      <div class="container-fluid" >
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="inde.php"><img src="../syspic/logo.png" width="150px" height="50px"></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav navbar-right">
            <li><?php times($user);?></li>
              <li><a href="inde.php">INICIO</a></li>
              <li ><a href="config.php">MI PERFIL</a></li>
              <li role="separator" class="divider"></li>
              <li style="font-size:12px;">
                <a href="../logout.php"><img src="../syspic/close.ico" width="30px" height="30px"></a>
              </li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <?php
}
?>
<?php
function gventas($user){
  validaSesion();
?>
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
        <!-- Top Navigation: Left Menu -->
        <!--
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
        </ul>
        -->
        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?php echo $user;?> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <!--<li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                    </li>-->
                    <li><a href="config.php"><i class="fa fa-gear fa-fw"></i> Configuracion</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> SALIR</a>
                    </li>
                </ul>
            </li>
        </ul>
        <br>
        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <?php echo "V 1.0.0"; ?>
                <ul class="nav" id="side-menu" style="font-size:19px;">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <?php times($user);?>
                        </div>
                    </li>
    <!--================================================================================================-->
                      <?php
                      if(isset($_SESSION['AltaGerencia'])){
                        ?>
                        <li><a href="../AltaGerencia/fielder.php">
                        <button type="button" class="btn btn-primary ">
                          <span class="glyphicon glyphicon-king" aria-hidden="true"></span>
                        </button>
                        </a></li>
                        <?php
                      }
                      ?>
                        <li>
                            <a href="inde.php" class=""><i class="fa fa-home fa-fw"></i> INICIO</a>
                        </li>
                        <li>
                            <a href="regUser.php" class=""><i class="fa fa-dashboard fa-fw"></i> Personal</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Asignaciones<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="addRecluta.php">AGREGAR BP</a></li>
                                <li><a href="fAsignarS.php">ASIGNACION</a></li>
                                <li><a href="promoverF.php">PROMOVER</a></li>
                                <li><a href="equiposF.php">GENERAR EQUIPOS</a></li>
                                <li><a href="contratista.php">CONTRATISTA</a></li>
                                <!--
                                <li>
                                    <a href="#">Alta de Empleados</a>
                                </li>
                                <li>
                                    <a href="#">Modificaciones <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Buscar Empelado</a>
                                        </li>
                                        <li>
                                            <a href="#">Modificar Empelado</a>
                                        </li>
                                    </ul>
                                </li>-->
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Ventas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              <li><a href="vender.php">Vender</a></li>
                              <li><a href="listVentas.php">Listado de ventas</a></li>
                              <li><a href="bventa.php">Buscar venta</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Nomina<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              <li><a href="buscar_pagos.php">Buscar</a></li>
                              <li><a href="pagar.php">Pagar</a></li>
                              <li><a href="nomina_personal.php">Nomina personal</a></li>
                              <!--<li><a href="listVentas.php">Reoporte</a></li>-->
                            </ul>
                        </li>
                        <li>
                          <a href="#" class=""><i class="fa fa-home fa-fw"></i> MIGRACIONES</a>
                        </li>
    <!--================================================================================================-->
                </ul>

            </div>
        </div>
  </nav>
<?php
}
?>
<?php
function gventasContra($user){
  validaSesion();
?>
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
        <!-- Top Navigation: Left Menu -->
        <!--
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
        </ul>
        -->
        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?php echo $user;?> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <!--<li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                    </li>-->
                    <li><a href="config.php"><i class="fa fa-gear fa-fw"></i> Configuracion</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> SALIR</a>
                    </li>
                </ul>
            </li>
        </ul>
        <br>
        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <?php echo "V 1.0.0"; ?>
                <ul class="nav" id="side-menu" style="font-size:19px;">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <?php times($user);?>
                        </div>
                    </li>
    <!--================================================================================================-->
                      <?php
                      if(isset($_SESSION['AltaGerencia'])){
                        ?>
                        <li><a href="../AltaGerencia/fielder.php">
                        <button type="button" class="btn btn-primary ">
                          <span class="glyphicon glyphicon-king" aria-hidden="true"></span>
                        </button>
                        </a></li>
                        <?php
                      }
                      ?>
                        <li>
                            <a href="inde.php" class=""><i class="fa fa-home fa-fw"></i> INICIO</a>
                        </li>
                        <li>
                            <a href="regUser.php" class=""><i class="fa fa-dashboard fa-fw"></i> Personal</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Asignaciones<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="addRecluta.php">AGREGAR BP</a></li>
                                <li><a href="fAsignarS.php">ASIGNACION</a></li>
                                <li><a href="promoverF.php">PROMOVER</a></li>
                                <li><a href="equiposF.php">GENERAR EQUIPOS</a></li>
                                <!--
                                <li>
                                    <a href="#">Alta de Empleados</a>
                                </li>
                                <li>
                                    <a href="#">Modificaciones <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Buscar Empelado</a>
                                        </li>
                                        <li>
                                            <a href="#">Modificar Empelado</a>
                                        </li>
                                    </ul>
                                </li>-->
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Ventas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              <li><a href="vender.php">Vender</a></li>
                              <li><a href="listVentas.php">Listado de ventas</a></li>
                              <li><a href="bventa.php">Buscar venta</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Nomina<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              <li><a href="buscar_pagos.php">Buscar</a></li>
                              <li><a href="pagar.php">Pagar</a></li>
                              <li><a href="nomina_personal.php">Nomina personal</a></li>
                              <!--<li><a href="listVentas.php">Reoporte</a></li>-->
                            </ul>
                        </li>
                        <li>
                          <a href="#" class=""><i class="fa fa-home fa-fw"></i> MIGRACIONES</a>
                        </li>
    <!--================================================================================================-->
                </ul>

            </div>
        </div>
  </nav>
<?php
}
?>
<?php
function lider($user){
  //validaSesion();
  valida();
?>
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
        <!-- Top Navigation: Left Menu -->
        <!--
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
        </ul>
        -->
        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?php echo $user;?> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <!--<li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                    </li>-->
                    <li><a href="config.php"><i class="fa fa-gear fa-fw"></i> Configuracion</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> SALIR</a>
                    </li>
                </ul>
            </li>
        </ul>
        <br>
        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <?php echo "V 1.0.0"; ?>
                <ul class="nav" id="side-menu" style="font-size:19px;">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <?php times($user);?>
                        </div>
                    </li>
    <!--================================================================================================-->
                        <li>
                            <a href="inde.php" class=""><i class="fa fa-home fa-fw"></i> INICIO</a>
                        </li>
                        <li>
                            <a href="regUser.php" class=""><i class="fa fa-dashboard fa-fw"></i> Personal</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Asignaciones<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="addRecluta.php">AGREGAR BP</a></li>
                                <!--<li><a href="fAsignarS.php">ASIGNACION</a></li>-->
                                <!--<li><a href="promoverF.php">PROMOVER</a></li>-->
                                <!--
                                <li>
                                    <a href="#">Alta de Empleados</a>
                                </li>
                                <li>
                                    <a href="#">Modificaciones <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li>
                                            <a href="#">Buscar Empelado</a>
                                        </li>
                                        <li>
                                            <a href="#">Modificar Empelado</a>
                                        </li>
                                    </ul>
                                </li>-->
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Nomina<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              <li><a href="pagar.php">Pagar</a></li>
                              <li>
                                  <a href="firmar_nomina.php">Firma de MOS PROYECTOS</a>
                              </li>
                              <!--<li><a href="#">Reporte</a></li>-->
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Ventas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              <li><a href="vender.php">Vender</a></li>
                              <li><a href="listVentas.php">Listado de ventas</a></li>
                              <li><a href="moVentas.php">Mover mis ventas</a></li>
                            </ul>
                        </li>
    <!--================================================================================================-->
                </ul>

            </div>
        </div>
  </nav>
<?php
}
?>
<?php
function ventas($user){
  //validaSesion();
  validaSesion();
?>
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
        <!-- Top Navigation: Left Menu -->
        <!--
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
        </ul>
        -->
        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?php echo $user;?> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <!--<li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                    </li>-->
                    <li><a href="config.php"><i class="fa fa-gear fa-fw"></i> Configuracion</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> SALIR</a>
                    </li>
                </ul>
            </li>
        </ul>
        <br>
        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <?php echo "V 1.0.0"; ?>
                <ul class="nav" id="side-menu" style="font-size:19px;">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <?php times($user);?>
                        </div>
                    </li>
    <!--================================================================================================-->
                        <li>
                            <a href="inde.php" class=""><i class="fa fa-home fa-fw"></i> INICIO</a>
                        </li>
                        <li>
                            <a href="ventas.php" class=""><i class="fa fa-money fa-fw"></i> Mis ventas</a>
                        </li>
                        <li>
                            <a href="pagos.php" class=""><i class="fa fa-money fa-fw"></i> Mis Pagos</a>
                        </li>
                        <!--
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Ventas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              <li><a href="vender.php">Vender</a></li>
                              <li><a href="listVentas.php">Listado de ventas</a></li>
                            </ul>
                        </li>
                        -->
    <!--================================================================================================-->
                </ul>

            </div>
        </div>
  </nav>
<?php
}
?>
<?php
function nivel4($user){
  //validaSesion();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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
        <!-- Top Navigation: Left Menu -->
        <!--
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
        </ul>
        -->
        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?php echo $user;?> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <!--<li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                    </li>-->
                    <li><a href="config.php"><i class="fa fa-gear fa-fw"></i> Configuracion</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> SALIR</a>
                    </li>
                </ul>
            </li>
        </ul>
        <br>
        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <?php echo "V 1.0.0"; ?>
                <ul class="nav" id="side-menu" style="font-size:19px;">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <?php times($user);?>
                        </div>
                    </li>
    <!--================================================================================================-->
                        <?php
                        if(isset($_SESSION['AltaGerencia'])){
                          ?>
                          <li><a href="../AltaGerencia/fielder.php">
                          <button type="button" class="btn btn-primary ">
                            <span class="glyphicon glyphicon-king" aria-hidden="true"></span>
                          </button>
                          </a></li>
                          <?php
                        }
                        ?>

                        <li>
                            <a href="inde.php" class=""><i class="fa fa-home fa-fw"></i> INICIO</a>
                        </li>
                        <!--
                        <li><a href="vender.php"><i class="fa fa-money fa-fw"></i> Vender</a></li>
                        -->
                        <li>
                          <a href="buscarVenta.php"><i class="fa fa-eye fa-fw"></i> Buscar Venta</a>
                        </li>
                        <li>
                          <a href="buscarVentaporarea.php"><i class="fa fa-eye fa-fw"></i> Buscar Venta por Area</a>
                        </li>
                        <!--
                        <li>
                            <a href="listadoVentas.php" class=""><i class="fa fa-line-chart fa-fw"></i> Listado</a>
                        </li>
                        -->
                        <li id="feedback-bg-info">
                            <a href="inde.php/?notify=1"></a>
                        </li>

                          <script>

                          $(document).ready(function() {
                                var refreshId =  setInterval( function(){
                                $('#feedback-bg-info').load('nitification.php');//actualizas el div
                              }, 10000 );
                          });

                          </script>
                        <!--
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Ventas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              <li><a href="vender.php">Vender</a></li>
                              <li><a href="listVentas.php">Listado de ventas</a></li>
                            </ul>
                        </li>
                        -->
    <!--================================================================================================-->
                </ul>

            </div>
        </div>
  </nav>
<?php
}
?>
<?php
function ventasS($user){
  //validaSesion();
?>
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
        <!-- Top Navigation: Left Menu -->
        <!--
        <ul class="nav navbar-nav navbar-left navbar-top-links">
            <li><a href="#"><i class="fa fa-home fa-fw"></i> Website</a></li>
        </ul>
        -->
        <!-- Top Navigation: Right Menu -->
        <ul class="nav navbar-right navbar-top-links">

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?php echo $user;?> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <!--<li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                    </li>-->
                    <li><a href="config.php"><i class="fa fa-gear fa-fw"></i> Configuracion</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> SALIR</a>
                    </li>
                </ul>
            </li>
        </ul>
        <br>
        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <?php echo "V 1.0.0"; ?>
                <ul class="nav" id="side-menu" style="font-size:19px;">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <?php times($user);?>
                        </div>
                    </li>
    <!--================================================================================================-->
                        <li>
                            <a href="inde.php" class=""><i class="fa fa-home fa-fw"></i> INICIO</a>
                        </li>
                        <li ><a href="ventas.php"><i class="fa fa-money fa-fw"></i> Mis ventas</a></li>
                        <li ><a href="productividad.php"><i class="fa fa-line-chart fa-fw"></i> Mi Equipo</a></li>

                        <!--<li><a href="buscarVenta.php">BUSCAR VENTA</a></li>-->
                        <!--<li>
                          <a href="buscarVenta.php"><i class="fa fa-eye fa-fw"></i> Buscar Venta</a>
                        </li>
                        <li>
                            <a href="listadoVentas.php" class=""><i class="fa fa-line-chart fa-fw"></i> Listado</a>
                        </li>-->
                        <!--
                        <li>
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Ventas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              <li><a href="vender.php">Vender</a></li>
                              <li><a href="listVentas.php">Listado de ventas</a></li>
                            </ul>
                        </li>
                        -->
    <!--================================================================================================-->
                </ul>

            </div>
        </div>
  </nav>
<?php
}
?>
<?php
function almacen($user){
  //validaSesion();
?>
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

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <?php echo $user;?> <b class="caret"></b>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <!--<li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                    </li>-->
                    <li><a href="config.php"><i class="fa fa-gear fa-fw"></i> Configuracion</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> SALIR</a>
                    </li>
                </ul>
            </li>
        </ul>
        <br>
        <!-- Sidebar -->
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <?php echo "V 1.0.0"; ?>
                <ul class="nav" id="side-menu" style="font-size:19px;">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <?php times($user);?>
                        </div>
                    </li>
    <!--================================================================================================-->
                      <?php
                        if(isset($_SESSION['AltaGerencia'])){
                          ?>
                          <li><a href="../AltaGerencia/inde.php">
                          <button type="button" class="btn btn-primary ">
                            <span class="glyphicon glyphicon-king" aria-hidden="true"></span>
                          </button>
                          </a></li>
                          <?php
                        }
                        ?>
                        <li>
                            <a href="inde.php" class=""><i class="fa fa-home fa-fw"></i> INICIO</a>
                        </li>
                        <li>
                            <a href="super.php" class=""><i class="fa fa-home fa-fw"></i> x SUPERVISOR</a>
                        </li>
                        <!--<li ><a href=""><i class="fa fa-line-chart fa-fw"></i> Agregar Material</a></li>-->
    <!--================================================================================================-->
                </ul>

            </div>
        </div>
  </nav>
<?php
}
?>
<?php
function ag($user){
  //validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">
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

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $user;?> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!--<li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                        </li>-->
                        <li><a href="config.php"><i class="fa fa-gear fa-fw"></i> Configuracion</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> SALIR</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <br>
            <!-- Sidebar -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <?php echo "V 1.0.0"; ?>
                    <ul class="nav" id="side-menu" style="font-size:19px;">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <?php times($user);?>
                            </div>
                        </li>
        <!--================================================================================================-->
                            <li>
                                <a href="inde.php" class=""><i class="fa fa-home fa-fw"></i> INICIO</a>
                            </li>
                            <li>
                                <a href="../cobranza/inde.php"><i class="fa fa-money"></i>COBRANZA<span class="fa arrow"></span></a>
                            </li>
                            <li>
                                <a href="../contabilidad/inde.php"><i class="fa fa-money"></i>CONTABILIDAD<span class="fa arrow"></span></a>
                            </li>
                            <li>
                                <a href="../rh/inde.php"><i class="fa fa-user-circle-o fa-fw"></i>Recursos Humanos<span class="fa arrow"></span></a>
                            </li>
                            <li>
                                <a href="bajantes.php"><i class="fa fa-plug fa-fw"></i> Proyecto Bajantes<span class="fa arrow"></span></a>
                            </li>

                            <li>
                                <a href="fielder.php"><i class="fa fa-plug fa-fw"></i> Proyecto Fielder<span class="fa arrow"></span></a>
                            </li>
                            <li>
                                <a href="../almacen/inde.php"><i class="fa fa-plug fa-fw"></i> Almacen<span class="fa arrow"></span></a>
                            </li>
                            <li class="divider"></li>
                            <li style="color:red;"><a href="../logout.php"><i class="fa fa-sign-out fa-fw"></i> SALIR</a>
                            </li>
                            <!--
                            <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Almacen<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                  <li><a href="#"><i class="fa fa-sitemap fa-fw"></i> CREAR</a></li>
                                  <li><a href="#"><i class="fa fa-sitemap fa-fw"></i> BUSCAR</a></li>
                                </ul>
                            </li>
                            -->
                            <!--<li ><a href=""><i class="fa fa-line-chart fa-fw"></i> Agregar Material</a></li>-->
        <!--================================================================================================-->
                    </ul>

                </div>
            </div>
      </nav>
  <?php
}
?>
<?php
function telmex($user){
  validaSesion();
  ?>
    <META name="Author" content="Miguel Angel Castro Escamilla">
    <META name="date" content="2017-05">
    <link rel="shortcut icon" href="../syspic/favicon.png">
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

                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $user;?> <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <!--<li><a href="#"><i class="fa fa-user fa-fw"></i> Perfil</a>
                        </li>-->
                        <li><a href="config.php"><i class="fa fa-gear fa-fw"></i> Configuracion</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <br>
            <!-- Sidebar -->
            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <?php echo "V 1.0.0"; ?>
                    <ul class="nav" id="side-menu" style="font-size:19px;">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <?php times($user);?>
                            </div>
                        </li>
        <!--================================================================================================-->
                            <li>
                                <a href="inde.php" class=""><i class="fa fa-home fa-fw"></i> INICIO</a>
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-user-circle-o fa-fw"></i>Recursos Humanos<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                  <li><a href="createUserF.php"><i class="fa fa-user-plus fa-fw"></i> Crear</a></li>
                                  <li><a href="searchUserF.php"><i class="fa fa-user-o fa-fw"></i> Buscar</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-plug fa-fw"></i> Proyecto Bajantes<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                  <li><a href="bolsaBajanteF.php"><i class="fa fa-sitemap fa-fw"></i> Bolsa por Supervisor</a></li>
                                  <li><a href="buscarBajanteF.php"><i class="fa fa-sitemap fa-fw"></i> Buscar Orden</a></li>
                                </ul>
                            </li>

                            <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Proyecto Fielder<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">

                                  <li><a href="buscarFielderF.php"><i class="fa fa-sitemap fa-fw"></i> BUSCAR</a></li>
                                </ul>
                            </li>
                            <!--
                            <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Almacen<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                  <li><a href="#"><i class="fa fa-sitemap fa-fw"></i> CREAR</a></li>
                                  <li><a href="#"><i class="fa fa-sitemap fa-fw"></i> BUSCAR</a></li>
                                </ul>
                            </li>
                            -->
                            <!--<li ><a href=""><i class="fa fa-line-chart fa-fw"></i> Agregar Material</a></li>-->
        <!--================================================================================================-->
                    </ul>

                </div>
            </div>
      </nav>
  <?php
}
?>
