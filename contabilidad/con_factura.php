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
        
        ?>
	</div>
    <div class="panel panel-primary">
        <div class="panel-heading">
        	<h3>PAQO SIN FACTURA</h3>
        	<br>
        	<h4>Para realizar una busqueda presiona CTRL + F y coloca el folio pisa que requieres.</h4>
        	<!--
        	<a href="downloadExcelSPQO.php" target="_blank"><button class="btn btn-success">DESCARGA</button></a>
        	<a href="downloadExcelSPQO.php?operacion=1" target="_blank"><button class="btn btn-success">DESCARGA FIBRA</button></a>
        	<a href="downloadExcelSPQO.php?operacion=2" target="_blank"><button class="btn btn-success">DESCARGA OTROS</button></a>
        	<a href="downloadExcelSPQO.php?operacion=3" target="_blank"><button class="btn btn-success">DESCARGA NORMAL</button></a>
        	-->
        </div>
        <div class="panel-body table-responsive" style="font-size:12px;">
        <!--
        	<form action="procesa_paqo.php" method="POST">
            <div align="center" style="background-color:gray;color: black;">
	        		<label><?php echo $dia."/".$mes."/".$aaaa;?></label>
	        		<input type="text" name="paqo" placeholder="INGRESA No DE PAQO" style="font-size:12pt;">

	        		<button type="submit" style="border: none;color: black;" name="pqo">
	        			Registro de FACTURA
	        		</button>
        	</div>
        -->
            <div style="height:500px;overflow-y:scroll;">            	
                <table class="table">
                    <tr>
                    	<th>PAQO</th>
                    	<th>NO DE OS</th>  
                        <th>FACTURA(S)</th>
                        <th></th>
                    </tr>
                    <?php
                    $sql="SELECT DISTINCT paqo from  validar_os where paqo<>'' and factura_os='' ORDER BY paqo";
                    
				        $con1 = Conectarse();
				        $resultado=$con1->query($sql);
				        while($row = $resultado->fetch_assoc())
				        {
				        	$pqo=$row['paqo'];
				        	$sqls="SELECT * from  validar_os  where  paqo like '%$pqo%'";
	                    	$contar=0;
					        $cons = Conectarse();
					        $resultados=$cons->query($sqls);
					        while($rows = $resultados->fetch_assoc())
					        {
					        	$contar++;
					        }
				        	?>
				        	<tr>
				        	<form action="procesa_factura" method="POST">
				        		<input type="hidden" name="paqo" value="<?php echo $row['paqo'];?>">
					        	<th><b style="font-size:12pt;"><?php echo $row['paqo'];?></b></th>
					        	<td><?php echo $contar;?></td>
					        	<td><input type="text" name="factura" placeholder="Ingresa factura(s)" style="font-size:12pt;"></td>
					        	<td>
					        		<button type="submit" style="border: none;color: black;">
					        			Registro de FACTURA
					        		</button>
					        	</td>
					        </form>
				        	</tr>	
				        	<?php
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


<script src="../js/bootstrap.min.js"></script>
<script src="../js/menu.js"></script>
</body>
</html>