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
//require_once("bd.php");

if($_POST && $_FILES){
$aviso_doc = "";
$f_hoy =  date("Y-m-d H:i:s");
//datos del arhivo /var/www/html/telesecundaria_prog/docs/
$dir_files = "../../assets/programacion_tele/";
$nombre_archivo = $_FILES['documento_pdf']['name']; 
$dir_files_up = $dir_files . $nombre_archivo;
$tipo_archivo = $_FILES['documento_pdf']['type']; 
$tamano_archivo = $_FILES['documento_pdf']['size']; 

if (file_exists($dir_files_up)) {
    $aviso_doc = "ERROR: Ya existe el archivo<br /> " . $nombre_archivo . "";
} else {
//compruebo si las características del archivo son las que deseo 
if (!((strpos($tipo_archivo, "pdf") || strpos($tipo_archivo, "doc")) && ($tamano_archivo < 10000000))) { 
   	$aviso_doc = "Sólo se permiten archivos PDF con un tamaño máximo de 10 Mb."; 
}else{ 
   	if (move_uploaded_file($_FILES['documento_pdf']['tmp_name'], $dir_files_up)){ 
	
      	$aviso_doc = "Archivo cargado correctamente"; 
			// ------------------------------------------------------------------------------------------------
		$insertar = "INSERT INTO ".$tablas_prog." (fecha_update, titulo, url, descripcion, mes, documento, programacion, estatus) VALUES ('" . $f_hoy . "', '".$_POST['nombre_contenido']."', '".$_POST['nombre_url']."', '".$_POST['descripcion']."', '".$_POST['mes']."', '".$nombre_archivo."', '".$_POST['programacion']."', '".$_POST['estatus']."')";
		$insertando = pg_query($enlace,$insertar);
		if($insertando){
			$aviso_doc = $aviso_doc . " y almacenado en DB."; 
		}else{
			$aviso_doc = $aviso_doc . ", pero no pudo guardarse en DB."; 
			//echo $insertar;
			//var_dump($insertar);
		}

		
   	}else{ 
      	$aviso_doc = "Error al subir el fichero."; 
   	} 
} 
}
?>
    <script type="text/javascript">window.addEventListener('load', function(){ Materialize.toast('<?php echo $aviso_doc; ?>', 4000); }, false);</script>
<?php 
}
?>
<h1 style="text-align:center;">Catálogo Libros del Rincón<br>
- Administrador de información-</h1>

<!-- FORMULARIO AGREAGAR CONTENIDO -->
<div class="row">
<h3>AGREGAR NUEVO LIBRO: </h3>
<form class="col s12" action="" method="post" onsubmit="return validate(this);" enctype="multipart/form-data">



<div class="file-field input-field">
  <div class="btn">
    <span>Seleccionar Portada</span>
    <input type="file" name="documento_pdf" id="documento_pdf" required>
  </div>
  <div class="file-path-wrapper">
    <input class="file-path validate browser-default" type="text" placeholder="Selecciona la imágen JPG de la portada para subir al servidor.">
  </div>
</div>



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


<hr class="col s12" />

    <div class="input-field col s12">
          <i class="material-icons prefix">reorder</i>
          <input id="folio" name="folio" type="text" required>
          <label for="folio">FOLIO</label>
    </div>
    <div class="input-field col s12">
          <i class="material-icons prefix">receipt</i>
          <input id="nombre_contenido" name="nombre_contenido" type="text" required>
          <label for="nombre_contenido">TÍTULO</label>
    </div>
    <div class="input-field col s12">
          <i class="material-icons prefix">receipt</i>
          <input id="nombre_contenido22" name="nombre_contenido22" type="text" required>
          <label for="nombre_contenido22">TÍTULO ORIGINAL</label>
    </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">http</i>
          <input id="nombre_url" name="nombre_url" type="text" required>
          <label for="nombre_url">TÍTULO PARA URL</label>
        </div>
    <div class="input-field col s12">
          <i class="material-icons prefix">my_location</i>
          <input id="nombre_contenidorr" name="nombre_contenidorr" type="text" required>
          <label for="nombre_contenidorr">CIUDAD DE ORIGEN</label>
    </div>
    <div class="input-field col s12">
          <i class="material-icons prefix">album</i>
          <input id="nombre_contenidorrrr" name="nombre_contenidorrrr" type="text" required>
          <label for="nombre_contenidorrrr">RAZÓN SOCIAL</label>
    </div>
    <div class="input-field col s12">
          <i class="material-icons prefix">stars</i>
          <input id="nombre_contenidorree" name="nombre_contenidorree" type="text" required>
          <label for="nombre_contenidorree">SELLO EDITORIAL</label>
    </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">perm_identity</i>
          <input id="1" name="1" type="text">
          <label for="1">AUTOR</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">supervisor_account</i>
          <input id="1g" ntraame="1g" type="text">
          <label for="1g">TRADUCTOR</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">label</i>
          <input id="8" name="8" type="text">
          <label for="8">ISBN</label>
        </div>
    <div class="input-field col s12">
          <i class="material-icons prefix">view_module</i>
          <input id="2" name="2" type="text">
          <label for="2">PUBLICACIÓN</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">view_day</i>
          <input id="9" name="9" type="text">
          <label for="9">TEMA</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">subject</i>
          <input id="91" name="91" type="text">
          <label for="91">RESEÑA</label>
        </div>
    <div class="input-field col s12">
          <i class="material-icons prefix">aspect_ratio</i>
          <input id="4" name="4" type="text">
          <label for="4">DESCRIPCIÓN FÍSICA</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">message</i>
          <input id="5" name="5" type="text">
          <label for="5">NOTAS</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">view_carousel</i>
          <input id="5y" name="5y" type="text">
          <label for="5y">NUMERO DE PAGINAS</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">swap_horiz</i>
          <input id="5y" name="5y" type="text">
          <label for="5y">DIMENSIONES</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">mode_edit</i>
          <input id="5y" name="5y" type="text">
          <label for="5y">ILUSTRADO</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">shopping_cart</i>
          <input id="5y" name="5y" type="text">
          <label for="5y">PRECIO</label>
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix">description</i>
          <input id="533" name="533" type="text">
          <label for="533">PALABRAS CLAVE (separadas por ,)</label>
        </div>


        <div class="input-field col s12 m8">
          <i class="material-icons prefix">today</i><label for="5y">TEMAS</label>
          <br /><br />
         <input type="checkbox" class="filled-in" id="filled-in-box1" />
      <label for="filled-in-box1">Tema 1</label>
      
      
         <input type="checkbox" class="filled-in" id="filled-in-box2" />
      <label for="filled-in-box2">Tema 2</label>
      
      
         <input type="checkbox" class="filled-in" id="filled-in-box3" />
      <label for="filled-in-box3">Tema 3</label>

