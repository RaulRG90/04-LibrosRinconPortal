<?php
require_once("bd.php");

$id = $_GET["i"];
$a = $_GET["a"];
// /var/www/html/telesecundaria_prog/docs/
$dir_files_up = "../../assets/programacion_tele/" . $a;
$confirmar = $_GET["c"];
$borrar_reg = "";

if($confirmar != "si"){
// Realizar una consulta MySQL Buscar elementos 1 ::::::::::::::::::
$query = "SELECT * FROM ".$tablas_prog." WHERE id_recurso = '".$id."'";
$result = pg_query($enlace, $query) or die('Consulta fallida: '.pg_last_error());
// Imprimir los resultados en HTML
while ($registro = pg_fetch_array($result)){
	$nombre = $registro["nombre_contenido"];
}
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>BORRAR</title>
<style type="text/css">
body,td,th {
	font-family: Arial, Helvetica, sans-serif; text-align:center;
}
</style>
</head>

<body>
<h3>¿Deseas borrar el elemento?</h3>  <h2><?php echo $nombre; ?></h2>
<p>&nbsp;</p>
<p><a href="borrar.php?i=<?php echo $id; ?>&c=si">SI, BORRAR</a></p>
<p>&nbsp;</p>
<p><a href="editar.php">NO, REGRESAR</a></p>
</body>
</html>
<?php }else{
	
	if (file_exists($dir_files_up)) {
    	$borrar_arch = unlink($dir_files_up);
		if($borrar_arch){
			$borrar_reg = "ok";
		}
	}else{$borrar_reg = "ok";}
	
	
	if($borrar_reg == "ok"){
	// BORRAR CONTENIDO ESPECÍFICO
	$sql =  "DELETE FROM ".$tablas_prog." WHERE id_recurso = '".$id."'"; 
	$borrando = pg_query($enlace,$sql);
		if($borrando){ 
			$borrado_ok = "Location: index.php?b=si"; 
		}else{ 
			$borrado_ok = "Location: index.php?b=no2"; 
		}
		
	}else{
		$borrado_ok = "Location: index.php?b=no";
	}
	
	header($borrado_ok);
	die();
		
} ?>