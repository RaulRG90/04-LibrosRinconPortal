<?php $fechar = date("Y-m-d-H-i-s");
header("Content-Type: text/plain");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=CatalogoLDR-".$fechar.".html");
require_once("bd.php");
require_once("identificadores.php");

$query = "SELECT * FROM ".$tablas_prog." ORDER BY titulo ASC";
$result = pg_query($enlace, $query) or die('Consulta fallida: '.pg_last_error());
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Catálogo Libros del Rincón</title>
<style type=”text/css”>
.style1 {
font-family: Verdana, Arial, Helvetica, sans-serif;
font-weight: bold;
}
.style2 {font-family: Verdana, Arial, Helvetica, sans-serif}
</style>
</head>
<body>
<table border="1">
  <tr>
    <th scope="col">ESTATUS</th>
    <th scope="col">ID</th>
    <th scope="col">ISBN</th>
    <th scope="col">Título</th>
    <th scope="col">Título Original</th>
    
    <th scope="col">Autor</th>
    <th scope="col">Ilustrador</th>
    <th scope="col">Traductor</th>
    <th scope="col">Publicación: Lugar</th>
    <th scope="col">Publicación: Editorial</th>
    
    <th scope="col">Publicación: Ediciones</th>
    <th scope="col">Publicación: Páginas</th>
    <th scope="col">Nivel</th>
    <th scope="col">Acervo</th>
    <th scope="col">Grado</th>
    
    <th scope="col">Lengua/Región</th>
    <th scope="col">Género</th>
    <th scope="col">Serie</th>
    <th scope="col">Categoría</th>
    <th scope="col">Temas</th>
    
    <th scope="col">Reseña</th>
    <th scope="col">Creación</th>
    <th scope="col">Modificación</th>
    <th scope="col">Portada</th>
    <th scope="col">Int 1</th>
    <th scope="col">Int 2</th>
  </tr>
<?php 
function celdas($c){echo"<td>".$c."</td>";} 
function imgesc($img){ // Funcion checar si existe imagen en la ubicación y codificarla en base 64 para insertarla en el html
	$rimg = "../portadas_ce/". $img .".jpg";
	if (file_exists($rimg)) { 
	$reimg = base64_encode(file_get_contents($rimg));
	return "<img src='data:image/jpeg;base64,".$reimg."' class='style3' />"; }
}
/*function imgesc($img){
	//return dirname(__FILE__)."";
	$host  = $_SERVER['HTTP_HOST'];
	$uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
	$base = "http://" . $host . $uri . "/";
	$rutaadmin = $base."".$img.".jpg";
	
	$ruta = str_replace("admin", "portadas_ce", $rutaadmin);
	
	$rimg = "../portadas_ce/". $img .".jpg";
	
	if (file_exists($rimg)) {
		return "<img src='".$ruta."' />";
	}
}*/

while ($registro = pg_fetch_array($result)){
	echo"<tr>";
	celdas($registro['estatus']);
	celdas($registro['id_recurso']);
	celdas($registro['isbn']);
	celdas($registro['titulo']);
	celdas($registro['titulo_original']);
	
	celdas($registro['autor']);
	celdas($registro['ilustrador']);
	celdas($registro['traductor']);
	celdas($registro['pub_lugar']);
	celdas($registro['pub_editorial']);
	
	celdas(str_replace(",", ", ", $registro['pub_anios']));
	celdas($registro['pub_paginas']);
	celdas($iden["nivel_escolar"][$registro['nivel_escolar']]);
	celdas($iden["acervo"][$registro['acervo']]);
	celdas($iden["grado"][$registro['grado']]);
	//echo "<!-- L:".$registro['lenguaje']." -->";
		if($registro['lenguaje'] < 100){$idt = "idioma";}else{$idt = "estados";}
	celdas($iden[$idt][$registro['lenguaje']]);
	celdas($iden["genero"][$registro['genero']]);
	celdas($iden["serie"][$registro['serie']]);
	celdas($iden["categoria"][$registro['categoria']]);
	celdas($registro['keywords']);
	
	celdas($registro['resena']);
	celdas($registro['fecha_alta']);
	celdas($registro['fecha_modificacion']);
	celdas(imgesc($registro['id_recurso']));
	celdas(imgesc($registro['id_recurso']."_int1"));
	celdas(imgesc($registro['id_recurso']."_int2"));
	//celdas($registro['pub_edicion']);
	
	
echo"</tr>";
}?>
</table>
</body>
</html>