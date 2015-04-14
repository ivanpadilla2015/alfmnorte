<?php
if(isset($_POST["numopago"]) && $_POST["numopago"]>0)
{
	header("location:".Conectar::ruta()."?accion=reporte_orden_pago&idnum=".$_POST["numopago"]);exit;
}
require_once("view/llamar_reporte_opago.phtml");
?>