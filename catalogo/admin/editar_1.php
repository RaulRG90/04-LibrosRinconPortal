<?php 
if($_GET){
$item_edit = $_GET["i"];
require_once("bd.php");
require_once("identificadores.php");
require_once("redimensionarjpg.php");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Agregar item</title>
    <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <!--Import Google Icon Font-->
      <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
      <!--Import materialize.css-->
      <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
      <link type="text/css" rel="stylesheet" href="css/estilos.css"  media="all"/>

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
if($_POST){
	
	

		$pub_anios_ini = 1986;
		$pub_anios_hoy = date("Y");
		$ii = 0;
		for ($i = $pub_anios_ini; $i <= $pub_anios_hoy; $i++){ 
			$datoanio = $_POST["pub_anios_".$i]; 
			if($datoanio){
				$datoanio_exp[$ii] =  $datoanio;
				$ii++;
			}
        } 
		$f_pub_anios = implode (",", $datoanio_exp);


	
	$f_hoy =  date("Y-m-d H:i:s");
	
	$f_titulo = reemp ($_POST["titulo"]);
	$f_titulo_original = reemp ($_POST["titulo_original"]);
	$f_autor = reemp ($_POST["autor"]);
	$f_ilustrador = reemp ($_POST["ilustrador"]);
	$f_traductor = reemp ($_POST["traductor"]);
	$f_keywords = reemp ($_POST["keywords"]);
	$f_resena = reemp ($_POST["resena"]);
	
	$actualizar_sql = "UPDATE ".$tablas_prog." SET estatus = '".$_POST["estatus"]."', titulo = '".$f_titulo."', titulo_original = '".$f_titulo_original."', autor = '".$f_autor."', ilustrador = '".$f_ilustrador."', traductor = '".$f_traductor."', nivel_escolar = '".$_POST["nivel_escolar"]."', acervo = '".$_POST["acervo"]."', grado = '".$_POST["grado"]."', lenguaje = '".$_POST["lenguaje"]."', genero = '".$_POST["genero"]."', serie = '".$_POST["serie"]."', categoria = '".$_POST["categoria"]."', keywords = '".$f_keywords."', isbn = '".$_POST["isbn"]."', resena = '".$f_resena."', pub_lugar = '".$_POST["pub_lugar"]."', pub_editorial = '".$_POST["pub_editorial"]."', pub_anios = '".$f_pub_anios."', pub_paginas = '".$_POST["pub_paginas"]."', pub_edicion = '".$_POST["pub_edicion"]."', fecha_modificacion = '".$f_hoy ."' WHERE id_recurso = '". $item_edit ."'";
	//var_dump($actualizar_sql);
	$actualizar = pg_query($enlace,$actualizar_sql);
	//echo $actualizar_sql;
	if($actualizar){ $toast = true;


		if($_FILES){
			$dir_files = "../portadas_ce/";

			$dir_files_up_2 = $dir_files . $item_edit. ".jpg";
			$dir_files_up_2_1 = $dir_files . $item_edit. "_int1.jpg";
			$dir_files_up_2_2 = $dir_files . $item_edit. "_int2.jpg";
			
			$tipo_archivo = $_FILES['img_portada']['type']; 
			$tamano_archivo = $_FILES['img_portada']['size']; 
			
			$tipo_archivo_1 = $_FILES['img_int1']['type']; 
			$tamano_archivo_1 = $_FILES['img_int1']['size']; 
			
			$tipo_archivo_2 = $_FILES['img_int2']['type']; 
			$tamano_archivo_2 = $_FILES['img_int2']['size']; 



			if($tamano_archivo > 0){
				if (file_exists($dir_files_up_2)) {
					$aviso_doc = $aviso_doc . "<br /> ERROR: Ya existe una portada con el mismo nombre: <br /> " . $item_edit . ".jpg";
				}else{
					//compruebo si las características del archivo son las que deseo 
					if (!(strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "jpeg"))) { 
						$aviso_doc = $aviso_doc . "<br /> Sólo se permiten archivos \"jpg\"."; 
					}else{ 
						if(redimg ($_FILES['img_portada']['tmp_name'], 400, 600, 70, $dir_files_up_2)){
							$aviso_doc = $aviso_doc . "<br /> Portada guardada correctamente."; 
						}else{
							$aviso_doc = $aviso_doc . "<br /> ERROR al guardar el archivo de portada: " . $item_edit . ".jpg"; 
						}
					}
				
				}
			
		
		?>
		<script type="text/javascript">window.addEventListener('load', function(){ Materialize.toast('<?php echo $aviso_doc; ?>', 4000); }, false);</script>
		<?php 
		}
			if($tamano_archivo_1 > 0){
				if (file_exists($dir_files_up_2_1)) {
					$aviso_doc = $aviso_doc . "<br /> ERROR: Ya existe una imagen interna 1 con el mismo nombre: <br /> " . $item_edit . "_int1.jpg";
				}else{
					//compruebo si las características del archivo son las que deseo 
					if (!(strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "jpeg"))) { 
						$aviso_doc = $aviso_doc . "<br /> Sólo se permiten archivos \"jpg\"."; 
					}else{ 
						if(redimg ($_FILES['img_int1']['tmp_name'], 400, 600, 70, $dir_files_up_2_1)){
							$aviso_doc = $aviso_doc . "<br /> Imagen interna 1 guardada correctamente."; 
						}else{
							$aviso_doc = $aviso_doc . "<br /> ERROR al guardar el archivo de imagen interna 1: " . $item_edit . "_int2.jpg"; 
						}
					}
				
				}
			
		
		?>
		<script type="text/javascript">window.addEventListener('load', function(){ Materialize.toast('<?php echo $aviso_doc; ?>', 4000); }, false);</script>
		<?php 
		}
			if($tamano_archivo_2 > 0){
				if (file_exists($dir_files_up_2_2)) {
					$aviso_doc = $aviso_doc . "<br /> ERROR: Ya existe una imagen interna 2 con el mismo nombre: <br /> " . $item_edit . "_int2.jpg";
				}else{
					//compruebo si las características del archivo son las que deseo 
					if (!(strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "jpeg"))) { 
						$aviso_doc = $aviso_doc . "<br /> Sólo se permiten archivos \"jpg\"."; 
					}else{ 
						if(redimg ($_FILES['img_int2']['tmp_name'], 400, 600, 70, $dir_files_up_2_2)){
							$aviso_doc = $aviso_doc . "<br /> Imagen interna 2 guardada correctamente."; 
						}else{
							$aviso_doc = $aviso_doc . "<br /> ERROR al guardar el archivo de imagen interna 2: " . $item_edit . "_int2.jpg"; 
						}
					}
				
				}
			
		
		?>
		<script type="text/javascript">window.addEventListener('load', function(){ Materialize.toast('<?php echo $aviso_doc; ?>', 4000); }, false);</script>
		<?php 
		}
		}
	}else{ $toast = false; }
}


