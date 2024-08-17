<?php
$server = "localhost";
$usuario = "root";
$clave = "";
// $base = "RikMac";
 $base = "proyecto_horarios";
//$base = "gestion_horarios";

$conex = new mysqli($server,$usuario,$clave,$base);

// Check connection
if ($conex->connect_error) {
    die("Connection fallida: " . $conex->connect_error);
  }else{
    //echo "Connected exitossa";
  }
