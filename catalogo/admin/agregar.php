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
    <!--<script src="ckeditor/ckeditor.js"></script>
    <script src="js/jquery/2.1.3/jquery.min.js"></script>-->
</head>

<body>
<?php 
require_once("bd.php"); 
require_once("identificadores.php");
require_once("redimensionarjpg.php");

function sanear_string($string){ // funcion eliminada
	
 
    $string = trim($string);
 
    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );
 
    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );
 
    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );
 
    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );
 
    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );
 
    $string = str_replace(
        array('ñ', 'Ñ', 'ç', 'Ç'),
        array('n', 'N', 'c', 'C',),
        $string
    );
 
    //Esta parte se encarga de eliminar cualquier caracter extraño se quitó "."
    $string = str_replace(
        array("¨", "º", "-", "~",
             "#", "@", "|", "!",
             "·", "$", "%", "&", "/",
             "(", ")", "?", "'", "¡",
             "¿", "[", "^", "<code>", "]",
             "+", "}", "{", "¨", "´",
             ">", "< ", ";", ",", ":",
             " ", 
			 "\\", "\""),
        '',
        $string
    );
 
 
    return $string;
}

function poner_guion($url){
	 $url = strtolower($url);
	 //Reemplazamos caracteres especiales latinos
	 $find = array('á','é','í','ó','ú','â','ê','î','ô','û','ã','õ','ç','ñ');
	 $repl = array('a','e','i','o','u','a','e','i','o','u','a','o','c','n');
	 $url = str_replace($find, $repl, $url);
	 //Añadimos los guiones
	 $find = array(' ', '&amp;', '\r\n', '\n','+');
	 $url = str_replace($find, '-', $url);
	 //Eliminamos y Reemplazamos los demas caracteres especiales
	 $find = array('/[^a-z0-9\-&lt;&gt;]/', '/[\-]+/', '/&lt;{^&gt;*&gt;/');
	 $repl = array('', '-', '');
	 $url = preg_replace($find, $repl, $url);
	 
	 $url = substr($url, 0, -4); // Quitar extenxión
	 $url = $url . ".jpg";
	 return $url;
}

