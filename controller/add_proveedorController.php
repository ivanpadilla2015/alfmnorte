<?php 
require_once("model/proveedoresModel.php");
$pe=new proveedores;
$datos=$pe->tipoper();
$dator=$pe->tiporete();
if (isset($_POST["grabar"]) and $_POST["grabar"]=="si")
{
	     $pe->add_provee();
	     exit;
}
require_once("view/add_proveedor.phtml");
?>