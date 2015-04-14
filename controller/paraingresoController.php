<?php
require_once("model/planillaModel.php");
$pl=new planillas;
$lisp=$pl->listadoplanilla();
require_once("view/paraingreso.phtml");
?>