<?php  
$demo = false;
if($demo){ // Wiki
$host_bd_prog ="localhost";
$puerto_bd_prog = "5432";
$bd_prog = "catalogo_electronico_2016";//"catalogo_ldr_2016";
$tablas_prog = "catalogo_ldr";
$usuario_prog ="ivan";
$pass_prog="dgme";
}else{ // Productivo
$host_bd_prog ="localhost";
$puerto_bd_prog = "5432";
$bd_prog = "catalogo_electronico_2016";
$tablas_prog = "catalogo_ldr";
$usuario_prog ="based";
$pass_prog="Yes02bsd4000";
}

//$enlace = pg_connect("host=". $host_bd_sea ." dbname=". $bd_sea ." user=". $usuario_sea ." password=". $pass_sea) or die('no se puede conectar: ' . pg_last_error());
$enlace = pg_connect("host=". $host_bd_prog ." port=". $puerto_bd_prog ." dbname=". $bd_prog ." user=". $usuario_prog ." password=". $pass_prog)  or die ("Error de conexion. ". pg_last_error());
?>