<!DOCTYPE html>
<html>
<head>
  <title>Admin</title>
    <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="css/estilos.css"  media="all"/>
      <style type="text/css">
      .margen_l { margin-left:50px !important;}
	  .listado_contenidos h3 { margin:0; }
	  h3{ margin:0;}
	  .mayusculas { text-transform:uppercase;}
      </style>

      <!--Let browser know website is optimized for mobile-->
    <script>
		function validate(form) {return confirm('¿Los datos son correctos?');}
        function justNumbers(e) { // 1
			tecla = (document.all) ? e.keyCode : e.which; // 2
			if (tecla==8) return true; // 3
			 if (tecla==9) return true; // 3
			 if (tecla==11) return true; // 3
			 if (tecla==46) return true; // 3
			patron = /[1234567890,dD]/; // 4
		 
			te = String.fromCharCode(tecla); // 5
			return patron.test(te); // 6
        }
    </script>
    <script src="ckeditor/ckeditor.js"></script>
    <script src="js/jquery/2.1.3/jquery.min.js"></script>
</head>

<body>
<?php 
$queryw = "";
if($_GET){if($_GET["b"] == "si"){  ?>
<script type="text/javascript">window.addEventListener('load', function(){ Materialize.toast('Se ha borrado el contenido con éxito', 4000); }, false);</script>
<?php }else{
	if($_GET["buscar"] || $_GET["p"]){
		$buscando = $_GET["buscar"];
		$queryw = " WHERE isbn LIKE '%".$buscando."%' ";
	}else{ ?>
<script type="text/javascript">window.addEventListener('load', function(){ Materialize.toast('ERROR al borrar el contenido', 4000); }, false);</script>
<?php }}} ?>
<?php 
require_once("bd.php");
require_once("identificadores.php");
$pagina = $_GET["p"];
//PÁGINAS - Limito la busqueda
$tamanopag = 50;
//examino la página a mostrar y el inicio del registro a mostrar
if (!$pagina) {
   $inicio = 0;
   $pagina = 1;
}else {$inicio = ($pagina - 1) * $tamanopag;}

?>
<h1 style="text-align:center;">Catálogo Libros del Rincón <br />
- Administrador de información-</h1>

<!-- FORMULARIO AGREAGAR CONTENIDO -->
<div class="col s12 m8">
<form action="?p=1&" method="get"><div>
<div class="row">
<h3>Buscar para Editar</h3>
    <div class="input-field col s6">
      <input value="<?php echo $buscando; ?>" id="buscar" name="buscar" type="text" class="">
      <label class="active" for="buscar">Buscar por ISBN</label>
    </div>
    <button class="btn waves-effect waves-light" type="submit">Buscar
    <i class="material-icons right">search</i>
  </button>
  <?php if($buscando){ ?>
  <a class="waves-effect waves-light btn" href="index.php"><i class="material-icons right">home</i>Cancelar Búsqueda</a>
  <?php } ?>
  </div>
  </div>
  </form>
<br /><br />
<h3><i class="material-icons">offline_pin</i> <a href="agregar.php">AGREGAR NUEVO</a> </h3>
<br /><br />
</div>

<div class="row">


<hr class="col s12" />

<div class="row">
        <div class="col s12">
<h3><i class="material-icons">reorder</i> ITEMS <?php if($buscando){ ?>ENCONTRADOS:<?php }else{ ?>AGREGADOS<?php } ?> </h3>


        
<?php
// función para modales
function mimodal($idmodal,$nombrecontenido,$archivo){
	
$modal = '<a class="waves-effect waves-light btn-flat modal-trigger" href="#modal'.$idmodal.'">Eliminar <i class="material-icons">delete</i></a>

  <!-- Modal -->
  <div id="modal'.$idmodal.'" class="modal">
    <div class="modal-content">
      <h4>¿Deseas borrar este contenido?</h4>
      <h5>'.$nombrecontenido.'</h5>
    </div>
    <div class="modal-footer">
      <a href="borrar.php?i='. $idmodal .'&c=si&a=' . $archivo . '" class="waves-effect waves-light btn">BORRAR</a>
      <a href="#!" class=" modal-action modal-close waves-effect waves-green btn-flat">NO</a>
    </div>
  </div>';
return $modal;
}
// funciones iconos y cadenas docs
function ico_estatus($estatus_bd){ if($estatus_bd=="on"){return $mi_estatus = "done";}else{ return $mi_estatus = "pause";} }
// meses
$mimes[1] = "Enero";
$mimes[2] = "Febrero";
$mimes[3] = "Marzo";
$mimes[4] = "Abril";
$mimes[5] = "Mayo";
$mimes[6] = "Junio";
$mimes[7] = "Julio";
$mimes[8] = "Agosto";
$mimes[9] = "Septiembre";
$mimes[10] = "Octubre";
$mimes[11] = "Noviembre";
$mimes[12] = "Diciembre";
$miprog[1] = "Regular";
$miprog[2] = "de Verano";

