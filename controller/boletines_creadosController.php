<?php
require_once("model/boletinesModel.php");
$impbc=new boletin;
$tb=$impbc->seleboletin();
if(isset($_POST["numbol"]) && $_POST["numbol"]>0)
{
	header("location:".Conectar::ruta()."?accion=reporte_boletin_creados&idnumb=".$_POST["numbol"]);exit;
}
require_once("view/boletines_creados.phtml");
?>
