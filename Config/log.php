<?php
//include("conexion2.php");  
//require_once 'conexion.php'; 
//$con = Conectarse();
    $nombre_archivo = "log/login.txt"; 
    $logout = "log/logout.txt"; 
    $logErrors = "log/logError.txt"; 
    function getRealIP() {
		    if (!empty($_SERVER['HTTP_CLIENT_IP']))
		    return $_SERVER['HTTP_CLIENT_IP'];
		    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
		    return $_SERVER['HTTP_X_FORWARDED_FOR'];
		    return $_SERVER['REMOTE_ADDR'];
	}
	function detect()
	{
		$browser=array("IE","OPERA","MOZILLA","NETSCAPE","FIREFOX","SAFARI","CHROME");
		$os=array("WIN","MAC","LINUX");
		$info['browser'] = "OTHER";
		$info['os'] = "OTHER";
		foreach($browser as $parent)
		{
			$s = strpos(strtoupper($_SERVER['HTTP_USER_AGENT']), $parent);
			$f = $s + strlen($parent);
			$version = substr($_SERVER['HTTP_USER_AGENT'], $f, 15);
			$version = preg_replace('/[^0-9,.]/','',$version);
			if ($s)
			{
				$info['browser'] = $parent;
				$info['version'] = $version;
			}
		}
		foreach($os as $val)
		{
			if (strpos(strtoupper($_SERVER['HTTP_USER_AGENT']),$val)!==false)
				$info['os'] = $val;
		}
		return $info;
	}
    function logIn($nombre_archivo,$usuario,$correo,$B){
    	$log='log/log.csv';
    	/*==IP=======================================*/
        $ntipo=$B;
		/*==============================================*/
	    if(file_exists($nombre_archivo))
	    {
	    	date_default_timezone_set('America/Mexico_City');
	    	$ip=getRealIP();
	    	$info=detect();
	        $mensaje = $ip."-[Get in] ".$usuario."[".date("d m Y H:m:s")."]"."-mail:".$correo."-[OS ".$info["os"]."]-[ browser ".$info["browser"]."]-[ version ".$info["version"]."]";
	        $mensaje2 = $ip.",[INGRESO] ,".$usuario.",".$ntipo.",[".date("d m Y H:m:s")."],".$correo.",[".$info["os"]."],[".$info["browser"]."],[".$info["version"]."]";
	    }else
	    {
	    	date_default_timezone_set('America/Mexico_City');
	    	$ip=getRealIP();
	    	$info=detect();
	        $mensaje = $ip."-[Get in] ".$usuario."[".date("d m Y H:m:s")."]"."-mail:".$correo."-[OS ".$info["os"]."]-[ browser ".$info["browser"]."]-[ version ".$info["version"]."]";
	        $mensaje2 = $ip.",[INGRESO] ,".$usuario.",".$ntipo.",[".date("d m Y H:m:s")."],".$correo.",[".$info["os"]."],[".$info["browser"]."],[".$info["version"]."]";
	    }
	    if($archivo = fopen($nombre_archivo, "a") AND $archivo2 = fopen($log, "a"))
	    {
	        if(fwrite($archivo,$mensaje. "\n") AND fwrite($archivo2,$mensaje2. "\n"))
	        {
	            return;
	        }
	        else
	        {
	            return;
	        }
	        fclose($archivo);
	        fclose($archivo2);
	    }
    }
    function logOut($logout,$usuario,$correo,$B){
    	$log='log/log.csv';
    	/*==IP=======================================*/
	    $ntipo=$B;
		/*==============================================*/
	    if(file_exists($logout))
	    {
	    	date_default_timezone_set('America/Mexico_City');
	    	$ip=getRealIP();
	    	$info=detect();
	        $mensaje = $ip."-[Get out] ".$usuario."[".date("d m Y H:m:s")."]"."-mail:".$correo."-[OS ".$info["os"]."]-[ browser ".$info["browser"]."]-[ version ".$info["version"]."]";
	        $mensaje2 = $ip.",[SALIDA] ,".$usuario.",".$ntipo.",[".date("d m Y H:m:s")."]".",".$correo.",[".$info["os"]."],[".$info["browser"]."],[".$info["version"]."]";
	    }else
	    {
	    	date_default_timezone_set('America/Mexico_City');
	    	$ip=getRealIP();
	    	$info=detect();
	        $mensaje = $ip."-[Get out] ".$usuario."[".date("d m Y H:m:s")."]"."-mail:".$correo."-[OS ".$info["os"]."]-[ browser ".$info["browser"]."]-[ version ".$info["version"]."]";
	        $mensaje2 = $ip.",[SALIDA] ,".$usuario.",".$ntipo.",[".date("d m Y H:m:s")."]".",".$correo.",[".$info["os"]."],[".$info["browser"]."],[".$info["version"]."]";
	    }
	    if($archivo = fopen($logout, "a") AND $archivo2 = fopen($log, "a"))
	    {
	        if(fwrite($archivo,$mensaje. "\n") and fwrite($archivo2,$mensaje2. "\n"))
	        {
	            return;
	        }
	        else
	        {
	            return;
	        }
	        fclose($archivo);
	        fclose($archivo2);
	    }
    }
    function logError($logErrors,$correo){
    	$log='log/log.csv';
    	/*==IP=======================================*/
	    
		/*==============================================*/
		/*
	    if(file_exists($logErrors))
	    {	
	    	date_default_timezone_set('America/Mexico_City');
	    	$ip=getRealIP();
	    	$info=detect();
	        $mensaje = $ip."-[Error] "."[".date("d m Y H:m:s")."]"."-mail:".$correo."-[OS ".$info["os"]."]-[ browser ".$info["browser"]."]-[ version ".$info["version"]."]";
	        $mensaje2 = $ip.",[ERROR DE INGRESO] ,".$usuario.",[".date("d m Y H:m:s")."]".",".$correo.",[".$info["os"]."],[".$info["browser"]."],[".$info["version"]."]";
	    }else
	    {
	    	date_default_timezone_set('America/Mexico_City');
	    	$ip=getRealIP();
	    	$info=detect();
	        $mensaje = $ip."-[Error] "."[".date("d m Y H:m:s")."]"."-mail:".$correo."-[OS ".$info["os"]."]-[ browser ".$info["browser"]."]-[ version ".$info["version"]."]";
	        $mensaje2 = $ip.",[ERROR DE INGRESO] ,".$usuario.",[".date("d m Y H:m:s")."]".",".$correo.",[".$info["os"]."],[".$info["browser"]."],[".$info["version"]."]";
	    }
	    if($archivo = fopen($logErrors, "a") and $archivo2 = fopen($log, "a"))
	    {
	        if(fwrite($archivo,$mensaje. "\n") and fwrite($archivo2,$mensaje2. "\n"))
	        {
	            return;
	        }
	        else
	        {
	            return;
	        }
	        fclose($archivo);
	        fclose($archivo2);
	    }*/
    }
    return;
 ?>