function datos_web($f_id_recurso, $f_estatus, $f_titulo, $f_titulo_original, $f_nivel_escolar, $f_acervo, $f_grado, $f_lenguaje, $f_genero, $f_serie, $f_categoria, $f_isbn, $f_fecha_modificacion){
	$textomodal = "ISBN: ".$f_isbn." <br /> " . $f_titulo;
	$infomodal = mimodal($f_id_recurso,$textomodal,$f_isbn);
	if($f_estatus=="done"){$f_color="#090";}else{$f_color="#F30";}
	if($f_titulo_original){$f_titulo_original=" (".$f_titulo_original.") ";}
	$img_muestra = "";
	$ruta_img1 = "../portadas_ce/".$f_id_recurso.".jpg";
	if (file_exists($ruta_img1)) {$img_muestra = $img_muestra." <img src='".$ruta_img1."' style='height:30px;' /> | ";}else{$img_muestra = $img_muestra." <small>(Sin Portada)</small> ";}
	$ruta_img2 = "../portadas_ce/".$f_id_recurso."_int1.jpg";
	if (file_exists($ruta_img2)) {$img_muestra = $img_muestra." <img src='".$ruta_img2."' style='height:30px;' />";}else{$img_muestra = $img_muestra." <small>(Sin IMG 1)</small> ";}
	$ruta_img3 = "../portadas_ce/".$f_id_recurso."_int2.jpg";
	if (file_exists($ruta_img3)) {$img_muestra = $img_muestra." <img src='".$ruta_img3."' style='height:30px;' />";}else{$img_muestra = $img_muestra." <small>(Sin IMG 2)</small> ";}
	
	echo "
	<li><hr />
	<p>
	<strong><i class='material-icons' style='font-size:1em;color:".$f_color.";'>" . $f_estatus . "</i> ISBN: ".$f_isbn."</strong><br /><span style='font-size:1.5em;;'>" . $f_titulo . "</span> ".$f_titulo_original." ".$img_muestra." <br />
	Serie: <strong>".$f_serie."</strong> | ".$f_nivel_escolar.",  ".$f_grado." | <strong>".$f_acervo."</strong> | Género ".$f_genero." | Categoría: ".$f_categoria." | ".$f_lenguaje."  <br /> 
	Última modificación: ".$f_fecha_modificacion."
	<br />
	<small><a href='editar.php?i=". $f_id_recurso ."' class='waves-effect waves-light btn-flat'> EDITAR <i class='material-icons'>mode_edit</i></a> | ".$infomodal." </small>
	</p> 
	</li>
	";
	}
	
	// Realizar una consulta MySQL Buscar elementos 1::::::::::::::::::
    $query = "SELECT id_recurso, estatus, titulo, titulo_original, nivel_escolar, acervo, grado, lenguaje, genero, serie, categoria, isbn, fecha_alta, fecha_modificacion FROM ".$tablas_prog . $queryw;
    
	
	
	// PAGINACION
	$resultP = pg_query($enlace, $query) or die('Consulta fallida: '.pg_last_error());
	$num_total_registros = pg_num_rows($resultP);
	$total_paginas = ceil($num_total_registros / $tamanopag);
	
	
	
	$consulta = $query . " ORDER BY titulo ASC LIMIT ".$tamanopag." OFFSET " . $inicio."";
	
	



