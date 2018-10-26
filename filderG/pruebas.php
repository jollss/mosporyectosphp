<?php
include("../Config/library.php");
$idos=2;
$con = Conectarse(); 
$Total=new Usuario();
$totalU=$Total->TotalUsuariosActivosBD($con);
$cantidad=new Ventas();
$totalV=$cantidad->totalVentasFull($con);
$aux=0;
for ($n=0; $n <= $totalU; $n++) {     
    $Usuario=new Usuario();
    $Usuario->obtenerUsuarioBD($n,$con);
    $tipo=$Usuario->regresaTipoIdTipo();
    $idUsuario=$Usuario->regresaIdu();
    $no=$Usuario->regresaNombre();
    $ap=$Usuario->regresaApaterno();
    $am=$Usuario->regresaAmaterno();
    if($tipo==21 or $tipo==4 or $tipo==23 or $tipo==22 or $tipo==24){
        $aux2=0;
        for ($i=0; $i <= $totalV ; $i++) {
            $cantidad->obtenerVentaBD($i,$con);
            $v=$cantidad->regresaVendedor();
            if($v==$idUsuario){
                $aux2=$aux2+1;
            }
        }
        echo "
                    {
                        name: '".$no."',
                        y: ".$aux2."
                    },";
    }
}
?>