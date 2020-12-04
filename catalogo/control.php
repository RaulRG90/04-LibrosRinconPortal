<?php 
$identificador = $_GET["pagina"];

 if($identificador=="ss"){
    include "templates/header.php";
     include "templates/menu.php";
    include "estudiantes/sistema_sea.php"; 
    include "templates/footer.php";
    $identificador="null";
}elseif($identificador=="c"){
     include "templates/header.php";
     include "templates/menu.php";
    include "estudiantes/cursos.php"; 
    include "templates/footer.php";
    $identificador="null";
}elseif($identificador=="m"){
    include "templates/header.php";
     include "templates/menu.php";
    include "estudiantes/materiales.php"; 
    include "templates/footer.php";
    $identificador="null";
}elseif($identificador=="ntp"){
    include "templates/header.php";
     include "templates/menu.php";
    include "estudiantes/no_ter_pri.php"; 
    include "templates/footer.php";
    $identificador="null";
}elseif($identificador=="asi_estudio"){
     include "templates/header.php";
   include "templates/menu.php";
   include "asi_estudio/menu_asi_estudio.php";
    include "templates/footer.php";
    $identificador="null";
}elseif($identificador==""){
     include "templates/header.php";
    
    include "templates/footer.php";
    $identificador="null";
}elseif($identificador==""){
     include "templates/header.php";
    
    include "templates/footer.php";
    $identificador="null";
}elseif($identificador==""){
     include "templates/header.php";
    
    include "templates/footer.php";
    $identificador="null";
}elseif($identificador==""){
     include "templates/header.php";
    
    include "templates/footer.php";
    $identificador="null";
}elseif($identificador==""){
     include "templates/header.php";
    
    include "templates/footer.php";
    $identificador="null";
}else{
     include "index.php";
 }   
    


?>