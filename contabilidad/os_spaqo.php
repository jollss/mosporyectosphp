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
    contabilidad($user);
    date_default_timezone_set('America/Mexico_City');
    $dia=date('j');
    $mes=date('n');
    $aaaa=date('Y');
    $semana = date("W");
?>
</head>
<body>
<br><br><br><br>

<div class="col-md-12">

<?php
$dia=date('d');
$mes=date('n');
$aaaa=date('Y');
//$sql="SELECT * FROM os inner join dataos where idmos=id_orden and mmos='$mes' and yearos='$aaaa' and estatus=2 ORDER BY mmos DESC, yearos DESC, ddos DESC";

?>
<?php
        if($mes<>'' and isset($mes)){
        ?>
        	<form action="downloadCobranza.php" method="GET" target="_blank">
	        	<input type="hidden" value="<?php echo $mes;?>" name="mes">
				<input type="hidden" value="<?php echo $aaaa;?>" name="anio">
				<input type="hidden" value="1" name="option_search">
				<!--
        		<div align="center">
        			<button class="btn btn-danger" type="submit">DESCARGAR x MES</button>
        		</div>
        		-->
        	</form>
        <?php
    	}else{}
        ?>
        <div align="center">
        <?php
        if(isset($_GET['month']) and isset($_GET['year']) and $_GET['option_search']==1){
        	?>
        	<form action="sin_paqoCSV.php" method="GET" target="_blank">
				<input type="hidden" name="mes" value="<?php echo $mes;?>">
				<input type="hidden" value="<?php echo $aaaa;?>" name="anio">
				<input type="hidden" value="1" name="option_search">
				<button type="submit" class="btn btn-danger">
					DESCARGA x MES
				</button>
			</form>
        	<?php
        }
        ?>
	</div>
    <div class="panel panel-primary">
        <div class="panel-heading">
        	<h3>ORDENES DE SERVICIO SIN PAQO</h3>
        	<br>
        	<h4>Para realizar una busqueda presiona CTRL + F y coloca el folio pisa que requieres.</h4>
        	<!--<a href="downloadExcelSPQO.php" target="_blank"><button class="btn btn-success">DESCARGA</button></a>-->
        	<a href="downloadExcelSPQO.php?operacion=1" target="_blank"><button class="btn btn-success">DESCARGA FIBRA</button></a>
        	<a href="downloadExcelSPQO.php?operacion=2" target="_blank"><button class="btn btn-success">DESCARGA OTROS</button></a>
        	<a href="downloadExcelSPQO.php?operacion=3" target="_blank"><button class="btn btn-success">DESCARGA NORMAL</button></a>
        </div>
        <div class="panel-body table-responsive" style="font-size:12px;">
        	<form action="procesa_paqo.php" method="POST">
            <div align="center" style="background-color:gray;color: black;">
	        		<label><?php echo $dia."/".$mes."/".$aaaa;?></label>
	        		<input type="text" name="paqo" placeholder="INGRESA No DE PAQO" style="font-size:12pt;">
	        		<!--<input type="text" name="tipo_paqo" placeholder="INGRESA TIPO DE PAQO" style="font-size:12pt;">-->
	        		<select name="tipo_paqo" style="font-size:12pt;">
	        			<option value="FIBRA">FIBRA</option>
	        			<option value="COBRE">COBRE</option>
	        			<option value="HIBRIDA">HIBRIDA</option>
	        			<option value="TECNICA">TECNICA</option>
	        			<option value="VOZ">VOZ</option>
	        			<option value="PSR">PSR</option>
	        		</select>
	        		<button type="submit" style="border: none;color: black;" name="pqo">
	        			Registro de PAQO
	        		</button>
        	</div>
            <div style="height:500px;overflow-y:scroll;">
                <table class="table">
                    <tr>
                    	<th></th>
                    	<th></th>
                        <th>FOLIO PISA</th>
                        <th>FECHA DE CIERRE</th>
                        <th>SUPERVISOR</th>
                        <th>TECNICO</th>
                        <th>TIPO DE ORDEN</th>
                        <!--<th>PAGADO</th>-->
                        <th>SELECCIONA</th>
                    </tr>
                    <?php
                    //$sql="SELECT * FROM os inner join dataos inner join validar_os where id_folio_pisa=folio_pisa and idmos=id_orden and paqo='' ";
                    $sql="SELECT * from os inner join dataos inner join validar_os where idmos=id_orden and folio_pisa=id_folio_pisa and folio_pisa<>0 and paqo='' and estatus=2";
                    	$contar=0;
				       