if($_POST){
	if($_POST["isbn"]){

$f_hoy =  date("Y-m-d H:i:s");

//$f_id_recurso = $_POST["id_recurso"];
$f_estatus = $_POST["estatus"];

$f_titulo = reemp ($_POST["titulo"]);
$f_titulo_original = reemp ($_POST["titulo_original"]);
$f_autor = reemp ($_POST["autor"]);
$f_ilustrador = reemp ($_POST["ilustrador"]);
$f_traductor = reemp ($_POST["traductor"]);

$f_nivel_escolar = $_POST["nivel_escolar"];
$f_acervo = $_POST["acervo"];
$f_grado = $_POST["grado"];
$f_lenguaje = $_POST["lenguaje"];
$f_genero = $_POST["genero"];
$f_serie = $_POST["serie"];
$f_categoria = $_POST["categoria"];

$f_keywords = reemp ($_POST["keywords"]);
$f_isbn = $_POST["isbn"];
$f_resena = reemp ($_POST["resena"]);

$f_pub_lugar = $_POST["pub_lugar"];
$f_pub_editorial = $_POST["pub_editorial"];

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

$f_pub_paginas = $_POST["pub_paginas"];
$f_pub_edicion = $_POST["pub_edicion"];
$f_fecha_alta = $f_hoy;
$f_fecha_modificacion = $f_hoy;

// -----------------------------------------------------------------------------------
$aviso_doc = "";

$insertar = "INSERT INTO ".$tablas_prog." (estatus, titulo, titulo_original, autor, ilustrador, traductor, nivel_escolar, acervo, grado, lenguaje, genero, serie, categoria, keywords, isbn, resena, pub_lugar, pub_editorial, pub_anios, pub_paginas, pub_edicion, fecha_alta, fecha_modificacion) VALUES ('".$f_estatus."', '".$f_titulo."', '".$f_titulo_original."', '".$f_autor."', '".$f_ilustrador."', '".$f_traductor."', '".$f_nivel_escolar."', '".$f_acervo."', '".$f_grado."', '".$f_lenguaje."', '".$f_genero."', '".$f_serie."', '".$f_categoria."', '".$f_keywords."', '".$f_isbn."', '".$f_resena."', '".$f_pub_lugar."', '".$f_pub_editorial."', '".$f_pub_anios."', '".$f_pub_paginas."', '".$f_pub_edicion."', '".$f_fecha_alta."', '".$f_fecha_modificacion."')";
		$insertando = pg_query($enlace,$insertar);
		if($insertando){
			$guardar_p = true;
			$aviso_doc = $aviso_doc . "Elemento almacenado en BD"; 
		}else{ 
			$guardar_p = false;
			$aviso_doc = $aviso_doc . "El elemento NO pudo guardarse en BD."; 
			//echo $insertar;
			//var_dump($insertar);
		}


// Realizar una consulta MySQL Buscar elementos 1::::::::::::::::::
$query = "SELECT id_recurso, isbn, fecha_modificacion FROM ".$tablas_prog." WHERE isbn = '".$f_isbn."' AND fecha_modificacion = '".$f_fecha_modificacion."'";
$result = pg_query($enlace, $query) or die('Consulta fallida: '.pg_last_error());
// Imprimir los resultados en HTML
while ($registro = pg_fetch_array($result)){	$new_id_recurso = $registro['id_recurso'];	}


if($guardar_p && $_FILES){
	
	$dir_files = "../portadas_ce/";
	//$nombre_archivo = poner_guion($_FILES['img_portada']['name']);
	
	//$dir_files_up = $dir_files . $nombre_archivo;
	$dir_files_up_2 = $dir_files . $new_id_recurso. ".jpg";
	$dir_files_up_2_1 = $dir_files . $new_id_recurso. "_int1.jpg";
	$dir_files_up_2_2 = $dir_files . $new_id_recurso. "_int2.jpg";
	
	$tipo_archivo = $_FILES['img_portada']['type']; 
	$tamano_archivo = $_FILES['img_portada']['size']; 
	
	$tipo_archivo_1 = $_FILES['img_int1']['type']; 
	$tamano_archivo_1 = $_FILES['img_int1']['size']; 
	
	$tipo_archivo_2 = $_FILES['img_int2']['type']; 
	$tamano_archivo_2 = $_FILES['img_int2']['size']; 	
	
	
	
	if (file_exists($dir_files_up_2) && $tamano_archivo < 1) {
		$aviso_doc = $aviso_doc . "<br /> ERROR: Ya existe una portada con el mismo nombre: <br /> " . $f_isbn . ".jpg";
	}else{
		//compruebo si las características del archivo son las que deseo 
		if (!(strpos($tipo_archivo, "jpg") || strpos($tipo_archivo, "jpeg"))) { 
			$aviso_doc = $aviso_doc . "<br /> Sólo se permiten archivos \"jpg\"."; 
		//}elseif($tamano_archivo > 1000000){$aviso_doc = $aviso_doc . "<br /> Sólo se permiten archivos con un tamaño máximo de 1 Mb."; 
		}else{ 
			if(redimg ($_FILES['img_portada']['tmp_name'], 400, 600, 70, $dir_files_up_2)){ 
				$aviso_doc = $aviso_doc . "<br /> Portada guardada correctamente."; 
			}else{
				$aviso_doc = $aviso_doc . "<br /> ERROR al guardar el archivo de portada."; 
			}
		}
	
	}






	if (file_exists($dir_files_up_2_1) && $tamano_archivo_1 < 1) {
		$aviso_doc = $aviso_doc . "<br /> ERROR: Ya existe una página interior 1 con el mismo nombre: <br /> " . $f_isbn . "_int1.jpg";
	}else{
		//compruebo si las características del archivo son las que deseo 
		if (!(strpos($tipo_archivo_1, "jpg") || strpos($tipo_archivo_1, "jpeg"))) { 
			$aviso_doc = $aviso_doc . "<br /> Sólo se permiten archivos \"jpg\"."; 
		//}elseif($tamano_archivo > 1000000){$aviso_doc = $aviso_doc . "<br /> Sólo se permiten archivos con un tamaño máximo de 1 Mb."; 
		}else{ 
			if(redimg ($_FILES['img_int1']['tmp_name'], 400, 600, 70, $dir_files_up_2_1)){ 
				$aviso_doc = $aviso_doc . "<br /> Página interior 1 guardada correctamente."; 
			}else{
				$aviso_doc = $aviso_doc . "<br /> ERROR al guardar el archivo de página interior 1."; 
			}
		}
	
	}





	if (file_exists($dir_files_up_2_2) && $tamano_archivo_2 < 1) {
		$aviso_doc = $aviso_doc . "<br /> ERROR: Ya existe una página interior 2 con el mismo nombre: <br /> " . $f_isbn . "_int2.jpg";
	}else{
		//compruebo si las características del archivo son las que deseo 
		if (!(strpos($tipo_archivo_2, "jpg") || strpos($tipo_archivo_2, "jpeg"))) { 
			$aviso_doc = $aviso_doc . "<br /> Sólo se permiten archivos \"jpg\"."; 
		//}elseif($tamano_archivo > 1000000){$aviso_doc = $aviso_doc . "<br /> Sólo se permiten archivos con un tamaño máximo de 1 Mb."; 
		}else{ 
			if(redimg ($_FILES['img_int2']['tmp_name'], 400, 600, 70, $dir_files_up_2_2)){ 
				$aviso_doc = $aviso_doc . "<br /> Página interior 2 guardada correctamente."; 
			}else{
				$aviso_doc = $aviso_doc . "<br /> ERROR al guardar el archivo de página interior 2."; 
			}
		}
	
	}





}

?> <script type="text/javascript">window.addEventListener('load', function(){ Materialize.toast('<?php echo $aviso_doc; ?>', 4000); }, false);</script><?php 
}}

