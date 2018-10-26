<?php
require_once '../Config/main.php';
require_once '../Config/foot.php';
include("../Config/conexion2.php");  
require_once '../Config/conexion.php';
if (session_id() ==''){ 
    session_start();
}
if($_SESSION['username']=="")
{
  header("Location: ../login.html");
}
date_default_timezone_set('America/Mexico_City');
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$semana = date("W");
$cnxe = Conectarse(); 
$con = Conectarse();  
$con2 = Conectarse(); 
$con3 = Conectarse();
$con4 = Conectarse();
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];
$cnxe->real_query("SELECT * FROM usuario WHERE correo = '$mail'");
$result = $cnxe->use_result();
while ($line = $result->fetch_assoc()){
    $iduser=$line['idu'];
}
$cantidad_resultados_por_pagina = 8;
if (isset($_GET["pagina"])) {
    if (is_string($_GET["pagina"])) {
         if (is_numeric($_GET["pagina"])) {
             if ($_GET["pagina"] == 1) {
                 header("Location: reclutamiento.php");
                 die();
             } else { 
                 $pagina = $_GET["pagina"];
            };
         } else {
             header("Location: reclutamiento.php");
            die();
         };
    };

} else { $pagina = 1;};
    $empezar_desde = ($pagina-1) * $cantidad_resultados_por_pagina;
if ($result = $con->query("SELECT * FROM reclutamiento ")) {// WHERE reclutamiento='REGISTRO' or reclutamiento='ENTREVISTA'")) {
    /* determinar el número de filas del resultado */
    $total_registros = $result->num_rows;
    printf("Result set has %d rows.\n", $total_registros);
    /* cerrar el resultset */
    $result->close();
    }
$total_paginas = ceil($total_registros / $cantidad_resultados_por_pagina); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
<script type="text/javascript" src="../js/browser5.js"></script>
        
<?php
    nivel2($user);
