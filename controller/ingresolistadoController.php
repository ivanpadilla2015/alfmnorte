<?php
require_once("model/ingresoModel.php");
$li=new Ingreso;
$lis=$li->listadoingreso();
require_once("view/ingresolistado.phtml");
?>