?>
<h1 style="text-align:center;">Catálogo Libros del Rincón<br>
- Administrador de información-</h1>

<div class="regresardiv">
<a class="waves-effect waves-light btn" href="index.php"><i class="material-icons right">home</i>Ir al INICIO</a>
<hr class="col s12" />
</div>

<!-- FORMULARIO AGREAGAR CONTENIDO -->
<div class="row">
<h3>AGREGAR NUEVO LIBRO: </h3>
<form class="col s12" role="form" action="" method="post" onsubmit="return validate(this);" enctype="multipart/form-data">



<!--<div class="file-field input-field">
  <div class="btn">
    <span>Portada</span>
    <input type="file" name="img_portada" id="img_portada">
  </div>
  <div class="file-path-wrapper">
    <input class="file-path validate browser-default" type="text" placeholder="Selecciona la imágen 'JPG' de la portada.">
  </div>
</div>

<div class="file-field input-field">
  <div class="btn">
    <span>Interior 1</span>
    <input type="file" name="img_int1" id="img_int1">
  </div>
  <div class="file-path-wrapper">
    <input class="file-path validate browser-default" type="text" placeholder="Selecciona interior 1.">
  </div>
</div>

<div class="file-field input-field">
  <div class="btn">
    <span>Interior 2</span>
    <input type="file" name="img_int2" id="img_int2">
  </div>
  <div class="file-path-wrapper">
    <input class="file-path validate browser-default" type="text" placeholder="Selecciona interior 2.">
  </div>
</div>-->



<div class="col s12 m8">
<h3><i class="material-icons">offline_pin</i> Estatus</h3>

<!-- Switch  -->
  <div class="switch">
    <label>
      Oculto
      <input type="checkbox" name="estatus" id="estatus">
      <span class="lever"></span>
      Publicado
    </label>
  </div>
</div>

<hr class="col s12" />

    <div class="input-field col s12">
          <i class="material-icons prefix">receipt</i>
          <input id="titulo" name="titulo" type="text" required >
          <label for="titulo">TÍTULO</label>
    </div>
    <div class="input-field col s12">
          <i class="material-icons prefix">receipt</i>
          <input id="titulo_original" name="titulo_original" type="text" >
          <label for="titulo_original">TÍTULO ORIGINAL</label>
    </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">perm_identity</i>
          <input id="autor" name="autor" type="text">
          <label for="autor">AUTOR</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">edit_mode</i>
          <input id="ilustrador" name="ilustrador" type="text">
          <label for="ilustrador">ILUSTRADOR</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">supervisor_account</i>
          <input id="traductor" name="traductor" type="text">
          <label for="traductor">TRADUCTOR</label>
        </div>
        
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">business</i>
          <select id="nivel_escolar" name="nivel_escolar" class="browser-default" style="margin-left:180px;"  >
            <option value="0" selected>SELECCIONAR</option>
            <option value="1">PREESCOLAR</option>
            <option value="2">PRIMARIA</option>
            <option value="3">SECUNDARIA</option>
          </select>
          <label for="nivel_escolar">NIVEL ESCOLAR</label>
        </div>
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">turned_in_not</i>
          <select id="acervo" name="acervo" class="browser-default" style="margin-left:180px;"  >
            <option value="0" selected>SELECCIONAR</option>
            <option value="1">BIBLIOTECA DE AULA</option>
            <option value="2">BIBLIOTECA ESCOLAR</option>
          </select>
            <label for="acervo">TIPO DE ACERVO</label>
        </div>
        <div class="input-field col s12">
        <hr />
        </div>
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">list</i>
          <select id="grado" name="grado" class="browser-default" style="margin-left:180px;"  >
            <option value="0" selected>SELECCIONAR</option>
            <option value="1">1º</option>
            <option value="2">2º</option>
            <option value="3">3º</option>
            <option value="4">4º</option>
            <option value="5">5º</option>
            <option value="6">6º</option>
          </select>
          <label for="grado">GRADO ESCOLAR</label>
        </div>
        
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">language</i>
          <select id="lenguaje" name="lenguaje" class="browser-default" style="margin-left:180px;"  >
            <option value="0" selected>SELECCIONAR</option>
            <option value="99">MONOLINGÜE - ESPAÑOL</option>
            <option disabled> ::::::::::::::::::::::: BILINGÜES :::::::::::::::::::::::</option>
            <?php  
			//$iden["idioma"];
			for($i=1; $i <= count($iden["idioma"]); $i++) { if($iden["idioma"][$i]){ ?>
				<option value="<?php echo $i; ?>"><?php echo $iden["idioma"][$i]; ?></option>
            <?php }} ?>
            	<option disabled> ::::::::::::::::::::::: ESTADOS :::::::::::::::::::::::</option>
            <?php  
			//$iden["estados"];
			$edo_sum = 100;
			for($i=1; $i <= count($iden["estados"]); $i++) { $i_mas = $edo_sum + $i; if($iden["estados"][$i_mas]){ ?>
				<option value="<?php echo $i_mas; ?>"><?php echo $iden["estados"][$i_mas]; ?></option>
            <?php }} ?>
            </select>
          <label for="lenguaje">LENGUAJE</label>
        </div>
        
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">dns</i>
          <select id="genero" name="genero" class="browser-default" style="margin-left:180px;"  >
            <option value="0" selected>SELECCIONAR</option>
            <option value="1">LITERARIO</option>
            <option value="2">INFORMATIVO</option>
            </select>
          <label for="genero">GÉNERO</label>
        </div>
