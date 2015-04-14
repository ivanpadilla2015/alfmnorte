<?php
if(isset($_POST["numreca"]) && $_POST["numreca"]>0)
{
	header("location:".Conectar::ruta()."?accion=reporte_recajas&idnumr=".$_POST["numreca"]);exit;
}
require_once("view/reporte_recajas_imp.phtml");
?>