<?php
if(isset($_POST["numajus"]) && $_POST["numajus"]>0)
{
	header("location:".Conectar::ruta()."?accion=reporte_ajustes&idnuma=".$_POST["numajus"]);exit;
}
require_once("view/reporte_ajustes_imp.phtml");
?>