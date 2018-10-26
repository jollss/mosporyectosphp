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
              <div id="reloj" style="width: 120px; height: 10px; padding: 2px 5px; border: 0px solid black; 
                     font: bold 1em dotum, 'lucida sans', arial; text-align: center;
                     float: right; margin: 1em 1em 1em 1em;">
    <?php
    echo $hh." : ".$min." : 00";
}
?>
<?php
function nivel1($user){
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
          <li><?php times();?></li>
              <li><a><b><?php echo $user;?></b></a></li>
              <li><a href="dataosuall.php">MIS OS </a></li>
              <!--
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">MIS OS <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="dataosuall.php">MIS OS </a></li>
                <li><a href="dataOsIn.php">MIS OS INTERNAS</a></li>
              </ul>
            </li>-->
              <li><a href="inde.php">INICIO</a></li>
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
          <li><label><?php times();?></label></li>       
                <li><a href="inde.php"><b><?php echo $user;?></b></a></li>
                <li><a href="ruserF.php">REGISTRO DE USUARIOS</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">USUARIOS <span class="caret"></span></a>
              <ul class="dropdown-menu">
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
          <li><label><?php times();?></label></li>
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
          <label><?php times();?></label>          
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
          <label><?php times();?></label>
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
          <label><?php times();?></label>
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
          <li><label><?php times();?></label></li>       
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
          <li><label><?php times();?></label></li>
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
            <li><?php times();?></li>              
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
            <li><?php times();?></li>              
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
            <li><?php times();?></li>              
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
          <li><label><?php times();?></label></li>
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
function bajantesG($user){
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
          <li><label><?php times();?></label></li>
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
?>
<?php
function supBajantes($user){
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
          <li><label><?php times();?></label></li>
          <li><a href="inde.php">INICIO</a></li>
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BAJANTES<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <!--<li><a href="filtrado.php">FILTRADO</a></li>-->
                <li><a href="buscar.php">BUSCAR</a></li>
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
          <li><label><?php times();?></label></li>
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
          <li><label><?php times();?></label></li>
          <li><a href="inde.php">INICIO</a></li>
          <li class="dropdown" >
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">BAJANTES<span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="filtrado.php">FILTRADO</a></li>
                <li><a href="buscar.php">BUSCAR</a></li>
                <li><a href="digital_file.php"> ARCHIVO DIGITAL</a></li>
                <li><a href="validar.php"> VALIDAR</a></li>
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
            <li><?php times();?></li>              
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
            <li><?php times();?></li>              
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
                            <?php times();?>
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
                            <?php times();?>
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
                            <a href="#"><i class="fa fa-sitemap fa-fw"></i> Ventas<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                              <li><a href="vender.php">Vender</a></li>
                              <li><a href="listVentas.php">Listado de ventas</a></li>
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
                            <?php times();?>
                        </div>
                    </li>
    <!--================================================================================================-->
                        <li>
                            <a href="inde.php" class=""><i class="fa fa-home fa-fw"></i> INICIO</a>
                        </li>
                        <li>
                            <a href="ventas.php" class=""><i class="fa fa-money fa-fw"></i> Mis ventas</a>
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
                            <?php times();?>
                        </div>
                    </li>
    <!--================================================================================================-->
                        <li>
                            <a href="inde.php" class=""><i class="fa fa-home fa-fw"></i> INICIO</a>
                        </li>
                        <!--<li><a href="buscarVenta.php">BUSCAR VENTA</a></li>-->
                        <li><a href="vender.php"><i class="fa fa-money fa-fw"></i> Vender</a></li>
                        <li>
                          <a href="buscarVenta.php"><i class="fa fa-eye fa-fw"></i> Buscar Venta</a>
                        </li>
                        <li>
                            <a href="listadoVentas.php" class=""><i class="fa fa-line-chart fa-fw"></i> Listado</a>
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
function ventasS($user){
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
                            <?php times();?>
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
                            <?php times();?>
                        </div>
                    </li>
    <!--================================================================================================-->
                        <li>
                            <a href="inde.php" class=""><i class="fa fa-home fa-fw"></i> INICIO</a>
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
                                <?php times();?>
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
                                  <!--<li><a href="#"><i class="fa fa-sitemap fa-fw"></i> CREAR</a></li>-->
                                  <li><a href="buscarFielderF.php"><i class="fa fa-sitemap fa-fw"></i> BUSCAR</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Almacen<span class="fa arrow"></span></a>
                                <ul class="nav nav-second-level">
                                  <!--<li><a href="#"><i class="fa fa-sitemap fa-fw"></i> CREAR</a></li>-->
                                  <li><a href="buscarTecnicoAlmacen.php"><i class="fa fa-sitemap fa-fw"></i> BUSCAR</a></li>
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
<?php
function telmex($user){
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
                                <?php times();?>
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