//				        $sql="SELECT * FROM os inner join dataos where idmos=id_orden and estatus=2 ORDER BY mmos DESC, yearos DESC, ddos DESC";
				        //$sql="SELECT * FROM os inner join dataos where idmos=id_orden and estatus=2 and mmos=10 and ddos=19 ORDER BY mmos DESC, yearos DESC, ddos DESC";
				        $resultado=$con->query($sql);
				        while($row = $resultado->fetch_assoc())
				        {
				        	$idmos=$row['idmos'];
				        	$folio_pisa=$row['folio_pisa'];
				        	$tipo_os=$row['tipo_os'];
				        	$ddos=$row['ddos'];
				        	$mmos=$row['mmos'];
				        	$yearos=$row['yearos'];
				        	$horaos=$row['horaos'];
				        	$supervisor_idu=$row['supervisor_idu'];
				        	$tecnico_asignado_idu=$row['tecnico_asignado_idu'];

				        	$fecha_sup=$row['fecha_sup'];
				        	$fecha_calidad=$row['fecha_calidad'];
				        	$fecha_coordinador=$row['fecha_coordinador'];
				        	$fecha_cobranza=$row['fecha_cobranza'];
				        	$a_cobro=$row['a_cobro'];
				        	?>

				        	<?php

					        $sql2="SELECT * FROM usuario WHERE idu='$supervisor_idu'";
					        $resultado2=$con->query($sql2);
					        while($row2 = $resultado2->fetch_assoc())
					        {
					        	$noms=$row2['nombre'];
					        	$apats=$row2['apaterno'];
					        	$amats=$row2['amaterno'];
					        }

					        $sql3="SELECT * FROM usuario WHERE idu='$tecnico_asignado_idu'";
					        $resultado3=$con->query($sql3);
					        while($row3 = $resultado3->fetch_assoc())
					        {
					        	$nomt=$row3['nombre'];
					        	$apatt=$row3['apaterno'];
					        	$amatt=$row3['amaterno'];
					        }
					        /*
					        if($folio_pisa=='' or $folio_pisa=='0'){
					        }else{
					        	*/
					        	//echo $folio_pisa."- ";
					        	//echo $idmos;
					        	?>
					        	<tr>

				        			<?php
				        			/*
				        			$con4 = Conectarse();
							        $sql4="SELECT * FROM validar_os WHERE id_folio_pisa='$folio_pisa'";
							        $resultado4=$con4->query($sql4);
							        while($row4 = $resultado4->fetch_assoc())
							        {
							        	$fecha_sup=$row4['fecha_sup'];
							        	$fecha_calidad=$row4['fecha_calidad'];
							        	$fecha_coordinador=$row4['fecha_coordinador'];
							        	$fecha_cobranza=$row4['fecha_cobranza'];
							        	$a_cobro=$row4['a_cobro'];
							        }*/
							        if(isset($fecha_cobranza) ){
							        $contar=$contar+1;
							        	?>
							        	<td><?php echo $contar;?></td>
							        	<td><button type="button" class="btn btn-info btn-md bntmodal myBtn" name="valor" data-id="<?php echo $idmos;?>" value="<?php echo $folio_pisa;?>">VER</button></td>
						        		<!--<td><button type="button" class="btn btn-success openBtn" data-id="<?php echo $idmos;?>" id="idmos">Open Modal</button></td>-->
						        		<td><?php echo $folio_pisa;?></td>
						        		<td><?php echo $ddos."/".$mmos."/".$yearos." ".$horaos;?></td>
						        		<td><?php echo $noms." ".$apats." ".$amats;?></td>
						        		<td><?php echo $nomt." ".$apatt." ".$amatt;?></td>
						        		<td><?php echo $tipo_os;?></td>
							        	<!--<td><span class="glyphicon glyphicon-thumbs-up btn btn-success" aria-hidden="true" title="<?php echo $fecha_cobranza;?>"> <?php echo $fecha_cobranza;?></span></td>-->
							        	<td align="center"><input type="checkbox" name="array_selecion[]" value="<?php echo $folio_pisa;?>"></td>
							        	<?php
							        }
							        unset($fecha_sup);
							        unset($fecha_calidad);
							        unset($fecha_coordinador);
							        unset($fecha_cobranza);
				        			?>
					        	</tr>
					        	<?php

				        	//}
				        }
                    ?>
                </table>
            </div>
            </form>
        </div>
        <div class="col-md-12" align="center">
          	<!--<label>TOTAL: <?php echo $contar;?></label>-->
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade myModal" id="" role="dialog" style="width:100% !important;">
<div class="modal-dialog modal-lg">

  <!-- Modal content-->
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
	    var idmos=$(this).data("id");
	    console.log(idmos);
	    $('.modal-body').load('getContentPago.php?idmos='+idmos,function(){
	        $('.myModal').modal({show:true});
	    });
	});
});
</script>

<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
</body>
</html>