$listapags = "";
if ($total_paginas > 1) {
	function enlacebuscar($mipag,$b){
			return '<li><a href="?p='.$mipag.'&buscar='.$b.'">';
	}

	$listapags = $listapags.'<ul class="pagination">';

   if ($pagina != 1){$listapags =  $listapags.enlacebuscar($pagina-1,$buscando).'&laquo;</a></li>';}else{$listapags =  $listapags."<li><a>&#8226;</a></li>";}
   for ($i=1;$i<=$total_paginas;$i++) {
         if ($pagina == $i)
            //si muestro el índice de la página actual, no coloco enlace
            $listapags = $listapags.'<li><a><strong style="text-decoration:underline;">'.$pagina.'</strong></a></li>';
         else
            //si el índice no corresponde con la página mostrada actualmente,
            //coloco el enlace para ir a esa página
            $listapags = $listapags.enlacebuscar($i,$buscando).$i.'</a></li>  ';
      }
   if ($pagina != $total_paginas){$listapags = $listapags.enlacebuscar($pagina+1,$buscando).'&raquo;</a></li>';}else{$listapags =  $listapags."<li><a>&#8226;</a></li>";}
		 
	$listapags = $listapags.'</ul>';
}



// Mostrar Paginación
echo "".$listapags."";

	
	
	$result = pg_query($enlace, $consulta) or die('Consulta fallida: '.pg_last_error());
