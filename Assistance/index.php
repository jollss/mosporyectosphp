<!DOCTYPE html>
<?php
require "zona.php";
require "clase_conexion.php";
//require "";
$zonas=new Zona();
$totalzonas=$zonas->obtenerTotaldeZona($bd);
?>
<html>
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
</head>
<body style="background-color:black;color:white;">
	<div class="col-md-12">
		<div class="col-md-3"></div>
		<div class="panel panel-primary col-md-6">
			<div class="panel-heading">Selecciona una tu ZONA.</div>
			<div class="panel-body" align="center">
				<form action="user.php" method="GET"> 
					<input type="hidden" name="ky" value="202cb962ac59075b964b07152d234b70">
					<select class="form-control" name="location">
                        <?php
                        for ($i=1; $i < $totalzonas; $i++) { 
                            $data=$zonas->obtenerZonaxID($bd,$i);
                            ?>
                            <option value="<?php echo $data[0]['nombre_zona'];?>"><?php echo $data[0]['nombre_zona'];?></option>
                            <?php
                        }
                        ?>
						<!--<option value="CDMX"> CDMX</option>
						<option value="CERRILLO"> CERRILLO</option>
						<option value="ACAPULCO"> ACAPULCO</option>
						<option value="CHILPANCINGO"> CHILPANCINGO</option>-->
					</select>
					<button type="submit" class="btn btn-success btn-lg">
						<span class="glyphicon glyphicon glyphicon-dashboard" aria-hidden="true"></span>
						Ingresar
					</button>
				</form>
			</div>
		</div>
		<div class="col-md-3"></div>
	</div>
</body>
</html>