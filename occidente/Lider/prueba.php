<?php
include("../Config/library.php");
$idos=2;
$con = Conectarse(); 
echo "Os:".$idos."<br>";
            $foto=new Adjunto_os();
            $totaladjuntos=$foto->TotalAdjuntosBD($con);
            echo "Total de adjuntos".$totaladjuntos."<br>";
            for ($i=0; $i <=$totaladjuntos; $i++) { 
                //echo "valor de i:".$i."<br>";
                $fotos=new Adjunto_os();
                $fotos->obtenerAdjuntoOsBD($i,$con);
                $idadjunto=$fotos->regresaOsIdos();
                //echo "Id:".$idadjunto."<br>";
                if($idadjunto==$idos){
                $imagen=$fotos->regresaNombreImg();
                
                ?>
                    <a href="../os/<?php echo $imagen;?>" target="_blank">
                        <?php echo $imagen; ?>
                        <img src="../syspic/see.png" width="20" height="20">
                    </a>
                <?php
                
                }
            }
?>