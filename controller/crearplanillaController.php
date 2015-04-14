<?php
require_once("model/planillaModel.php");
$pla=new planillas;
//$capl=$pla->calnumpla();
$capl=$pla->ultima_numpla();
if(isset($_POST["grabar"]) and $_POST["grabar"]="si")
{
	$pla->addplanilla();exit;
}
require_once("view/crearplanilla.phtml");
?>