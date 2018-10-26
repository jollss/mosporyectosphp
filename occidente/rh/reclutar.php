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
                <label>Zona de vacante: (Ej. Toluca)</label>
                <input type="text" class="form-control" name="zona" placeholder="Ej. TOLUCA" required>
                <label>Puesto de vacante:</label>
                <input type="text" class="form-control" name="puesto" placeholder="Ej. PROMOTOR" required>
                <label>Cantidad de vacantes:</label>
                <input type="number" class="form-control" min=0 max=9999 name="vacantes" placeholder="Ej. 2" required>
                <button type="submit" class="btn btn-success">
                    AGREGAR
                  </button>
                </form>
              </form>
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
    ?>
</div>
<div class="col-md-1"></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>