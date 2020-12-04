<?php
unlink('../portadas_ce/'.$_GET["p"]);
header('Location: editar.php?i='.$_GET["i"]);
?>