// Realizar una consulta MySQL Buscar elementos 1::::::::::::::::::
$query = "SELECT * FROM ".$tablas_prog." WHERE id_recurso = ".$item_edit;
$result = pg_query($enlace, $query) or die('Consulta fallida: '.pg_last_error());
// Imprimir los resultados en HTML
while ($registro = pg_fetch_array($result)){

	$bd_id_recurso = $registro['id_recurso'];
	$bd_titulo = $registro['titulo'];
	$bd_titulo = $registro['titulo_original'];
	$bd_estatus = $registro["estatus"];
	$bd_titulo = $registro["titulo"];
	$bd_titulo_original = $registro["titulo_original"];
	$bd_autor = $registro["autor"];
	$bd_ilustrador = $registro["ilustrador"];
	$bd_traductor = $registro["traductor"];
	$bd_nivel_escolar = $registro["nivel_escolar"];
	$bd_acervo = $registro["acervo"];
	$bd_grado = $registro["grado"];
	$bd_lenguaje = $registro["lenguaje"];
	$bd_genero = $registro["genero"];
	$bd_serie = $registro["serie"];
	$bd_categoria = $registro["categoria"];
	$bd_keywords = $registro["keywords"];
	$bd_isbn = $registro["isbn"];
	$bd_resena = $registro["resena"];
	$bd_pub_lugar = $registro["pub_lugar"];
	$bd_pub_editorial = $registro["pub_editorial"];
	$bd_pub_anios = $registro["pub_anios"];
	$bd_pub_paginas = $registro["pub_paginas"];
	$bd_pub_edicion = $registro["pub_edicion"];
	$bd_fecha_alta = $registro["fecha_alta"];
	$bd_fecha_modificacion = $registro["fecha_modificacion"];

}
?>
<?php
if($toast){ ?>
    <script type="text/javascript">window.addEventListener('load', function(){ Materialize.toast('Se ha actualizado con éxito', 4000); }, false);</script>
<?php }elseif($_POST){ ?>
		<script type="text/javascript">window.addEventListener('load', function(){ Materialize.toast('ERROR al actualizar', 4000); }, false);</script>
<?php } ?>
<h1 style="text-align:center;">Catálogo Libros del Rincón <br />
- Administrador de información-</h1>

