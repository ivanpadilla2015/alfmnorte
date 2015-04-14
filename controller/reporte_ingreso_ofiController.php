<?php
if(isset($_POST["numing"]) && $_POST["numing"]>0)
{
	header("location:".Conectar::ruta()."?accion=reporte_ingreso2&idnumi=".$_POST["numing"]);exit;
}
require_once("view/reporte_ingreso_ofi.phtml");
?>