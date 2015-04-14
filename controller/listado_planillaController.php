<?php
require_once("model/planillaModel.php");
$lisp=new planillas;
$tp=$lisp->listadoplanilla();
require_once("view/listado_planilla.phtml");
?>