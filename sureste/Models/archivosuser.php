<?php
/**
* 
*/
class Archivosuser extends Infuser
{
	
//Atributos
	var $idarchiuser;
	var $acta_na;
	var $comp_dom;
	var $comp_estudios;
	var $arch_curp;
	var $arch_licencia;
	var $fotos;
	var $est_socioeco;
	var $usuario_idus;
//Metodos
	public function obtenerasarchiUserBD($idus,$con){
		$sql1="SELECT * FROM archivosuser WHERE '$idus'=usuario_idus";
        $resultado=$con->query($sql1);
        while($row = $resultado->fetch_assoc())
        {
        	$this->idarchiuser=$row['idarchiuser'];
         	$this->acta_na=$row['acta_na'];
			$this->comp_dom=$row['comp_dom'];
			$this->comp_estudios=$row['comp_estudios'];
			$this->arch_curp=$row['arch_curp'];
			$this->arch_licencia=$row['arch_licencia'];
			$this->fotos=$row['fotos'];
			$this->est_socioeco=$row['est_socioeco'];
			$this->usuario_idus=$row['usuario_idus'];
        }
	}
	public function verarchiUserBD(){
    	echo $this->idarchiuser; echo "<br>";
     	echo $this->acta_na;echo "<br>";
		echo $this->comp_dom;echo "<br>";
		echo $this->comp_estudios;echo "<br>";
		echo $this->arch_curp;echo "<br>";
		echo $this->arch_licencia;echo "<br>";
		echo $this->fotos;echo "<br>";
		echo $this->est_socioeco;echo "<br>";
		echo $this->usuario_idus;echo "<br>";

	}
	public function regresaIdarchiuser(){return $this->idarchiuser;}
	public function regresaActaNa(){return $this->acta_na;}
	public function regresaCompDom(){return $this->comp_dom;}
	public function regresaCompEstudios(){return $this->comp_estudios;}
	public function regresaArchCurp(){return $this->arch_curp;}
	public function regresaArchLicencia(){return $this->arch_licencia;}
	public function regresaFotos(){return $this->fotos;}
	public function regresaEstSocioeco(){return $this->est_socioeco;}
	public function regresaUsuarioIdus(){return $this->usuario_idus;}
}
?>