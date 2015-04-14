<?php
if(isset($_POST["numpla"]) && $_POST["numpla"]>0)
{
	header("location:".Conectar::ruta()."?accion=reporte_planilla2&idnump=".$_POST["numpla"]);exit;
}
require_once("view/reporte_planilla_imp2.phtml");
?>