?>
</head>
<body>
<br><br><br><br>
<div class="container col-md-12" name="toTop" id="topPos">
    <div class="col-md-1">
    <br><br><br>
    </div>
    <div class="col-md-10">
    <div align="center"><h3><?php //echo $user;?></h3></div>
        <div class="panel panel-info">
            <div class="panel-heading">Datos de Reclutamiento</div>
            <div class="panel-body" style="background-color:gray;">
              <form action="reclutar.php" method="GET">
                <input type="hidden" name="option" value="1">
                <div class="col-md-5">
                  <label>Nombre Completo</label>
                  <input type="text" class="form-control" name="nombre" placeholder="Nombre Completo" required>
                  <label>Usuario Facebook:</label>
                  <input type="text" class="form-control" name="user_face" placeholder="USUARIO O NOMBRE DE FACEBOOK">
                </div>
                <div class="col-md-2">
                  <label>Telefono:</label>
                  <input type="tel" class="form-control" name="telefono" placeholder="Ej. 722214568" required>
                </div>
                <div class="col-md-3">
                  <label>Correo Electronico:</label>
                  <input type="mail" class="form-control" name="mail" placeholder="" required>
                </div>
                 <div class="col-md-10">
                  <label>Dirección:</label>
                  <input type="text" class="form-control" name="direccion" placeholder="Direccion" required>
                  <label>Lugar al que se aplica:</label>
                  <input type="text" class="form-control" name="zona" placeholder="" required>
                  <label>Estatus:</label>
                  <select name="estatus" class="form-control">
                    <option>Di información de Fielder</option>
                    <option>Di información de Bajantes</option>
                    <option>Di información de OTRO (Colocar en observaciónes cual)</option>
                  </select>
                  <label>Observaciones:</label>
                  <textarea class="form-control" name="observacion"  required></textarea>
                  </div>
                  <div align="center" class="col-md-10">
                  <button type="submit" class="btn btn-success">
                      AGREGAR
                    </button>
                  </div>
                </form>
              <div class="col-md-12">
              <br><br><br>
              </div>
              <div class="col-md-12">
                <div align="center">
                  <form method="GET" action="reclutar.php">
                    <input type="hidden" name="option" value="2">
                    <input type="text" name="search" placeholder="DATO A BUSCAR (nombre, telefono, facebook.)" class="form-control">
                    <button type="submit" class="btn btn-default">BUSCAR</button>
                  </form>
                </div>
              </div>
              <!--
              <div class="col-md-12">
                <table class="table" style="background-color:white;">
                <tr>
                  <td>ZONA</td>
                  <td>PUESTO</td>
                  <td>NÚMERO DE VACANTES</td>
                </tr>
                <?php
                $c=Conectarse();
                $c->real_query("SELECT * FROM vacantes WHERE num_vacantes<>0");
                $result = $c->use_result();
                while ($line = $result->fetch_assoc()){
                    $idzona=$line['idzona'];
                    $zona=$line['zona'];
                    $puesto=$line['puesto'];
                    $num_vacantes=$line['num_vacantes'];
                  ?>
                  <tr>
                    <td><?php echo $zona;?></td>
                    <td><?php echo $puesto;?></td>
                    <td><?php echo $num_vacantes;?></td>
                    <td>
                      <form action="reclutar.php" method="GET">
                        <input type="hidden" name="id" value="<?php echo $idzona;?>">
                        <button type="submit" class="btn btn-danger">
                          ELIMINAR
                        </button>
                      </form>
                    </td>
                  </tr>
                  <?php
                }
                ?>
                </table>
              </div>
              -->
            </div>
        </div>
    </div>
    <?php 
    function refresh(){
      ob_start(); 
      header('Location: reclutar.php');
      header("Location: reclutar.php");
      ob_end_flush();
    }
      if(isset($_GET['id'])){
        
        require "../Contacts/conexion.php";
        include("../Contacts/vacantes.php");
        $vacante=new Vacantes();
        $estado=$vacante->EliminarVacante($bd,$data);
        $id=$_GET['id'];
        $vacante->EliminarVacante($bd,$id);
        refresh();
      }if(isset($_GET['zona']) && isset($_GET['puesto']) && isset($_GET['vacantes'])){
        require "../Contacts/conexion.php";
        include("../Contacts/vacantes.php");
        $vacante=new Vacantes();
        $id=$vacante->TotalVacantes($bd);
        $id=count($id);
        $id=$id+1;
        $vacante->RegistrarVacante($bd,$_GET,$id);
        refresh();
      }
      if(isset($_GET['option'])){
        if($_GET['option']==1){
          date_default_timezone_set('America/Mexico_City');
          $con = Conectarse();  
          $con2 = Conectarse();  
          $dia=date('j');
          $mes=date('n');
          $aaaa=date('Y');
          $hora = date("g");
          $min = date("i");
          $fecha=$dia."/".$mes."/".$aaaa." ".$hora.":".$min;
          $nombre=$_GET['nombre'];
          $usuario=$_GET['user_face'];
          $tel=$_GET['telefono'];
          $correo=$_GET['mail'];
          $dir=$_GET['direccion'];
          $zona=$_GET['zona'];
          $obser=$_GET['observacion'];
          $estatus=$_GET['estatus'];
          //include("../Config/library.php"); 
          $sql1s="SELECT * FROM reclutamos WHERE correo_reclutamos='$correo' or usuario_reclutamos='$usuario'";
          $resultados=$con->query($sql1s);
          while($rows = $resultados->fetch_assoc())
          {
            $correoss=$rows['correo_reclutamos'];
          }

          if(!isset($correoss) or $correoss<>$correo){
              $id_reclutamos=0;
              $sql1="SELECT id_reclutamos FROM reclutamos ORDER BY id_reclutamos";
              $resultado=$con->query($sql1);
              while($row = $resultado->fetch_assoc())
              {
                $id_reclutamos=$row['id_reclutamos'];
              }
              $id_reclutamos=$id_reclutamos+1;
              
              $sql="INSERT INTO reclutamos (
              id_reclutamos,nombre_reclutamos,usuario_reclutamos,
              telefono_reclutamos,correo_reclutamos,direccion_reclutamos,
              zona_reclutamos,estatus_reclutamos,observacion_reclutamos,fecha_reclutamos)
              VALUES
              ('".$id_reclutamos."','".$nombre."','".$usuario."',
                '".$tel."','".$correo."','".$dir."',
                '".$zona."','".$estatus."','".$obser."','".$fecha."'
                )"; 
              if ($con->query($sql) === TRUE) { 
                echo "
                <div align=center>
                  <H2>CORRECTO.</H2>
                </div>
                "; 
              } else { if (!mysqli_query($con, $sql)) { printf("Errormessage: %s\n", mysqli_error($con)); echo "<br>";} }
          }if($correoss==$correo){
            $_GET['search']=$correo;
            $_GET['option']=2;
            echo "
                <div align=center class=col-md-12>
                  <H2>DATOS YA EXISTENTES.</H2>
                </div>
                "; 
          }
          
        }if($_GET['option']==2){
          $buscar=$_GET['search'];
          if($buscar<>''){
              $sql1s="SELECT * FROM reclutamos WHERE correo_reclutamos like '%$buscar%' or usuario_reclutamos like '%$buscar%' or nombre_reclutamos like '%$buscar%'";
              $resultados=$con->query($sql1s);
               ?>
              <div style="height:100px;overflow-y:scroll;" class="col-md-12">
              <table class="table">
              <?php
              while($rows = $resultados->fetch_assoc())
              {
                $fecha=$rows['fecha_reclutamos'];
                $nombre=$rows['nombre_reclutamos'];
                $user_fa=$rows['usuario_reclutamos'];
                $telefono=$rows['telefono_reclutamos'];
                $mail=$rows['correo_reclutamos'];
                $zona=$rows['zona_reclutamos'];
                $direccion=$rows['direccion_reclutamos'];
                $estatus=$rows['estatus_reclutamos'];
                $observacion=$rows['observacion_reclutamos'];
                ?>
                <tr>
                    <td><?php echo $fecha;?></td>
                    <td><?php echo $nombre;?></td>
                    <td><?php echo $user_fa;?></td>
                    <td><?php echo $telefono;?></td>
                    <td><?php echo $mail;?></td>
                    <td><?php echo $zona;?></td>
                    <td><?php echo $direccion;?></td>
                    <td><?php echo $estatus;?></td>
                    <td><?php echo $observacion;?></td>
                </tr>
                <?php
              }
              ?>
              </table>
              </div>
              <?php
          }if($buscar<>''){
            echo "Coloca dato a buscar";
          }
        }
      }
    ?>
</div>
<div class="col-md-1"></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>