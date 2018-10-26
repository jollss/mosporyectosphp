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
                 header("Location: inde.php");
                 die();
             } else { 
                 $pagina = $_GET["pagina"];
            };
         } else {
             header("Location: inde.php");
            die();
         };
    };

} else { $pagina = 1;};
    $empezar_desde = ($pagina-1) * $cantidad_resultados_por_pagina;
if ($result = $con->query("SELECT * FROM usuario WHERE tipo_idtipo=3")) {
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
    asignar($user);
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
            <div class="panel-heading">Asignar Tecnicos</div>
            <div class="panel-body" style="background-color:gray;">
            <div align="center" style="font-size:12px !important;">
            <nav aria-label="Page navigation">
              <ul class="pagination">
                <?php for ($i=1; $i<=$total_paginas; $i++) {?>
                <li><?php echo "<a href='?pagina=".$i."'>".$i."</a>";?></li>
                <?php }; ?>
                </li>
              </ul>
            </nav>
                <div id="resultadoBusqueda">

                <?php
                   $sql1="SELECT * FROM usuario 
                     WHERE activo=1 AND tipo_idtipo=3 ORDER BY nombre
                     LIMIT $empezar_desde, $cantidad_resultados_por_pagina";
                   $resultado=$con2->query($sql1);
                ?>
                            <div class="table-responsive" >
                                <table class="table table-bordered" style="background-color:white;">
                                    <tr>
                                      <th></th>
                                      <th>Nombre</th>
                                      <th>Teléfono</th>
                                      <th>Correo</th>
                                    </tr>
                        <?php
                        $aux=0;
                        $aux2=0;
                    while($row = $resultado->fetch_assoc())
                    {
                        $name=$row['nombre']." ".$row['apaterno']." ".$row['amaterno'];
                        $phone=$row['cel'];
                        $mail=$row['correo'];
                        ?> 
                            <tr>
                                <th>
                                    <form action="infoos.php" method="POST">
                                        <input type="text" value="<?php echo $row['idu'];?>" name="ident" style="display:none;">
                                        <input class="btn btn-info"  type="submit" value="Asignar">
                                    </form>
                                </th>
                                <th><?php echo $name;?></th> 
                                <th><?php echo $phone;?></th> 
                                <th><?php echo $mail;?></th> 
                            </tr>
                        <?php                                              
                        }
                        ?>
                        </table>
                            </div>                        
                        <?php
                    ?>
                 </div>
            </div>
            </div>
        </div>
    </div>
    <?php footer();?>
</div>
<div class="col-md-1"></div>
<script src="../js/jquery-3.2.0.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
</body>
</html>