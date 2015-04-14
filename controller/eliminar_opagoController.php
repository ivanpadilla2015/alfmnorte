<?php
if(isset($_POST["numopago"]) && $_POST["numopago"]>0)
{
	
	header("location:".Conectar::ruta()."?accion=eliminar_opago_mostrar&numop=".$_POST["numopago"]);exit;
}
require_once("view/eliminar_opago.phtml");
?>