echo "<ul>";
// Imprimir los resultados en HTML
while ($registro = pg_fetch_array($result)){
	$lengua = $registro['lenguaje'];
	if($lengua){ if($lengua >= 1 && $lengua <= 60){$idioma = "Lengua: Bilingüe, ".$iden["idioma"][$lengua];}elseif($lengua >= 101 && $lengua <= 132){$idioma = "Región: ".$iden["estados"][$lengua];}elseif($lengua == 99){$idioma = "Lengua: Monolingüe, Español.";}}
	datos_web($registro['id_recurso'],ico_estatus($registro['estatus']),$registro['titulo'],$registro['titulo_original'], $iden["nivel_escolar"][$registro['nivel_escolar']], $iden["acervo"][$registro['acervo']], $iden["grado"][$registro['grado']], $idioma, $iden["genero"][$registro['genero']], $iden["serie"][$registro['serie']], $iden["categoria"][$registro['categoria']], $registro['isbn'], $registro['fecha_modificacion']);
}
echo "</ul>";	
	
	
	/*
?>
                <ul class="collapsible" data-collapsible="accordion">
                
                <li><div class="collapsible-header"><i class="material-icons">label_outline</i>PROGRAMACIÓN REGULAR</div><div class="collapsible-body" style="margin:10px;"><ul><?php 
// Realizar una consulta MySQL Buscar elementos 1::::::::::::::::::
    $query = "SELECT *  FROM ".$tablas_prog." WHERE serie = 1 ORDER BY titulo";
    $result = pg_query($enlace, $query) or die('Consulta fallida: '.pg_last_error());
// Imprimir los resultados en HTML
while ($registro = pg_fetch_array($result)){
	datos_web($registro['id_recurso'],$registro['titulo'],$registro['titulo_original'],$registro['estatus']);
	// verresult($miprog[$registro["titulo"]], $mimes[$registro["mes"]], $registro['titulo'], $registro['id_recurso'], ico_estatus($registro["estatus"]), $registro["url"], $registro["documento"], $registro["descripcion"]);
} //---
?></ul></div></li>



                <li><div class="collapsible-header"><i class="material-icons">label_outline</i>PROGRAMACIÓN REGULAR 1o</div><div class="collapsible-body" style="margin:10px;"><ul><?php 
// Realizar una consulta MySQL Buscar elementos 1::::::::::::::::::
    $query = "SELECT *  FROM ".$tablas_prog." WHERE serie = 2 ORDER BY titulo";
    $result = pg_query($enlace, $query) or die('Consulta fallida: '.pg_last_error());
// Imprimir los resultados en HTML
while ($registro = pg_fetch_array($result)){
	datos_web($registro['id_recurso'],$registro['titulo'],$registro['titulo_original'],$registro['estatus']);
	 //verresult($miprog[$registro["programacion"]], $mimes[$registro["mes"]], $registro['titulo'], $registro['id_recurso'], ico_estatus($registro["estatus"]), $registro["url"], $registro["documento"], $registro["descripcion"]);
} //---
?></ul></div></li>



                <li><div class="collapsible-header"><i class="material-icons">label_outline</i>PROGRAMACIÓN REGULAR 2o</div><div class="collapsible-body" style="margin:10px;"><ul><?php 
// Realizar una consulta MySQL Buscar elementos 1::::::::::::::::::
    $query = "SELECT *  FROM ".$tablas_prog." WHERE serie = 3 ORDER BY titulo";
    $result = pg_query($enlace, $query) or die('Consulta fallida: '.pg_last_error());
// Imprimir los resultados en HTML
while ($registro = pg_fetch_array($result)){
	datos_web($registro['id_recurso'],$registro['titulo'],$registro['titulo_original'],$registro['estatus']);
	 //verresult($miprog[$registro["programacion"]], $mimes[$registro["mes"]], $registro['titulo'], $registro['id_recurso'], ico_estatus($registro["estatus"]), $registro["url"], $registro["documento"], $registro["descripcion"]);
} //---
?></ul></div></li>



                <li><div class="collapsible-header"><i class="material-icons">label_outline</i>PROGRAMACIÓN REGULAR 3o</div><div class="collapsible-body" style="margin:10px;"><ul><?php 
// Realizar una consulta MySQL Buscar elementos 1::::::::::::::::::
    $query = "SELECT *  FROM ".$tablas_prog." WHERE serie = 4 ORDER BY titulo";
    $result = pg_query($enlace, $query) or die('Consulta fallida: '.pg_last_error());
// Imprimir los resultados en HTML
while ($registro = pg_fetch_array($result)){
	datos_web($registro['id_recurso'],$registro['titulo'],$registro['titulo_original'],$registro['estatus']);
	 //verresult($miprog[$registro["programacion"]], $mimes[$registro["mes"]], $registro['titulo'], $registro['id_recurso'], ico_estatus($registro["estatus"]), $registro["url"], $registro["documento"], $registro["descripcion"]);
} //---
?></ul></div></li>


                <li><div class="collapsible-header"><i class="material-icons">label_outline</i>PROGRAMACIÓN DE VERANO</div><div class="collapsible-body" style="margin:10px;"><ul><?php 
// Realizar una consulta MySQL Buscar elementos 1::::::::::::::::::
    $query = "SELECT *  FROM ".$tablas_prog." WHERE serie = 5 ORDER BY titulo";
    $result = pg_query($enlace, $query) or die('Consulta fallida: '.pg_last_error());
// Imprimir los resultados en HTML
while ($registro = pg_fetch_array($result)){
	datos_web($registro['id_recurso'],$registro['titulo'],$registro['titulo_original'],$registro['estatus']);
	 //verresult($miprog[$registro["programacion"]], $mimes[$registro["mes"]], $registro['titulo'], $registro['id_recurso'], ico_estatus($registro["estatus"]), $registro["url"], $registro["documento"], $registro["descripcion"]);
} //---
?></ul></div></li>
          		</ul>
				*/ 


// Mostrar Paginación
echo "<br /><hr /><br />".$listapags;




?>
    </div>
</div>

</div>
<!-- END FORMULARIO AGREGAR CONTENIDO -->
  

<hr />
<h3><i class="material-icons dp48">system_update_alt</i> Descargar Respaldos Completos</h3><br />
<a class="btn waves-effect waves-light" href="excel.php" target="_blank">
<i class="material-icons right">play_for_work</i> Excel
</a>

<a class="btn waves-effect waves-light" href="respaldohtml.php" target="_blank">
<i class="material-icons right">play_for_work</i> HTML con imágenes
</a>
<br />
<p>(Puede demorar un poco, dependiendo de la cantidad total de información e imágenes)</p>
<br /><br /><br />
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
      <script type="text/javascript">
	  $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
		$('.modal-trigger').leanModal();
	  });
	  </script>
</body>
</html>
<?php 
mysqli_close($enlace);
 ?>