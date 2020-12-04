<?php 
require_once("admin/bd.php");
require_once("admin/identificadores.php");

$tipo = $_GET["t"]; if(!is_numeric($tipo)) { die; } 
$pagina = $_GET["p"]; if(!is_numeric($pagina)) { die; } 
$buscar = $_GET["b"];
$tiposbusqueda = array("0","Buscar por serie","Buscar por tipo de acervo","Buscar alfabéticamente","Búsqueda rápida","Búsqueda avanzada","Búsqueda por Nivel"); 
$columnabusqueda = array("","serie","acervo","titulo","",""); 
//PÁGINAS - Limito la busqueda
$tamanopag = 5;

function limpiacadenab($c,$t){
	$search = array(
		'@<script[^>]*?>.*?</script>@si',   // Elimina javascript
		'@<[\/\!]*?[^<>]*?>@si',            // Elimina las etiquetas HTML
		'@<style[^>]*?>.*?</style>@siU',    // Elimina las etiquetas de estilo
		'@<![\s\S]*?--[ \t\n\r]*>@'         // Elimina los comentarios multi-línea
	);
	$c = preg_replace($search, '', $c);
	
	if($t=="k"){$c = str_replace(" ", ",", $c);$c = str_replace('%20', ',', $c);$c = str_replace("'", ",", $c);$c = str_replace('"', ',', $c);} // keywords para búsqueda
	
	$c = str_replace("'", "’", $c); 
	$c = str_replace('"', '“', $c); 
	
	$c = str_replace('/', '', $c); 
	$c = str_replace('\\', '', $c);
	$c = str_replace('/', '', $c); 
	
	$c = str_ireplace("SELECT","",$c);
	$c = str_ireplace("COPY","",$c);
	$c = str_ireplace("DELETE","",$c);
	$c = str_ireplace("DROP","",$c);
	$c = str_ireplace("DUMP","",$c);
	$c = str_ireplace(" OR ","",$c);
	$c = str_ireplace("%","",$c);
	$c = str_ireplace("LIKE","",$c);
	$c = str_ireplace("--","",$c);
	$c = str_ireplace("^","",$c);
	$c = str_ireplace("[","",$c);
	$c = str_ireplace("]","",$c);
	$c = str_ireplace("!","",$c);
	$c = str_ireplace("¡","",$c);
	$c = str_ireplace("?","",$c);
	$c = str_ireplace("=","",$c);
	$c = str_ireplace("&","",$c);
	$c = str_ireplace("<","",$c);
	$c = str_ireplace(">","",$c);

	// Faltan limpiar cadena $c a fondo !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
	return $c;
}

