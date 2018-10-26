<?php
include("../Config/library.php"); 

$con = Conectarse();  
$mail = $_SESSION['mail'];
$user = $_SESSION['username'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1" name="viewport">
    <title>MOS Proyectos</title>
        <link href="../css/bootstrap.css" rel="stylesheet">
        <script type="text/javascript" src="../js/browserDigital.js"></script>
        <script src="../js/jquery-3.2.0.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script type="text/javascript">
		        $(document).ready(function(){
			    $(window).scroll(function(){
			        var lastID = $('.load-more').attr('lastID');
			        if ($(window).scrollTop() == $(document).height() - $(window).height() && lastID != 0){
			            $.ajax({
			                type:'POST',
			                url:'getData.php',
			                data:'id='+lastID,
			                beforeSend:function(html){
			                    $('.load-more').show();
			                },
			                success:function(html){
			                    $('.load-more').remove();
			                    $('#postList').append(html);
			                }
			            });
			        }
			    });
			});
        </script>
<?php
    cobranza($user);
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana = date("W");
?>  
</head>
<body>
<br><br><br><br>
<!--<div class="col-md-3"></div>-->
<div class="col-md-12" align="center">
	<!--<table border="0" class="table">-->
	<!--
	<div class="col-md-6">
	<table class="table">
	<tr>
		<th>
			<form action="con_pqo.php" method="GET">
			<th align="center">
				<table border="0" class="table">
					<tr align="center">
						<td>MES</td>
						<td>AÑO</td>
					</tr>
					<tr>
						<td>
							<input class="" type="number" min=0 max=12 name="mes" value="<?php echo $mes;?>" placeholder="MES">
						</td>
						<td>
							<input class="" type="number" min=2000 max=3000 name="anio" value="<?php echo $aaaa;?>" placeholdeR="AÑO">
						</td>
					</tr>
				</table>
			</th>
			<th>
				<label>ORDENAR</label>
				<select name="option_search" class="form-control">
					<option value="1">FOLIO PISA</option>
					<option value="2">SUPERVISOR</option>
					<option value="3">TIPO DE ORDEN</option>
					<option value="4">TECNICO</option>
				</select>
			</th>
			<th>
				<button type="submit" class="btn btn-primary">
					BUSCAR
				</button>

			</th>
			</form>
		</th>
	</tr>
	</table>
	</div>
	-->
	<!--
	<div class="col-md-6">
	<table class="table">
		<tr>
		<form action="con_pqo.php" method="GET">
			<th>
				<input type="number" name="data" class="form-control" placeholder="FOLIO PISA" required>
			</th>
			<th></th>
			<th>
				<button type="submit" class="btn btn-danger btn-md bntmodal" name="valor" data-id="" value="search">VER</button>
			</th>
		</form>
		</tr>
	</table>
	</div>
	-->

</div>
<div class="col-md-12"><br><br<br></div>
<div class="col-md-12">
<?php
$mes=date('n');
$aaaa=date('Y');
//$sql="SELECT * FROM os inner join dataos where idmos=id_orden and mmos='$mes' and yearos='$aaaa' and estatus=2 ORDER BY mmos DESC, yearos DESC, ddos DESC";
 	if(isset($_GET['data'])){
    	$mes=date('n');
    	$aaaa=date('Y');
    	$data=$_GET['data'];
    	$sql="SELECT * FROM os inner join dataos inner join validar_os 
    	where idmos=id_orden and id_folio_pisa=folio_pisa and folio_pisa='$data'";
    }
?>
    <div class="panel panel-primary">
        <div class="panel-heading col-md-12">
        	<!--Ingresa el NUMERO DE REPORTE-->
        	<div class="col-md-6">
				<label>Archivo CSV maximo 1000 filas</label>
				<form action="carga_pqo.php" method="POST" enctype="multipart/form-data">
					<input type="hidden" value="con_pqo.php" name="url">
					<table class="table">
						<tr>
							<th>
							<td>
								<input type="file" name="file" accept=".csv">
							</td>
							<td>
								<button class="btn btn-success" type="submit">
									CARGAR
								</button>
							</td>
						</tr>
					</table>
				</form>
			</div>
			<div class="col-md-6">
				<form action="con_pqo.php" method="GET">
					<table>
						<tr>PAQO o Folio Pisa a buscar.</tr>
						<tr>
							<th>
								<input type="text" name="data" placeholder="PAQO o FOLIO PISA" class="form-control">
							</th>
						</tr> 
						<tr>
							<th>
								<button class="btn btn-success" type="submit">
									BUSCAR
								</button>
							</th>
						</tr>
					</table>
				</form>
			</div>
        </div>
        <div class="panel-body table-responsive" style="font-size:12px;">
            <div style="height:400px;overflow-y:scroll;">
                
                <?php
                if(isset($sql) and isset($_GET['data'])){
                	$contar=0;
			        $con1 = Conectarse();
			        $resultado=$con1->query($sql);
			        while($row = $resultado->fetch_assoc())
			        {
			        	
			        	$idmos=$row['idmos'];
			        	$folio_pisa=$row['folio_pisa'];
			        	$tipo_os=$row['tipo_os'];
			        	$ddos=$row['ddos'];
			        	$mmos=$row['mmos'];
			        	$yearos=$row['yearos'];
			        	$horaos=$row['horaos'];
			        	$idusup=$row['supervisor_idu'];
			        	$idutec=$row['tecnico_asignado_idu'];
			        	
			        	if($row['a_cobro']==0){
			        		$estatus_pago="<label style='color:red'>SIN PAGO</label>";	
			        	}if($row['a_cobro']==1){
			        		$estatus_pago="<label style='color:green'>PAGADAS</label>";	
			        	}
			        	$paqo=$row['paqo'];
			        	$factura=$row['factura_os'];
			        	$cobranza=$row['fecha_cobranza'];
			        	$sql1="SELECT * FROM usuario where idu='$idutec'";
    					$sql2="SELECT * FROM usuario where idu='$idusup'";
    					$con2 = Conectarse();
    					$con3 = Conectarse();
				        $resultado2=$con2->query($sql1);
				        while($row2 = $resultado2->fetch_assoc())
				        {
				        	$nt=$row2['nombre'];
				        	$apt=$row2['apaterno'];
				        	$amt=$row2['amaterno'];
				        }
				        $resultado3=$con3->query($sql2);
				        while($row3 = $resultado3->fetch_assoc())
				        {
				        	$ns=$row3['nombre'];
				        	$aps=$row3['apaterno'];
				        	$ams=$row3['amaterno'];
				        }
			        }
			        $supervisor=$ns." ".$aps." ".$ams;
			        $tecnico=$nt." ".$apt." ".$amt;
			        ?>
			        <table class="table" style="font-size:20px;">
	                    <tr>
	                        <th>FOLIO PISA</th>
	                        <th>FECHA DE CIERRE</th>
	                        <th>SUPERVISOR</th>
	                        <th>TECNICO</th>
	                        <th>TIPO DE ORDEN</th>
	                    </tr>
	                    <tr>
	                    	<td><?php echo $folio_pisa;?></td>
	                    	<td><?php echo $ddos."/".$mmos."/".$yearos." ".$horaos;?></td>
	                    	<td><?php echo $supervisor;?></td>
	                    	<td><?php echo $tecnico;?></td>
	                    	<td><?php echo $tipo_os;?></td>
	                    </tr>
                    </table>
                    <table class="table" style="font-size:20px;">
	                    <tr>
	                        <th>ESTATUS DE PAGO</th>
	                        <th>Fecha de Pago</th>
	                        <th>PAQO</th>
	                        <th>FACTURA</th>
	                    </tr>
	                    <tr>
	                    	<td><?php echo $estatus_pago;?></td>
	                    	<td><?php echo $cobranza;?></td>
	                    	<td><?php echo $paqo;?></td>
	                    	<td><?php echo $factura;?></td>
	                    </tr>
                    </table>
			        <?php
			    }
                ?>
            </div>
        </div>
        <div class="col-md-12" align="center">
          	<!--<label>TOTAL: <?php echo $contar;?></label>-->
        </div>
    </div>
</div>				  
<!-- Modal -->
<!--
<div class="modal fade myModal" id="" role="dialog" style="width:100% !important;">
<div class="modal-dialog modal-lg">

  <div class="modal-content">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal">&times;</button>
      <h4 class="modal-title">Datos de la Orden</h4>
    </div>
    <div class="modal-body">
      <p>No hay datos por buscar</p>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
    </div>
  </div>
  
</div>
</div>	
<script>
$(document).ready(function(){
	$('.bntmodal').click (function(){
	    var idmos=$(this).data("#id");
	    console.log(idmos);
	    $('.modal-body').load('getContentPago.php?idmos='+idmos,function(){
	        $('.myModal').modal({show:true});
	    });
	});
});
</script>
-->
<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
</body>
</html>