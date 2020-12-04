<?php require_once ("admin/identificadores.php"); ?>
<!DOCTYPE html>
<html>
    <head>

        <meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=7" />
        <meta http-equiv="X-UA-Compatible" content="IE=9" />
        <meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
        <Meta  http-equiv = "X-UA-Compatible"  contenido = "IE = 9; IE = 8; IE = 7"  />
        <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
        <title>Catálogo de Libros del Rincón</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!----- hojas de estilo ------>
        <link href="https://framework-gb.cdn.gob.mx/favicon.ico" rel="shortcut icon">
        <link href="https://framework-gb.cdn.gob.mx/assets/styles/main.css" rel="stylesheet">

        <link href="assets/css/estilos.css" media="all" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <link href="assets/css/animate.css" media="all" rel="stylesheet">
        <script>
      		function buscar_link (t,b,p) {
			      var buscar = "resultados.php?t="+t+"&b="+b+"&p="+p;
			      $('#resultados').load(buscar);
		        }
		  function buscar_form (p,tipo,bus,ini,fin,en,serie,genero,categoria,idioma,acervo,nivel,grado,autor,titulo,temas) {
        if(tipo == "6"){
          var av_nivel= $("#av_nivel").val();
          var buscar_iniN = $("#buscar_iniN").val();
          var buscar_finN = $("#buscar_finN").val();
          var ba = buscar_iniN+","+buscar_finN+","+av_nivel;
          var buscar = "resultados.php?t=6&p="+p+"&b="+ba+"";
      }
      if(tipo == "4"){
				if(!buscar && !ini && !fin && !en){
					var buscar = $("#buscar").val();
					var buscar_ini = $("#buscar_ini").val();
					var buscar_fin = $("#buscar_fin").val();
					var buscar_en = $("#buscar_en").val();

				}else{
					var buscar = bus;
					var buscar_ini = ini;
					var buscar_fin = fin;
					var buscar_en = en;
				}
				var b = buscar_ini + buscar_fin + buscar_en + "" + buscar;
				var buscar = "resultados.php?t=4&p="+p+"&b="+b+"";
			}

			if(tipo == "5"){
				  var av_titulo = $("#av_titulo").val();
					var av_autor= $("#av_autor").val();
					var av_serie= $("#av_serie").val();
					var av_genero= $("#av_genero").val();
					var av_categoria= $("#av_categoria").val();
					var av_idioma= $("#av_idioma").val();
					var av_acervo= $("#av_acervo").val();
					var av_nivel= $("#av_nivelA").val();
					var av_grado= $("#av_grado").val();
					var av_ini= $("#av_ini").val();
					var av_fin= $("#av_fin").val();
				function comprueba(t,a){
          var ti = t;
          var au = a;
          ti= ti.replace(/\s/g,"_");
          av_titulo=ti;
          au= au.replace(/\s/g,"_");
          av_autor=au;
        }
        comprueba(av_titulo,av_autor);
        var ba = av_titulo +"¬"+ av_autor +"¬"+ av_serie +"¬"+ av_genero +"¬"+ av_categoria +"¬"+ av_idioma +"¬"+ av_acervo +"¬"+ av_nivel +"¬"+ av_grado +"¬"+ av_ini +"¬"+ av_fin;
				var buscar = "resultados.php?t=5&p="+p+"&b="+ba+"";
			}
			$('#resultados').load(buscar);
		}
		</script>

      <script src="assets/js/slider.js"></script>
      <script type="text/javascript">
        $(function () {
                $('.scr_top').click(function (e) {
                    e.preventDefault();
                    $('html,body').animate({
                    scrollTop: $('#top').offset().top -90
                    }, 800);
                });
                })
        $(function () {
                $('.scr_nb').click(function (e) {
                    e.preventDefault();
                    $('html,body').animate({
                    scrollTop: $('#resultados').offset().top -90
                    }, 800);
                });
                })
			$(document).ready(function() {
				setTimeout(function() {
					var miscroll = $(window).scrollTop();
					$('html, body').delay(0).animate({scrollTop: miscroll-90}, 0);
				},200);
			});
		function validarn(e) { //
			tecla = (document.all) ? e.keyCode : e.which; //
			if (tecla==8) return true; //
			 if (tecla==9) return true; //
			 if (tecla==11) return true; //
			patron = /[1234567890.,:A-Za-zñÑ'áéíóúÁÉÍÓÚàèìòùÀÈÌÒÙâêîôûÂÊÎÔÛÑñäëïöüÄËÏÖÜ\s\t]/; // 4

			te = String.fromCharCode(tecla); //
			return patron.test(te); //
		}
 </script>
    <style media="screen">
        .sub-navbar .navbar-collapse {
          background-color: #EAEAEA;
        }
    </style>
 </head>
<body><a id="top"></a>
  <!--Navbar -->
  <nav class="navbar navbar-default navbar-dark">
            <div class="container">

                <!-- Navbar Header [collects both toggle button and navbar brand] -->
                <div class="navbar-header">
                    <!-- Toggle Button [handles opening navbar menu on mobile screens]-->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#exampleNavComponents" aria-expanded"false"="">
                        <i class="glyphicon glyphicon-align-center"></i>
                    </button>

                    <!-- Navbar Brand -->
                    <a href="#" class="navbar-brand">
                        Libros del Rincón
                    </a>
                </div>


                <!-- Navbar Collapse [collect navbar components such as navbar links and forms ] -->
                <div class="collapse navbar-collapse" id="exampleNavComponents">

                    <!-- Navbar Links -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="#" class="nav-link waves-effect waves-light"> Conoce tus acervos</a></li>
                        <li><a href="#" class="nav-link waves-effect waves-light">Proceso de selección</a></li>
                        <li><a href="#" class="nav-link waves-effect waves-light">Alumnos</a></li>
                        <li><a href="#" class="nav-link waves-effect waves-light">Docentes</a></li>
                        <li><a href="#" class="nav-link waves-effect waves-light">Archivo histórico</a></li>
                    </ul>
                </div>
            </div>

        </nav>
<div class="container">
   
<div class="vertical-buffer ">

<h3>Catálogo Electrónico</h3>
<hr class="red">





    <div class="row">
  <div class="col-md-12" style="text-align:justify;">
  <img class="img-responsive animated bounceInDown" src="assets/images/ldr.jpg" style="margin:0 auto 10px auto;">
  <p style=" font-family:sans-serif;">El Catálogo de Libros del Rincón es una herramienta de consulta dirigida a todos los interesados en conocer los títulos que conforman esta colección presente en las Bibliotecas de Aula y Bibliotecas Escolares de los planteles de educación básica.</p>
  <hr />

  <ul class="nav nav-tabs">
      <li class="active"><a data-toggle="tab" href="#tab-01">Buscar</a></li>
      <li><a data-toggle="tab" href="#tab-02">Series</a></li>
      <li><a data-toggle="tab" href="#tab-03">BE/BA</a></li>
      <li><a data-toggle="tab" href="#tab-04">A-Z</a></li>
      <li><a data-toggle="tab" href="#tab-06">Nivel</a></li>
      <li><a data-toggle="tab" href="#tab-05">Avanzada</a></li>

  </ul>

    <div class="tab-content">
      <div class="tab-pane active" id="tab-01">
      	<h4>Búsqueda rápida por título, autor o tema</h4>
        <form class="form-horizontal" role="form" id="buscar_normal">
      <div class="form-group">
        <div class="col-sm-8">
          <input class="form-control" id="buscar" name="buscar" placeholder="Buscar" type="text" onkeypress="return validarn(event);" pattern="[1234567890a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,64}" required />
        </div>
      <div class="col-sm-4">
        <select class="form-control" id="buscar_en" name="buscar_en">
          <option value="1">Título</option>
          <option value="2">Autor</option>
          <option value="3">Tema</option>
        </select>
      </div>

      </div>

      <div class="form-group">
        <div class="" style="text-align:center;">
          <strong>Periodo</strong>
        </div>
      </div>

      <p></p>

      <div class="form-group">
        <div class="col-sm-6">
      <select class="form-control" id="buscar_ini" name="buscar_ini">
      <option value="9000" selected="selected">- Cualquier Año</option>
      <?php generaranios(1986, 0); ?>
    </select>
    </div>
      <div class="col-sm-1">
          <div class="" style="text-align:center;">
              <strong>a</strong>
            </div>
      </div>
      <div class="col-sm-5">
    <select class="form-control" id="buscar_fin" name="buscar_fin">
      <option value="9000" selected="selected">&nbsp;</option>
      <?php generaranios(1986, 0); ?>
    </select>


        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <button class="btn btn-primary pull-right scr_nb" type="submit" onClick="buscar_form(1,'4','','','','','','','','','','','','','','');return(false);">Buscar</button>
        </div>
      </div>
    </form>
  </div>
      <div class="tab-pane" id="tab-02"><h4>Series</h4>
      	<div class="row" style="text-align:center; font-size:12px; font-weight:bold">
        <div class="col-md-6">
            <div class=""><a href="#" class="scr_nb" onClick="buscar_link('1',1,1);return(false);"><img src="assets/images/s1_al_sol.png" alt="" /></a>
            <div>Para los más <br />chiquitos</div>
            </div>
             
            <div><a href="#" class="scr_nb" onClick="buscar_link('1',2,1);return(false);"><img src="assets/images/s2_p_luna.png" alt="" /></a>
            <div>Para los que empiezan <br /> a leer</div>
            </div>
         </div>
         <div class="col-md-6">
            <div><a href="#" class="scr_nb" onClick="buscar_link('1',3,1);return(false);"><img src="assets/images/s3_astrol.png" alt="" /></a>
            <div>Para los que leen <br /> con fluidez</div>
            </div>
             
            <div><a href="#" class="scr_nb" onClick="buscar_link('1',4,1);return(false);"><img src="assets/images/s4_espej.png" alt="" /></a>
            <div>Para los lectores <br />autónomos</div>
            </div>
         </div>
         <div class="col-md-12">
            <div><a href="#" class="scr_nb" onClick="buscar_link('1',5,1);return(false);"><img src="assets/images/s5_comet.png" alt="" /></a>
            <div>Para los lectores de <br />diversas edades</div>
            </div>
         </div>
         </div>
      </div>
      <div class="tab-pane" id="tab-03"><h4>BE/BA</h4>
      	<div>
          <a href="#" onClick="buscar_link('2','2',1);return(false);" class="btn btn-default scr_nb">Biblioteca Escolar</a><br /><br /><br />
          <a href="#" onClick="buscar_link('2','1',1);return(false);" class="btn btn-default scr_nb">Biblioteca de Aula</a>
        </div>
      </div>
      <div class="tab-pane" id="tab-04"><h4>A-Z</h4>
      	<div class="abecedario">
        	<a href="#" onClick="buscar_link('3','a',1);return(false);" class="btn btn-default scr_nb">A</a>
        	<a href="#" onClick="buscar_link('3','b',1);return(false);" class="btn btn-default scr_nb">B</a>
        	<a href="#" onClick="buscar_link('3','c',1);return(false);" class="btn btn-default scr_nb">C</a>
        	<a href="#" onClick="buscar_link('3','d',1);return(false);" class="btn btn-default scr_nb">D</a>
        	<a href="#" onClick="buscar_link('3','e',1);return(false);" class="btn btn-default scr_nb">E</a>
        	<a href="#" onClick="buscar_link('3','f',1);return(false);" class="btn btn-default scr_nb">F</a>
        	<a href="#" onClick="buscar_link('3','g',1);return(false);" class="btn btn-default scr_nb">G</a>
        	<a href="#" onClick="buscar_link('3','h',1);return(false);" class="btn btn-default scr_nb">H</a>
        	<a href="#" onClick="buscar_link('3','i',1);return(false);" class="btn btn-default scr_nb">I</a>
        	<a href="#" onClick="buscar_link('3','j',1);return(false);" class="btn btn-default scr_nb">J</a>
        	<a href="#" onClick="buscar_link('3','k',1);return(false);" class="btn btn-default scr_nb">K</a>
        	<a href="#" onClick="buscar_link('3','l',1);return(false);" class="btn btn-default scr_nb">L</a>
        	<a href="#" onClick="buscar_link('3','m',1);return(false);" class="btn btn-default scr_nb">M</a>
        	<a href="#" onClick="buscar_link('3','n',1);return(false);" class="btn btn-default scr_nb">N</a>
        	<a href="#" onClick="buscar_link('3','ñ',1);return(false);" class="btn btn-default scr_nb">Ñ</a>
        	<a href="#" onClick="buscar_link('3','o',1);return(false);" class="btn btn-default scr_nb">O</a>
        	<a href="#" onClick="buscar_link('3','p',1);return(false);" class="btn btn-default scr_nb">P</a>
        	<a href="#" onClick="buscar_link('3','q',1);return(false);" class="btn btn-default scr_nb">Q</a>
        	<a href="#" onClick="buscar_link('3','r',1);return(false);" class="btn btn-default scr_nb">R</a>
        	<a href="#" onClick="buscar_link('3','s',1);return(false);" class="btn btn-default scr_nb">S</a>
        	<a href="#" onClick="buscar_link('3','t',1);return(false);" class="btn btn-default scr_nb">T</a>
        	<a href="#" onClick="buscar_link('3','u',1);return(false);" class="btn btn-default scr_nb">U</a>
        	<a href="#" onClick="buscar_link('3','v',1);return(false);" class="btn btn-default scr_nb">V</a>
        	<a href="#" onClick="buscar_link('3','w',1);return(false);" class="btn btn-default scr_nb">W</a>
        	<a href="#" onClick="buscar_link('3','x',1);return(false);" class="btn btn-default scr_nb">X</a>
        	<a href="#" onClick="buscar_link('3','y',1);return(false);" class="btn btn-default scr_nb">Y</a>
        	<a href="#" onClick="buscar_link('3','z',1);return(false);" class="btn btn-default scr_nb">Z</a>
        </div>
      </div>
     <div class="tab-pane" id="tab-06"><h4>Nivel</h4>
       <form class="form-horizontal" role="form" id="buscar_avanzado">
          <div class="form-group">
            <div class="col-sm-12">
              <select class="form-control" id="av_nivel" name="av_nivel">
                <option value="0">- Cualquiera</option>
                <option value="1">- Preescolar</option>
                <option value="2">- Primaria</option>
                <option value="3">- Secundaria</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-6">
              <select class="form-control" id="buscar_iniN" name="buscar_iniN">
                <option value="9000" selected="selected">- Cualquier Año</option>
                <?php generaranios(1986, 0); ?>
              </select>
            </div>
            <div class="col-sm-1">
              <div class="" style="text-align:center;">
                <strong>a</strong>
              </div>
            </div>
            <div class="col-sm-5">
              <select class="form-control" id="buscar_finN" name="buscar_finN">
                <option value="9000" selected="selected">&nbsp;</option>
                <?php generaranios(1986, 0); ?>
              </select>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-3 col-sm-9">
              <button class="btn btn-primary pull-right scr_nb" type="submit" onClick="buscar_form(1,'6','','','','','','','','','','','','','','');return(false);">Buscar</button>
          </div>
        </div>
       </form>
      </div>
      <div class="tab-pane" id="tab-05">
      	<h4>Búsqueda Avanzada</h4>
      	<form class="form-horizontal" role="form" id="buscar_avanzado">
        <div class="form-group">
        	<div class="col-sm-12" style="text-align:center;">
          		<strong>Título</strong>
      		</div>
            <div class="col-sm-12">
          		<input class="form-control" id="av_titulo" name="av_titulo" placeholder="Título" type="text" onkeypress="return validarn(event);" pattern="[1234567890a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,64}">
        	</div>
        </div>


        <div class="form-group">
        	<div class="col-sm-12" style="text-align:center;">
          		<strong>Autor</strong>
      		</div>
            <div class="col-sm-12">
          		<input class="form-control" id="av_autor" name="av_tautor" placeholder="Autor" type="text" onkeypress="return validarn(event);" pattern="[1234567890a-zA-ZàáâäãåąčćęèéêëėįìíîïłńòóôöõøùúûüųūÿýżźñçčšžÀÁÂÄÃÅĄĆČĖĘÈÉÊËÌÍÎÏĮŁŃÒÓÔÖÕØÙÚÛÜŲŪŸÝŻŹÑßÇŒÆČŠŽ∂ð ,.'-]{3,64}">
        	</div>
        </div>


        <div class="form-group">
        	<div class="col-sm-12" style="text-align:center;">
          		<strong>Serie</strong>
      		</div>
            <div class="col-sm-12">
          		<select class="form-control" id="av_serie" name="av_serie">
                  <option value="0">- Cualquiera</option>
                  <option value="1">- Al Sol Solito</option>
                  <option value="2">- Pasos de Luna</option>
                  <option value="3">- Astrolabio</option>
                  <option value="4">- Espejo de Urania</option>
                  <option value="5">- Cometas Convidados</option>
                </select>
        	</div>
        </div>


        <div class="form-group">
        	<div class="col-sm-12" style="text-align:center;">
          		<strong>Género</strong>
      		</div>
            <div class="col-sm-12">
          		<select class="form-control" id="av_genero" name="av_genero">
                  <option value="0">- Cualquiera</option>
                  <option value="1">- Literiario</option>
                  <option value="2">- Informativo</option>
                </select>
        	</div>
        </div>


        <div class="form-group">
        	<div class="col-sm-12" style="text-align:center;">
          		<strong>Categoría</strong>
      		</div>
            <div class="col-sm-12">
          		<select class="form-control" id="av_categoria" name="av_categoria">
                  <option selected value="100">- Cualquiera</option>
            <?php

for ($i = 1;$i <= count($iden["categoria"]);$i++)
{
    if ($iden["categoria"][$i])
    {

        if ($i == 1)
        { ?>
                <option disabled>:::::::::::: INFORMATIVOS ::::::::::::</option>
				<?php
        }
        if ($i == 24)
        { ?>
                <option disabled>&nbsp;</option>
                <option disabled>:::::::::::: LITERARIOS ::::::::::::</option>
				<?php
        }
        if ($i == 1 || $i == 24)
        { ?>
                <option disabled>:::::::::::: Preescolar / 1º - 3º de Primaria</option>
				<?php
        }
        if ($i == 12 || $i == 35)
        { ?>
                <option disabled>:::::::::::: 4º - 6º de Primaria / Secundaria</option>
				<?php
        } ?>
				<option value="<?php echo $i; ?>">- <?php echo $iden["categoria"][$i]; ?></option>
            <?php
    }
} ?>
                </select>
        	</div>
        </div>


        <div class="form-group">
        	<div class="col-sm-12" style="text-align:center;">
          		<strong>Idioma / Región</strong>
      		</div>
            <div class="col-sm-12">
          		<select class="form-control" id="av_idioma" name="av_idioma">
                  <option value="100">- Cualquiera</option>
                    <option value="0">- MONOLINGÜE - ESPAÑOL</option>
                <option disabled>&nbsp;</option>
                    <option disabled> ::::::::::::::::::::::: BILINGÜES :::::::::::::::::::::::</option>
                    <?php

for ($i = 1;$i <= count($iden["idioma"]);$i++)
{
    if ($iden["idioma"][$i])
    { ?>
                        <option value="<?php echo $i; ?>">- <?php echo $iden["idioma"][$i]; ?></option>
                    <?php
    }
} ?>
                <option disabled>&nbsp;</option>
                        <option disabled> ::::::::::::::::::::::: ESTADOS :::::::::::::::::::::::</option>
                    <?php

$edo_sum = 100;
for ($i = 1;$i <= count($iden["estados"]);$i++)
{
    $i_mas = $edo_sum + $i;
    if ($iden["estados"][$i_mas])
    { ?>
                        <option value="<?php echo $i_mas; ?>">- <?php echo $iden["estados"][$i_mas]; ?></option>
                    <?php
    }
} ?>
                </select>
        	</div>
        </div>


        <div class="form-group">
        	<div class="col-sm-12" style="text-align:center;">
          		<strong>Biblioteca / Acervo</strong>
      		</div>
            <div class="col-sm-12">
          		<select class="form-control" id="av_acervo" name="av_acervo">
                  <option value="0">- Cualquiera</option>
                  <option value="1">- Biblioteca de Aula</option>
                  <option value="2">- Biblioteca Escolar</option>
                </select>
        	</div>
        </div>


        <div class="form-group">
        	<div class="col-sm-12" style="text-align:center;">
          		<strong>Nivel</strong>
      		</div>
            <div class="col-sm-12">
          		<select class="form-control" id="av_nivelA" name="av_nivel">
                  <option value="0">- Cualquiera</option>
                  <option value="1">- Preescolar</option>
                  <option value="2">- Primaria</option>
                  <option value="3">- Secundaria</option>
                </select>
        	</div>
        </div>


        <div class="form-group">
        	<div class="col-sm-12" style="text-align:center;">
          		<strong>Grado</strong>
      		</div>
            <div class="col-sm-12">
          		<select class="form-control" id="av_grado" name="av_grado">
                  <option value="7">- Cualquiera</option>
                  <option value="0">- Sin grado</option>
                  <option value="1">- 1°</option>
                  <option value="2">- 2°</option>
                  <option value="3">- 3°</option>
                  <option value="4">- 4°</option>
                  <option value="5">- 5°</option>
                  <option value="6">- 6°</option>
                </select>
        	</div>
        </div>


        <div class="form-group">
            <div class="" style="text-align:center;">
              <strong>Periodo</strong>
            </div>
        </div>
      <div class="form-group">
        <div class="col-sm-6">
      <select class="form-control" id="av_ini" name="av_ini">
      <option value="9000" selected="selected">- Cualquier Año</option>
      <?php generaranios(1986, 0); ?>
    </select>
    </div>
      <div class="col-sm-1">
          <div class="" style="text-align:center;">
              <strong>a</strong>
            </div>
      </div>
      <div class="col-sm-5">
    <select class="form-control" id="av_fin" name="av_fin">
      <option value="9000" selected="selected"></option>
      <?php generaranios(1986, 0); ?>
    </select>


        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <button class="btn btn-primary pull-right scr_nb" type="submit" onClick="buscar_form(1,'5','','','','','','','','','','','','','','');return(false);">Buscar</button>
        </div>
      </div>
    </form>
      </div>
    </div>

</div>
<!-- INICIA PANEL RESULTADOS -->
  	

    <!-- CONTENIDO -->
    <div class="container animated" >
    <!-- FIN CONTENIDO -->
	</div>
    <script type="text/javascript">
    $(function () {
		    });
	// Fix scroll #seccion
	$(document).ready(function() {
		setTimeout(function() {
			var miscroll = $(window).scrollTop();
			$('html, body').delay(0).animate({scrollTop: miscroll-100}, 800);
		},200);
	});
    </script>
    </div>
</div>

<div>
<div class="col-md-12 ">
  		<div id="resultados"></div>
	</div>
</div>
    <script src="https://framework-gb.cdn.gob.mx/gobmx.js"></script>

    <script type="text/javascript" src="assets/js/slider.js"></script>
</body>

</html>