// Generar SQQL para Búsqueda
if($tipo == 1 || $tipo == 2){ // buscar por serie o acervo - numero
	if(is_numeric($buscar)) {
		$query = "SELECT * FROM ".$tablas_prog." WHERE ".$columnabusqueda[$tipo]." = '" .$buscar."' AND estatus = 'on' ORDER BY pub_anios ASC";
	}else{ die; }
}
elseif($tipo == 3){ // buscar alfabeticamente - letra




	if(ctype_alpha($buscar) || $buscar == "ñ" || $buscar == "Ñ") {
		if($buscar == "ñ" || $buscar == "Ñ") {
			$buscar = "ñ";
		}else{
			$buscar = substr($buscar, 0, 1);
		}
		
		$abcdario = array ("","a","b","c","d","e","f","g","h","i","j","k","l","m","n","ñ","o","p","q","r","s","t","u","v","w","x","y","z");
		
		for($i = 1; $i <= 27; $i++){ if(strtolower ($abcdario[$i]) == $buscar){ $siguiente = $abcdario[($i+1)]; } }
		
		if($siguiente){ // Buscar abecedario
			$query = "SELECT * FROM ".$tablas_prog." WHERE ((".$columnabusqueda[$tipo]." > '" .strtolower ($buscar)."') AND (".$columnabusqueda[$tipo]." < '" .strtolower ($siguiente)."')) AND estatus = 'on' ORDER BY titulo ASC";
		}else{ // Busca con z-Z
			$query = "SELECT * FROM ".$tablas_prog." WHERE ((".$columnabusqueda[$tipo]." = '" .strtolower ($buscar)."') OR (".$columnabusqueda[$tipo]." = '" .strtoupper ($buscar)."')) AND estatus = 'on' ORDER BY titulo ASC";
		}
		
	}else{ die; }
}elseif($tipo==4){ // buscar por texto normal
	
	$anio_ini = substr($buscar, 0, 4); if(!is_numeric($anio_ini)){die;}
	$anio_fin = substr($buscar, 4, 4); if(!is_numeric($anio_fin)){die;}
	$anios_b = "";
	
	if($anio_ini == 9000){
		$msj_anio = " Cualquier Año ";
	}elseif($anio_ini < 9000 && $anio_fin == 9000){
		$anios_b = " AND pub_anios LIKE '%".$anio_ini."%' ";
		$msj_anio = " Año ".$anio_ini." ";
	}elseif($anio_ini < 9000 && $anio_fin < 9000){
		if($anio_ini >= $anio_fin){ //echo"ctl<br />";
			$anios_b = " AND pub_anios LIKE '%".$anio_ini."%' ";
			$msj_anio = " Año ".$anio_ini." ";
		}else{
			$anios_b = " AND (";
			for($i=$anio_ini; $i <= $anio_fin; $i++){
				if($i != $anio_ini){ $anios_b = $anios_b." OR ";}
				$anios_b = $anios_b . "pub_anios LIKE '%".$i."%' ";
			}
			$anios_b = $anios_b . " ) ";
			$msj_anio = " Años: ".$anio_ini." a " .$anio_fin. " ";
		}
	}else{
		$anios_b = "";
	}
	
	$tab = substr($buscar, 8, 1); if(!is_numeric($tab)){die;}
	$tabla = array("titulo","titulo","autor","keywords");
	$buscar2 =  limpiacadenab(substr($buscar, 9),0); // Limpiar Cadena
	$query = "SELECT * FROM ".$tablas_prog." WHERE ((SP_ASCII(".$tabla[$tab].") ILIKE SP_ASCII('%" .$buscar2."%'))".$anios_b.") AND estatus = 'on' ORDER BY titulo ASC";
	
}elseif($tipo==6) {//busqueda por nivel
	$a = explode(",", $buscar);
	$cadena="";
	   if($a[2] != 0){
	   		$cadena = $cadena." and nivel_escolar = '$a[2]'";
	   }
	   if($a[0]!= 9000 and $a[1] == 9000){
	   		$cadena = $cadena." and pub_anios = '$a[0]'";
	   }
	   if($a[1]!=9000 and $a[0] == 9000){
	   		$cadena = $cadena." and pub_anios <= '$a[1]'";
	   }
	   if($a[1]!=9000 and $a[0] != 9000){
	   		$cadena = $cadena." and (pub_anios >= '$a[0]' and pub_anios <= '$a[1]')";
	   }
	   	if($cadena != ""){
	   		$query = "SELECT * FROM catalogo_ldr WHERE estatus = 'on' $cadena ORDER BY pub_anios ASC";
	   		//$query = $cadena;
	    }else{
	   	die;
	   }                                                                                                                                                                                           
		
}elseif($tipo==5){ // buscar avanzado
	$a = explode("¬", $buscar);
	$cadena="";
	if($a[0]!=""){
		$q= str_replace("_"," ",$a[0]);
		$cadena = $cadena." and (SP_ASCII(titulo) ILIKE SP_ASCII('%$q%')) ";
	}
	if($a[1]!=""){
		$q= str_replace("_"," ",$a[1]);
		$cadena = $cadena." and (SP_ASCII(autor) ILIKE SP_ASCII('%$q%'))";
	}
	if($a[2]!=0){
		$cadena = $cadena." and serie = '$a[2]'";
	}
	if($a[3]!=0){
		$cadena = $cadena." and genero = '$a[3]'";
	}
	if($a[4]!=100){
		$cadena = $cadena." and categoria = '$a[4]'";
	}
	if($a[5]!=100){
		$cadena = $cadena." and lenguaje = '$a[5]'";
	}
	if($a[6]!=0){
		$cadena = $cadena." and acervo = '$a[6]'";
	}
	if($a[7]!=0){
		$cadena = $cadena." and nivel_escolar = '$a[7]'";
	}
	if($a[8]!=7){
		$cadena = $cadena." and grado = '$a[8]'";
	}
	if($a[9]!= 9000 and $a[10] == 9000){
		$cadena = $cadena." and pub_anios = '$a[9]'";
	}
	if($a[10]!=9000 and $a[9] == 9000){
		$cadena = $cadena." and pub_anios <= '$a[10]'";
	}
	if($a[9]!=9000 and $a[10] != 9000){
		$cadena = $cadena." and (pub_anios >= '$a[9]' and pub_anios <= '$a[10]')";
	}
	if($cadena != ""){
	   		$query = "SELECT * FROM catalogo_ldr WHERE estatus = 'on' $cadena ORDER BY pub_anios ASC";
	   		//$query = $buscar;
	    }else{
	   	die;
	   }    
	}
