<?php $pagina="null"; ?>

<div class="vertical-buffer ">
    <!-- BANNER --> 
    <div>
        <img class="img-responsive animated bounceInDown" src="assets/images/icon_index/banner.png">
    </div>
    <br />
    <p>El Catálogo de Libros del Rincón es una herramienta de consulta dirigida a todos los interesados en conocer los títulos que conforman esta colección presente en las Bibliotecas de Aula y bibliotecas Escolares de los planteles de educación básica.</p>
     <!-- FIN BANNER --> 
    
    <!-- CONTENIDO -->
    <div class="container animated" >
        
        
        <div class="row"   align="center">
        
            <div class="col-sm-3 col-xs-6">
                <article>
                    <div class="guard-of">
                        <a href="?pagina=16&contenido=sistema_sea" class="rolloverimg" title="" target="_self">
                            <img src="docs/iconos/sistema.png" class="img-responsive animated rolloverimg1"> <img src="docs/iconos/sistema_neg.png" class="img-responsive animated rolloverimg2">
                        </a>
                    </div>
                </article>
                <p>Sistema SEA</p>
            </div>
            
            <div class="col-sm-3 col-xs-6">
                <article>
                    <div class="guard-of">
                        <a href="?pagina=21&contenido=cursos" class="rolloverimg" title="" target="_self">
                            <img src="docs/iconos/cursos.png" class="img-responsive animated rolloverimg1"> <img src="docs/iconos/cursos_neg.png" class="img-responsive animated rolloverimg2">
                        </a>
                    </div>
                </article>
                <p>Cursos</p>
                
            </div>
        
        </div>
        
        <?php /*
// Realizar una consulta MySQL Buscar elementos 1::::::::::::::::::
    $query = "SELECT id_recurso, nombre_contenido, nombre_menu, nombre_url, intro, nombre_icono, url_externa  FROM ".$tablas_sea." WHERE nivel = '0' AND estatus = 'on' ORDER BY orden_menu";
    $result = pg_query($enlace, $query) or die('Consulta fallida: '.pg_last_error());
	
	// Imprimir los resultados en HTML
	while ($registro = pg_fetch_array($result)){//$registro['nombre_contenido']
	$java_links .= $java_links . " $('#".$registro['nombre_url']."link').click(function (e) {e.preventDefault();
             $('html,body').animate({scrollTop: $('#".$registro['nombre_url']."').offset().top -100}, 100);
        });
		";
	
?>
        <a id="<?php echo $registro['nombre_url']; ?>"></a>
        <strong><?php echo $registro['nombre_contenido']; ?></strong>
        <hr class="red" style="margin-bottom:15px;">        <?php if($registro['intro']){ ?><p><?php echo $registro['intro']; ?></p><?php } ?>
        <div class="row"   align="center">
        <?php 
		$query2 = "SELECT id_recurso, nombre_contenido, nombre_menu, nombre_url, intro, nombre_icono, url_externa  FROM ".$tablas_sea." WHERE nivel = '".$registro['id_recurso']."' AND estatus = 'on' ORDER BY orden_menu";
    	$result2 = pg_query($enlace, $query2) or die('Consulta fallida: '.pg_last_error());
		while ($registro2 = pg_fetch_array($result2)){//$registro2['nombre_contenido']
			if($registro2['url_externa']){
				$url_armada_icono = $registro2['url_externa'];
				$url_armada_icono_target = "_blank";
			}else{
				$url_armada_icono = '?pagina='. $registro2['id_recurso'] . '&contenido=' . $registro2['nombre_url'];
				$url_armada_icono_target = "_self";
			}
			/*?pagina=<?php echo $registro2['id_recurso']; ?>&contenido=<?php echo $registro2['nombre_url']; ?>* /
		 ?>
        <div class="col-sm-3 col-xs-6">
                <article>
                    <div class="guard-of">
                        <a href="<?php echo $url_armada_icono; ?>" class="rolloverimg" title="<?php echo $registro2['intro']; ?>" target="<?php echo $url_armada_icono_target; ?>">
                            <img src="docs/iconos/<?php echo $registro2['nombre_icono']; ?>" class="img-responsive animated rolloverimg1">
                            <?php $img_neg = explode(".",$registro2['nombre_icono']); ?>
                            <img src="docs/iconos/<?php echo $img_neg[0] . "_neg." . $img_neg[1]; ?>" class="img-responsive animated rolloverimg2">
                        </a>
                    </div>
                </article>
                <p><?php echo $registro2['nombre_menu']; ?></p>
                
            </div>
        <?php } ?>
        </div><br />
<?php } */ ?>
    
    <!-- FIN CONTENIDO --> 
    
</div>
    <script type="text/javascript"> 
    $(function () {
		<?php echo $java_links; ?>
    });
	// Fix scroll #seccion
	$(document).ready(function() {
		setTimeout(function() {
			var miscroll = $(window).scrollTop();
			$('html, body').delay(0).animate({scrollTop: miscroll-100}, 800);
		},200);
	});
    </script> 
    