<br /><br />
        </div>


        <div class="input-field col s12 m8">
          <i class="material-icons prefix">today</i>
          <select id="programacion3" name="programacion3" class="browser-default" style="margin-left:180px;" required >
            <option disabled selected>SELECCIONAR</option>
            <option value="1">1986</option>
            <option value="2">1987</option>
            <option value="3">...</option>
            <option value="4">2015</option>
            <option value="5">2016</option>
          </select>
          <label for="programacion3">AÑO DE EDICIÓN</label>
        </div>
<div class="input-field col s12 m8">
<i class="material-icons prefix">dashboard</i>
    <select id="programacion" name="programacion" class="browser-default" style="margin-left:180px;" required >
            <option disabled selected>SELECCIONAR</option>
    <option value="1">Al sol solito - Para los más chiquitos</option>
    <option value="2">Pasos de luna - Para los que empiezan a leer</option>
    <option value="3">Astrolabio - Para los que leen con fluidez</option>
    <option value="4">Espejo de urania - Para los lectores autónomos</option>
    <option value="5">Cometas convidados - Para los lectores de diversas edades</option>
    </select>
    <label for="programacion">SERIE</label>
</div>
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">language</i>
          <select id="programacion4" name="programacion4" class="browser-default" style="margin-left:180px;" required >
            <option disabled selected>SELECCIONAR</option>
            <option value="1">ESPAÑOL</option>
            <option value="2">INGLÉS</option>
            <option value="3">FRANCÉS</option>
            <option value="4">OTOMÍ</option>
            <option value="5">NAHUATL</option>
            <option value="6">...</option>
            </select>
          <label for="programacion4">IDIOMA</label>
        </div>
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">dns</i>
          <select id="programacion5" name="programacion5" class="browser-default" style="margin-left:180px;" required >
            <option disabled selected>SELECCIONAR</option>
            <option value="1">LITERARIO</option>
            <option value="2">INFORMATIVO</option>
            </select>
          <label for="programacion5">GÉNERO</label>
        </div>
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">group_work</i>
          <select id="programacion6" name="programacion6" class="browser-default" style="margin-left:180px;" required >
            <option disabled selected>SELECCIONAR</option>
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
            <option value="2">...</option>
          </select>
          <label for="programacion6">CATEGORÍA</label>
        </div>
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">view_week</i>
          <select id="programacion52" name="programacion52" class="browser-default" style="margin-left:180px;" required >
            <option disabled selected>SELECCIONAR</option>
            <option value="1">I</option>
            <option value="2">II</option>
            <option value="3">III</option>
            <option value="4">IV</option>
            <option value="5">V</option>
            <option value="6">VI</option>
          </select>
          <label for="programacion52">VOLUMEN</label>
        </div>
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">business</i>
          <select id="programacion5" name="programacion5" class="browser-default" style="margin-left:180px;" required >
            <option disabled selected>SELECCIONAR</option>
            <option value="1">PREESCOLAR</option>
            <option value="2">PRIMARIA</option>
            <option value="2">SECUNDARIA</option>
          </select>
          <label for="programacion5">NIVEL ESCOLAR</label>
        </div>
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">list</i>
          <select id="programacion52" name="programacion52" class="browser-default" style="margin-left:180px;" required >
            <option disabled selected>SELECCIONAR</option>
            <option value="1">1º</option>
            <option value="2">2º</option>
            <option value="3">3º</option>
            <option value="4">4º</option>
            <option value="5">5º</option>
            <option value="6">6º</option>
          </select>
          <label for="programacion52">GRADO ESCOLAR</label>
        </div>
        <div class="input-field col s12 m8">
          <i class="material-icons prefix">turned_in_not</i>
          <select id="programacion5" name="programacion5" class="browser-default" style="margin-left:180px;" required >
            <option disabled selected>SELECCIONAR</option>
            <option value="1">BIBLIOTECA DE AULA</option>
            <option value="2">BIBLIOTECA ESCOLAR</option>
          </select>
            <label for="programacion5">BIBLIOTECA</label>
        </div>




















<hr />



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
// mysqli_close($enlace);
?>