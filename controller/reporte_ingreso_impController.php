<?php
if(isset($_POST["numing"]) && $_POST["numing"]>0)
{
	header("location:".Conectar::ruta()."?accion=reporte_ingreso&idnumi=".$_POST["numing"]);exit;
}
require_once("view/reporte_ingreso_imp.phtml");
?>