<?php

include "connexion.php";

$path = $_GET['path'];

header('Content-Type: application/octet-stream');  
header("Content-Transfer-Encoding: utf-8");   
header("Content-disposition: attachment; filename=\"" . basename($path) . "\"");   
readfile($path);  
 
?>