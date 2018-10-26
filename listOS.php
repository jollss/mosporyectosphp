<?php
$directorio = opendir("./os"); //ruta actual
while ($archivo = readdir($directorio)) //obtenemos un archivo y luego otro sucesivamente
{
    if (is_dir($archivo))//verificamos si es o no un directorio
    {
        echo "[".$archivo . "]<br />"; //de ser un directorio lo envolvemos entre corchetes
    }
    else
    {
        //echo $archivo . "<br />";
		?>
		
		<a href="/os/<?php echo $archivo;?>" target="_blank"><?php echo $archivo;?></a><br>
		<?php
    }
}
?>