<div class="regresardiv">
<a class="waves-effect waves-light btn" href="index.php"><i class="material-icons right">home</i>Ir al INICIO</a>
<hr class="col s12" />
</div>

<!-- FORMULARIO AGREAGAR CONTENIDO -->
<!--<div class="row">
<h3>Editar: </h3>
<form class="col s12" role="form" action="" method="post" onsubmit="return validate(this);" enctype="multipart/form-data">


    	<div class="file-field input-field">
<?php // if archvio existe 
if (file_exists("../portadas_ce/".$item_edit.".jpg")) { ?>
		<img src='../portadas_ce/<?php echo $item_edit; ?>.jpg' style='height:150px;' />
        <a href="borrarportada.php?i=<?php echo $bd_id_recurso; ?>&p=<?php echo $item_edit.".jpg"; ?>">[x] Eliminar la portada: (<?php echo $item_edit.".jpg"; ?>)</a><input type="hidden" value="" name="img_portada" >
		<?php
	}else{ ?>
  <div class="btn">
    <span>Portada</span>
    <input type="file" name="img_portada" id="img_portada">
  </div>
  <div class="file-path-wrapper">
    <input class="file-path validate browser-default" type="text" placeholder="Selecciona la imágen JPG de la portada para subir al servidor.">
  </div>
	<?php }
// end if archivo else mostrar jpg ?>
</div>

    	<div class="file-field input-field">
<?php // if archvio existe 
if (file_exists("../portadas_ce/".$item_edit."_int1.jpg")) { ?>
		<img src='../portadas_ce/<?php echo $item_edit; ?>_int1.jpg' style='height:150px;' />
        <a href="borrarportada.php?i=<?php echo $bd_id_recurso; ?>&p=<?php echo $item_edit."_int1.jpg"; ?>">[x] Eliminar interior 1: (<?php echo $item_edit."_int1.jpg"; ?>)</a><input type="hidden" value="" name="interior 1" >
		<?php
	}else{ ?>
  <div class="btn">
    <span>Interior 1</span>
    <input type="file" name="img_int1" id="img_int1">
  </div>
  <div class="file-path-wrapper">
    <input class="file-path validate browser-default" type="text" placeholder="Selecciona interior 1.">
  </div>
	<?php }
// end if archivo else mostrar jpg ?>
</div>

    	<div class="file-field input-field">
<?php // if archvio existe 
if (file_exists("../portadas_ce/".$item_edit."_int2.jpg")) { ?>
		<img src='../portadas_ce/<?php echo $item_edit; ?>_int2.jpg' style='height:150px;' />
        <a href="borrarportada.php?i=<?php echo $bd_id_recurso; ?>&p=<?php echo $item_edit."_int2.jpg"; ?>">[x] Eliminar interior 2: (<?php echo $item_edit."_int2.jpg"; ?>)</a><input type="hidden" value="" name="interior 2" >
		<?php
	}else{ ?>
  <div class="btn">
    <span>Interior 2</span>
    <input type="file" name="img_int2" id="img_int2">
  </div>
  <div class="file-path-wrapper">
    <input class="file-path validate browser-default" type="text" placeholder="Selecciona interior 2.">
  </div>-->
	<?php }
