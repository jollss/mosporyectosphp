<?php

date_default_timezone_set('America/Mexico_City');
$dia=date('j');
$mes=date('n');
$aaaa=date('Y');
$hora=date('G');
$min=date('i');
$seg=date('s');

$name=$dia.$mes.$aaaa.$hora.$min.$seg;
$upload_dir = "fotos/";
$img = $_POST['hidden_data'];
$user=$_POST['user'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);





$file = $upload_dir . $user."-".$name . ".png";
$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';
?>