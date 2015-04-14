<?php
require_once("model/planillaModel.php");
$plc=new planillas;
$lisp=$plc->listadoplanilla();
require_once("view/legalizaplanilla.phtml");
?>