//echo $query;
$result = pg_query($enlace, $query) or die('Consulta fallida: '.pg_last_error());
$num_total_registros = pg_num_rows($result);


//PÁGINAS
//examino la página a mostrar y el inicio del registro a mostrar
if (!$pagina) {
   $inicio = 0;
   $pagina = 1;
}else {$inicio = ($pagina - 1) * $tamanopag;}
//calculo el total de páginas
$total_paginas = ceil($num_total_registros / $tamanopag);

// Consulta de resultados por página
$consulta = $query . " LIMIT ".$tamanopag." OFFSET " . $inicio;
$result2 = pg_query($enlace, $consulta) or die('Consulta fallida: '.pg_last_error());
?>
<div style="text-align:center;" id="top2">
<h3><?php echo $tiposbusqueda[$tipo]; ?></h3>
<div><?php
if($tipo == 1){ echo '<img src="assets/images/'.$iden["serie_img"][$buscar].'" alt="'.$iden["serie"][$buscar].'" />'; }
if($tipo == 2){ echo '<h4>'.$iden["acervo"][$buscar].'</h4>'; }
if($tipo == 3){ echo '<h4><small>Letra:</small><br /><small style="text-transform:uppercase;">'.strtoupper($buscar).'</small></h4>'; }
 //echo "-".$buscar."-"; ?></div>
<h5><strong>Se encontraron <?php echo $num_total_registros; ?> resultados.</strong></h5>
</div>
<?php
	
// Obtener Páginas
	$listapags = "";
if ($total_paginas > 1) {
	function enlacebuscar($t,$b,$mipag){
		if($t < 4){
			return '<li><a href="#resultados" class="scr_resultados" onClick="buscar_link(\''.$t.'\',\''.$b.'\','.$mipag.');">';
		}else{
			$buss = 'buscar_form (\''.$mipag.'\',\''.$t.'\',\''.substr($b, 9).'\',\''.substr($b, 0, 4).'\',\''.substr($b, 4, 4).'\',\''.substr($b, 8, 1).'\',\'\',\'\',\'\',\'\',\'\',\'\',\'\',\'\',\'\',\'\') ';
			return '<li><a href="#resultados" class="scr_resultados" onClick="'.$buss.';">'; //// buscar_form (pag,tipo,bus,ini,fin,en,serie,genero,categoria,idioma,acervo,nivel,grado,autor,titulo,temas) 
			
		}
	}

	$listapags = $listapags.'<ul class="pagination">';

   if ($pagina != 1){$listapags =  $listapags.enlacebuscar($tipo,$buscar,($pagina-1)).'&laquo;</a></li>';}else{$listapags =  $listapags."<li><a>&#8226;</a></li>";}
   for ($i=1;$i<=$total_paginas;$i++) {
         if ($pagina == $i)
            //si muestro el índice de la página actual, no coloco enlace
            $listapags = $listapags.'<li><a><strong>'.$pagina.'</strong></a></li>';
         else
            //si el índice no corresponde con la página mostrada actualmente,
            //coloco el enlace para ir a esa página
            $listapags = $listapags.enlacebuscar($tipo,$buscar,$i).$i.'</a></li>  ';
      }
   if ($pagina != $total_paginas){$listapags = $listapags.enlacebuscar($tipo,$buscar,($pagina+1)).'&raquo;</a></li>';}else{$listapags =  $listapags."<li><a>&#8226;</a></li>";}
		 
	$listapags = $listapags.'</ul>';
}

