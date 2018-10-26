<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<head>
<title>MosProyectos</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='viewport' content='width=device-width, initial-scale=1, maximum-scale=1'>
<link href='css/style.css' rel='stylesheet' type='text/css' media='all'/>
<link href='css/nav.css' rel='stylesheet' type='text/css' media='all'/>
<link href='http://fonts.googleapis.com/css?family=Carrois+Gothic+SC' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.1/css/all.css" integrity="sha384-5sAR7xN1Nv6T6+dT2mhtzEpVJvfS3NScPQTrOxhwjIuvcA67KV2R5Jz6kr4abQsz" crossorigin="anonymous">


<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/login.js'></script>
<script type='text/javascript' src='js/Chart.js'></script>
 <script type='text/javascript' src='js/jquery.easing.js'></script>
 <script type='text/javascript' src='js/jquery.ulslide.js'></script>
 <!----Calender -------->
  <link rel='stylesheet' href='css/clndr.css' type='text/css' />
  <script src='js/underscore-min.js'></script>
  <script src= 'js/moment-2.2.1.js'></script>
  <script src='js/clndr.js'></script>
  <script src='js/site.js'></script>
  <script src="code/highcharts.js"></script>
  <script src="code/modules/exporting.js"></script>
  <script src="code/modules/export-data.js"></script>
  <!----End Calender -------->
</head>
<body>
  <?php
