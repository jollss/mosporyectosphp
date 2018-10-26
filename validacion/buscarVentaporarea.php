<?php
include("../Config/library.php");
//include("../Models/areas_fielder.php");
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse();
$con = Conectarse();
$con2 = Conectarse();
$con3 = Conectarse();
$con4 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$Yo=new Usuario();
$Yo->obtenerUsuarioCorreoBD($mail,$con);
$iduser=$Yo->regresaIdu();
$tos=0;
/*========================================*/
/*========================================*/
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
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
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
    <?php
    $query = "SELECT * FROM usuario  WHERE  idu='$iduser' and bandera_contrase='no' ";
  $result = $con->query($query);
  while($filas = $result->fetch_assoc()) {
    //print_r($filas);
   $modificarcontrase=$filas['bandera_contrase'];
    $modificarcontrasenombre=$filas['nombre'];
    $modificarcontraseidu=$filas['idu'];
   }
  if($modificarcontrase=='no'){
  echo"<h2><p style='color:#FF0000';>$modificarcontrasenombre</p> tienes que cambiar contraseña por motivos de seguridad  favor de llenar el siguiente formulario</h2> ";
  echo"<form action='../modi.php' method='POST'>
  <input type='hidden'  placeholder='nueva contraseña'  name='idu' value='$modificarcontraseidu'>
    <input type='password'  placeholder='nueva contraseña'  name='pass' aria-describedby='sizing-addon2' maxlength='10' required>
      <input type='submit' class='btn btn-primary' value='Enviar'>


  </form>

  ";
  }else{
    nivel4($user);
}



    ?>
    <br><br>
    <br><br>
    <!-- Page Content -->
    <style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td, th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }
    </style>

    <div id="page-wrapper">

      	  <div class="panel-body" align="center">
            <form id="buscador" name="buscador" method="post" action="<?php echo $_SERVER['PHP_SELF'] ?>">
                <input id="buscar" name="buscar" type="search" placeholder="Ingresa el Area Aqui..." autofocus >
                <input type="submit" name="buscador" class="boton peque aceptar" value="buscar">
            </form>

      	  </div>
          <table>
            <tr>
                <th>Folio de la Venta</th>
              <th>area</th>
                <th>Nombre Cliente</th>
  <th>Direccion </th>
<th>Fecha de Registro </th>
<th>Acciones </th>
            </tr>
          <?php
          $texto = '';
          //Variable que contendrá el número de resgistros encontrados
          $registros = '';
          if($_POST){



  $entero = 0;

  if (empty($busqueda)){
	  $texto = 'Búsqueda sin resultados';
         $busqueda = trim($_POST['buscar']);
       }
             $sql = "SELECT AREA,idventa,direccion,nombrev,apaternov,amaternov,hora,dia,mes,YEAR,folio_ventas FROM venta WHERE AREA LIKE '%$busqueda%' AND contesto='' ORDER BY idventa DESC";
             $result1 = $con->query($sql);
             //$total_num_rows = $result1->num_rows;
              while($fila = $result1->fetch_array())
            {
              $texto = $fila['AREA'] ;
              $idventa = $fila['idventa'] ;
                $folio_ventas = $fila['folio_ventas'] ;
              $direccion = $fila['direccion'] ;
              $nombrev= $fila['nombrev'] ;
              $apaternov = $fila['apaternov'] ;
              $amaternov= $fila['amaternov'] ;
                $hora = $fila['hora'] ;
                  $dia = $fila['dia'] ;
                    $mes = $fila['mes'] ;
                      $year = $fila['YEAR'] ;
              echo"


                <tr>
                    <td>$folio_ventas</td>
                  <td>$texto</td>
<td>$nombrev <br>$apaternov $amaternov</td>
  <td>$direccion</td>
  <td>fecha:$dia-$mes-$year <br>hora:$hora</td>
  <td><center><a href='ventaeditar.php?id=$idventa&foli_venta=$folio_ventas'><i class='<i fas fa-edit fa-3x'></i></a></center></td>
                </tr>



              ";
            //  echo $texto;
              //  print_r($row);
         }
         if (mysqli_num_rows($result1) > 0){
           // Se recoge el número de resultados
       $registros = mysqli_num_rows($result1);
           // Se almacenan las cadenas de resultado
           while($fila = $result1->fetch_array())
         {

      }

        }else{
             $texto = "NO HAY RESULTADOS EN LA BBDD";
        }
             //while($filas1 = $result1->fetch_assoc()) {
               //$nombre=$filas1['nombre'];
               //$apaterno=$filas1['apaterno'];
                // $amaterno=$filas1['amaterno'];
             //   print_r($filas1);
            // }
               // $resultado = mysql_query($sql); //Ejecución de la consulta
                   //Si hay resultados...

                // $registros = '<p>HEMOS ENCONTRADO ' . mysql_num_rows($resultado) . ' registros </p>';
                   // Se almacenan las cadenas de resultado
                // while($fila = mysql_fetch_assoc($resultado)){
                  //         $texto .= $fila['provincia'] . '<br />';
                   //}
                 }
                   ?>  </table>

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
