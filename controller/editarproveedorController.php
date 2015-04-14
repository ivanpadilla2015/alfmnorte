<?php 
require_once("model/proveedoresModel.php");
$tra=new proveedores;
$datos=$tra->tipoper();
$dator=$tra->tiporete();

$dato=$tra->editarproveedor_por_id($_GET["id"]);

//echo sizeof($dato);exit;
	if (isset($_POST["grabar"]) and $_POST["grabar"]=="si")
	{
		 $tra->edit_proveedor();exit;
	}


require_once("view/editarproveedor.phtml");
?>