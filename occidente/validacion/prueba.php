<table border="5">
<?php
include("../Config/library.php");
$idos=2;
$con = Conectarse(); 
date_default_timezone_set('America/Mexico_City');
$cnxe = Conectarse(); 
$tos=0;
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$venta=0;
$sql="SELECT * FROM areas_fielder order by nom_area DESC";
$resultado=$con->query($sql);
while($row = $resultado->fetch_assoc())
{
    $idarea=$row['idarea'];
    $nom_area=$row['nom_area'];
    $con2 = Conectarse(); 
    $venta=0;
    $ventaV=0;
    $sql2="SELECT * FROM equipos_fielder WHERE id_area='$idarea'";
    $resultado2=$con2->query($sql2);
    while($row2 = $resultado2->fetch_assoc())
    {
        $id_fielder=$row2['id_fielder'];
        $cnxe->real_query("SELECT * FROM ventas  
            WHERE idvendedor='$id_fielder'
            order by idventa");
        $result = $cnxe->use_result();
        while ($line = $result->fetch_assoc()){
            $venta=$venta+1;
        }
        $cnxe->real_query("SELECT * FROM ventas inner join tienda_comercial  
            WHERE idvendedor='$id_fielder' and id_venta=idventa
            order by idventa");
        $result = $cnxe->use_result();
        while ($line = $result->fetch_assoc()){
            $ventaV=$ventaV+1;
        }
        $RESTANTE=$venta-$ventaV;
    }
     echo " <tr>
            <td style='font-size:10px;' width='20%'>".$nom_area."</td>
            <th style='font-size:12px' width='20%'>".$venta."</th>
            <th style='font-size:12px' width='20%'>".$ventaV."</th>
            <th style='font-size:12px' width='20%'>".$RESTANTE."</th>
            </tr>";
    
}
?>
</table>