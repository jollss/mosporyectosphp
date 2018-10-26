<?php
/**
* 
*/
class Checklist
{
//Atributos
	var $idchek;
	var $idors;
	var $idus;
	var $revisado;
//Metodos
	public function execute($query){
	      $con = Conectarse();  
	      return mysqli_query($con,$query);
	}
	public function ultimoChecklist($con){
		$tos=0;
		$con->real_query("SELECT * FROM checklist");
	    $resultado = $con->use_result();
	    while ($row = $resultado->fetch_assoc()){
	        $tos++;
	    }
	    return $tos;
	}
	public function ingresaChecklist($idchek,$idors,$idus){
		$this->idchek=$idchek;
		$this->idors=$idors;
		$this->idus=$idus;
		$this->revisado=0;
	}
	public function registroChecklistBD($con){
		  $sql="INSERT INTO checklist (
          idchek,idors,idus,
          revisado)
          VALUES
          ('".$this->idchek."','".$this->idors."','".$this->idus."',
          	'".$this->revisado."'
            )"; 
          $this->execute($sql) or die (mysqli_error($con)); 
	}
	public function regresaIdcheck(){return $this->idchek;}
	public function regresaIdors(){return $this->idors;}
	public function regresaIdus(){return $this->idus;}
	public function regresaRevisado(){return $this->revisado;}
}
?>