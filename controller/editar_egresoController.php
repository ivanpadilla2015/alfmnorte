<?php
require_once("model/egresosModel.php");
$egrem=new Egresos;
$ban1=$egrem->listabanco();
$eid=$egrem->egrsospor_id($_GET["nunegr"]);
//print_r($eid);exit;
if (isset($_POST["editar"]) and $_POST["editar"]="si")
{  
   
	$egrem->editar_egreso_id();
	exit;
}

require_once("view/editar_egreso.phtml");
?>