//error_reporting(0);




  $idu = $_GET['idu'];
  $asignado= $_GET['asignado'];
  $pertenece_a = $_GET['pertenece_a'];
  $coordinador = $_GET['coordinador'];
  $id_zona = $_GET['id_zona'];




  /*------------------------------------------------------------------ empieza promotor------------------------------------------------------------------------------------------------------------------------------------------------------------------*/


      require ('../conexion.php');
      /*------------------------------------------------------------------ Consulta Nombre lider------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

      $query = "SELECT nombre,tipo FROM usuario AS u
    INNER JOIN tipo AS t
    ON t.idtipo=u.tipo_idtipo

    WHERE idu='$idu'";
      $resultado=$mysqli->query($query);

      while($row = $resultado->fetch_assoc()) {
          $nombrelider=$row['nombre'];
            $tipolider=$row['tipo'];

      /*------------------------------------------------------------------ Consulta Nombre------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

      $consultadeventasupervisor= mysqli_query($mysqli,"SELECT COUNT(*) AS totalventasupervisor FROM venta AS v
      INNER JOIN usuario AS u
      ON u.idu=v.idvendedor

      WHERE  u.coordinador='$coordinador' AND u.pertenece_a='$pertenece_a' and u.asignado='$asignado' and idu='$idu'");
      $rowconsupervisor = mysqli_fetch_assoc($consultadeventasupervisor);
      $totalventasupervisor = $rowconsupervisor['totalventasupervisor'];
        /*------------------------------------------------------------------ Consulta total de ventas como supervisor------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
        /*------------------------------------------------------------------ Consulta total ESTATUS de ventas POR supervisor------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
        $consultadeventalidersinvalidar= mysqli_query($mysqli,"SELECT COUNT(*) AS totalventalidersinvalider FROM usuario AS u
      INNER JOIN venta AS v
      ON v.idvendedor=u.idu
      WHERE v.etapa='' AND u.coordinador='$coordinador' AND u.pertenece_a='$pertenece_a' and u.asignado='$asignado' and idu='$idu' ");
        $rowconliderSN = mysqli_fetch_assoc($consultadeventalidersinvalidar);
        $totalventaliderSN = $rowconliderSN['totalventalidersinvalider'];
        /////////////////////////////////////////////////////////////////////totalventalidersinvasupervisorr//////////////////////////////////////////////////////////////////////////7
        $consultadeventacoordinadorABIERTA= mysqli_query($mysqli,"SELECT COUNT(*) AS totalventacoordinadorABIERTA FROM usuario AS u
      INNER JOIN venta AS v
      ON v.idvendedor=u.idu
      WHERE v.etapa='ABIERTA' AND u.coordinador='$coordinador' AND u.pertenece_a='$pertenece_a' and u.asignado='$asignado' and idu='$idu'");
        $rowconCooABIERTA = mysqli_fetch_assoc($consultadeventacoordinadorABIERTA);
        $totalventacoordinadorABIERTA = $rowconCooABIERTA['totalventacoordinadorABIERTA'];
        //////////////
        $consultadeventacoordinadorDEMANDAINFRAESTRUCTURA= mysqli_query($mysqli,"SELECT COUNT(*) AS totalventacoordinadorDEMANDAINFRAESTRUCTURA FROM usuario AS u
      INNER JOIN venta AS v
      ON v.idvendedor=u.idu
      WHERE v.etapa='DEMANDA/INFRAESTRUCTURA' AND u.coordinador='$coordinador' AND u.pertenece_a='$pertenece_a' and u.asignado='$asignado' and idu='$idu'");
        $rowconCooDEMANDAINFRAESTRUCTURA = mysqli_fetch_assoc($consultadeventacoordinadorDEMANDAINFRAESTRUCTURA);
        $totalventacoordinadorDEMANDAINFRAESTRUCTURA = $rowconCooDEMANDAINFRAESTRUCTURA['totalventacoordinadorDEMANDAINFRAESTRUCTURA'];
        ////////////
        $consultadeventacoordinadorSOLICITUDDUPLICADAA= mysqli_query($mysqli,"SELECT COUNT(*) AS totalventacoordinadorSOLICITUDDUPLICADA FROM usuario AS u
      INNER JOIN venta AS v
      ON v.idvendedor=u.idu
      WHERE v.etapa='SOLICITUD DUPLICADA' AND u.coordinador='$coordinador' AND u.pertenece_a='$pertenece_a' and u.asignado='$asignado' and idu='$idu'");
        $rowconCooSOLICITUDDUPLICADA = mysqli_fetch_assoc($consultadeventacoordinadorSOLICITUDDUPLICADAA);
        $totalventacoordinadorSOLICITUDDUPLICADAA = $rowconCooSOLICITUDDUPLICADA['totalventacoordinadorSOLICITUDDUPLICADA'];
        /////////////////////
        $consultadeventacoordinadorCANCELADA= mysqli_query($mysqli,"SELECT COUNT(*) AS totalventacoordinadorCANCELADA FROM usuario AS u
      INNER JOIN venta AS v
      ON v.idvendedor=u.idu
      WHERE v.etapa='CANCELADO'  AND u.coordinador='$coordinador' AND u.pertenece_a='$pertenece_a' and u.asignado='$asignado' and idu='$idu'");
        $rowconCooCANCELADA = mysqli_fetch_assoc($consultadeventacoordinadorCANCELADA);
        $totalventacoordinadorCANCELADA = $rowconCooCANCELADA['totalventacoordinadorCANCELADA'];
        /////////////////
        $consultadeventacoordinadorCOMERCIAL= mysqli_query($mysqli,"SELECT COUNT(*) AS totalventacoordinadorCOMERCIAL FROM usuario AS u
      INNER JOIN venta AS v
      ON v.idvendedor=u.idu
      WHERE v.etapa='COMERCIAL'  AND u.coordinador='$coordinador' AND u.pertenece_a='$pertenece_a' and u.asignado='$asignado' and idu='$idu'");
        $rowconCooCOMERCIAL = mysqli_fetch_assoc($consultadeventacoordinadorCOMERCIAL);
        $totalventacoordinadorCOMERCIAL = $rowconCooCOMERCIAL['totalventacoordinadorCOMERCIAL'];
      ///////////////////////////////////////////////
      $consultadeventacoordinadorP= mysqli_query($mysqli,"SELECT COUNT(*) AS totalventacoordinadorP FROM usuario AS u
      INNER JOIN venta AS v
      ON v.idvendedor=u.idu
      WHERE v.etapa='P'  AND u.coordinador='$coordinador' AND u.pertenece_a='$pertenece_a' and u.asignado='$asignado' and idu='$idu'");
      $rowconCooP = mysqli_fetch_assoc($consultadeventacoordinadorP);
      $totalventacoordinadorP = $rowconCooP['totalventacoordinadorP'];
      /////////////////////////////////
      $consultadeventacoordinadorADEUDO= mysqli_query($mysqli,"SELECT COUNT(*) AS totalventacoordinadorADEUDO FROM usuario AS u
      INNER JOIN venta AS v
      ON v.idvendedor=u.idu
      WHERE v.etapa='ADEUDO'  AND u.coordinador='$coordinador' AND u.pertenece_a='$pertenece_a' and u.asignado='$asignado' and idu='$idu'");
      $rowconCooADEUDO = mysqli_fetch_assoc($consultadeventacoordinadorADEUDO);
      $totalventacoordinadorADEUDO = $rowconCooADEUDO['totalventacoordinadorADEUDO'];
      /////////////////////////////////////
      $consultadeventacoordinadorNINGUNO= mysqli_query($mysqli,"SELECT COUNT(*) AS totalventacoordinadorNINGUNO FROM usuario AS u
      INNER JOIN venta AS v
      ON v.idvendedor=u.idu
      WHERE v.etapa='0'  AND u.coordinador='$coordinador' AND u.pertenece_a='$pertenece_a' and u.asignado='$asignado' and idu='$idu'");
      $rowconCooNINGUNO = mysqli_fetch_assoc($consultadeventacoordinadorNINGUNO);
      $totalventacoordinadorNINGUNO = $rowconCooNINGUNO['totalventacoordinadorNINGUNO'];
      ////////////////////////////////
      $consultadeventacoordinadorNINGUNO= mysqli_query($mysqli,"SELECT COUNT(*) AS totalventacoordinadorNOENCONTRADO FROM usuario AS u
      INNER JOIN venta AS v
      ON v.idvendedor=u.idu
      WHERE v.etapa='3'  AND u.coordinador='$coordinador' AND u.pertenece_a='$pertenece_a' and u.asignado='$asignado' and idu='$idu'");
      $rowconCooNOENCONTRADO = mysqli_fetch_assoc($consultadeventacoordinadorNINGUNO);
      $totalventacoordinadorNOENCONTRADO = $rowconCooNOENCONTRADO['totalventacoordinadorNOENCONTRADO'];
      ////////////////////////////////////
      $consultadeventacoordinadorSINESTRATEGIA= mysqli_query($mysqli,"SELECT COUNT(*) AS totalventacoordinadorSINESTRATEGIA FROM usuario AS u
      INNER JOIN venta AS v
      ON v.idvendedor=u.idu
      WHERE v.etapa='4'  AND u.coordinador='$coordinador' AND u.pertenece_a='$pertenece_a' and u.asignado='$asignado' and idu='$idu'");
      $rowconCooSINESTRATEGIA = mysqli_fetch_assoc($consultadeventacoordinadorSINESTRATEGIA);
      $totalventacoordinadorSINESTRATEGIA = $rowconCooSINESTRATEGIA['totalventacoordinadorSINESTRATEGIA'];
      /*------------------------------------------------------------------ Consulta total de ventas POR ESTATUS------------------------------------------------------------------------------------------------------------------------------------------------------------------*/
      /*------------------------------------------------------------------ Consulta total de uSUARIOS A SU CARGO------------------------------------------------------------------------------------------------------------------------------------------------------------------*/


      $consultadeventacoordinadorsupervisor= mysqli_query($mysqli,"SELECT COUNT(*) AS supervisor FROM usuario AS u
      INNER JOIN tipo AS t
      ON t.idtipo=u.tipo_idtipo
      WHERE  t.tipo='SUP. VENTAS' AND u.pertenece_a='$pertenece_a' and u.asignado='$asignado' and idu='$idu'");
      $rowconCoosupervisor = mysqli_fetch_assoc($consultadeventacoordinadorsupervisor);
      $totalventacoordinadorsupervisor = $rowconCoosupervisor['supervisor'];

      $consultadeventacoordinadorPROMOTOR= mysqli_query($mysqli,"SELECT COUNT(*) AS PROMOTOR FROM usuario AS u
      INNER JOIN tipo AS t
      ON t.idtipo=u.tipo_idtipo
      WHERE  t.tipo='PROMOTOR' AND  u.coordinador='$coordinador' AND u.pertenece_a='$pertenece_a' and u.asignado='$asignado' and idu='$idu'");
      $rowconCooPROMOTOR = mysqli_fetch_assoc($consultadeventacoordinadorPROMOTOR);
      $totalventacoordinadorPROMOTOR = $rowconCooPROMOTOR['PROMOTOR'];
      /*------------------------------------------------------------------ Consulta total de uSUARIOS A SU CARGO------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

        echo "
        <div class='wrap'>
          <div class='header'>
              <div class='header_top'>
              <div class='menu'>
                <a class='toggleMenu' href='#'><img src='images/nav.png' alt='' /></a>
                <ul class='nav'>

                  <li class='active'><a href='#'><i class='fas fa-globe-americas fa-2x'></i><i>    $nombrelider</a></li>

                <div class='clear'></div>
                  </ul>
                <script type='text/javascript' src='js/responsive-nav.js'></script>
                  </div>
              <div class='profile_details'>
                     <div id='loginContainer'>
                            <a id='loginButton' class=''><span>$nombrelider</span></a>
                              <div id='loginBox'>
                                <form id='loginForm'>
                                  <fieldset id='body'>
                                      <div class='user-info'>
                              <h4>Hola,<a href='#'> $nombrelider</a></h4>
                              <ul>

                                <li class='logout'><a href='inde.php'> Regresar</a></li>
                                <div class='clear'></div>
                              </ul>
                            </div>
                                  </fieldset>
                              </form>
                          </div>
                      </div>
                       <div class='profile_img'>
                        <a href='#'><img src='images/profile_img40x40.jpg' alt='' />	</a>
                       </div>
                       <div class='clear'></div>
                </div>
                <div class='clear'></div>
             </div>
        </div>
        </div>
        <div class='main'>
         <div class='wrap'>
            <div class='column_left'>
              <div class='menu_box'>
              <h3>$nombrelider<br>Te Presentamos los 10 estatus </h3>
                <div class='menu_box_list'>
                   <ul>

        <li ><a href='#'><i class='fas fa-envelope-open fa-2x'></i><span>Abierta</span><label class='digits active'>$totalventacoordinadorABIERTA</label><div class='clear'></div></a></li>
        <li><a href='#' ><i class='fas fa-times-circle fa-2x'></i><span>DEMANDA/INFRA </span><label class=''>$totalventacoordinadorDEMANDAINFRAESTRUCTURA</label><div class='clear'></div></a></li>
        <li><a href='#'><i class='fas fa-copy fa-2x'></i><span>Duplicada</span><label class='digits'>$totalventacoordinadorSOLICITUDDUPLICADAA</label><div class='clear'></div></a></li>
        <li><a href='#'><i class='fas fa-ban fa-2x'></i><span>Cancelada</span><label class='digits'>$totalventacoordinadorCANCELADA</label><div class='clear'></div></a></li>
        <li><a href='#'><i class='fas fa-hands-helping fa-2x'></i><span>Comercial</span><label class='digits'>$totalventacoordinadorCOMERCIAL</label><div class='clear'></div></a></li>
        <li><a href='#'><i class='fas fa-thumbs-up fa-2x'></i><span>Posteada</span><label class='digits active'>$totalventacoordinadorP</label><div class='clear'></div></a></li>
        <li><a href='#'><i class='far fa-credit-card fa-2x'></i><span>Adeudo</span><label class='digits'>$totalventacoordinadorADEUDO</label><div class='clear'></div></a></li>
        <li><a href='#' ><i class='fas fa-exclamation fa-2x'></i><span>Ninguno</span><label class='digits'>$totalventacoordinadorNINGUNO</label><div class='clear'></div></a></li>
        <li><a href='#'><i class='fas fa-times fa-2x'></i><span>NO ENCONTRADO</span><label class='digits'>$totalventacoordinadorNOENCONTRADO</label><div class='clear'></div></a></li>
        <li><a href='#' ><i class='fas fa-chess-queen fa-2x'></i><span>SIN ESTRATEGIA</span><label class='digits'>$totalventacoordinadorSINESTRATEGIA</label><div class='clear'></div></a></li>
                 </ul>
               </div>


              </div>
        </div>



        ";
        echo"<div class='column_middle'>
        <div class='column_middle_grid1'>
        <div class='profile_picture'>
        <a href=''><img src='images/profile_img150x150.jpg' alt='' />	</a>
        <div class='profile_picture_name'>
          <h2>$nombrelider</h2>
          <p>Bienvenido, El TOTAL DE TUS VENTAS ES DE $totalventasupervisor ventas (TOMA EN CUENTA QUE SON VENTAS TUYAS Y DE TU EQUIPO DE TRABAJO ES DECIR SUPERVISORES Y PROMOTORES)</p>
        </div>
         <span><a href='#'> <img src='images/follow_user.png' alt='' /> </a></span>
        </div>
        <div class='articles_list'>
          <ul>
            <li><a href='#' class='red'>Reporte de Todas las Ventas de </a></li>
            <li><a href='#' class='purple'>Ventas Sin Validar Aun <br>$totalventaliderSN<br>Consultalas aqui</a></li>
            <li><a href='#' class='yellow'>Realizar Consulta de </a></li>
            <div class='clear'></div>
          </ul>
        </div>
        </div>




        </div>";
        echo"
        <div class='column_right'>

         <div class='newsletter'>
           <div class='menu_box'>
             <h3>$nombrelider total de Personal Activo</h3>
               <div class='menu_box_list'>
                  <ul>



        <li><a href='#'><i class='fas fa-users fa-2x'></i><span>$nombrelider</span><div class='clear'></div></a></li>

                </ul>
              </div>

           </div>
        </div>
        </div>


        ";
        ?>

        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>



            <script type="text/javascript">

        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Filders'
            },
            subtitle: {
                text: 'www.mosproyectos.com.mx'
            },
            xAxis: {
                categories: [
                    'ENERO',
                    'FEBRERO',
                    'MARZO',
                    'ABRIL',
                    'MAYO',
                    'JUNIO',
                    'JULIO',
                    'AGOSTO',
                    'SEPTIEMBRE',
                    'OCTUBRE',
                    'NOVIEMBRE',
                    'DICIEMBRE'
                ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Rainfall (mm)'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.1f} mm</b></td></tr>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
        <?php
            $meses = array("","ENERO","FEBRERO","MARZO","ABRIL","MAYO","JUNIO","JULIO","AGOST0","SEPTIEMBRE","OCTUBRE","NOVIEMBRE","DICIEMBRE");
            $estatus = array("ABIERTA","p","CANCELADA","COMERCIAL","ADEUDO","SOLICITUD DUPLICADA","DEMANDA/INFRAESTRUCTURA","0","3","4");
            $longitud = count($estatus);
            $longitudw = count($meses);

            for ($j = 1; $j <$longitudw; $j++) {
            //saco el numero de elementos
            //Recorro todos los elementos

            for($i=0; $i<$longitud; $i++)
                  {
                  $sestatus=$estatus[$i];
                  //saco el valor de cada elemento
                  $estatusmeses = mysqli_query($mysqli,"SELECT COUNT(*) AS ptotal FROM venta AS v
      INNER JOIN usuario AS u
      ON u.idu=v.idvendedor where etapa='$sestatus' AND mes='$j' and u.coordinador='$coordinador' AND u.pertenece_a='$pertenece_a' and u.asignado='$asignado' and idu='$idu'");
                  $prow = mysqli_fetch_assoc($estatusmeses);
        $me=$meses[$j];


        $ptotal[]=$prow['ptotal'];




        }


        }


        $Ajan = $ptotal[0];//ENERO ESTATUS ABIERTA//////////////
        $Afeb = $ptotal[1];//ENERO ESTATUS p//////////////
        $Amar = $ptotal[2];//ENERO ESTATUS CANCELADA//////////////
        $Aapr = $ptotal[3];//ENERO ESTATUS COMERCIAL//////////////
        $Amay = $ptotal[4];//ENERO ESTATUS ADEUDO//////////////
        $Ajun = $ptotal[5];//ENERO ESTATUS SOLICITUD DUPLICADA//////////////
        $Ajul = $ptotal[6];//ENERO ESTATUS DEMANDA/INFRAESTRUCTURA//////////////
        $Aaug = $ptotal[7];//ENERO ESTATUS 0//////////////
        $Asep = $ptotal[8];//ENERO ESTATUS 3//////////////
        $Aoct = $ptotal[9];//ENERO ESTATUS 4//////////////
        $Anov = $ptotal[10];////////////FEBRERO ESTATUSABIERTA////////////
        $Adec = $ptotal[11];////////////FEBRERO p////////////
        $pjan = $ptotal[12];////////////FEBRERO CANCELADA////////////
        $pfeb = $ptotal[13];////////////FEBRERO COMERCIAL////////////
        $pmar = $ptotal[14];////////////FEBRERO ADEUDO////////////
        $papr = $ptotal[15];////////////FEBRERO SOLICITUD DUPLICADA////////////
        $pmay = $ptotal[16];////////////FEBRERO DEMANDA/INFRAESTRUCTURA////////////
        $pjun = $ptotal[17];////////////FEBRERO 0////////////
        $paug = $ptotal[19];////////////FEBRERO 3////////////
        $pjul = $ptotal[18];////////////FEBRERO 4////////////
        $psep = $ptotal[20];////////////marzo ABIERTA////////////
        $poct = $ptotal[21];////////////marzo p////////////
        $pnov = $ptotal[22];////////////MARZO cancelada////////////
        $pdec = $ptotal[23];////////////MARZO comercial////////////
        $cjan = $ptotal[24];////////////MARZO adeudo////////////
        $cfeb = $ptotal[25];////////////MARZO duplicada////////////
        $cmar = $ptotal[26];////////////MARZO demanda////////////
        $capr = $ptotal[27];////////////MARZO 0////////////
        $cmay = $ptotal[28];////////////MARZO 3////////////
        $cjun = $ptotal[29];////////////MARZO 4////////////
        $cjul = $ptotal[30];////////////ABRIL ABIERTA////////////
        $caug = $ptotal[31];////////////ABRIL p////////////
        $csep = $ptotal[32];////////////ABRIL CANCELADA////////////
        $coct = $ptotal[33];////////////ABRIL COMERCIAL////////////
        $cnov = $ptotal[34];////////////ABRIL ADEUDO////////////
        $cdec = $ptotal[35];////////////ABRIL duplicado////////////
        $cojan = $ptotal[36];////////////ABRIL DEMANDA////////////
        $cofeb = $ptotal[37];////////////ABRIL 0////////////
        $comar = $ptotal[38];////////////ABRIL 3////////////
        $coapr = $ptotal[39];////////////ABRIL 4////////////
        $comay = $ptotal[40];///////////////////////////mayo ESTATUSABIERTA/////////
        $cojun = $ptotal[41];////////////mayo p////////////
        $cojul = $ptotal[42];////////////mayo cancelada////////////
        $coaug = $ptotal[43];////////////mayo COMERCIAL////////////
        $cosep = $ptotal[44];////////////mayo ADEUDO////////////
        $cooct = $ptotal[45];////////////mayo duplicado////////////
        $conov = $ptotal[46];////////////mayo DEMANDA////////////
        $codec = $ptotal[47];////////////mayo 0////////////
        $adjan = $ptotal[48];////////////mayo 3////////////
        $adfeb = $ptotal[49];////////////mayo 4////////////
        $admar = $ptotal[50];//////////////////////////////junio ESTATUSABIERTA////////////////
        $adapr = $ptotal[51];////////////junio p////////////
        $admay = $ptotal[52];////////////junio cancelada////////////
        $adjun = $ptotal[53];////////////junio COMERCIAL////////////
        $adjul = $ptotal[54];////////////junio ADEUDO////////////
        $adaug = $ptotal[55];////////////junio duplicada////////////
        $adsep = $ptotal[56];////////////junio DEMANDA////////////
        $adoct = $ptotal[57];////////////junio 0////////////
        $adnov = $ptotal[58];////////////junio 3////////////
        $addec = $ptotal[59];////////////junio 4////////////
        $sdjan = $ptotal[60];////////////////////////////julio ESTATUSABIERTA//////////////
        $sdfeb = $ptotal[61];////////////julio p////////////
        $sdmar = $ptotal[62];////////////julio CANCELADA////////////
        $sdapr = $ptotal[63];////////////julio COMERCIAL////////////
        $sdmay = $ptotal[64];////////////julio ADEUDO////////////
        $sdjun = $ptotal[65];////////////julio duplicado////////////
        $sdjul = $ptotal[66];////////////julio DEMANDA////////////
        $sdaug = $ptotal[67];////////////julio 0////////////
        $sdsep = $ptotal[68];////////////julio 3////////////
        $sdoct = $ptotal[69];////////////julio 4////////////
        $sdnov = $ptotal[70];////////////////////////////agosto ESTATUSABIERTA////////////////////////
        $sddec = $ptotal[71];////////////agosto p////////////
        $dijan = $ptotal[72];////////////agosto cancelada////////////
        $difeb = $ptotal[73];////////////agosto COMERCIAL////////////
        $dimar = $ptotal[74];////////////agosto adeudo////////////
        $diapr = $ptotal[75];////////////agosto duplciado////////////
        $dimay = $ptotal[76];////////////agosto DEMANDA////////////
        $dijun = $ptotal[77];////////////agosto 0////////////
        $dijul = $ptotal[78];////////////agosto 3////////////
        $diaug = $ptotal[79];////////////agosto 4////////////
        $disep = $ptotal[80];////////////////////////////semptiembre ESTATUSABIERTA///////////////
        $dioct = $ptotal[81];////////////semptiembre p///////////
        $dinov = $ptotal[82];////////////semptiembre Cancelada////////////
        $didec = $ptotal[83];////////////semptiembre COMERCIAL////////////
        $ninjan = $ptotal[84];////////////semptiembre ADEUDO////////////
        $ninfeb = $ptotal[85];////////////semptiembre dulicado////////////
        $ninmar = $ptotal[86];////////////semptiembre DEMANDA////////////
        $ninapr = $ptotal[87];////////////semptiembre 0////////////
        $ninmay = $ptotal[88];////////////semptiembre 3////////////
        $ninjun = $ptotal[89];////////////semptiembre 4////////////
        $ninjul = $ptotal[90];////////////////////////////octumbre ESTATUSABIERTA////////////////////
        $ninaug = $ptotal[91];////////////octumbre p////////////
        $ninsep = $ptotal[92];////////////octumbre CANCELADA////////////
        $ninoct = $ptotal[93];////////////octumbre COMERCIAL////////////
        $ninnov = $ptotal[94];////////////octumbre ADEUDO////////////
        $nindec = $ptotal[95];////////////octumbre duplicada////////////
        $noejan = $ptotal[96];////////////octumbre DEMANDA////////////
        $noefeb = $ptotal[97];////////////octumbre 0////////////
        $noemar = $ptotal[98];////////////octumbre 3////////////
        $noeapr = $ptotal[99];////////////octumbre 4////////////
        $noemay = $ptotal[100];/////////////////////////////noviembre ESTATUSABIERTA////////////////////////////
        $noejun = $ptotal[101];////////////noviembre p////////////
        $noejul = $ptotal[102];////////////noviembre CANCELADA////////////
        $noeaug = $ptotal[103];////////////noviembre COMERCIAL////////////
        $noesep = $ptotal[104];////////////noviembre ADEUDO////////////
        $noeoct = $ptotal[105];////////////noviembre duplicada////////////
        $noenov = $ptotal[106];////////////noviembre DEMANDA////////////
        $noedec = $ptotal[107];////////////noviembre 0////////////
        $sinestjan = $ptotal[108];////////////noviembre 3////////////
        $sinestfeb = $ptotal[109];////////////noviembre 4////////////
        $sinestmar = $ptotal[110];/////////////////////////////////////diciembre ESTATUSABIERTA//////////////////
        $sinestapr = $ptotal[111];////////////diciembre p////////////
        $sinestmay = $ptotal[112];////////////diciembre CANCELADA////////////
        $sinestjun = $ptotal[113];////////////diciembre COMERCIAL////////////
        $sinestjul = $ptotal[114];////////////diciembre ADEUDO////////////
        $sinestaug = $ptotal[115];////////////diciembre duplicada////////////
        $sinestsep = $ptotal[116];////////////diciembre DEMANDA////////////
        $sinestoct = $ptotal[117];////////////diciembre 0////////////
        $sinestnov = $ptotal[118];////////////diciembre 3////////////
        $sinestdec = $ptotal[119];////////////diciembre 4////////////
            echo"
            series: [
              {
                name: 'Abierta',
                data: [$Ajan,$Anov,$psep,$cjul,$comay,$admar,$sdjan,$sdnov,$disep,$ninjul,$noemay,$sinestmar]

            },
            {
              name: 'POSTEADO',
                data: [$Afeb,$Adec,$poct,$caug,$cojun,$adapr,$sdfeb,$sddec,$dioct,$ninaug,$noejun,$sinestapr]

          },
          {
            name: 'CANCELADA',
              data: [$Amar,$pjan,$pnov,$csep,$cojul,$admay,$sdmar,$dijan,$dinov,$ninsep,$noejul,$sinestmay]

        },
        {
          name: 'COMERCIAL',
            data: [$Aapr,$pfeb,$pdec,$coct,$coaug,$adjun,$sdapr,$difeb,$didec,$ninoct,$noeaug,$sinestjun]

        },
        {
          name: 'ADEUDO',
            data: [$Amay,$pmar,$pdec,$cnov,$cosep,$adjul,$sdmay,$dimar,$ninjan,$ninnov,$noesep,$sinestjul]

        },
        {
          name: 'DUPLICADA',
            data: [$Ajun,$papr,$cfeb,$cdec,$cooct,$adaug,$sdjun,$diapr,$ninfeb,$nindec,$noeoct,$sinestaug]

        },
        {
          name: 'DEMANDA',

          data: [$Ajul,$pmay,$cmar,$cojan,$conov,$adsep,$sdjul,$dimay,$ninmar,$noejan,$noenov,$sinestsep]


        },
        {
          name: 'NINGUNO',
            data: [$Aaug,$pjun,$capr,$cofeb,$codec,$adoct,$sdaug,$dijun,$ninapr,$noefeb,$noedec,$sinestoct]

        },
        {
          name: 'NO ENCONTRADO',
            data: [$Asep,$paug,$cmay,$comar,$adjan,$adnov,$sdsep,$dijul,$ninmay,$noemar,$sinestjan,$sinestnov]

        },
        {
          name: 'SIN ESTRATEGIA',
            data: [$Aoct,$pjul,$cjun,$coapr,$adfeb,$addec,$sdoct,$diaug,$ninjun,$noeapr,$sinestfeb,$sinestdec]

        },
          ]
        });
            </script>
        ";

    /*------------------------------------------------------------------ termina promotor------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

}

?>