// Mostrar Paginación
//echo $listapags;
?>
<br><br>
<!-- LISTADO DE RESULTADOS -->
	<div class="panel-group ficha-collapse">
      <?php 
				// Obtener información de cada ficha e imprimir en HTML
				while ($registro = pg_fetch_array($result2)){
					$i = $registro['id_recurso'];
					$lengua = $registro['lenguaje'];
					?>
				<div class="panel panel-default" style="margin-bottom:20px;">             	
					<div class="row">
							<div class="col-md-6">
									<div class="panel-heading">
										<div class="panel-title">
											<div class="row show-grid">
													<div class="col-md-5">
														<a data-parent="#accordion" data-toggle="collapse" href="#" aria-expanded="true" aria-controls="panel-<?php echo $i; ?>" class="btn_ficha">
															<?php $ruta_archivo = "portadas_ce/".$i.".jpg"; if(file_exists ($ruta_archivo)){ ?><img class="img-responsive sombras" src="<?php echo $ruta_archivo; ?>" style="margin:0 auto; width:100%;height: 200px;"><?php }else{ ?><img src="sinportda.jpg" /><?php } ?>
																				</a>
													</div>
													<div class="col-md-7 titulolibro">
														<h4><?php echo $registro['titulo']; ?></h4> 
														<?php if($registro['titulo_original']){ ?>
														<small>(<?php echo $registro['titulo_original']; ?>)</small>
														<?php } ?>
														
														<?php if($registro['autor']){ ?><p class="f_autor"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> <strong>Autor:</strong> <?php echo $registro['autor']; ?></p><?php } ?>
															<?php if($registro['ilustrador']){ ?><p><span class="glyphicon glyphicon-picture" aria-hidden="true"></span> <strong>Ilustrador:</strong> <?php echo $registro['ilustrador']; ?></p><?php } ?>
															<?php if($registro['traductor']){ ?><p><span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span> <strong>Traductor:</strong> <?php echo $registro['traductor']; ?></p><?php } ?>
														<?php $publicacion = $registro['pub_lugar'].", ".$registro['pub_editorial'].", ".str_replace(',',' - ',$registro['pub_anios']).", ".$registro['pub_paginas']." páginas."; //"México D.F., SEP-planeta , 2005 - 2006- 2007, 32 páginas."; ?>
														<p><span class="glyphicon glyphicon-folder-close" aria-hidden="true"></span> <strong>Publicación:</strong> <?php echo $publicacion; ?></p>
														
													</div>
											</div>
										</div>
								</div>
							
							</div>
							<div class="col-md-6">
											<!-- AQUI VA  -->
											<div class="panel-collapse collapse in" id="panel-<?php echo $i; ?>">
                          <div class="panel-body">
                                  <?php if($registro['nivel_escolar']){ ?><p><strong>Nivel:</strong> <?php echo $iden["nivel_escolar"][$registro['nivel_escolar']]; ?> <?php if($registro['acervo']){ ?><strong>/</strong> <?php echo $iden["acervo"][$registro['acervo']]; ?> <?php } ?></p>
                                    	<?php if($registro['grado'] && $registro['acervo'] != 2){ ?>
                                        <p><strong>Grado:</strong> <?php echo $iden["grado"][$registro['grado']]; ?></p>
										<?php } ?>
                                  <?php } ?>
                                  <?php 
										$lengua = $registro['lenguaje'];
										if($lengua){ 
								  
										if($lengua >= 1 && $lengua <= 60){
											$idioma = "<strong>Lengua:</strong> <span>Bilingüe, ".$iden["idioma"][$lengua]."</span>";
										}elseif($lengua >= 101 && $lengua <= 132){
											$idioma = "<strong>Región:</strong> <span>".$iden["estados"][$lengua]."</span>";
										}elseif($lengua == 99){
											$idioma = "<strong>Lengua:</strong> <span>Monolingüe, Español.</span>";
										}
								  ?><p><?php echo $idioma; ?></p><?php } ?>
                                  <?php if($registro['genero']){ ?><p><strong>Género:</strong> <?php echo $iden["genero"][$registro['genero']]; ?></p><?php } ?>
                                  <?php if($registro['serie']){ ?><p><strong>Serie:</strong> <?php echo $iden["serie"][$registro['serie']]; ?></p><?php } ?>
                                  <?php if($registro['categoria']){ ?><p><strong>Categoría:</strong> <?php echo $iden["categoria"][$registro['categoria']]; ?></li><?php } ?>
                                  <?php if($registro['keywords']){ ?><p><strong>Temas:</strong> <?php echo $registro['keywords']; ?></p><?php } ?>
                                  <?php if($registro['isbn']){ ?><p><strong>ISBN:</strong> <?php echo $registro['isbn']; ?></p><?php } ?>
                                <?php if($registro['resena']){ ?><p class="resena"><strong>Reseña:</strong> <br /><?php echo $registro['resena']; ?></p><?php } ?>
    
                
                
                          </div>
                  					

							</div>
					</div>
                </div>
			</div>
			<?php }
	   ?>
     
	</div>
	
<!-- FIN LISTADO -->
<div style="text-align: center;"> 
<?php echo $listapags;?>
</div>

<div class="btn_subir"><a href="#top" class="scr_top"> Realiza otra Busqueda </a></div>
    <script type="text/javascript">           
        $(function () {
                $('.scr_resultados').click(function (e) {
                    e.preventDefault();
                    $('html,body').animate({
                    scrollTop: $('#top2').offset().top -90
                    }, 800);
                });
                }) 
				
				$(function () {
                $('.scr_top').click(function (e) {
                    e.preventDefault();
                    $('html,body').animate({
                    scrollTop: $('#top').offset().top -90
                    }, 800);
                });
                })
        </script>