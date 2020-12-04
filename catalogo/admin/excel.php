<?php $fechar = date("Y-m-d-H-i-s");
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=CatalogoLDR-".$fechar.".xls");
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
  </tr>
<?php 
function celdas($c,$f){if($f=="x"){$f="";}else{$f=" style='".$f."'";}echo"<td".$f.">".$c."</td>";} 
function imgescx($img){ // Funcion checar si existe imagen en la ubicación y codificarla en base 64 para insertarla en el html
	$rimg = "../portadas_ce/". $img .".jpg";
	if (file_exists($rimg)) { 
	$reimg = base64_encode(file_get_contents($rimg));
	return "<img src='data:image/jpeg;base64,".$reimg."' class='style3' />"; }
}
function imgesc($img){
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
}

$msonf = array( 'x', 
'mso-number-format:"0"', //                 1 Sin Decimales
'mso-number-format:"0.00"', //              2   02 Decimals
'mso-number-format:"#,##0.000"', //         3     Coma separadora de miles y 03 decimales
'mso-number-format:"mm/dd/yy"', //          4    Formato de Fecha Completa
'mso-number-format:"mmmm d, yyyy"', //      5     Formato de Fecha Literal
'mso-number-format:"m/d/yy h:mm AM/PM"', // 6       Formato de Fecha Corta con Hora y AM/PM
'mso-number-format:"Short Date"', //        7      Formato de Fecha Corta
'mso-number-format:"Medium Date"', //       8       Formato de Fecha Mediana
'mso-number-format:"d-mmm-yyyy"', //        9      Fecha Mediana separada por guiones
'mso-number-format:"Short Time"', //        10      Formato corto de hora
'mso-number-format:"Medium Time"', //       11    Formato mediana de hora
'mso-number-format:"Long Time"', //         12     Formato de Hora Larga
'mso-number-format:"Percent"', //           13   Porcentaje con 02 decimales
'mso-number-format:"0%"', //                14   Porcentaje sin decimale
'mso-number-format:"0.E+00"', //            15     Notación Cientifica
'mso-number-format:"@"', //                 16   Texto
'mso-number-format:"# ???/???"', //         17       Fracciones - de 3 dígitos a más (312/943)
'mso-number-format:"0022£0022#,##0.00"', // 18          Formato de Moneda (Libras Esterlinas)
'mso-number-format:"#,##0.00_ ;[Red]-#,##0.00"'); //  19   Formato de Número con negativos en rojo y signo -

while ($registro = pg_fetch_array($result)){
	echo"<tr>";
	celdas($registro['estatus'],$msonf[16]);
	celdas($registro['id_recurso'],$msonf[0]);
	celdas($registro['isbn'],$msonf[16]);
	celdas($registro['titulo'],$msonf[16]);
	celdas($registro['titulo_original'],$msonf[16]);
	
	celdas($registro['autor'],$msonf[16]);
	celdas($registro['ilustrador'],$msonf[16]);
	celdas($registro['traductor'],$msonf[16]);
	celdas($registro['pub_lugar'],$msonf[16]);
	celdas($registro['pub_editorial'],$msonf[16]);
	
	celdas(str_replace(",", ", ", $registro['pub_anios']),$msonf[16]);
	celdas($registro['pub_paginas'],$msonf[0]);
	celdas($iden["nivel_escolar"][$registro['nivel_escolar']],$msonf[16]);
	celdas($iden["acervo"][$registro['acervo']],$msonf[16]);
	celdas($iden["grado"][$registro['grado']],$msonf[16]);

	//echo "<!-- L:".$registro['lenguaje']." -->";
		if($registro['lenguaje'] < 100){$idt = "idioma";}else{$idt = "estados";}
	celdas($iden[$idt][$registro['lenguaje']],$msonf[16]);
	celdas($iden["genero"][$registro['genero']],$msonf[16]);
	celdas($iden["serie"][$registro['serie']],$msonf[16]);
	celdas($iden["categoria"][$registro['categoria']],$msonf[16]);
	celdas($registro['keywords'],$msonf[16]);
	
	celdas($registro['resena'],$msonf[16]);
	celdas($registro['fecha_alta'],$msonf[16]);
	celdas($registro['fecha_modificacion'],$msonf[16]);
	echo"</tr>";
}?>
</table>
</body>
</html>