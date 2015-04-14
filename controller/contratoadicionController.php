<?php
require_once("model/contratosModel.php");
$cad=new Contratos;
$tcad=$cad->ver_contratoall();
if(isset($_POST["grabar"]) and $_POST["grabar"]="si")
{
	$cad->grabaradicion();exit;
}
require_once("view/contratoadicion.phtml");
?>