// end if archivo else mostrar jpg ?>
</div>


<div class="col s12 m8">
<h3><i class="material-icons">offline_pin</i> Estatus</h3>
<!-- Switch  -->
  <div class="switch">
    <label>
      Oculto
      <input type="checkbox" name="estatus" id="estatus"<?php if($bd_estatus == "on"){echo" checked ";} ?>>
      <span class="lever"></span>
      Publicado
    </label>
  </div>
</div>

<hr class="col s12" />

    <div class="input-field col s12">
          <i class="material-icons prefix">receipt</i>
          <input id="titulo" name="titulo" type="text" value="<?php echo $bd_titulo;?>" required >
          <label for="titulo">TÍTULO -<?php echo $bd_estatus;?></label>
    </div>
    <div class="input-field col s12">
          <i class="material-icons prefix">receipt</i>
          <input id="titulo_original" name="titulo_original" type="text" value="<?php echo $bd_titulo_original;?>">
          <label for="titulo_original">TÍTULO ORIGINAL</label>
    </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">perm_identity</i>
          <input id="autor" name="autor" type="text" value="<?php echo $bd_autor;?>">
          <label for="autor">AUTOR</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">edit_mode</i>
          <input id="ilustrador" name="ilustrador" type="text" value="<?php echo $bd_ilustrador;?>">
          <label for="ilustrador">ILUSTRADOR</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">supervisor_account</i>
          <input id="traductor" name="traductor" type="text" value="<?php echo $bd_traductor;?>">
          <label for="traductor">TRADUCTOR</label>
        </div>
        
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">business</i>
          <select id="nivel_escolar" name="nivel_escolar" class="browser-default" style="margin-left:180px;" >
            <option value="0"<?php if($bd_nivel_escolar == 0){echo" selected ";} ?>>SELECCIONAR</option>
            <option value="1"<?php if($bd_nivel_escolar == 1){echo" selected ";} ?>>PREESCOLAR</option>
            <option value="2"<?php if($bd_nivel_escolar == 2){echo" selected ";} ?>>PRIMARIA</option>
            <option value="3"<?php if($bd_nivel_escolar == 3){echo" selected ";} ?>>SECUNDARIA</option>
          </select>
          <label for="nivel_escolar">NIVEL ESCOLAR</label>
        </div>
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">turned_in_not</i>
          <select id="acervo" name="acervo" class="browser-default" style="margin-left:180px;" >
            <option value="0"<?php if($bd_acervo == 0){echo" selected ";} ?>>SELECCIONAR</option>
            <option value="1"<?php if($bd_acervo == 1){echo" selected ";} ?>>BIBLIOTECA DE AULA</option>
            <option value="2"<?php if($bd_acervo == 2){echo" selected ";} ?>>BIBLIOTECA ESCOLAR</option>
          </select>
            <label for="acervo">TIPO DE ACERVO</label>
        </div>
        <div class="input-field col s12">
        <hr />
        </div>
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">list</i>
          <select id="grado" name="grado" class="browser-default" style="margin-left:180px;" >
            <option value="0"<?php if($bd_grado == 0){echo" selected ";} ?>>SELECCIONAR</option>
            <option value="1"<?php if($bd_grado == 1){echo" selected ";} ?>>1º</option>
            <option value="2"<?php if($bd_grado == 2){echo" selected ";} ?>>2º</option>
            <option value="3"<?php if($bd_grado == 3){echo" selected ";} ?>>3º</option>
            <option value="4"<?php if($bd_grado == 4){echo" selected ";} ?>>4º</option>
            <option value="5"<?php if($bd_grado == 5){echo" selected ";} ?>>5º</option>
            <option value="6"<?php if($bd_grado == 6){echo" selected ";} ?>>6º</option>
          </select>
          <label for="grado">GRADO ESCOLAR</label>
        </div>
        
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">language</i>
          <select id="lenguaje" name="lenguaje" class="browser-default" style="margin-left:180px;" >
            <option value="0"<?php if($bd_lenguaje == 0){echo" selected ";} ?>>SELECCIONAR</option>
            <option value="99"<?php if($bd_lenguaje ==99){echo" selected ";} ?>>MONOLINGÜE - ESPAÑOL</option>
            <option disabled> ::::::::::::::::::::::: BILINGÜES :::::::::::::::::::::::</option>
            <?php  
			//$iden["idioma"];
			for($i=1; $i <= count($iden["idioma"]); $i++) { if($iden["idioma"][$i]){ ?>
				<option value="<?php echo $i; ?>"<?php if($bd_lenguaje == $i){echo" selected ";} ?>><?php echo $iden["idioma"][$i]; ?></option>
            <?php }} ?>
            	<option disabled> ::::::::::::::::::::::: ESTADOS :::::::::::::::::::::::</option>
            <?php  
			//$iden["estados"];
			$edo_sum = 100;
			for($i=1; $i <= count($iden["estados"]); $i++) { $i_mas = $edo_sum + $i; if($iden["estados"][$i_mas]){ ?>
				<option value="<?php echo $i_mas; ?>"<?php if($bd_lenguaje == $i_mas){echo" selected ";} ?>><?php echo $iden["estados"][$i_mas]; ?></option>
            <?php }} ?>
            </select>
          <label for="lenguaje">LENGUAJE</label>
        </div>
        
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">dns</i>
          <select id="genero" name="genero" class="browser-default" style="margin-left:180px;" >
            <option value="0"<?php if($bd_genero == 0){echo" selected ";} ?>>SELECCIONAR</option>
            <option value="1"<?php if($bd_genero == 1){echo" selected ";} ?>>LITERARIO</option>
            <option value="2"<?php if($bd_genero == 2){echo" selected ";} ?>>INFORMATIVO</option>
            </select>
          <label for="genero">GÉNERO</label>
        </div>
