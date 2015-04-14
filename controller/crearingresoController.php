<?php
require_once("model/ingresoModel.php");
$ing=new Ingreso();
//$ca=$ing->calnumin();
$funing=$ing->funciona();
if(isset($_POST["grabar"]) and $_POST["grabar"]="si")
{
	$ing->grabaringre();
}
require_once("view/crearingreso.phtml");
?>