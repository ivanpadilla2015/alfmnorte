<?php 
require_once("model/proveedoresModel.php");
$p=new proveedores;
$datos=$p->listarpro();
require_once("view/proveedores.phtml");
?>