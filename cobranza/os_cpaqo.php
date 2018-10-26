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

<div class="col-md-12">
<a href="listpaqo.php" target="_blank"><button>OS CON PAQO</button></a>
	<form action="os_cpaqo.php" method="GET">
		<input type="text" class="form-control" name="paqo_search" placeholder="INGRESA PAQO A BUSCAR">
		<button class="btn btn-primary" type="submit">
			BUSCAR
		</button>
	</form>
	<a href="os_cpaqo.php">
	<button class="btn btn-success">
		LISTADO COMPLETO
	</button>
	</a>
	<div>
        <?php
        if(isset($_GET['paqo_search'])){
        	$pqo=$_GET['paqo_search'];
        	?>
        	<form action="downloadExcelCPQO.php" method="GET" target="_blank">
				<input type="hidden" name="pqo" value="<?php echo $pqo;?>">
				<button type="submit" class="btn btn-danger">
					DESCARGA
				</button>
			</form>
        	<?php
        }
        ?>
	</div>
</div>
<div class="col-md-12">
<?php
$dia=date('d');
$mes=date('n');
$aaaa=date('Y');
$sql="";
 	if(!isset($_GET['mes']) and !isset($_GET['anio'])){
 		$dia=date('d');
    	$mes=date('n');
    	$aaaa=date('Y');
    	$fecha_pago=$dia."/".$mes."/".$aaaa;
    	$sql="SELECT * FROM os
    	inner join validar_os inner join dataos
    	where id_folio_pisa=folio_pisa and idmos=id_orden and paqo<>'' ";
    }
    if(isset($_GET['paqo_search'])){
    	$pqo=$_GET['paqo_search'];
    	$sql="SELECT * FROM validar_os
    	where paqo like '%$pqo%'";
    }

?>
<?php
        if($mes<>'' and isset($mes)){
        ?>
        	<form action="downloadCobranza.php" method="POST" target="_blank">
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
    <div class="panel panel-primary">
        <div class="panel-heading">
        	<h3>ORDENES DE SERVICIO CON PAQO</h3>
        	<br>
        	<h4>Para realizar una busqueda presiona CTRL + F y coloca el folio pisa que requieres.</h4>

        </div>
        <div class="panel-body table-responsive" style="font-size:12px;">

            <div style="height:500px;overflow-y:scroll;">
                <table class="table">
                    <tr>
                    	<th></th>
                    	<th></th>
                        <th>FOLIO PISA</th>
                        <th>SUPERVISOR</th>
                        <th>TECNICO</th>
                        <!--<th>PAGADO</th>-->
                        <th>PAQO</th>
                        <th>TIPO PAQO</th>
                        <th>FACTURA</th>
                    </tr>
                    <?php
                    //echo $sql;
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
				        	$supervisor_idu=$row['usuario_idu'];
				        	$tecnico_asignado_idu=$row['asignado'];
				        	$pisa=$row['id_folio_pisa'];
				        	//echo "IDMOS-".$idmos."-<br>";
				        	if(!isset($idmos) or $idmos==0 or $idmos==NULL or $idmos==''){
				        		$con21 = Conectarse();
						        $sql21="SELECT * FROM os  WHERE '$pisa'=folio_pisa";
						        //echo "enrto";
						        $resultado21=$con21->query($sql21);
						        while($row21 = $resultado21->fetch_assoc())
						        {
						        	$idmos=$row21['idmos'];
						        	$folio_pisa=$row21['folio_pisa'];
						        	$tipo_os=$row21['tipo_os'];
						        	$ddos=$row21['ddos'];
						        	$mmos=$row21['mmos'];
						        	$yearos=$row21['yearos'];
						        	$horaos=$row21['horaos'];
						        	$supervisor_idu=$row21['usuario_idu'];
						        	$tecnico_asignado_idu=$row21['asignado'];
						        }
				        	}

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
					        if(!isset($noms) or !isset($apats) or !isset($amats)){
					        	$noms='';
					        	$apats='';
					        	$amats='';
					        }if(!isset($nomt) or !isset($apatt) or !isset($amatt)){
					        	$nomt='';
					        	$apatt='';
					        	$amatt='';
					        }
					        //echo "<br>".$folio_pisa."-----".$noms."---".$nomt;
					        if($folio_pisa=='' or $folio_pisa=='0'){
					        }if($folio_pisa!='' or $folio_pisa!='0'){
					        	//echo $folio_pisa."- ";
					        	//echo $folio_pisa;
					        	?>
					        	<tr>

				        			<?php
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
							        	$paqo=$row4['paqo'];
							        	$tipo_paqo=$row4['tipo_paqo'];
							        	$factura=$row4['factura_os'];
							        }
							        if(isset($paqo) and isset($tipo_paqo) and $folio_pisa<>0 and $folio_pisa<>''){
							        	//echo "string";
							        $contar=$contar+1;
							        	?>
							        	<td><?php echo $contar;?></td>
							        	<td><button type="button" class="btn btn-info btn-md bntmodal myBtn" name="valor" data-id="<?php echo $idmos;?>" value="<?php echo $folio_pisa;?>">VER</button></td>
						        		<!--<td><button type="button" class="btn btn-success openBtn" data-id="<?php echo $idmos;?>" id="idmos">Open Modal</button></td>-->
						        		<td><?php echo $folio_pisa;?></td>
						        		<td><?php echo $noms." ".$apats." ".$amats;?></td>
						        		<td><?php echo $nomt." ".$apatt." ".$amatt;?></td>
							        	<!--<td><span class="btn btn-default"> <?php echo $fecha_cobranza;?></span></td>-->
							        	<td><?php echo $paqo;?></td>
							        	<td><?php echo $tipo_paqo;?></td>
							        	<td><?php echo $factura;?></td>
							        	<!--<td align="center"><input type="checkbox" name="array_selecion[]" value="<?php echo $folio_pisa;?>"></td>-->
							        	<?php
							        }
							        unset($fecha_sup);
							        unset($fecha_calidad);
							        unset($fecha_coordinador);
							        unset($fecha_cobranza);
				        			?>
					        	</tr>
					        	<?php

				        	}
				        }
                    ?>
                </table>
            </div>
            <!--</form>-->
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
