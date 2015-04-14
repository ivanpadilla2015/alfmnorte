<?php
require_once("model/proveedoresModel.php");
$prov=new proveedores;
$lpro=$prov->listarpro();
require_once("view/listado_proveedores.phtml");
?>