<div class="input-field col s12 m8">
<i class="material-icons prefix">dashboard</i>
    <select id="serie" name="serie" class="browser-default" style="margin-left:180px;"  >
            <option value="0" selected>SELECCIONAR</option>
    <option value="1">Al sol solito</option>
    <option value="2">Pasos de luna</option>
    <option value="3">Astrolabio</option>
    <option value="4">Espejo de urania</option>
    <option value="5">Cometas convidados</option>
    </select>
    <label for="serie">SERIE</label>
</div>
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">group_work</i>
          <select id="categoria" name="categoria" class="browser-default" style="margin-left:180px;"  >
            <option value="0" selected>SELECCIONAR</option>
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
				<option value="<?php echo $i; ?>"><?php echo $iden["categoria"][$i]; ?></option>
            <?php }} ?>
            <!--
            <option value="1" disabled>LITERARIO</option>
            <option value="2" disabled>PREESCOLAR 1º - 3º</option>
            <option value="1">LA NATURALEZA</option>
            <option value="2">EL CUERPO</option>
            <option value="1">...</option>
            <option value="2">...</option>
            <option value="1" disabled>4º - 6º PRIMARIA / SECUNDARIA</option>
            <option value="2">INFORMATIVO</option>
            <option value="1">LITERARIO</option>
            <option value="2" disabled>INFORMATIVO</option>
            <option value="1" disabled>PREESCOLAR 1º - 3º</option>
            <option value="2">...</option>
            <option value="1">...</option>
            <option value="2" disabled>4º - 6º PRIMARIA / SECUNDARIA</option>
            <option value="1">...</option>
            <option value="2">...</option> -->
          </select>
          <label for="categoria">CATEGORÍA</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">view_day</i>
          <input id="keywords" name="keywords" type="text">
          <label for="keywords">TEMAS / Palabras Clave (Separadas por ,)</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">label</i>
          <input id="isbn" name="isbn" type="text" required >
          <label for="isbn">ISBN</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">subject</i>
          <input id="resena" name="resena" type="text">
          <label for="resena">RESEÑA</label>
        </div>
        
        <div class="col s12 m8">
        <h3><i class="material-icons prefix">view_module</i> PUBLICACIÓN</h3>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">my_location</i>
          <input id="pub_lugar" name="pub_lugar" type="text">
          <label for="pub_lugar">LUGAR</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">print</i>
          <input id="pub_editorial" name="pub_editorial" type="text">
          <label for="pub_editorial">EDITORIAL</label>
        </div>
        
        <div class="row"></div>

    <div class="row" style="margin-left:30px;">
        <h5 style="font-size:14px; color:#999; font-weight:light;"> AÑOS DE PUBLICACIÓN</h5>
    	<?php 
		$pub_anios_ini = 1986;
		$pub_anios_hoy = date("Y");
		for ($i = $pub_anios_ini; $i <= $pub_anios_hoy; $i++){ ?>
        <div class="chip">
          <input type="checkbox" name="pub_anios_<?php echo $i; ?>" id="pub_anios_<?php echo $i; ?>" value="<?php echo $i; ?>" />
          <label for="pub_anios_<?php echo $i; ?>"><?php echo $i; ?></label>
		</div>
        <?php } ?>
        <div class="row"></div>
    </div>
        
        <div class="input-field col s12">
          <i class="material-icons prefix">info_outline</i>
          <input id="pub_paginas" name="pub_paginas" type="text">
          <label for="pub_paginas">NÚMERO DE PÁGINAS</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">replay</i>
          <input id="pub_edicion" name="pub_edicion" type="text">
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
?>