<div class="input-field col s12 m8">
<i class="material-icons prefix">dashboard</i>
    <select id="serie" name="serie" class="browser-default" style="margin-left:180px;" >
            <option value="0"<?php if($bd_serie == 0){echo" selected ";} ?>>SELECCIONAR</option>
    <option value="1"<?php if($bd_serie == 1){echo" selected ";} ?>>Al sol solito</option>
    <option value="2"<?php if($bd_serie == 2){echo" selected ";} ?>>Pasos de luna</option>
    <option value="3"<?php if($bd_serie == 3){echo" selected ";} ?>>Astrolabio</option>
    <option value="4"<?php if($bd_serie == 4){echo" selected ";} ?>>Espejo de urania</option>
    <option value="5"<?php if($bd_serie == 5){echo" selected ";} ?>>Cometas convidados</option>
    </select>
    <label for="serie">SERIE</label>
</div>
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">group_work</i>
          <select id="categoria" name="categoria" class="browser-default" style="margin-left:180px;" >
            <option value="0"<?php if($bd_categoria == 0){echo" selected ";} ?>>SELECCIONAR</option>
            <?php
			//$iden["idioma"];
			for($i=1; $i <= count($iden["categoria"]); $i++) { if($iden["categoria"][$i]){
				 
            	if($i==1 ){ ?>
                <option disabled>:::::::::::: INFORMATIVOS ::::::::::::</option>
				<?php } 
            	if($i==24){ ?>
                <option disabled>:::::::::::: LITERARIOS ::::::::::::</option>
				<?php } 
                if($i==1||$i==24){ ?>
                <option disabled>:::::::::::: Preescolar / 1º - 3º de Primaria</option>
				<?php } 
                if($i==12||$i==35){ ?>
                <option disabled>:::::::::::: 4º - 6º de Primaria / Secundaria</option>
				<?php } ?>
				<option value="<?php echo $i; ?>"<?php if($bd_categoria == $i){echo" selected ";} ?>><?php echo $iden["categoria"][$i]; ?></option>
            <?php }} ?>
          </select>
          <label for="categoria">CATEGORÍA</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">view_day</i>
          <input id="keywords" name="keywords" type="text" value="<?php echo $bd_keywords;?>">
          <label for="keywords">TEMAS / Palabras Clave (Separadas por ,)</label>
        </div>
        <div class="input-field col s12">
          <?php if (file_exists("../portadas_ce/".$bd_isbn.".jpg")) { ?>
          <input  id="isbn" name="isbn"  type="hidden" value="<?php echo $bd_isbn;?>"><strong>ISBN:</strong> <?php echo $bd_isbn;?><br /><br />
          <?php }else{ ?>
          <i class="material-icons prefix">label</i>
          <input id="isbn" name="isbn" type="text" value="<?php echo $bd_isbn;?>" required >
          <label for="isbn">ISBN</label>
          <?php } ?>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">subject</i>
          <input id="resena" name="resena" type="text" value="<?php echo $bd_resena;?>">
          <label for="resena">RESEÑA</label>
        </div>
        
        <div class="col s12 m8">
        <h3><i class="material-icons prefix">view_module</i> PUBLICACIÓN</h3>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">my_location</i>
          <input id="pub_lugar" name="pub_lugar" type="text" value="<?php echo $bd_pub_lugar;?>">
          <label for="pub_lugar">LUGAR</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">print</i>
          <input id="pub_editorial" name="pub_editorial" type="text" value="<?php echo $bd_pub_editorial;?>">
          <label for="pub_editorial">EDITORIAL</label>
        </div>
        
        <div class="row"></div>

    <div class="row" style="margin-left:30px;">
        <h5 style="font-size:14px; color:#999; font-weight:light;"> AÑOS DE PUBLICACIÓN <small>(<?php echo $bd_pub_anios; ?>)</small></h5>
    	<?php 
		$pub_anios_ini = 1986;
		$pub_anios_hoy = date("Y");
		
		$anios_exp = explode(",",$bd_pub_anios); 
		
		function checar_anio ($anio, $anioslist){
			for($ix=0; $ix <= count($anioslist); $ix++) { 
				if($anioslist[$ix] == $anio){
					echo" checked ";
				}
			}
		}
		
		for ($i = $pub_anios_ini; $i <= $pub_anios_hoy; $i++){ ?>
        <div class="chip">
          <input type="checkbox" name="pub_anios_<?php echo $i; ?>" id="pub_anios_<?php echo $i; ?>" value="<?php echo $i; ?>"<?php checar_anio($i,$anios_exp); ?> />
          <label for="pub_anios_<?php echo $i; ?>"><?php echo $i; ?></label>
		</div>
        <?php } ?>
        <div class="row"></div>
    </div>
        
        <div class="input-field col s12">
          <i class="material-icons prefix">info_outline</i>
          <input id="pub_paginas" name="pub_paginas" type="text" value="<?php echo $bd_pub_paginas;?>">
          <label for="pub_paginas">NÚMERO DE PÁGINAS</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">replay</i>
          <input id="pub_edicion" name="pub_edicion" type="text" value="<?php echo $bd_pub_edicion;?>">
          <label for="pub_edicion">NÚMERO DE CATÁLOGO</label>
        </div>




        <div class="input-field col s12 m12 right-align">
        <input name="GUARDAR" type="submit" value="GUARDAR" class="waves-effect waves-light btn pleca_azul" ><br /><br />
        </div>
  </form>


</div>
<!-- END FORMULARIO AGREGAR CONTENIDO -->
  



<div class="regresardiv">
<hr class="col s12" />
<a class="waves-effect waves-light btn" href="index.php"><i class="material-icons right">home</i>Ir al INICIO</a>
</div>
<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
  <script type="text/javascript" src="js/materialize.min.js"></script>
</body>
</html>
<?php 
mysqli_close($enlace);
}
?>