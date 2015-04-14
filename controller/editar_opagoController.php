<?php
if(isset($_POST["numopago"]) && $_POST["numopago"]>0)
{
	
	header("location:".Conectar::ruta()."?accion=editar_opago_mostar&numop=".$_POST["numopago"]);exit;
}
require_once("view/editar_opago.phtml");
?>