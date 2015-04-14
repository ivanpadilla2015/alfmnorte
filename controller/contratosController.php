<?php
require_once("model/contratosModel.php");
$co=new Contratos;
$cvpro=$co->listaprov();
$ctcon=$co->tiposcon();
$cdep=$co->depen();
if(isset($_POST["grabar"] )and $_POST["grabar"]="si" )
{
	
	$co->grabarcontra();exit;
}
require_once("view/contratos.phtml");
?>