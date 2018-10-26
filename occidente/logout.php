<?php
include("Config/log.php"); 
  session_start();
  logOut($logout,$_SESSION['username'],$_SESSION['mail'],'0');
  $_SESSION = array();
  if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
	}
  
  session_destroy();
  
  
  header("Location: index.html");
  exit;
?>